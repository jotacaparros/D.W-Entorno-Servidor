<?php
define("ENCRYPT_METHOD", "AES-256-CBC");
define("SECRET_KEY", "12345");
define("SECRET_IV", "67890");

class Crypt
{
    public static function Encriptar($string)
    {
        $output = false;
    
        $key = hash("sha256", SECRET_KEY);    
        
        $iv  = substr(hash("sha256", SECRET_IV), 0, 16);
    
        $output = openssl_encrypt($string, ENCRYPT_METHOD, $key, 0, $iv);
        $output = base64_encode($output);

    
        return $output;
    }
    
    public static function Desencriptar($string)
    {
        $output = false;
    
        $key = hash("sha256", SECRET_KEY);    
        
        $iv  = substr(hash("sha256", SECRET_IV), 0, 16);
    
        $output = base64_decode($string);
        $output = openssl_decrypt($output, ENCRYPT_METHOD, $key, 0, $iv);
    
        return $output;        
    }

}

//echo Crypt::Desencriptar('aFRDTTNUTkRRWCtSRFEyeUlOWVRYdz09');

?>