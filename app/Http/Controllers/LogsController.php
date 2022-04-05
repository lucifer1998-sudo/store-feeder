<?php

namespace App\Http\Controllers;

use App\Models\Logs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;
use App\Notifications\OrderLogNotification;
use Illuminate\Support\Facades\Notification;

class LogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $attachment = '';
        if (isset($request -> file)){
            $file = $request -> file;
            $file_name = $file->getClientOriginalName();
//            dd($file->getClientOriginalExtension());
            // $file_size = round($file->getSize() / 1024);
            // $file_ex = $file->getClientOriginalExtension();
            // $file_mime = $file->getMimeType();

            // if (!in_array($file_ex, array('jpg', 'gif', 'png'))) return Redirect::to('/')->withErrors('Invalid image extension we just allow JPG, GIF, PNG');

            $newname = time().'-'.$file_name;
            $file->move(base_path().'/public/uploads/', $newname);
            $attachment = '/uploads/'.$newname;
        }
        Logs::create([
            'order_id' => $request -> order_id,
            'body'  => $request -> body,
            'high_priority' => $request->high_priority == 'on' ? 1 : 0 ,
            'created_by' => Auth::id(),
            'attachment' => $attachment
        ]);

        $message = 'Order # '.$request -> order_id.' has a new log.';
        $link = 'search-order?id='.$request -> order_id;
        if (isset($request -> users)){
            $users = User::whereIn('id',$request -> users) -> get();
            Notification ::send($users , new OrderLogNotification(['link' => $link, 'message' => $message]));
        }
        return redirect('search-order?id='.$request -> order_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
