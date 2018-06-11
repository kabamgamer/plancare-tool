<?php
namespace API\ajax;

require "../../../core/init.php";

use \errorHandlers\HttpErrors;
use PlanCare\Services;

$request = $_REQUEST;
$col = [
    0 => 'serviceID',
    1 => 'name',
    2 => 'project',
    3 => 'plancare_version'
]; //create columns

$service = new Services;
$customerId = $_POST["customerId"];
$responseHeaders = $service->get()["headers"];

// Order data
$sort = "sort".ucfirst($request['order'][0]['dir']);
$result = $service->get(($customerId == 0 ? "?" : "?projects.customerID=" . $customerId) . "&expand=project&limit=" . $request['length'] . "&offset=".$request['start'] . "&$sort=plancare_services." . $col[$request['order'][0]['column']]);
$services = $result["body"];
$pos = intval(strpos($result['headers'][13],":")) + 1;
$resultNum = intval(substr($result['headers'][13], $pos));

// Search data
if(!empty($request['search']['value'])){
    $result = $service->get(($customerId == 0 ? "?" : "?projects.customerID=" . $customerId) . "&expand=project&id,name,plancare_version*=" . $request['search']['value']. "&limit=" . $request['length'] . "&offset=".$request['start'] . "&$sort=plancare_services." . $col[$request['order'][0]['column']]);
    $services = $result["body"];
    $pos = intval(strpos($result['headers'][13],":")) + 1;
    $resultNum = intval(substr($result['headers'][13], $pos));
}

$data = array();

$resultFilter = $resultNum;

$httpCheck = new HttpErrors($result["headers"][0]);

if($httpCheck->passed()){
    // Place services in table
    foreach($services as $headers => $service){
        $subdata = array();
        $subdata[] = $service["id"]; // ID
        $subdata[] = $service["name"]; // Name
        $subdata[] = $service["project"]["name"]; // Project
        $subdata[] = $service["plancare_version"]; // Version
        $subdata[] = "<a href=\"properties.php?serviceId=".$service['id']."&customerId=" . $customerId . "  \"><button class='next-btn'><span>Eigenschappen </span></button></a>";
        $data[] = $subdata;
    }
} else {
    $subdata = array();
    $subdata[] = $httpCheck->message(); // ID
    $data[] = $subdata;
}



$json_data = array(
    "draw"              => intval($request['draw']),
    "recordsTotal"      => intval($resultNum),
    "recordsFiltered"   => intval($resultFilter),
    "data"              => $data
);

echo json_encode($json_data);
