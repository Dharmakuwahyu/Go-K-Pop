<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\MemberSortingService;
use Illuminate\Http\Request;

class SortingController extends Controller
{
    public function adminSortingPc()
    {
        $orders = Order::with([
            'priorities' => function ($query) {
                $query->orderBy('priority');
            },
            'dp1Payment',
        ])
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

        return view('pages.admin.sorting', compact('members', 'orders'));
    }

    public function processSorting(Request $request)
    {
        $orders = Order::with([
            'priorities' => function ($query) {
                $query->orderBy('priority');
            },
            'dp1Payment',
        ])
            ->where('status', 'dp1_confirmed')
            ->whereHas('dp1Payment')
            ->get()
            ->sortBy(function ($order) {
                return $order->dp1Payment->uploaded_at;
            })
            ->values();

        $service = new MemberSortingService();
        $result  = $service->sort(
            $orders,
            $request->members
        );

        return response()->json([
            'success' => true,
            'result'  => $result,
        ]);
    }
}
