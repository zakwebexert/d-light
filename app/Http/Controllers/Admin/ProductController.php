<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\choice_options;
use App\Models\HomePageContent;
use App\Models\product_choices;
use App\Models\product_colors;
use App\Models\product_size;
use App\Models\ProductImage;
use App\Models\Products;
use App\Models\Style;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Str;

class ProductController extends Controller
{

    public function index()
    {

        $title = 'Products';
        return view('admin.products.index',compact('title'));
    }

    public function getProducts(Request $request){


        $totalData = Products::count();

        if(empty($request->input('search.value'))){
            $products = Products::get();
            $totalFiltered = Products::count();
        }else{
            $search = $request->input('search.value');
            $products = Products::where([
                ['name', 'like', "%{$search}%"],
            ])
                ->orWhere('price','like',"%{$search}%")
                ->orWhere('created_at','like',"%{$search}%")
                ->get();
            $totalFiltered = Products::where([
                ['name', 'like', "%{$search}%"],
            ])
                ->orWhere('price', 'like', "%{$search}%")
                ->orWhere('created_at','like',"%{$search}%")
                ->count();
        }


        $data = array();

        if($products){
            foreach($products as $p){
                $edit_url = route('products.edit',$p->id);
                $addColors_url = route('products.addColorsget',$p->id);
                $addOptions_url = route('products.addOptionsget',$p->id);
                $nestedData['id'] = '<td><label class="checkbox checkbox-outline checkbox-success"><input type="checkbox" name="clients[]" value="'.$p->id.'"><span></span></label></td>';
                $nestedData['name'] = $p->name;
                $nestedData['category'] = $p->category->name;
                $nestedData['style_id'] = $p->style['style_name'];
                $nestedData['price'] = $p->price;

                $nestedData['created_at'] = date('d-m-Y',strtotime($p->created_at));
                $nestedData['action'] = '
                                <div>
                                <td>
                                    <a class="btn btn-sm btn-clean btn-icon" onclick="event.preventDefault();viewInfo('.$p->id.');" title="View Product" href="javascript:void(0)">
                                        <i class="icon-1x text-dark-50 flaticon-eye"></i>
                                    </a>
                                    <a title="Edit Product" class="btn btn-sm btn-clean btn-icon"
                                       href="'.$edit_url.'">
                                       <i class="icon-1x text-dark-50 flaticon-edit"></i>
                                    </a>
                                    <a title="Add colors" class="btn btn-sm btn-clean btn-icon"
                                       href="'.$addColors_url.'">
                                       <i class="icon-1x text-dark-50 flaticon-list"></i>
                                    </a>

                                    <a title="Add options" class="btn btn-sm btn-clean btn-icon"
                                       href="'.$addOptions_url.'">
                                       <i class="icon-1x text-dark-50 flaticon-plus"></i>
                                    </a>

                                    <a class="btn btn-sm btn-clean btn-icon" onclick="event.preventDefault();del('.$p->id.');" title="Delete Product" href="javascript:void(0)">
                                        <i class="icon-1x text-dark-50 flaticon-delete"></i>
                                    </a>
                                </td>
                                </div>
                            ';
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"			=> intval($request->input('draw')),
            "recordsTotal"	=> intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"			=> $data
        );

        echo json_encode($json_data);

    }


    public function create()
    {
        $title = 'Add New Product';

        $categories = Category::all();
        $styles = Style::all();
        return view('admin.products.create',['categories' => $categories,'title'=>$title,'styles'=>$styles]);

    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'desc' => 'required',
            'category' => 'required',
            'style_id' => 'required',
            'image' => 'required',
            'price' => 'required',

        ]);

        $input = $request->all();

        $product = new Products();

        $product->name = $input['name'];
        $product->product_desc = $input['desc'];
        $product->product_sku = Str::random(6);
        $product->category_id = $input['category'];
        $product->style_id = $input['style_id'];
        $product->price = $input['price'];

        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                $this->validate($request, [
                    'image' => 'required|image|mimes:jpeg,png,jpg'
                ]);
                $file = $request->file('image');
                $destinationPath = public_path('/productImage');
                $image = $file->getClientOriginalName('image');
                $image = rand().$image;


