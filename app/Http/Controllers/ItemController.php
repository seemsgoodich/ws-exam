<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function create(Request $request) {
        $path = $request->file('image')->store('public');
        $path = str_replace('public', '/storage', $path);

        $item = Item::create([
           'name' => $request->name,
           'price' => $request->price,
           'model_type' => $request->model_type,
           'model_year' => $request->model_year,
           'model_country' => $request->model_country,
           'available' => $request->available,
           'category_id' => $request->category_id,
           'image' => $path,
        ]);

        return redirect()->route('admin.items.index');
    }

    public function edit(Request $request, Item $item) {
        $params = [
            'name' => $request->name,
            'price' => $request->price,
            'model_type' => $request->model_type,
            'model_year' => $request->model_year,
            'model_country' => $request->model_country,
            'available' => $request->available,
            'category_id' => $request->category_id
        ];

        if ($request->image) {
            $path = $request->file('image')->store('public');
            $params['image'] = str_replace('public', '/storage', $path);
        }

        $item->update($params);

        return redirect()->route('admin.items.index');
    }

    public function delete(Item $item) {
        $item->delete();
        return redirect()->route('admin.items.index');
    }
}
