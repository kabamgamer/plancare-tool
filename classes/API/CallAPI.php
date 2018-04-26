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
        $token = "207.658313.1524754598.88713f5373c10bc17f445c9c61c7d78dcc8970a94e936160c6ad208d50273e37";

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
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

                break;

            case "PUT":
                curl_setopt($curl, CURLOPT_PUT, TRUE);
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
     * Method for retrieving PlanCare services
     */
    public function getServices($id = null)
    {
        return $this->apiCall("GET", "/plancareServices/$id?offset=160&limit=25");
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
    public function updateProperty($serviceId)
    {
        return $this->apiCall("PUT", "/plancareServices/$serviceId", "");
    }


}