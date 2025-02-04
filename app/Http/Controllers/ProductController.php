<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json(Product::all());
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1'
        ]);

        DB::beginTransaction();

        try {
            $product = Product::create($validatedData);
            DB::commit();
            return response()->json(['message' => 'Product created successfully', 'product' => $product], 201);

        } catch (\Exception $e) {

            DB::rollBack();
            return response()->json(['message' => 'Failed to create product', 'error' => $e->getMessage()], 500);
        }

    }


    public function show(Product $product)
    {
        return response()->json($product);
    }

    public function update(Request $request, Product $product)
    {
        if ($request->user()->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
        ]);

        $item = Product::find($request->id);

        if($item){
            $item->update($request->only(['name', 'description', 'price', 'quantity']));
        }

        return response()->json($item);
    }

    public function destroy(Request $request, $id)
    {
        if ($request->user()->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $product = Product::find($id);
        $deleted = $product->delete();

        if ($deleted) {
            // Return a success message if the deletion was successful
            return response()->json(['message' => 'Product deleted successfully']);
        } else {
            // Return an error message if the product is not found or not deleted
            return response()->json(['message' => 'Product not found'], 404);
        }


    }
}
