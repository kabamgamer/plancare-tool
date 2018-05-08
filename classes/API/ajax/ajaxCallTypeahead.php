<?php
namespace API\ajax;

require "../../../autoload.php";

use API\CallAPI;

$request = $_POST["query"];

$api = new CallAPI;
$customers = $api->getCustomers("?name*=".$request)["body"];

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