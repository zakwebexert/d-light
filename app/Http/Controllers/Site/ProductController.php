<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\CartItems;
use App\Models\product_choices;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($name)
    {
        $title = 'product name';
        $product = Products::where('name',$name)->with('choices')->with('images')->first();
        return view('site.pages.showProduct',['title'=>$title,'product'=>$product]);
    }

    public function storeCartItem(Request $request){
        $user_id = auth()->user()->id;
        $product_id = $request->product_id;
        $quantity = $request->quantity;


        $data = $request->all();
        $choices = [];
        foreach ($data as $key => $value) {
            if($key == '_token' || $key == 'product_id' || $key == 'quantity'){

            }else{
                array_push($choices,"$key=>$value");
            }
        }
        $choice = new CartItems();
        $choice->product_id = $product_id;
        $choice->user_id = $user_id;
        $choice->quantity = $quantity;
        $choice->product_choices = json_encode($choices);
        $choice->save();

        Session::flash('success_message', 'Great! Item has been saved to cart successfully!');
        return redirect()->route('site.home');


    }

    public function storeCartItemSingle(Request $request){
        $user_id = auth()->user()->id;
        $product_id = $request->product_id;
        $quantity = $request->quantity;


        $data = $request->data;

        $choices = [];

        foreach ($data as $key => $value) {
            if($value['name'] == '_token' || $value['name'] == 'product_id' || $value['name'] == 'quantity'){

            }else{
                $key = $value['name'];
                $val= $value['value'];
                array_push($choices,"$key=>$val");
            }
        }
        $choice = new CartItems();
        $choice->product_id = $product_id;
        $choice->user_id = $user_id;
        $choice->quantity = $quantity;
        $choice->product_choices = json_encode($choices);
        $choice->save();

        //Session::flash('success_message', 'Great! Item has been saved to cart successfully!');
        //return redirect()->route('site.home');

    }



public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
