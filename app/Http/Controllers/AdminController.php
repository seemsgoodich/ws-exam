<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Item;
use App\Models\Order;
use App\Models\User;

class AdminController extends Controller
{
    public function index() {
        return view('admin.index');
    }

    public function items() {
        $items = Item::get();
        return view('admin.items.index', compact('items'));
    }

    public function categories() {
        $categories = Category::get();
        return view('admin.categories.index', compact('categories'));
    }

    public function orders(Request $request) {
        $status = $request->get('status', null);
        $orders = Order::get();
        $users = User::get();

        if ($status) {
            $orders = $orders->where('status', $status);
        }

        return view('admin.orders.index', compact('orders', 'status', 'users'));
    }

    public function categoriesCreate() {
        return view('admin.categories.create');
    }

    public function itemsCreate() {
        $categories = Category::get();
        return view('admin.items.create', compact('categories'));
    }

    public function itemsUpdate(Item $item, Request $request) {
        $categories = Category::get();
        return view('admin.items.edit', compact('item', 'categories'));
    }
}
