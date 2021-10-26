<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Style;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function index()
    {
        $title = 'Categories';
        return view('admin.categories.index',compact('title'));
    }



    public function getCategories(Request $request){
        $columns = array(
            1 => 'id',
            2 => 'name',
            3 => 'created_at',
            4 => 'action'
        );

        $totalData = Category::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value'))){
            $users = Category::offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
            $totalFiltered = Category::count();
        }else{
            $search = $request->input('search.value');
            $users = Category::where([
                ['name', 'like', "%{$search}%"],
            ])
                ->orWhere('id','like',"%{$search}%")
                ->orWhere('created_at','like',"%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = Category::where([
                ['name', 'like', "%{$search}%"],
            ])
                ->orWhere('id','like',"%{$search}%")
                ->orWhere('created_at','like',"%{$search}%")
                ->count();
        }


        $data = array();

        if($users){
            foreach($users as $r){
                $edit_url = route('categories.edit',$r->id);
//                $nestedData['id'] = '<td><label class="checkbox checkbox-outline checkbox-success"><input type="checkbox" name="clients[]" value="'.$r->id.'"><span></span></label></td>';
                $nestedData['id'] = $r->id;
                $nestedData['name'] = $r->name;

                $nestedData['created_at'] = date('d-m-Y',strtotime($r->created_at));
                $nestedData['action'] = '
                                <div>
                                <td>
                                 <a class="btn btn-sm btn-clean btn-icon" onclick="event.preventDefault();viewInfo('.$r->id.');" title="View Category" href="javascript:void(0)">
                                        <i class="icon-1x text-dark-50 flaticon-eye"></i>
                                    </a>
                                      <a title="Edit category" class="btn btn-sm btn-clean btn-icon"
                                       href="'.$edit_url.'">
                                       <i class="icon-1x text-dark-50 flaticon-edit"></i>
                                    </a>
                                    <a class="btn btn-sm btn-clean btn-icon" onclick="event.preventDefault();del('.$r->id.');" title="Delete Category" href="javascript:void(0)">
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

    public function categorydetail(Request $request){
        $category = Category::findOrFail($request->id);
        return view('admin.categories.detail', ['title' => 'Category Detail', 'category' => $category]);

    }

    public function edit($id){
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', ['title' => 'Category edit', 'category' => $category]);

    }

    public function update(Request $request,$id){
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $input = $request->all();
        $user =Category::find($id);
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
                $user->image = $input['image'];

            }
        }


        $user->name = $input['name'];
        $user->save();

        Session::flash('success_message', 'Great! Category has been updated successfully!');

        return redirect()->route('categories.index');
    }
    public function create()
    {
        $title = 'Add New Category';
        return view('admin.categories.create',compact('title'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $input = $request->all();
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
        $user = new Category();
        $user->image = $input['image'];
        $user->name = $input['name'];
        $user->save();

        Session::flash('success_message', 'Great! Category has been saved successfully!');

        return redirect()->route('categories.index');
    }


    public function destroy($id)
    {
            $user = Category::find($id);
            $user->delete();
            Session::flash('success_message', 'Category successfully deleted!');

        return redirect()->route('categories.index');

    }
    public function deleteSelectedCategories(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            'clients' => 'required',

        ]);
        foreach ($input['clients'] as $index => $id) {

            $user = Category::find($id);
                $user->delete();

        }
        Session::flash('success_message', 'Categories successfully deleted!');
        return redirect()->route('categories.index');

    }
}