                $request->file('image')->move($destinationPath, $image);
                $input['image'] = $image;


            }
        }else{
            $input['image'] = 'noimage.jpg';
        }

        $product->image = $input['image'];
        $product->save();

        //product multiple images
        $images = $request->file('images');
        $count = count($request->file('images'));
        $destinationPath = public_path() . '/productImage';


        for($i = 0; $i < $count; $i++) {

            $data = new ProductImage();
            $file = $images[$i];

            if ($file->isValid()) {
                $extension = $file->getClientOriginalExtension(); // file extension
                $fileName = uniqid(). '.' .$extension; // file name with extension
                $file->move($destinationPath, $fileName); // move file to our uploads path

                $data->image = $fileName;
                $data->product_id = $product->id;
                $data->save();
            }
        }

        Session::flash('success_message', 'Great! product has been saved successfully!');
        return redirect()->route('products.index');
    }

    public function productDetail(Request $request){

        $product = Products::findOrFail($request->id);
        return view('admin.products.detail', ['title' => 'Product Detail', 'product' => $product]);

    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $product = Products::find($id);
        $categories = Category::all();

        return view('admin.products.edit', ['title' => 'Edit product details','product'=>$product,'categories' => $categories]);

    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
             'name' => 'required|max:255',
             'product_desc' => 'required',
             'category' => 'required',
             'price' => 'required',

        ]);

        $input = $request->all();

        $product = Products::find($id);

        $product->name = $input['name'];
        $product->product_desc = $input['product_desc'];
        //create random sku number
        $product->product_sku = Str::random(6);

        $product->category_id = $input['category'];
        $product->price = $input['price'];

        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                $file = $request->file('image');
                $destinationPath = public_path('/productImage');
                $image = $file->getClientOriginalName('image');
                $image = rand().$image;


                $request->file('image')->move($destinationPath, $image);
                $input['image'] = $image;

                $product->image = $input['image'];
            }
        }


        $product->save();

        Session::flash('success_message', 'Great! product has been update successfully!');
        return redirect()->route('products.index');
    }


    public function destroy($id)
    {
        $product = Products::find($id);
        $product->delete();

        Session::flash('success_message', 'Product successfully deleted!');

        return redirect()->route('products.index');
    }

    public function deleteSelectedProducts(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            'clients' => 'required',

        ]);
        foreach ($input['clients'] as $index => $id) {

            $product = Products::find($id);
            $product->delete();
        }
        Session::flash('success_message', 'products successfully deleted!');
        return redirect()->route('products.index');

    }


    public function importProducts(Request $request){

        if($file=$request->file('csv')){
            $destinationPath = public_path('/products_imports');
            $csv = $file->getClientOriginalName();
            $csv = rand().$csv;
            $file->move($destinationPath, $csv);
        }
        $file_path = $destinationPath."/".$csv;

        $users = (new FastExcel)->import("$file_path", function ($line) {
            $product = new Products();
            $product->name = $line['name'];
            $product->product_desc = $line['product_desc'];
            $product->product_sku = Str::random(6);
            $product->category_id = $line['category_id'];
            $product->style_id = $line['style_id'];
            $product->price = $line['price'];
            $product->image = $line['image'];
            $product->save();
        });
        Session::flash('success_message', 'Great! Products successfully added!');
        return redirect()->route('products.index');
    }


    public function importProductsSample(){
        return response()->download(public_path('/products_imports/productsSample.csv'));
    }

    public function importImages(Request $request){

        $this->validate($request, [

            'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'

        ]);

        if($request->hasfile('images'))
        {

            foreach($request->file('images') as $image)
            {
                $name=$image->getClientOriginalName();
                $image->move(public_path().'/productImage', $name);
            }
            return redirect()->route('products.index');

        }

    }


    ////choice and options
    ///

    public function addColors($id){
        $title = 'add colors';
        $product = Products::where('id',$id)->with('choices')->first();
        $colors = [];
        foreach ($product['choices'] as $choice){
            if($choice['choice_title'] == 'colors'){
                foreach ($choice['options'] as $option){
                    array_push($colors,$option);
                }
            }
        }
        return view('admin.products.add_colors',['title'=>$title,'id'=>$id,'colors'=>$colors]);
    }


    public function storeColors(Request $request){

        $product_id = $request['product_id'];
        $pre_choices = product_choices::where([['choice_title','colors'],['product_id',$product_id]])->delete();
        $choice = new product_choices();
        $choice->product_id = $product_id;
        $choice->choice_title = $request['choice_name'];
        $choice->save();

        foreach ($request['color'] as $color){
            $colors = new choice_options();
            $colors->choice_id = $choice->id;
            $colors->option_title = $color;
            $colors->save();
        }
        Session::flash('success_message', 'Great! Color and Size has been saved successfully!');
        return redirect()->back();


    }

    public function addOptions($id){
        $title = 'add choices and options';
        return view('admin.products.add_choices_options',['title'=>$title,'product_id'=>$id]);
    }

    public function storeOptions(Request $request){
        $this->validate($request, [

            'choice' => 'required',
            'option.*' => 'required'

        ]);

        $choice = new product_choices();
        $choice->product_id = $request->product_id;
        $choice->choice_title = $request->choice;
        $choice->save();

        foreach ($request->option as $opt){
            $option = new choice_options();
            $option->choice_id = $choice->id;
            $option->option_title = $opt;
            $option->save();
        }

        Session::flash('success_message', 'Great! Color and Size has been saved successfully!');
        return redirect()->back();

    }
}
