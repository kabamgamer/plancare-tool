<?php

namespace API;

class CallAPI
{
    const URI = 'https://api-dev2.tapster.nl/v1';

    /**
     * Get headers
     *
     * @param $curl
     */
    public function headers($curl)
    {
//        $token = $this->authorization()["body"]["token"];
        $token = "207.658313.1527605652.3e7c18f281b7889d429f59668776d09b1de048040a8447d46f7d842b5a0d3df2";

        $headers   = array();
        $headers[] = "Content-type: application/json";
        $headers[] = "Authorization: bearer $token";

        // Send headers
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    }

    /**
     * Create token out of refresh token
     *
     * @param $curl
     * @return array|mixed
     */
    public function authorization()
    {
        $data = array(
            "refreshToken" => "MB2vKtRyGX3fsNKzSG7J6qLUC7ZJWweBl85pPSQxEVYMBDlF9jNP8mwzclDTmnnF"
        );

        $result = $this->apiCall("POST", "/api/createAuthTokenFromRefreshToken", $data);

        return $result;
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
     * Methods for Customers
     */
    public function getCustomers($request = null)
    {
        return $this->apiCall("GET", "/customers/$request");
    }
    public function postCustomer($data)
    {
        return $this->apiCall("POST", "/customers", $data);
    }

    /**
     * Methods for PlanCare services
     */
    public function getServices($request = null)
    {
        return $this->apiCall("GET", "/plancareServices/".$request);
    }
    public function getService($request)
    {
        return $this->apiCall("GET", "/plancareServices/$request");
    }
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

    public function getVersion($id)
    {
        $data = [
            "method" => "getPlancareversionsPlancareversion"
        ];
        return $this->apiCall("POST", "/plancareServices/$id/executeOnConnector", $data);
    }

}