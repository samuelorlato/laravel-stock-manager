<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();

        return Product::where('user_id', $user_id)->paginate(10);
    }

    public function show($id)
    {
        $user_id = Auth::id();

        return Product::where([
            ['user_id', $user_id],
            ['id', $id],
        ])->firstOrFail();
    }

    public function store(StoreProductRequest $request)
    {
        $user_id = Auth::id();

        $data = $request->validated();
        $data['user_id'] = $user_id;

        return Product::create($data);
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $user_id = Auth::id();

        $data = $request->validated();

        Product::where([
            ['user_id', $user_id],
            ['id', $id],
        ])->firstOrFail()->update($data);

        return response()->noContent();
    }

    public function destroy($id)
    {
        $user_id = Auth::id();

        $product = Product::where([
            ['user_id', $user_id],
            ['id', $id],
        ])->firstOrFail();

        Product::destroy($product->id);

        return response()->noContent();
    }
}
