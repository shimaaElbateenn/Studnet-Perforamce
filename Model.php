<?php


class Model
{
    public static function CallAPI($method = 'POST')
    {
        $endpoint = "http://127.0.0.1:12346/";
//        $headers = [
//            "Content-Type: application/json",
//            "Accept: application/json"
//        ];


        $curl = curl_init();
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_URL, $endpoint);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($curl);
        if (!$result) {
            die("Connection Failure");
        }
        curl_close($curl);
        return $result;
    }
}