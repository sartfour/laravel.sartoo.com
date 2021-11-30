<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemTypeRequest;
use App\Http\Requests\UpdateItemTypeRequest;
use App\Models\ItemType;

use Illuminate\Support\Facades\Auth;

class ItemTypesApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index','show']]);
    }

    public function index()
    {
        $itemTypes = ItemType::all()->sortBy('singular_name');
        return $itemTypes;
    }

    public function store(StoreItemTypeRequest $request)
    {

        $itemType = ItemType::create([
            'singular_name' => $request->singular_name,
            'plural_name' => $request->plural_name,
            'user_id' => Auth::id(),
        ]);

        return response()->json($itemType, 201);
    }

    public function show(ItemType $itemType)
    {
        return $itemType;
    }

    public function update(UpdateItemTypeRequest $request, ItemType $itemType)
    {
        $itemType->update([
            'singular_name' => $request->singular_name,
            'plural_name' => $request->plural_name
        ]);

        return response()->json($itemType, 200);
    }

    public function delete(ItemType $itemType)
    {
        $itemType->delete();

        return response()->json(null, 204);
    }
}
