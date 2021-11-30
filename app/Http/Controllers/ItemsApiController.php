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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::select('items.*')->join('item_types', 'items.item_type_id', '=', 'item_types.id')->orderBy('item_types.singular_name')->orderBy('name')->get();
        return $items;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreItemTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreItemRequest $request)
    {

        $item = Item::create([
            'name' => $request->name,
            'item_type_id' => $request->item_type_id,
            'user_id' => Auth::id(),
        ]);

        return redirect()->action([self::class, 'index'])->with('success', 'A new item was created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ItemType  $itemType
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        return $item;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ItemType  $itemType
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        $itemTypes = ItemType::all()->sortBy('singular_name');
        return view('item.edit', compact('item', 'itemTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateItemTypeRequest  $request
     * @param  \App\Models\ItemType  $itemType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        $item->update([
            'name' => $request->name,
            'item_type_id' => $request->item_type_id
        ]);

        return redirect()->action([self::class, 'index'])->with('success', 'Item has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItemType  $itemType
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->action([self::class, 'index'])->with('success', 'Item has been deleted.');
    }
}
