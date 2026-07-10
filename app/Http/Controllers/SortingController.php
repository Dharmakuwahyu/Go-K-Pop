<?php
namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Order;
use App\Models\SortingResult;
use App\Models\SortingSession;
use App\Services\MemberSortingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SortingController extends Controller
{
    public function adminSortingPc()
    {
        $processingAlbumIds = SortingSession::where('status', 'processing')
            ->pluck('album_id')
            ->toArray();

        $closedAlbumIds = SortingSession::where('status', 'closed')
            ->pluck('album_id');

        $albums = Order::with('album')
            ->where('status', 'dp1_confirmed')
            ->whereHas('dp1Payment')
            ->whereNotIn('album_id', $closedAlbumIds)
            ->get()
            ->pluck('album')
            ->unique('id')
            ->values();

        $albums->each(function ($album) use ($processingAlbumIds) {
            $album->is_processing = in_array($album->id, $processingAlbumIds);
        });

        // Ambil semua sesi sorting yang sudah selesai (closed)
        // Nantinya akan ditampilkan pada tabel Riwayat Sorting
        $sortingSessions = SortingSession::with('album')
            ->where('status', 'closed')
            ->latest('created_at')
            ->get();

        return view('pages.admin.sorting', compact('albums', 'sortingSessions'));
    }

    public function getAlbumData(Album $album)
    {
        $orders = Order::with([
            'priorities' => function ($query) {
                $query->orderBy('priority');
            },
            'dp1Payment',
        ])
            ->where('album_id', $album->id)
            ->where('status', 'dp1_confirmed')
            ->whereHas('dp1Payment')
            ->get()
            ->sortBy(function ($order) {
                return $order->dp1Payment->uploaded_at;
            })
            ->values();

        $members = $orders
            ->flatMap(function ($order) {
                return $order->priorities;
            })
            ->pluck('member_name')
            ->unique()
            ->sort()
            ->values();

        return response()->json([
            'members' => $members,
            'orders'  => $orders,
        ]);
    }

    public function processSorting(Request $request)
    {
        $request->validate([
            'album_id' => 'required|exists:albums,id',
            'members'  => 'required|array',
        ]);

        $orders = Order::with([
            'album',
            'priorities' => function ($query) {
                $query->orderBy('priority');
            },
            'dp1Payment',
        ])
            ->where('album_id', $request->album_id)
            ->where('status', 'dp1_confirmed')
            ->whereHas('dp1Payment')
            ->get()
            ->sortBy(function ($order) {
                return $order->dp1Payment->uploaded_at;
            })
            ->values();

        // Pengaman kalau ternyata tidak ada order
        if ($orders->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Belum ada peserta yang memenuhi syarat untuk sorting.',
            ], 422);
        }

        $album = $orders->first()->album;

        $session = SortingSession::where('album_id', $album->id)
            ->where('status', 'processing')
            ->latest('created_at')
            ->first();

        if (! $session) {
            $session = SortingSession::create([
                'album_id'   => $album->id,
                'title'      => 'Sorting ' . $album->group_name . ' - ' . $album->title,
                'status'     => 'processing',
                'created_by' => Auth::user()->profile->id,
            ]);
        }

        $service = new MemberSortingService();

        $result = $service->sort(
            $orders,
            $request->members
        );

        return response()->json([
            'success'    => true,
            'session_id' => $session->id,
            'result'     => $result,
        ]);
    }

    public function saveSorting(Request $request)
    {
        $request->validate([
            'session_id' => 'required|exists:sorting_sessions,id',
            'result'     => 'required|array',
        ]);

        $session = SortingSession::findOrFail($request->session_id);

        if ($session->status === 'closed') {
            return response()->json([
                'success' => false,
                'message' => 'Hasil sorting sudah pernah disimpan.',
            ], 422);
        }

        foreach ($request->result as $item) {

            if ($item['member'] == '-') {
                continue;
            }

            SortingResult::create([
                'session_id'      => $session->id,
                'order_id'        => $item['order_id'],
                'assigned_member' => $item['member'],
            ]);
        }

        $session->update([
            'status' => 'closed',
        ]);

        return response()->json([
            'success' => true,
        ]);
    }
}
