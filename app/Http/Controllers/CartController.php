<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class CartController extends Controller
{
    public function index() {
        $items = $this->user->carts->toArray();
        $finalPrice = collect($items)->sum('price');
        return view('pages.cart', compact('items', 'finalPrice'));
    }

    public function add(Request $request, Item $item) {
        $count = $request->get('count', 0);

        $cartItem = $this->user->carts()->where('item_id', $item->id)->first();
        if ($cartItem) $count += $cartItem->count;

        $item->available -= $count;
        if ($item->available < 0) return ['message' => 'Недостаточно товара'];

        $cartItem = $this->user->carts()->firstOrCreate(['item_id' => $item->id], ['count' => 0]);
        $cartItem->count = $count;
        $cartItem->save();

        if ($cartItem->count < 0) {
            $cartItem->delete();
            return ['message' => 'Товар удалён из корзины'];
        }

        return ['message' => 'Товар обновлён'];
    }
}
