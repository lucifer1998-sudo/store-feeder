<?php

namespace App\Http\Controllers;

use App\Models\Logs;
use App\Models\User;
use App\Models\Order;
use App\Models\Orders;
use App\Traits\StoreFeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    use StoreFeeder;
    public function search(Request $request)
    {
        $request -> validate([
            'id' => 'required'
        ]);
        if (isset($request->channel)){
            $response = $this -> getOrderDetailByChannelOrderId($request->id);
            if ( $response['status'] != 200 ) abort(404,$response['data']['Message']);
            return view('order.details',['order' => $response['data'][0] ]);
        }
        $order = Orders::find($request -> id);
//        dd($order);
        if ( isset($order) ) $order_logs = $order -> logs ;
        else $order_logs = [];
        // if (isset($order)) return view('order.details',[ 'order' => $order -> body ]);
        $response = $this -> getOrderDetailById($request -> id);
        $users = User::select('id','name')-> where('id','!=',auth()->id())->get();
        // dd($response);
        if ( $response['status'] != 200 ) abort(404,$response['data']['Message']);
        return view('order.details',['order' => $response['data'] , 'logs' => $order_logs , 'users' => $users , 'assigned_to' => $order -> assigned_to ?? ''  , 'status' => $order -> status ]);
    }

    public function assignOrder(Request $request , $order_id){
        $order = Order ::find($order_id);
        $order -> update([ 'assigned_to' => $request -> assign_to , 'status' => $request -> status]);
        if (isset($request -> assign_to) && $request -> assign_to > 0){
            Logs::create([
                'order_id' => $request -> order_id,
                'body'  => 'Assigned to '. User::find($request -> assign_to)->name . ' with status '. $request -> status,
                'created_by' => Auth::id()
            ]);
        }
        return redirect('search-order?id='.$order_id);
    }
}
