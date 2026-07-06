<?php
namespace App\Services;

class MemberSortingService
{
    public function sort($orders, $quotas)
    {
        $results = [];

        foreach ($orders as $order) {

            $assigned = false;

            // Coba Prioritas 1 → 2 → 3
            foreach ($order->priorities as $priority) {

                $member = $priority->member_name;

                if (($quotas[$member] ?? 0) <= 0) {
                    continue;
                }

                $results[] = [
                    'order_id'   => $order->id,
                    'buyer'      => $order->buyer_name,
                    'member'     => $member,
                    'priority'   => $priority->priority,
                    'uploaded_at' => $order->dp1Payment->uploaded_at,
                ];

                $quotas[$member]--;

                $assigned = true;

                // berhenti karena sudah mendapat member
                break;
            }

            // Tidak mendapat member sama sekali
            if (! $assigned) {

                $results[] = [
                    'order_id'   => $order->id,
                    'buyer'      => $order->buyer_name,
                    'member'     => '-',
                    'priority'   => null,
                    'created_at' => $order->created_at,
                ];

            }

        }

        return $results;
    }
}
