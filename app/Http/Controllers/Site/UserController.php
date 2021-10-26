<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
//use http\Client\Curl\User;
use App\Models\CartItems;
use App\Models\OrderDetail;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{

    public function index()
    {


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

    public function edit()
    {
	    $user = Auth::user();
	    return view('client.settings.edit', ['title' => 'Edit Profile','user'=>$user]);
    }


    public function update(Request $request)
    {
	    $admin = Auth::user();
	    $this->validate($request, [
		    'name' => 'required|max:255',
		    'email' => 'required|unique:users,email,'.$admin->id,
	    ]);
	    $input = $request->all();
	    if (empty($input['password'])) {
		    $input['password'] = $admin->password;
	    } else {
		    $input['password'] = bcrypt($input['password']);
	    }
	    $admin->fill($input)->save();
	    Session::flash('success_message', 'Great! Client successfully updated!');
	    return redirect()->back();
    }


    public function destroy($id)
    {
        //
    }

    public function edit_profile(){
        $user = auth()->user();
        return view('site.pages.edit_profile',['title'=>'edit profile','user'=>$user]);
    }

    public function update_profile(Request $request){

        $user = User::find(auth()->user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();

        Session::flash('message', 'Great! User has been updated successfully!');
        return redirect()->back();
    }


    public function showallpages(){
        return view('site.pages.all_pages',['title'=>'all pages']);
    }

    public function update_profile_image(Request $request){
        request()->validate([
            'file'  => 'required|mimes:doc,docx,pdf,txt|max:2048',
        ]);

        if ($files = $request->file('file')) {

            //store file into document folder
            $file = $request->file->store('public/documents');

            //store your file into database
            //$document = new Document();
            //$document->title = $file;
            //$document->save();

            return Response()->json([
                "success" => true,
                "file" => $file
            ]);

        }

        return Response()->json([
            "success" => false,
            "file" => ''
        ]);
    }

    public function show_change_password_form(){
        $title = 'change password';
        return view('site.pages.change_password',['title'=>$title]);
    }

    public function update_password(Request $request){

        $this->validate($request, [
            'password' => 'required|confirmed|min:6',
        ]);
        $old_password = $request->old_password;
        if(Hash::check($old_password,auth()->user()->password)) {
            //change password
            $user = User::find(auth()->user()->id);

            $user->password = bcrypt($request->password);
            $user->save();

            Session::flash('message', 'Great! Password has been updated successfully!');
            return redirect()->back();
        }else{
            return redirect()->back()->withErrors(['Password not matched']);
        }
    }

    public function wishlist(Request $request){
        $product_id = $request->product_id;

        $wishitem = new Wishlist();

        $wishitem->user_id = auth()->user()->id;
        $wishitem->item_id = $product_id;
        $wishitem->save();

        return response()->json(['success'=>"Your item has been add to wishlist."]);
    }

    public function my_wish_grid(){
        $wish_list_items = Wishlist::where('user_id',auth()->user()->id)->get();
        $list_ids = [];
        foreach ($wish_list_items as $list){
            array_push($list_ids,$list['item_id']);
        }
        return view('site.pages.wishlist_grid',['list'=>$wish_list_items,'title'=>'wish list','ids'=>$list_ids]);

    }

    public function wishlist_list(){
        $wish_list_items = Wishlist::where('user_id',auth()->user()->id)->get();

        $list_ids = [];
        foreach ($wish_list_items as $list){
            array_push($list_ids,$list['item_id']);
        }
        return view('site.pages.wishlist_list',['list'=>$wish_list_items,'title'=>'wish list','ids'=>$list_ids]);

    }

    public function wishlist_cart(Request $request){
        $user_id = auth()->user()->id;
        $product_ids = $request->ids;
        $quantity = 1;


        foreach ($product_ids as $id){
            $choice = new CartItems();
            $choice->product_id = $id;
            $choice->user_id = $user_id;
            $choice->quantity = $quantity;
            $choice->product_choices = '[]';
            $choice->save();
        }

        $deletItems = Wishlist::where('user_id',$user_id)->get();

        foreach ($deletItems as $item){
            $item->delete();
        }
        return redirect()->route('cart');

    }

    public function show_my_orders(){
        $user_id = auth()->user()->id;
        $all_orders = OrderDetail::where('user_id',$user_id)->where('status','Paid')->with('orderitems')->get();
        //return $all_orders[0]['orderitems'][0]->product['image'];
        return view('site.pages.myorders',['orders'=>$all_orders,'title'=>'my orders']);

    }
}
