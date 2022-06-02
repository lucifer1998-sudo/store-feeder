<?php

namespace App\Http\Controllers;

use App\Models\DelayedReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class ReportsController extends Controller
{

//    private $API_ROOT = "https://rest.storefeeder.com";
//    private $ACCESS_TOKEN = "";
//
//    public function __construct(){
//        $apiRequest = Http::asForm()->post($this->API_ROOT . "/Token", [
//            "grant_type" => "password",
//            "username" => env('STORE_FEEDER_USERNAME'),
//            "password" => env("STORE_FEEDER_PASSWORD"),
//            "client_id" => env("STORE_FEEDER_CLIENT_ID")
//        ]);
//
//        $json = $apiRequest->json();
//        $this->ACCESS_TOKEN = $json["access_token"];
//    }


    public function index(){
        $notifications = DelayedReply::all();
        return view('admin.dashboard',compact('notifications'));
    }

    //Daily Reports
//    public function dailyReports(){
//
//        $channelRequest = Http::withToken($this->ACCESS_TOKEN)->get($this->API_ROOT . "/channel-categories", [
//
//        ]);
//        return $channelRequest->body();
//        return $token;

//        grant_type=password&username={example%40example.com}&password={example}&client_id={example}

//    }
}
