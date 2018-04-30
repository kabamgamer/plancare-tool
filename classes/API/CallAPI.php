<?php

namespace API;

class CallAPI
{
    const URI = 'https://api-dev2.tapster.nl/v1';

    /**
     * Get headers
     */
    private function headers($curl)
    {
        $token = "207.658313.1525128146.2ffb1697a1ff6d26423707fe9c46c8ad5eb1a7e1874b2ee1ea735e14fa6d0ea2";

        $headers   = array();
        $headers[] = "Content-type: application/json";
        $headers[] = "Authorization: bearer $token";

        // Send headers
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    }

    /**
     * Check method
     */
    private function method($curl, $method, $url, $data)
    {
        // Check method
        switch ($method) {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, TRUE);

                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));

                break;

            case "PUT":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
                break;

            case "GET":
                curl_setopt($curl, CURLOPT_HTTPGET, TRUE);
                break;

            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }
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

        // Add headers
        $this->headers($curl);

        // Check method
        $this->method($curl, $method, $url, $data);

        // Set URL and other appropriate options
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);

        // Decode json to array
        $result = json_decode(curl_exec($curl), TRUE);

        curl_close($curl);

        return $result;
    }


    /**
     * Get customers
     */
    public function getCustomers($id = null)
    {
        return $this->apiCall("GET", "/customers/$id?limit=10");
    }

    /**
     * Method for retrieving PlanCare services
     */
    public function getServices($id = null)
    {
        return $this->apiCall("GET", "/plancareServices/$id?limit=20");
    }

    /**
     * Method for posting new service
     */
    public function postService($data)
    {
        return $this->apiCall("POST", "/plancareServices", $data);
    }

    /**
     * Method for updating service properties
     *
     * @param int $serviceId
     */
    public function updateProperty($serviceId, $data)
    {
        return $this->apiCall("PUT", "/plancareServices/$serviceId", $data);
    }


}