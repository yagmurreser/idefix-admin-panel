<?php

namespace Database\Seeders;

use App\Models\Campaign;
use App\Models\CategoryDiscountCampaign;
use App\Models\OrderTotalDiscountCampaign;
use App\Models\BuyXPayYCampaign;
use Illuminate\Database\Seeder;

class CampaignSeeder extends Seeder
{
    public function run(): void
    {
        $categoryCampaign = Campaign::updateOrCreate(
            ['name' => 'Roman Kategorisinde %20 İndirim'],
            [
                'type' => 'category_discount',
                'is_active' => true,
                'starts_at' => null,
                'ends_at' => null,
            ]
        );

        CategoryDiscountCampaign::updateOrCreate(
            ['campaign_id' => $categoryCampaign->id],
            [
                'category_id' => 1,
                'discount_percentage' => 20,
            ]
        );

        $orderTotalCampaign = Campaign::updateOrCreate(
            ['name' => '100 TL Üzeri %10 İndirim'],
            [
                'type' => 'order_total_discount',
                'is_active' => true,
                'starts_at' => null,
                'ends_at' => null,
            ]
        );

        OrderTotalDiscountCampaign::updateOrCreate(
            ['campaign_id' => $orderTotalCampaign->id],
            [
                'min_order_amount' => 100,
                'discount_percentage' => 10,
            ]
        );

        $buyXPayYCampaign = Campaign::updateOrCreate(
            ['name' => '2 Al 1 Öde'],
            [
                'type' => 'buy_x_pay_y',
                'is_active' => true,
                'starts_at' => null,
                'ends_at' => null,
            ]
        );

        BuyXPayYCampaign::updateOrCreate(
            ['campaign_id' => $buyXPayYCampaign->id],
            [
                'product_id' => 1,
                'buy_quantity' => 2,
                'pay_quantity' => 1,
                'max_free_quantity' => 1,
            ]
        );
    }
}