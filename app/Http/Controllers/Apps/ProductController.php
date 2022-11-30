<?php

namespace App\Http\Controllers\Apps;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::query()
            ->search('name')
            ->paginate(10)
            ->withQueryString();

        return view('pages.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();

        return view('pages.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // generate barcode
        $product = Product::latest()->first() ?? new Product();
        $barcode = 'P'.generate_barcode($product->id + 1,6);

        // image
        $image = $request->file('image');
        $image->storeAs('public/products/', $image->hashName());

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'barcode' => $barcode,
            'category_id' => $request->category_id,
            'image' => $image->hashName(),
            'buy_price' => $request->buy_price,
            'sell_price' => $request->sell_price,
            'stock' => $request->stock,
            'description' => $request->description,
        ]);

        return redirect(route('app.product.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::get();

        return view('pages.product.edit', compact('categories', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'buy_price' => $request->buy_price,
            'sell_price' => $request->sell_price,
            'stock' => $request->stock,
            'description' => $request->description,
        ]);

        if($request->file('image')){
            Storage::disk('local')->delete('public/products/'.basename($product->image));

            $image = $request->file('image');
            $image->storeAs('public/products/', $image->hashName());

            $image->update([
                'image' => $image->hashName(),
            ]);
        }

        return redirect(route('app.product.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        Storage::disk('local')->delete('public/products/'. basename($product->image));

        $product->delete();

        return back();
    }

    public function destroySelected(Request $request)
    {
        foreach ($request->id as $id) {
            $product = Product::findorFail($id);
            $product->delete();
        }

        return back();
    }
}
