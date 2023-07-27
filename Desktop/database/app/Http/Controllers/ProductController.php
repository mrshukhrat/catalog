<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $result=$request->file('file')->store('main_images');

        $product=new Product;
        $product->name=$request->name;
        $product->save_address=$request->save_address;
        $product->period=$request->period;
        $product->files=$result;


        $product->category_id=$request->category_id;
        $product->save();
        if($request){
            return ['Result'=>"Data has been saved"];
        }
        else{
        return ['Result'=>"Operation failed"];
        }
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store($id)
      {
      $cate=Product::find($id);
      $result=$cate->delete();
      if($result){
            return ["result"=>"record has been delete".$id];
          }
       else{
           return ["result"=>"record has been not delete"];
      }
      }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Product::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $product=Product::find($id);
        $product->name=$request->name;
        $product->save_address=$request->save_address;
        $product->period=$request->period;
        $product->category_id=$request->category_id;
        $product->save();
        if($request){
            return ['Result'=>"Data has been saved"];
        }
        else{
        return ['Result'=>"Operation failed"];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cat_id)
    {
//      $results = DB::table('products')
//                      ->where('category_id', '==', $cat_id)
//                      ->get();
      $result=DB::table('products')
      ->select('id','category_id','name','files','period','save_address')
      ->where('category_id', '=', $cat_id)
      ->get();
     return $result;
    }
}
