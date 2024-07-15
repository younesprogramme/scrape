<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

/**
 * Trait TokenApiV2Trait
 * @package App\Http\Traits
 */
trait TokenTrait
{

    /**
     * Encrypt text
     * @param string $crypt
     * @param string $key
     * @return string
     */
    private function cryptECB($crypt, $key) {
        // $cipher = "des-ecb";
        $cipher= 'aria-256-cfb';
        if (in_array($cipher, openssl_get_cipher_methods()))
        {
            $ivlen = openssl_cipher_iv_length($cipher);
            $iv = openssl_random_pseudo_bytes($ivlen);
            $cryptText = openssl_encrypt($crypt, $cipher, $key, $options=0, $iv);
            return $cryptText;
        }
        return false;
    }

    /**
     * Decrypt text
     * @param string $encrypted
     * @param object $key
     * @return string
     */
    private function decryptECB($encrypted, $key) {
        // $cipher = "des-ecb";
        $cipher= 'aria-256-cfb';
        if (in_array($cipher, openssl_get_cipher_methods()))
        {
            $ivlen = openssl_cipher_iv_length($cipher);
            $iv = openssl_random_pseudo_bytes($ivlen);

            $stringText = openssl_decrypt($encrypted, $cipher, $key, $options=0, $iv);
            return $stringText;
        }
        return false;
    }

    /**
     * @param $service
     * @return string
     */
    public function getToken($service){
        $current_day = (new \DateTime())->format('d.m.Y');
        $key = config('api.key');
        $text = $current_day.'@'.$service.config('api.base');

        // crypting text
        $crypt = $this->cryptECB($text, $key);
        return base64_encode($crypt);
    }

    /**
     * @param $authorization
     * @return array|bool
     */
    public function isvalidToken($authorization){
        $current_day_new = new \DateTime();
        $current_day_new = $current_day_new->format('d/m/Y');
        $current_day = \DateTime::createFromFormat('d/m/Y',$current_day_new);

        $key = config('api.key');
        $text = config('api.base');
        $token = str_replace('Basic ','',$authorization);
        $token_crypt = base64_decode($token);
        $decrypt = $this->decryptECB($token_crypt, $key);
        $findText = stripos($decrypt,$text);
        if($findText){
            $data_token = substr($decrypt,0,$findText);
            $split_data_token = explode('@',$data_token);
            if(count($split_data_token) > 1){
                $date = str_replace('.','/',$split_data_token[0]);
                $token_date = \DateTime::createFromFormat('d/m/Y',$date);
                if($current_day == $token_date){
                    return [
                        'date'    => $token_date->format('d/m/Y'),
                        'service' => $split_data_token[1]
                    ];
                }else{
                    Log::error("Token expired ".$token);
                }
            }
        }
        return false;
    }

    public function checkRoute($service_id){
        $services = config('api.services');
        $service_name = array_search($service_id,$services);
        if(!$service_name){
            Log::error("Trace : ".$service_id);
            return false;
        }
        Log::info("Trace ".$service_name.": ".$service_id);
        return true;
    }
}
