<?php
namespace API\ajax;

require "../../../core/init.php";

use API\CallAPI;

$request = $_POST["query"];

$api = new CallAPI;
$customers = $api->getCustomers("?name*=".$request."&limit=8")["body"];

$data = array();

if (count($customers) > 0) {
    foreach($customers as $customer){
        $data[] = [
            "id" => $customer["id"],
            "name" => $customer["name"],
            "href"=>"index.php?customerId=".$customer['id']
        ];
    }
    echo json_encode($data);
}