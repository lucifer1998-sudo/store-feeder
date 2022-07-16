<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReturnOrder;
use Illuminate\Support\Facades\Auth;
use Rap2hpoutre\FastExcel\FastExcel;
use Spatie\Permission\Traits\HasRoles;

class ReturnOrderController extends Controller
{
    public function store(Request $request){
        ReturnOrder::create([
            'created_by' => Auth::id(),
            'order_id' => $request->order_id,
            'body' => $request->body,
        ]);
        return redirect('search-order?id='.$request -> order_id);
    }

    public function show(Request $request)
    {
        $returnOrders = new ReturnOrder;
        $orderid = $request->orderid;
        $startDate = $request->startDate;
        $endDate = $request->endDate;
            if ($request->type)
                {
                    $returnOrders = new ReturnOrder;
                    if(isset($orderid) && $orderid != '')
                    {
                        $returnOrders = $returnOrders->where('order_id', $orderid);
                    }
                if( (isset($orderid) && $orderid != '') && ($startDate!='' && $endDate!='') )
                    {
                        $returnOrders=$returnOrders->wherebetween('created_at',[$startDate,$endDate]);
                    }
                $returnOrders = $returnOrders->get();
                $view = view('admin.filter_return_replacement')->with(['returnOrders' => $returnOrders])->render();
                return response()->json(['html' => $view]);
                }
                else
                {
                    $returnOrders = new ReturnOrder;
                    $returnOrders = $returnOrders->get();
                    return view('admin.returnOrders')->with(['returnOrders'=> $returnOrders]);
                }
    }

    public function returnOrderReport()
    {
        $returnOrderReport = ReturnOrder::all();
        return (new FastExcel($returnOrderReport))->download('returnOrderReport.xlsx');
    }

}
