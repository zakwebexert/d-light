<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\CartItems;
use App\Models\OrderDetail;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StripeController extends Controller
{


    public function index()
    {
        //
    }

    public function stripe(Request $request){
        //dd($request->all());
        \Stripe\Stripe::setApiKey ( 'sk_test_51JVrOGFuaXaPZq5rHdP4ATLfhhRK8aDdXyRRfsdiUJWb9S96iFkvXotdHEFgWBL7X6TnJXKLLn3nDavWxxxeW0f200JmDOExTM' );
//        try {
            \Stripe\Charge::create ( array (
                "amount" => $request->price * 100,
                "currency" => "usd",
                "source" => $request->stripe_token, // obtained with Stripe.js
                "description" => $request->description,
            ));

            //add token to order row
            //add token to session and redirect to success route then get order_id and token get order records with 2 checks same as paypal.


//            Session::flash ( 'success-message', 'Payment done successfully !' );
//            return redirect()->back ();

            $order_id = Session::get('order_id');
            //dd($order_id);
            $title = 'order detail';

            $order = OrderDetail::where('id',$order_id)->with('orderitems')->first();
            $products = [];
            //dd($order);
            for ($i =0 ;$i<count($order['orderitems']);$i++){
                $item = Products::where('id',$order['orderitems'][$i]->product_Id)->first();
                $item['quantity'] = $order['orderitems'][$i]->quantity;
                $item['choices'] = $order['orderitems'][$i]->product_choices;
                array_push($products,$item);
            }


            $order->status = 'Paid';
            $order->save();
            $items = CartItems::where('user_id',auth()->user()->id)->delete();
            return view('site.pages.paypal.success',['order'=>$order,'title'=>$title,'products'=>$products]);


//        } catch ( \Exception $e ) {
//
//            Session::forget('order_id');
//            return redirect()->route('cart');
//
//            //Session::flash ( 'fail-message', "Error! Please Try again." );
//            //return redirect()->back ();
//        }
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
