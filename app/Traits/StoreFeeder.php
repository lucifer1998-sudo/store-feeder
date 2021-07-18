<?php


namespace App\Traits;

use Exception;
use Carbon\Carbon;
use App\Models\Orders;

trait StoreFeeder {

    public function getBearerToken(){
        if (strtotime(Carbon::now()) < session('token_expiry')){
            return session('store_feeder_token');
        }
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => config('app.store_feeder_url') . 'Token',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'grant_type=password&username='.config('app.store_feeder_username').'&password='.config('app.store_feeder_password').'&client_id='.config('app.store_feeder_client_id'),
        ));

        $res = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($res,true);
        session(['store_feeder_token'=>$response['access_token']]);
        session(['token_expiry' =>  strtotime($response['.expires'])]);
        return $response['access_token'];
    }

    public function getOrderDetailById($id){
        $token = $this ->getBearerToken();
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => config('app.store_feeder_url').'orders/'.$id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$token,
        ),
        ));

        $res = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $response = json_decode($res,true);
        // dump($httpcode);
        // dd($response);
        if ($httpcode == 200){
            $this -> saveOrder($response);
            return ['status' => $httpcode , 'message' => 'Success!' , 'data' => $response ];
        }else {
            return ['status' => $httpcode , 'message' => 'ERROR!!' , 'data' => $response ];
        }
    }

    public function saveOrder( $data ){
        Orders::updateOrCreate(
            [ 'id' => $data['OrderNumber'] ],
            [ 'data' => json_encode($data) ]
        );
    }

}