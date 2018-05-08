<?php

namespace API;

class CallAPI
{
    const URI = 'https://api-dev2.tapster.nl/v1';

    /**
     * Get headers
     */
    protected function headers($curl)
    {
        $token = "207.658313.1525802302.85db6eb57265e9d5593374310f1e290be8b07a93b0df414dc986cafc0327f97f";

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
        curl_setopt($curl, CURLOPT_VERBOSE, 1);
        curl_setopt($curl, CURLOPT_HEADER, 1);

        $response = curl_exec($curl);

        $header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
        $headers = substr($response, 0, $header_size);
        $header = explode("\n", $headers);
        $body = substr($response, $header_size);

        // Decode json to array
        if($method == "POST" || $method == "PUT") {
            $result = json_decode($body, TRUE);
        } else {
            $result = array("headers" => $header, "body" => json_decode($body, TRUE));
        }


        curl_close($curl);

        return $result;
    }


    /**
     * Get customers
     */
    public function getCustomers($request = null)
    {
        return $this->apiCall("GET", "/customers/$request");
    }
    public function postCustomers($data)
    {
        return $this->apiCall("POST", "/customers", $data);
    }

    /**
     * Method for retrieving PlanCare services
     */
    public function getServices($request = null)
    {
        return $this->apiCall("GET", "/plancareServices/".$request);
    }
    public function getService($request)
    {
        return $this->apiCall("GET", "/plancareServices/$request");
    }

    /**
     * Method for posting new service
     */
    public function postService($data)
    {
        return $this->apiCall("POST", "/plancareServices/forCustomer", $data);
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