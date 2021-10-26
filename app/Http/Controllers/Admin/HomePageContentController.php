<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomePageContent;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomePageContentController extends Controller
{

    public function index()
    {
    }

    public function show_slide_show_form($num){
        $items = Products::all();

        if($num == 1){
            $slide_items = HomePageContent::where('product_num',$num)->get();
            $title = 'Slide Show form';
            return view('admin.frontpage.slide_show_form',['title' => $title,'items' => $items,'slide_items'=>$slide_items,'num'=>$num]);
        }elseif ($num == 2){
            $slide_items = HomePageContent::where('product_num',$num)->get();
            $title = 'Flash Sale form';
            return view('admin.frontpage.flash_sale_form',['title' => $title,'items' => $items,'slide_items'=>$slide_items,'num'=>$num]);

        }elseif ($num == 3){
            $slide_items = HomePageContent::where('product_num',$num)->get();
            $title = 'Top Products form';
            return view('admin.frontpage.top_products',['title' => $title,'items' => $items,'slide_items'=>$slide_items,'num'=>$num]);

        }elseif ($num == 4){
            $slide_items = HomePageContent::where('product_num',$num)->get();
            $title = 'Best Sellers form';
            return view('admin.frontpage.best_sellers',['title' => $title,'items' => $items,'slide_items'=>$slide_items,'num'=>$num]);

        }elseif ($num == 5){
            $slide_items = HomePageContent::where('product_num',$num)->get();
            $title = 'featured products form';
            return view('admin.frontpage.featured_products',['title' => $title,'items' => $items,'slide_items'=>$slide_items,'num'=>$num]);

        }

    }

    public function store_slide_show(Request $request){
        $this->validate($request, [
            'item_ids' => 'required',

        ]);

        $input = $request->all();
        $existed_item = HomePageContent::where('product_num',$input['num'])->delete();
        for ($i=0; $i<count($input['item_ids']); $i++){
            $front_items = new HomePageContent();
            $front_items->product_id = $input['item_ids'][$i];
            $front_items->product_num = $input['num'];

            if (isset($input['items_comments'])){
                $front_items->comment = $input['items_comments'][$i];
            }
            $front_items->save();

        }
        Session::flash('success_message', 'Great! product has been saved successfully!');
        return redirect()->back();

    }



    //////////////////


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        dd($request->all());
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
}
