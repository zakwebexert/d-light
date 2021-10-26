<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
use App\Models\Products;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PaidOrderController extends Controller
{

    public function index()
    {
        $title = 'Paid orders';
        return view('admin.orders.index',compact('title'));
    }

    public function processedindex(){
        $title = 'processed orders';
        return view('admin.processedorders.index',compact('title'));
    }



    public function getOrders(Request $request){
        $columns = array(
            0 => 'id',
            1 => 'shiffing_method',
            2 => 'total',
            3 => 'status',
            4 => 'created_at',
            5 => 'action'
        );

        $totalData = OrderDetail::where('status','Paid')->count();
        $limit = $request->input('length');
        $start = $request->input('start');
        //$order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value'))){
            $users = OrderDetail::where('status','Paid')
                //->offset($start)
                //->limit($limit)
                //->orderBy($order,$dir)
                ->get();
            $totalFiltered = OrderDetail::where('status','Paid')->count();
        }else{
            $search = $request->input('search.value');
            $users = OrderDetail::where([
                ['status','Paid'],
            ])
                ->orWhere('created_at','like',"%{$search}%")
//                ->offset($start)
//                ->limit($limit)
//                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = OrderDetail::where([
                ['status','Paid'],
            ])
                ->orWhere('created_at','like',"%{$search}%")
                ->count();
        }


        $data = array();

        if($users){
            foreach($users as $r){
                $show_url = route('orders.show',$r->id);
                $nestedData['id'] = '<td><label class="checkbox checkbox-outline checkbox-success"><input type="checkbox" name="clients[]" value="'.$r->id.'"><span></span></label></td>';
                $nestedData['user'] = $r->user->name;
                $nestedData['shiffing_method'] = $r->shiffing_method;
                $nestedData['total'] = $r->total;
                $nestedData['status'] = $r->status;

                $nestedData['created_at'] = date('d-m-Y',strtotime($r->created_at));
                $nestedData['action'] = '
                                <div>
                                <td>
                                    <a class="btn btn-sm btn-clean btn-icon" href="'.$show_url.'" title="View Client" href="javascript:void(0)">
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

    public function getProcessedOrders(Request $request){
        $columns = array(
            0 => 'id',
            1 => 'shiffing_method',
            2 => 'total',
            3 => 'status',
            4 => 'created_at',
            5 => 'action'
        );

        $totalData = OrderDetail::where('status','Processed')->count();
        $limit = $request->input('length');
        $start = $request->input('start');
        //$order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value'))){
            $users = OrderDetail::where('status','Processed')
                //->offset($start)
                //->limit($limit)
                //->orderBy($order,$dir)
                ->get();
            $totalFiltered = OrderDetail::where('status','Processed')->count();
        }else{
            $search = $request->input('search.value');
            $users = OrderDetail::where([
                ['status','Processed'],
            ])
                ->orWhere('created_at','like',"%{$search}%")
//                ->offset($start)
//                ->limit($limit)
//                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = OrderDetail::where([
                ['status','Processed'],
            ])
                ->orWhere('created_at','like',"%{$search}%")
                ->count();
        }


        $data = array();

        if($users){
            foreach($users as $r){
                $show_url = route('admin.ProcessedOrder',$r->id);
                $nestedData['id'] = '<td><label class="checkbox checkbox-outline checkbox-success"><input type="checkbox" name="clients[]" value="'.$r->id.'"><span></span></label></td>';
                $nestedData['user'] = $r->user->name;
                $nestedData['shiffing_method'] = $r->shiffing_method;
                $nestedData['total'] = $r->total;
                $nestedData['status'] = $r->status;

                $nestedData['created_at'] = date('d-m-Y',strtotime($r->created_at));
                $nestedData['action'] = '
                                <div>
                                <td>
                                    <a class="btn btn-sm btn-clean btn-icon" href="'.$show_url.'" title="View Client" href="javascript:void(0)">
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

    public function ProcessedOrderShow($id){
        $title = 'order detail';
        $order_id = $id;
        $order = OrderDetail::where('id',$order_id)->with('orderitems')->with('user')->first();
        $products = [];

        for ($i =0 ;$i<count($order['orderitems']);$i++){
            $item = Products::where('id',$order['orderitems'][$i]->product_Id)->first();
            $item['quantity'] = $order['orderitems'][$i]->quantity;
            $itemss = json_decode($order['orderitems'][$i]->product_choices);
            $choices = [];
            foreach ($itemss as $ch){
                $c =  explode("=>",$ch);
                array_push($choices,$c);

            }
            $item['choices'] = $choices;
            array_push($products,$item);
        }

        return view('admin.processedorders.detail', ['title' => 'Complete Order Detail', 'order' => $order,'products'=>$products]);

    }


    public function show($id){
        $title = 'order detail';
        $order_id = $id;
        $order = OrderDetail::where('id',$order_id)->with('orderitems')->with('user')->first();
        $products = [];

        for ($i =0 ;$i<count($order['orderitems']);$i++){
            $item = Products::where('id',$order['orderitems'][$i]->product_Id)->first();
            $item['quantity'] = $order['orderitems'][$i]->quantity;
            $itemss = json_decode($order['orderitems'][$i]->product_choices);
            $choices = [];
            foreach ($itemss as $ch){
                $c =  explode("=>",$ch);
                array_push($choices,$c);

            }
            $item['choices'] = $choices;
            array_push($products,$item);
        }

        return view('admin.orders.detail', ['title' => 'Paid Order Detail', 'order' => $order,'products'=>$products]);

    }

    public function change_status($id){
    $order = OrderDetail::find($id);

    $order->status = 'Processed';
    $order->save();

    return redirect()->route('orders.index');
    }


}
