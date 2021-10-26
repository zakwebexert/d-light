<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\CartItems;
use App\Models\OrderDetail;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PaypalController extends Controller
{

    public function index()
    {
        //
    }

    public function success(){

        $title = 'order detail';
        $order_id = Session::get('order_id');

        $order = OrderDetail::where('id',$order_id)->with('orderitems')->first();

        $products = [];

        for ($i =0 ;$i<count($order['orderitems']);$i++){
            $item = Products::where('id',$order['orderitems'][$i]->product_Id)->first();
            $item['quantity'] = $order['orderitems'][$i]->quantity;
            $item['choices'] = $order['orderitems'][$i]->product_choices;
            array_push($products,$item);
        }
        //

        $order->status = 'Paid';
        $order->save();
        //dd($order);
        $items = CartItems::where('user_id',auth()->user()->id)->delete();
        return view('site.pages.paypal.success',['order'=>$order,'title'=>$title,'products'=>$products]);

    }

    public function fail(){
        Session::forget('order_id');
        return redirect()->route('cart');
    }


    public function destroy($id)
    {
        //
    }
}
