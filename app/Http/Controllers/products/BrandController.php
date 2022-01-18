<?php

namespace App\Http\Controllers\products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\products\Brand;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $search = $request->input('search');

        $brands = Brand::where('name', 'like', "%{$search}%")
            ->orWhere('id', 'like', "%{$search}%")
            ->paginate(15);
        
        return view('products.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.brands.create');
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
            'name' => 'required|max:30'            
        ]);

        $brand = new Brand();
        $brand->name = $request->name;        
        $brand->save();

        return redirect()->route('brands.index')->with('success', 'Marca cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = Brand::find($id);
        return view('products.brands.edit', compact('brand'));
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
            'name' => 'required|max:30'            
        ]);

        $brand = Brand::find($id);
        $brand->name = $request->name;        
        $brand->save();

        return redirect()->route('brands.index')->with('success', 'Marca atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::find($id);

        if ($brand->products->count() > 0) {
            return redirect()->route('brands.index')->with('error', 'Não é possível excluir marca com produtos!');
        }
        
        $brand->delete();

        return redirect()->route('brands.index')->with('success', 'Marca excluída com sucesso!');
    }
}
