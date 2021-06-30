<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// custom
use Illuminate\Support\Facades\Http;

class GetCarsController extends Controller
{
    public function getCars(Request $request){
        // $login_url1 = "https://www.vehiclehistory.com/";
        // $post_data['input-1'] = str_replace(' ', '', "1013436209395125"); //'1013436209395125'; //$_REQUEST['LicenseNo'];
        // $out = GetCarsController::getdata($login_url1, '', $post_data, 0, [], false);

        // JTJBT20X830005389 vin number
        $vin_number = "JTJBT20X830005389";
        
        $response = Http::get('https://www.vehiclehistory.com/vin-report/JTJBT20X830005389');
        // $response = Http::get('https://www.vehiclehistory.com/data?operationName=getVinChainReport&variables=%7B%22vin%22%3A%22'.$vin_number.'%22%2C%22ip%22%3A%222400%3Aadc1%3A1ed%3A8400%3Ab9b4%3Ac985%3A6e41%3A4f44%22%7D&extensions=%7B%22persistedQuery%22%3A%7B%22version%22%3A1%2C%22sha256Hash%22%3A%22d465778edd4c81cbddc47b642fe9587b5c47a15195d746b02d0c5930ffcefb5b%22%7D%7D');
        echo "<pre>";
        print_r($response->body());
        // print_r($out);
        echo "</pre>";

        // echo "asdasds";
    }


    public static function getdata($url, $cookie_jar = '', $post = array(), $sleep = 2, $cookies = array(), $verbose = false) {
        global $proxy;
        global $user_agent;

        // Setup request
        $ch = curl_init();
        $fields = '';
        $capcha = false;

        // Set curl options
        curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_jar);
        // curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_jar);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($ch, CURLOPT_MAXREDIRS, 2);
        // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        // curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
        // curl_setopt($ch, CURLOPT_HEADER, 1);
        // curl_setopt($ch, CURLOPT_NOBODY, false);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        // if ($verbose) {
        //     curl_setopt($ch, CURLOPT_VERBOSE, 1);
        // }

        // if ($proxy['host'] != '') {
        //     curl_setopt($ch, CURLOPT_PROXY, $proxy['host']);
        //     if ($proxy['auth'] != '') {
        //         curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxy['auth']);
        //     }
        // }

        // if (count($cookies) > 0) {
        //     $cookie_string = '';
        //     foreach ($cookies as $key => $val) {
        //         logger("... Setting cookie: $key=$val");
        //         $cookie_string .= " $key=\"$val\";";
        //     }
        //     curl_setopt($ch, CURLOPT_COOKIE, $cookie_string);
        // }

        // Submit POST fields
        // if (count($post) > 0) {
        //     curl_setopt($ch, CURLOPT_POST, true);
        //     foreach ($post as $key => $value) {
        //         //logger("... Sending $key: '".urlEncode($value)."'");
        //         $fields .= $key . '=' . urlEncode($value) . '&';
        //     }
        //     $fields = rtrim($fields, '&');
        //     curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        // }

        // Execute + extract data to array
        $curl_output = curl_exec($ch);
        $out['headers'] = explode("\n", substr($curl_output, 0, curl_getinfo($ch, CURLINFO_HEADER_SIZE)));
        $out['html'] = substr($curl_output, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
        $out['http_code'] = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $out['last_url'] = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
        curl_close($ch);


        // Verbose print
        if ($verbose) {
            print_r($out);
        }

        // Sleep
        if ($sleep > 0) {
            logger("... Sleeping for $sleep seconds");
            sleep($sleep);
        }

        // Return
        return $out;
    }
}
