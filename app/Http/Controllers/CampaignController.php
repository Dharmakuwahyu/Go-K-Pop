<?php
namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\AlbumMember;
use App\Models\AlbumVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CampaignController extends Controller
{
    public function adminCampaign()
    {
        $albums = Album::with(['variants', 'members'])->get();

        return view('pages.admin.campaign', compact('albums'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'group_name'  => 'required|string|max:255',
            'title'       => 'required|string|max:255',
            'price'       => 'required|integer',
            'slots'       => 'required|integer',
            'album_cover' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'variants'    => 'required|array',
            'variants.*'  => 'string',
            'members'     => 'required|array',
            'members.*'   => 'string',
        ], [
            'album_cover.image'   => 'File harus berupa gambar.',
            'album_cover.mimes'   => 'Format gambar harus JPG, JPEG, PNG, atau WEBP.',
            'album_cover.max'     => 'Ukuran gambar maksimal 2MB.',
            'group_name.required' => 'Kolom input wajib diisi',
            'title.required'      => 'Kolom input wajib diisi',
            'price.required'      => 'Kolom input wajib diisi',
            'slots.required'      => 'Kolom input wajib diisi',
            'variants.required'   => 'Kolom input wajib diisi',
            'members.required'    => 'Kolom input wajib diisi',
        ]);

        // upload cover
        $imageName = null;

        if ($request->hasFile('album_cover')) {

            $imageName = $request
                ->file('album_cover')
                ->hashName();

            $request
                ->file('album_cover')
                ->storeAs(
                    'albums',
                    $imageName,
                    'public'
                );
        }

        // insert album
        $album = Album::create([

            'group_name'  => $request->group_name,
            'title'       => $request->title,
            'price'       => $request->price,
            'total_slots' => $request->slots,
            'slots_left'  => $request->slots,
            'image_url'   => $imageName,
            'created_by'  => null,

            // status biarkan default database
        ]);

        // insert variants
        foreach ($request->variants ?? [] as $variant) {

            AlbumVariant::create([
                'album_id' => $album->id,
                'name'     => $variant,
            ]);

        }

        // insert members
        foreach ($request->members ?? [] as $member) {

            AlbumMember::create([
                'album_id' => $album->id,
                'name'     => $member,
            ]);

        }

        return redirect()
            ->back()
            ->with(
                'success',
                'Campaign berhasil dibuat.'
            );
    }

    public function update(Request $request, Album $album)
    {
        $validator = Validator::make($request->all(), [
            'group_name'  => 'required|string|max:255',
            'title'       => 'required|string|max:255',
            'price'       => 'required|integer',
            'slots'       => 'required|integer',
            'album_cover' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'variants'    => 'required|array',
            'variants.*'  => 'string',
            'members'     => 'required|array',
            'members.*'   => 'string',
        ], [
            'album_cover.image'   => 'File harus berupa gambar.',
            'album_cover.mimes'   => 'Format gambar harus JPG, JPEG, PNG, atau WEBP.',
            'album_cover.max'     => 'Ukuran gambar maksimal 2MB.',
            'group_name.required' => 'Kolom input wajib diisi',
            'title.required'      => 'Kolom input wajib diisi',
            'price.required'      => 'Kolom input wajib diisi',
            'slots.required'      => 'Kolom input wajib diisi',
            'variants.required'   => 'Kolom input wajib diisi',
            'members.required'    => 'Kolom input wajib diisi',
        ]);

        if ($validator->fails()) {

            return back()
                ->withErrors(
                    $validator,
                    'updateCampaign'
                )
                ->withInput()
                ->with(
                    'editing_album_id',
                    $album->id
                );
        }

        // update cover jika ada
        if ($request->hasFile('album_cover')) {
            if ($album->image_url) {
                Storage::disk('public')
                    ->delete('albums/' . $album->image_url);
            }

            $imageName = $request
                ->file('album_cover')
                ->hashName();

            $request
                ->file('album_cover')
                ->storeAs(
                    'albums',
                    $imageName,
                    'public'
                );

            $album->image_url = $imageName;
        }

        // update album
        $album->group_name  = $request->group_name;
        $album->title       = $request->title;
        $album->price       = $request->price;
        $album->total_slots = $request->slots;

        $album->save();

        // update variants
        $album->variants()->delete();
        foreach ($request->variants as $variant) {
            AlbumVariant::create([
                'album_id' => $album->id,
                'name'     => $variant,
            ]);
        }

        // update members
        $album->members()->delete();
        foreach ($request->members as $member) {
            AlbumMember::create([
                'album_id' => $album->id,
                'name'     => $member,
            ]);
        }

        return redirect()
            ->back()
            ->with(
                'success',
                'Campaign berhasil diperbarui.'
            );
    }

}
