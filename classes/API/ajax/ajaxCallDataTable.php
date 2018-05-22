<?php
namespace API\ajax;

require "../../../core/init.php";

use API\CallAPI;
use \errorHandlers\HttpErrors;

$request = $_REQUEST;
$col = [
    0 => 'serviceID',
    1 => 'name',
    2 => 'project',
    3 => 'plancare_version'
]; //create columns

$api = new CallAPI;
$responseHeaders = $api->getServices()["headers"];

// Order data
$sort = "sort".ucfirst($request['order'][0]['dir']);
$result = $api->getServices(($_POST['customerId'] == 0 ? "?" : "?projects.customerID=" . $_POST['customerId']) . "&limit=" . $request['length'] . "&offset=".$request['start'] . "&$sort=plancare_services." . $col[$request['order'][0]['column']]);
$services = $result["body"];
$pos = intval(strpos($result['headers'][13],":")) + 1;
$resultNum = intval(substr($result['headers'][13], $pos));

// Search data
if(!empty($request['search']['value'])){
    $result = $api->getServices(($_POST['customerId'] == 0 ? "?" : "?projects.customerID=" . $_POST['customerId']) . "?id,name,plancare_version*=" . $request['search']['value']);
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
        $subdata[] = $service["project"]; // Project
        $subdata[] = $service["plancare_version"]; // Version
        $subdata[] = "<a href=\"properties.php?serviceId=".$service['id']."&customerId=" . $_POST["customerId"] . "  \"><button class='next-btn'><span>Eigenschappen </span></button></a>";
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
