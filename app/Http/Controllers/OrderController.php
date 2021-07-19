<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Traits\StoreFeeder;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use StoreFeeder;
    public function search(Request $request){
        $request -> validate([
            'id' => 'required'
        ]);
        if (isset($request->channel)){
            $response = $this -> getOrderDetailByChannelOrderId($request->id);
            if ( $response['status'] != 200 ) abort(404,$response['data']['Message']);
            return view('order.details',['order' => $response['data'][0] ]);
        }
        $order = Orders::find($request -> id);
        if (isset($order)) return view('order.details',[ 'order' => $order -> body ]);
        $response = $this -> getOrderDetailById($request -> id);
        if ( $response['status'] != 200 ) abort(404,$response['data']['Message']);
        return view('order.details',['order' => $response['data'] ]);
    }
}
