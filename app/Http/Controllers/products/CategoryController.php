<?php

namespace App\Http\Controllers\products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search = $request->input('search');

        $categories = Category::where('name', 'like', "%{$search}%")
            ->orWhere('id', 'like', "%{$search}%")
            ->paginate(15);
        
        return view('products.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.categories.create');
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

        $category = new Category();
        $category->name = $request->name;        
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Categoria cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('products.categories.edit', compact('category'));
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

        $category = Category::find($id);
        $category->name = $request->name;        
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Categoria atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if($category->products->count() > 0){
            return redirect()->route('categories.index')->with('error', 'Categoria não pode ser excluída pois possui produtos vinculados!');
        }
        
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Categoria excluída com sucesso!');
    }
}
