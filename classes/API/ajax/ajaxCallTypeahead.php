<?php
namespace API\ajax;

require "../../../core/init.php";

use API\CallAPI;
use errorHandlers\HttpErrors;

$request = $_POST["query"];

$api = new CallAPI;
$result = $api->getCustomers("?name*=".$request."&limit=8");
$customers = $result["body"];

$httpCheck = new HttpErrors($result["headers"][0]);

$data = array();

if (count($customers) > 0) {
    foreach($customers as $customer){
        $data[] = [
            "id" => $customer["id"],
            "name" => $customer["name"],
            "href"=>"index.php?customerId=".$customer['id']
        ];
    }
}

echo json_encode($data);
