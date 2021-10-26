<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Style;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StyleController extends Controller
{
    public function index()
    {
        $title = 'Styles';
        $all_styles = Style::all();
       // return $all_styles[0]->category;
        return view('admin.styles.index',compact('title'));
    }



    public function getStyles(Request $request){
        $columns = array(
            0 => 'id',
            1 => 'category_id',
            2 => 'style_name',
            3 => 'created_at',
            4 => 'action'
        );

        $totalData = Style::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        //$order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value'))){
            $users = Style::all();
            $totalFiltered = Style::count();
        }else{
            $search = $request->input('search.value');
            $users = Style::where([
                ['style_name', 'like', "%{$search}%"],
            ])
                ->orWhere('created_at','like',"%{$search}%")
                ->offset($start)
                //->limit($limit)
               // ->orderBy($order, $dir)
                ->get();
            $totalFiltered = Style::where([
                ['style_name', 'like', "%{$search}%"],
            ])
                ->orWhere('created_at','like',"%{$search}%")
                ->count();
        }


        $data = array();

        if($users){
            foreach($users as $r){
                $edit_url = route('styles.edit',$r->id);
                $nestedData['id'] = '<td><label class="checkbox checkbox-outline checkbox-success"><input type="checkbox" name="clients[]" value="'.$r->id.'"><span></span></label></td>';
                $nestedData['category_id'] = $r->category->name;
                $nestedData['style_name'] = $r->style_name;
                $nestedData['created_at'] = date('d-m-Y',strtotime($r->created_at));
                $nestedData['action'] = '
                                <div>
                                <td>
                                    <a class="btn btn-sm btn-clean btn-icon" onclick="event.preventDefault();del('.$r->id.');" title="Delete Client" href="javascript:void(0)">
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
        $all_categories = Category::all();
        $title = 'Add New Style';
        return view('admin.styles.create',['title'=>$title,'categories'=>$all_categories]);
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'category_id' => 'required',

        ]);

        $input = $request->all();
        $user = new Style();
        $user->style_name = $input['name'];
        $user->category_id = $input['category_id'];
        $user->save();

        Session::flash('success_message', 'Great! Style has been saved successfully!');
        $user->save();
        return redirect()->route('styles.index');
    }


    public function destroy($id)
    {
        $user = Style::find($id);
        $user->delete();
        Session::flash('success_message', 'Style successfully deleted!');

        return redirect()->route('styles.index');

    }

    public function CategoryStyles(Request $request){
        $category_id = $request->id;
        $all_styles = Style::where('category_id',$category_id)->get();

        return $all_styles;

    }
}
