<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Item;
use App\Models\ItemType;

use Illuminate\Support\Facades\Auth;

class ItemsApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index','show']]);
    }

    public function index()
    {
        $items = Item::select('items.*')->join('item_types', 'items.item_type_id', '=', 'item_types.id')->orderBy('item_types.singular_name')->orderBy('name')->get();
        return $items;
    }

    public function store(StoreItemRequest $request)
    {

        $item = Item::create([
            'name' => $request->name,
            'item_type_id' => $request->item_type_id,
            'user_id' => Auth::id(),
        ]);

        return response()->json($item, 201);
    }

    public function show(Item $item)
    {
        return $item;
    }

    public function update(UpdateItemRequest $request, Item $item)
    {
        $item->update([
            'name' => $request->name,
            'item_type_id' => $request->item_type_id
        ]);

        return response()->json($item, 200);
    }

    public function delete(Item $item)
    {
        $item->delete();

        return response()->json(null, 204);
    }
}
