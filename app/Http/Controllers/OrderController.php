<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(Request $request) {
        $orders = $this->user->orders;
        return view('pages.orders', compact('orders'));
    }

    public function store(Request $request) {
        $password = $request->get('password', '');
        if ($password !== $this->user->password) return ['error' => 'Неверный пароль'];

        $items = $this->user->carts->toArray();
        $finalPrice = collect($items)->sum('price');

        if ($finalPrice < 1) return ['error' => 'Добавьте товары в корзину'];

        $order = $this->user->orders()->create([
           'items' => $items,
           'finalPrice' => $finalPrice
        ]);

        foreach($this->user->carts as $orderItem) {
            $orderItem->item->available -= $orderItem->count;
            $orderItem->item->save();
        }

        $this->user->carts()->delete();

        return $order;
    }

    public function delete(Order $order) {
        if ($order->status !== 'Новый') {
            return redirect()->back();
        }

        $order->delete();

        return redirect()->route('orders');
    }

    public function cancelOrder(Request $request, Order $order) {
        $description = $request->get('description');
        $order->status = 'Отменён';
        $order->description = $description;
        $order->save();

        return redirect()->back();
    }

    public function confirmOrder(Order $order) {
        $order->status = 'Подтверждён';
        $order->save();

        return redirect()->back();
    }
}
