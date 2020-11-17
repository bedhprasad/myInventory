<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use DB;
use File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $product = DB::table('products as p')
            ->select('p.*', 'pc.name as products_category')
            ->leftJoin('product_category as pc', 'pc.id', '=', 'p.category')
            ->get(); 
            
        return view('admin/product/product_list', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productCategory = ProductCategory::all();
        return view('admin/product/product_add', compact('productCategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Handle File Upload
        if($request->hasFile('image')){
            $getFilenameWithExt = $request->file('image')->getClientOriginalName();
            //get just Filename
            $filename = pathinfo($getFilenameWithExt, PATHINFO_FILENAME);
            //get just Extension
            $extension = $request->file('image')->getClientOriginalExtension();
            //Filename to store
            $filenameToStore = $filename.'_'.time().'.'.$extension;
            //Upload the Image
            $path = $request->file('image')->storeAs('public/images/ProductImages', $filenameToStore);
        }else{
            $filenameToStore = 'Avatar.png';
        }

        $product = new Product;
        $product->name = $request->name;
        $product->category = $request->category;
        $product->image = $filenameToStore;
        $product->available_quantities = $request->available_quantities;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->status = $request->status;
        $product->save();
    // dd($product);
        return redirect()->to('product');
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
    public function edit(Product $product)
    {
        // $productCategory = ProductCategory::all();
        //$product = Product::find($id);
        
        $productCategory = DB::table('products')
            ->leftJoin('product_category', 'product_category.name', '=', 'products.category')
            ->get();

        return view('admin/product/product_edit', compact('productCategory','product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Product $product)
    {
        // $this->validate($request, [
        //     'name' => 'required'
        // ]);
        // Handle File Upload
        if($request->hasFile('image')){
            $getFilenameWithExt = $request->file('image')->getClientOriginalName();
            //get just Filename
            $filename = pathinfo($getFilenameWithExt, PATHINFO_FILENAME);
            //get just Extension
            $extension = $request->file('image')->getClientOriginalExtension();
            //Filename to store
            $filenameToStore = $filename.'_'.time().'.'.$extension;
            //Upload the Image
            $path = $request->file('image')->storeAs('public/images/ProductImages', $filenameToStore);

            $product = Product::findOrFail($product->id);
            $productImage = $product->image;
            if($productImage){
                File::delete('storage/images/ProductImages/'.$productImage);
            }
        }else{
            $filenameToStore = 'Avatar.png';
        }
        //dd($product::all());
        $product = Product::find($product->id);
        $product->name = $request->get('name');
        $product->category = $request->get('category');
        if($request->hasFile('image')) {
            $product->image =  $filenameToStore;
        }
        $product->description = $request->get('description');
        $product->available_quantities = $request->get('available_quantities');
        $product->price = $request->get('price');
        $product->status = $request->get('status');
        $product->save();
        
        return redirect()->to('product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product = Product::findOrFail($product->id);
            $productImage = $product->image;
            if($productImage){
                File::delete('storage/images/ProductImages/'.$productImage);
        }

        $product->delete($product->id);
        
        return redirect()->to('product')->with('success','Data Deleted');
    }
}
