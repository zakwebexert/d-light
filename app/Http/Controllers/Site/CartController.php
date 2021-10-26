<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\CartItems;
use App\Models\OrderDetail;
use App\Models\OrderItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{

    public function cart()
    {
        //dd(auth()->user());
        //with cart information
        $items = CartItems::where('user_id',auth()->user()->id)->with('product')->get();

        $price = 0;
        foreach ($items as $item){
            $price = $price + ($item['product']['price'] * $item['quantity']);
        }

        return view('site.pages.cart',['title' => 'cart','items' => $items,'price' => $price]);
    }


    public function remove($id){
        $item = CartItems::find($id)->delete();
        Session::flash('success_message', 'Item removed successfully!');
        return redirect()->back();
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
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

    public function showCheckout(){

        $user = auth()->user();
        $items = CartItems::where('user_id',auth()->user()->id)->with('product')->get();

        $price = 0;

        foreach ($items as $item){
            $price = $price + ($item['product']['price'] * $item['quantity']);
        }
        return view('site.pages.checkout',['title' => 'checkout', 'user' => $user, 'price' => $price]);
    }


    public function checkout_payment(Request $request){


        $items_product_id = CartItems::where('user_id',auth()->user()->id)->select('product_id','user_id','quantity','product_choices')->get();
        $shift_method = $request->shift_method;
        $price = $request->price;

        $neworder = new OrderDetail();

        $neworder->user_id = auth()->user()->id;
        $neworder->total = $price;
        $neworder->shiffing_method = $shift_method;
        $neworder->status = 'pending';
        $neworder->address = $request->address;
        $neworder->building_Info = $request->buildingInfo;
        $neworder->save();
        if($neworder){
            foreach ($items_product_id as $item_id){
                $newOrderItem = new OrderItems();

                $newOrderItem->order_id = $neworder->id;
                $newOrderItem->product_id = $item_id['product_id'];
                $newOrderItem->quantity = $item_id['quantity'];
                $newOrderItem->product_choices = $item_id['product_choices'];

                $newOrderItem->save();
            }
        }

        Session::put('order_id', $neworder->id);
        return true;

    }

    public function payment_methods(){

        $title = 'checkout payment';
        return view('site.pages.checkout.checkout-payment',['title'=>$title]);

    }

    public function credit_card(){
        $order_id = Session::get('order_id');
        $title = 'paypal';
        $user = auth()->user();
        $order_detail = OrderDetail::where('id',$order_id)->first();
        $items = CartItems::where('user_id',auth()->user()->id)->with('product')->get();

        $price = 0;

        foreach ($items as $item){
            $price = $price + ($item['product']['price'] * $item['quantity']);
        }
        $title = 'credit card';
        return view('site.pages.checkout.checkout_credit_card',['title'=>$title,'price'=>$price,'customerName'=>auth()->user()->name]);
    }


    public function paypal(){
        $order_id = Session::get('order_id');
        $title = 'paypal';
        $user = auth()->user();
        $order_detail = OrderDetail::where('id',$order_id)->first();
        $items = CartItems::where('user_id',auth()->user()->id)->with('product')->get();

        $price = 0;

        foreach ($items as $item){
            $price = $price + ($item['product']['price'] * $item['quantity']);
        }

        return view('site.pages.checkout.checkout_paypal',['title'=>$title,'user'=>$user,'price'=>$price,'order_detail'=>$order_detail]);
    }

    public function cash(){
        $title = 'cash';
        return view('site.pages.checkout.checkout_cash',['title'=>$title]);
    }
}
