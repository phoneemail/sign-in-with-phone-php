<?php

require 'vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;


if(isset($_GET['phtoken'])){
    try {
        $api_key = 'API_KEY'; // Please specify API key provided by Phone Email mobile application
        $decoded = JWT::decode($_GET['phtoken'], new Key($api_key, 'HS256'));
        $jwt_response = 1;  // JWT decoded successfully
        $jwt_phone = $decoded->country_code.$decoded->phone_no; // You will get user phone number here from JWT
    } catch (Exception $e) {
        $jwt_response = 0; // Invalid JWT
        $jwt_phone = '';
    }
}else{
    $jwt_response = 0; // Invalid JWT
    $jwt_phone = '';
}

?>
