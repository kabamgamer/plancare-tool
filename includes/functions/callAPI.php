<?php
function CallAPI($method, $url, $data = false)
{
    $curl = curl_init();
    $token = "207.658313.1523985054.3778732819b6f3e4130eaa1b060523594fd7912bcd2504a2af84801eaff147c7";

    switch ($method)
    {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);

            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        case "GET":
            curl_setopt($curl, CURLOPT_HTTPGET, TRUE);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }

    // Optional Authentication:
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: bearer $token"));

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);

    $result = json_decode(curl_exec($curl), true);

    curl_close($curl);

    return $result;
}