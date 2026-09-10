<?php

namespace App\Services;

use App\Models\Campaign;
use Illuminate\Support\Collection;

class CampaignEvaluator
{
    public function findBestCampaign(Collection $items, float $subtotal): array
    {
        $campaigns = Campaign::with([
            'categoryDiscount',
            'orderTotalDiscount',
            'buyXPayY',
        ])
            ->where('is_active', true)
            ->where(function ($query) {
                $query->whereNull('starts_at')
                    ->orWhere('starts_at', '<=', now());
            })
            ->where(function ($query) {
                $query->whereNull('ends_at')
                    ->orWhere('ends_at', '>=', now());
            })
            ->get();

        $bestCampaign = null;
        $bestDiscount = 0;

        foreach ($campaigns as $campaign) {
            $discount = match ($campaign->type) {
                'category_discount' =>
                    $this->calculateCategoryDiscount($campaign, $items),

                'order_total_discount' =>
                    $this->calculateOrderTotalDiscount($campaign, $subtotal),

                'buy_x_pay_y' =>
                    $this->calculateBuyXPayYDiscount($campaign, $items),

                default => 0,
            };

            if ($discount > $bestDiscount) {
                $bestDiscount = $discount;
                $bestCampaign = $campaign;
            }
        }

        return [
            'campaign' => $bestCampaign,
            'discount_amount' => round($bestDiscount, 2),
        ];
    }

    private function calculateCategoryDiscount(
        Campaign $campaign,
        Collection $items
    ): float {
        $detail = $campaign->categoryDiscount;

        if (!$detail) {
            return 0;
        }

        $eligibleTotal = $items
            ->filter(function ($item) use ($detail) {
                return $item['product']->category_id == $detail->category_id;
            })
            ->sum(function ($item) {
                return $item['product']->list_price * $item['quantity'];
            });

        return $eligibleTotal * ($detail->discount_percentage / 100);
    }

    private function calculateOrderTotalDiscount(
        Campaign $campaign,
        float $subtotal
    ): float {
        $detail = $campaign->orderTotalDiscount;

        if (!$detail) {
            return 0;
        }

        if ($subtotal < $detail->min_order_amount) {
            return 0;
        }

        return $subtotal * ($detail->discount_percentage / 100);
    }

    private function calculateBuyXPayYDiscount(
        Campaign $campaign,
        Collection $items
    ): float {
        $detail = $campaign->buyXPayY;

        if (!$detail) {
            return 0;
        }

        $item = $items->first(function ($item) use ($detail) {
            return $item['product']->id == $detail->product_id;
        });

        if (!$item) {
            return 0;
        }

        $quantity = $item['quantity'];

        if ($quantity < $detail->buy_quantity) {
            return 0;
        }

        $freePerGroup =
            $detail->buy_quantity - $detail->pay_quantity;

        $groupCount = intdiv(
            $quantity,
            $detail->buy_quantity
        );

        $freeQuantity = $groupCount * $freePerGroup;

        $freeQuantity = min(
            $freeQuantity,
            $detail->max_free_quantity
        );

        return $freeQuantity * $item['product']->list_price;
    }
}