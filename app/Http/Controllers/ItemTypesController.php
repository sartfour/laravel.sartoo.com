<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemTypeRequest;
use App\Http\Requests\UpdateItemTypeRequest;
use App\Models\ItemType;

use Illuminate\Support\Facades\Auth;

class ItemTypesController extends Controller
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
        $itemTypes = ItemType::all()->sortBy('singular_name');
        return view('itemtype.index', compact('itemTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('itemtype.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreItemTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreItemTypeRequest $request)
    {

        $itemType = ItemType::create([
            'singular_name' => $request->singular_name,
            'plural_name' => $request->plural_name,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('item-types.index')->with('success', 'A new item type was created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ItemType  $itemType
     * @return \Illuminate\Http\Response
     */
    public function show(ItemType $itemType)
    {
        $items = $itemType->items->sortBy('name');
        $lists = $itemType->lists;
        return view('itemtype.view', compact('itemType', 'items', 'lists'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ItemType  $itemType
     * @return \Illuminate\Http\Response
     */
    public function edit(ItemType $itemType)
    {
        return view('itemtype.edit', compact('itemType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateItemTypeRequest  $request
     * @param  \App\Models\ItemType  $itemType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateItemTypeRequest $request, ItemType $itemType)
    {
        $itemType->update([
            'singular_name' => $request->singular_name,
            'plural_name' => $request->plural_name
        ]);

        return redirect()->route('item-types.index')->with('success', 'Item type has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItemType  $itemType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemType $itemType)
    {
        $itemType->delete();

        return redirect()->route('item-types.index')->with('success', 'Item type has been deleted.');
    }
}
