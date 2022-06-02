<?php

namespace App\Http\Controllers;

use App\Models\Complain;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Database\Eloquent\Collection;

class ComplainController extends Controller
{
    public function index(){
        return view('admin.progressreport');
    }
    public function store(Request $request){
//dd($request->all());
        foreach($request->against as $against){
            Complain::create([
                'created_by' => Auth::id(),
                'against' => $against,
                'order_id' => $request->order_id,
                'comment' => $request->comment,
            ]);
        };

        return redirect('search-order?id='.$request -> order_id);
    }
    public function generateReport(){
        $complains = Complain::all();
        return (new FastExcel($complains))->download('UsersReport.xlsx');
    }


}
