<?php
namespace App\Http\Controllers;

use App\Models\Album;

class AlbumController extends Controller
{
    public function memberCatalog()
    {
        $albums = Album::with([
            'variants',
            'members',
        ])->get();

        return view('pages.member.catalog', compact('albums'));
    }

    public function showFormPembelian(Album $album)
    {
        $album->load([
            'variants',
            'members',
        ]);

        return response()->json($album);
    }
}
