<?php

namespace App\Http\Controllers\products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\products\Product;
use \App\Models\products\Category;
use \App\Models\products\Brand;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $products = Product::where('name', 'like', "%{$search}%")
            ->orWhere('id', 'like', "%{$search}%")
            ->orWhere('reference', 'like', "%{$search}%")
            ->paginate(20);

        return view('products.index', compact('products'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('products.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:130',
            'reference' => 'max:10',
            'description' => 'max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',           
                        
        ]);

        // $product = new Product();
        // $product->name = $request->name;
        // $product->reference = $request->reference;
        // $product->description = $request->description;
        // $product->price = $request->price;
        // $product->quantity = $request->quantity;       
        // $product->brand_id = $request->brand_id;

        $data = $request->all();
        $product = Product::create($data);
        $product = Product::find($product->id);
        
        if(isset($data['category_id'])){
            $product->categories()->sync($data['category_id']);
        }

        return redirect()->route('itens.index')->with('success', 'Produto criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        $brands = Brand::all();

        return view('products.edit', compact('product', 'categories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $request->validate([
            'name' => 'required|max:130',
            'reference' => 'max:10',
            'description' => 'max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',   
                        
        ]);

        $product = Product::find($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;       
        $product->brand_id = $request->brand_id;

        $product->save();        
        $product->categories()->sync($request->category_id);

        return redirect()->route('itens.show', $id)->with('success', 'Produto atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);        
        $product->categories()->sync(null);
        $product->delete();

        return redirect()->route('itens.index')->with('success', 'Produto excluído com sucesso!');
    }
}
