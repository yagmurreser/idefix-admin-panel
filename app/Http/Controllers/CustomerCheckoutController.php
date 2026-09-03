<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use Illuminate\Http\Request;
use RuntimeException;

class CustomerCheckoutController extends Controller
{
    public function store(
        Request $request,
        OrderService $orderService
    ) {
        $user = $request->user();

        if (!$user || !$user->isCustomer()) {
            abort(403, 'Bu işlem yalnızca müşteriler tarafından yapılabilir.');
        }

        $cart = session()->get('cart', []);

        try {
            $order = $orderService->create(
                $user,
                $cart
            );
        } catch (RuntimeException $exception) {
            return redirect()
                ->route('customer.cart.index')
                ->withErrors([
                    'order' => $exception->getMessage(),
                ]);
        }

        session()->forget('cart');

        return redirect()
            ->route(
                'customer.orders.show',
                $order->order_number
            )
            ->with(
                'success',
                'Siparişiniz başarıyla oluşturuldu.'
            );
    }
}