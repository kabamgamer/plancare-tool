<?php
namespace API\ajax;

require "../../../autoload.php";

use API\CallAPI;

$request = $_REQUEST;
$col = [
    0 => 'id',
    1 => 'name',
    2 => 'project',
    3 => 'plancare_version'
]; //create columns

$api = new CallAPI;
$services = $api->getServices();
$resultNum = count($services);
$resultFilter = $resultNum;

$data = array();

// Place services in table
foreach($services as $headers => $service){
    $subdata = array();
    $subdata[] = $service["id"]; // ID
    $subdata[] = $service["name"]; // Name
    $subdata[] = $service["project"]; // Project
    $subdata[] = $service["plancare_version"]; // Version
    $subdata[] = "<a href=\"properties.php?serviceId=".$service['id']."  \"><button class='next-btn'><span>Eigenschappen </span></button></a>";
    $data[] = $subdata;
}

$json_data = array(
    "draw"              => intval($request['draw']),
    "recordsTotal"      => intval($resultNum),
    "recordsFiltered"   => intval($resultFilter),
    "data"              => $data

);

echo json_encode($json_data);
