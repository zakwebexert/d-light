<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\HomePageContent;
use App\Models\Products;
use App\Models\Style;
use Illuminate\Http\Request;

class SiteController extends Controller
{

    public function index()
    {
        $title = 'Home';
        $categories = Category::all();
        $slide_items = HomePageContent::where('product_num',1)->with('products')->get();
        $flash_items = HomePageContent::where('product_num',2)->with('products')->skip(0)->take(6)->get();
        $top_items = HomePageContent::where('product_num',3)->with('products')->skip(0)->take(8)->get();
        $best_seller = HomePageContent::where('product_num',4)->with('products')->skip(0)->take(4)->get();
        $featured_items = HomePageContent::where('product_num',5)->with('products')->skip(0)->take(4)->get();

        $data  = [
            "slide_items" => $slide_items,
            "flash_items" => $flash_items,
            "top_items" => $top_items,
            "best_seller" => $best_seller,
            "featured_items" => $featured_items,
            ];
        return view('site.pages.home',['title'=>$title , 'data'=>$data , 'categories'=>$categories]);
    }

    public function category_product($id){
        $title = 'all styles';
        $all_styles = Style::all();
        $slide_items = HomePageContent::where('product_num',1)->with('products')->get();

        $category = Category::where('id',$id)->with('product')->first();

        return view('site.pages.styles',['styles'=>$all_styles,'slide_items'=>$slide_items,'title'=>$title,'products'=>$category['product']]);
    }

    public function styles_product($id){
        $styles = Style::where('id',$id)->with('products')->first();
        return view('site.pages.category',['styles'=>$styles]);
    }


    public function all_flash_items($num,$name){

        $all_flash_items = HomePageContent::where('product_num',$num)->with('products')->get();
        return view('site.pages.all_flash_sale',['all_flash_sale'=>$all_flash_items,'name'=>$name]);
    }

    public function shop_grid($num){
        $top_items = HomePageContent::where('product_num',$num)->with('products')->get();
        return view('site.pages.shop_grid',['top_items'=>$top_items]);
    }

    public function shop_list($num){
        $top_items = HomePageContent::where('product_num',$num)->with('products')->get();
        return view('site.pages.shop_list',['top_items'=>$top_items]);
    }

    public function search_item(Request $request){

        $items = Products::where('name', 'like', '%' . $request->name . '%')->get();
        return view('site.pages.search_items',['items'=>$items]);
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
        return view('site.pages.category');
    }

    public function categories(){
        $title = 'all categories';
        $categories = Category::all();
        return view('site.pages.categories',['title'=>$title,'categories'=>$categories]);
    }


    public function destroy($id)
    {
        //
    }
}
