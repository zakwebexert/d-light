<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ClientController extends Controller
{

    public function index()
    {
	    $title = 'Clients';
	    return view('admin.clients.index',compact('title'));
    }

    public function admin_index(){
        $title = 'Admins';
        return view('admin.admins.index',compact('title'));
    }


    public function getClients(Request $request){
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'email',
            3 => 'active',
            4 => 'created_at',
            5 => 'action'
        );

        $totalData = User::where('is_admin',0)->count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value'))){
            $users = User::where('is_admin',0)->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
            $totalFiltered = User::where('is_admin',0)->count();
        }else{
            $search = $request->input('search.value');
            $users = User::where([
                ['is_admin',0],
                ['name', 'like', "%{$search}%"],
            ])
                ->orWhere('email','like',"%{$search}%")
                ->orWhere('created_at','like',"%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = User::where([
                ['is_admin',0],
                ['name', 'like', "%{$search}%"],
            ])
                ->orWhere('name', 'like', "%{$search}%")
                ->orWhere('email','like',"%{$search}%")
                ->orWhere('created_at','like',"%{$search}%")
                ->count();
        }


        $data = array();

        if($users){
            foreach($users as $r){
                $edit_url = route('clients.edit',$r->id);
                $nestedData['id'] = '<td><label class="checkbox checkbox-outline checkbox-success"><input type="checkbox" name="clients[]" value="'.$r->id.'"><span></span></label></td>';
                $nestedData['name'] = $r->name;
                $nestedData['email'] = $r->email;
                if($r->active){
                    $nestedData['active'] = '<span class="label label-success label-inline mr-2">Active</span>';
                }else{
                    $nestedData['active'] = '<span class="label label-danger label-inline mr-2">Inactive</span>';
                }

                $nestedData['created_at'] = date('d-m-Y',strtotime($r->created_at));
                $nestedData['action'] = '
                                <div>
                                <td>
                                    <a class="btn btn-sm btn-clean btn-icon" onclick="event.preventDefault();viewInfo('.$r->id.');" title="View Client" href="javascript:void(0)">
                                        <i class="icon-1x text-dark-50 flaticon-eye"></i>
                                    </a>
                                    <a title="Edit Client" class="btn btn-sm btn-clean btn-icon"
                                       href="'.$edit_url.'">
                                       <i class="icon-1x text-dark-50 flaticon-edit"></i>
                                    </a>
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



	public function getAdmins(Request $request){
		$columns = array(
			0 => 'id',
			1 => 'name',
			2 => 'email',
			3 => 'active',
			4 => 'created_at',
			5 => 'action'
		);

		$totalData = User::where('is_admin',1)->count();
		$limit = $request->input('length');
		$start = $request->input('start');
		$order = $columns[$request->input('order.0.column')];
		$dir = $request->input('order.0.dir');

		if(empty($request->input('search.value'))){
			$users = User::where('is_admin',1)->offset($start)
				->limit($limit)
				->orderBy($order,$dir)
				->get();
			$totalFiltered = User::where('is_admin',1)->count();
		}else{
			$search = $request->input('search.value');
			$users = User::where([
				['is_admin',0],
				['name', 'like', "%{$search}%"],
			])
				->orWhere('email','like',"%{$search}%")
				->orWhere('created_at','like',"%{$search}%")
				->offset($start)
				->limit($limit)
				->orderBy($order, $dir)
				->get();
			$totalFiltered = User::where([
				['is_admin',0],
				['name', 'like', "%{$search}%"],
			])
				->orWhere('name', 'like', "%{$search}%")
				->orWhere('email','like',"%{$search}%")
				->orWhere('created_at','like',"%{$search}%")
				->count();
		}


		$data = array();

		if($users){
			foreach($users as $r){
				$edit_url = route('clients.edit',$r->id);
				$nestedData['id'] = '<td><label class="checkbox checkbox-outline checkbox-success"><input type="checkbox" name="clients[]" value="'.$r->id.'"><span></span></label></td>';
				$nestedData['name'] = $r->name;
				$nestedData['email'] = $r->email;
				if($r->active){
					$nestedData['active'] = '<span class="label label-success label-inline mr-2">Active</span>';
				}else{
					$nestedData['active'] = '<span class="label label-danger label-inline mr-2">Inactive</span>';
				}

				$nestedData['created_at'] = date('d-m-Y',strtotime($r->created_at));
				$nestedData['action'] = '
                                <div>
                                <td>
                                    <a class="btn btn-sm btn-clean btn-icon" onclick="event.preventDefault();viewInfo('.$r->id.');" title="View Client" href="javascript:void(0)">
                                        <i class="icon-1x text-dark-50 flaticon-eye"></i>
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
	    $title = 'Add New Client';
	    return view('admin.clients.create',compact('title'));
    }


    public function store(Request $request)
    {
	    $this->validate($request, [
		    'name' => 'required|max:255',
		    'email' => 'required|unique:users,email',
		    'password' => 'required|min:6',
	    ]);

	    $input = $request->all();
	    $user = new User();
	    $user->name = $input['name'];
	    $user->email = $input['email'];
	    $res = array_key_exists('active', $input);
	    if ($res == false) {
		    $user->active = 0;
	    } else {
		    $user->active = 1;

	    }
	    $user->password = bcrypt($input['password']);
	    $user->save();

	    Session::flash('success_message', 'Great! Client has been saved successfully!');
	    $user->save();
	    return redirect()->route('clients.index');
    }


    public function show($id)
    {
	    $user = User::find($id);
	    return view('admin.clients.single', ['title' => 'Client detail', 'user' => $user]);
    }

	public function clientDetail(Request $request)
	{

		$user = User::findOrFail($request->id);


		return view('admin.clients.detail', ['title' => 'Client Detail', 'user' => $user]);
	}


    public function edit($id)
    {
	    $user = User::find($id);
	    return view('admin.clients.edit', ['title' => 'Edit client details'])->withUser($user);
    }


    public function update(Request $request, $id)
    {
	    $user = User::find($id);
	    $this->validate($request, [
		    'name' => 'required|max:255',
		    'email' => 'required|unique:users,email,'.$user->id,
	    ]);
	    $input = $request->all();

	    $user->name = $input['name'];
	    $user->email = $input['email'];
	    $res = array_key_exists('active', $input);
	    if ($res == false) {
		    $user->active = 0;
	    } else {
		    $user->active = 1;

	    }
	    if(!empty($input['password'])) {
		    $user->password = bcrypt($input['password']);
	    }

	    $user->save();

	    Session::flash('success_message', 'Great! Client successfully updated!');
	    return redirect()->route('clients.index');
    }


    public function destroy($id)
    {
	    $user = User::find($id);
	    if($user->is_admin == 0){
		    $user->delete();
		    Session::flash('success_message', 'User successfully deleted!');
	    }
	    return redirect()->route('clients.index');

    }
	public function deleteSelectedClients(Request $request)
	{
		$input = $request->all();
		$this->validate($request, [
			'clients' => 'required',

		]);
		foreach ($input['clients'] as $index => $id) {

			$user = User::find($id);
			if($user->is_admin == 0){
				$user->delete();
			}

		}
		Session::flash('success_message', 'clietns successfully deleted!');
		return redirect()->route('clients.index');

	}
}
