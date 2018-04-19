<?php

namespace API;


class CallAPI
{
    const URI = 'https://api2.tapster.nl/v1';


    /**
     * Get headers
     */
    private function headers()
    {
        $token = "207.658313.1524150539.5219a7dccaef822d46a5467d86f59b285626d448ef13ba5f10d94414c3d73674";

        $headers = array();
        $headers[] = "Content-type: application/json";
        $headers[] = "Authorization: bearer $token";

        return $headers;
    }

    /**
     * Method for API calls
     *
     * @param string $method
     * @param string $url
     * @param array $data
     */
    private function apiCall($method, $url, $data = false)
    {
        $url = (self::URI . $url);

        $curl = curl_init();

        $headers = $this->headers();

        // Check method
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

        // Send headers
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        // Decode json to array
        $result = json_decode(curl_exec($curl), true);

        curl_close($curl);

        return $result;
    }


    /**
     * Method for retrieving PlanCare services
     */
    public function getServices($ext = null)
    {
        if(isset($ext)){
            return $this->apiCall("GET", "/customers/$ext");
        } else{
            return $this->apiCall("GET", "/customers");
        }
    }

    /**
     * Method for posting new service
     */
    public function postService()
    {
        return $this->apiCall("POST", "/plancareServices", "");
    }

    /**
     * Method for updating service properties
     *
     * @param int $serviceId
     */
    public function updateProperty($serviceId)
    {
        return $this->apiCall("PUT", "/plancareServices/$serviceId", "");
    }


}