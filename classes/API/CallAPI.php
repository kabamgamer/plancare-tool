<?php

namespace API;

use \Cookie;

class CallAPI
{
    private $_URI,
            $_DotENV;


    public function __construct()
    {
        $this->_DotENV = new \Dotenv\Dotenv(ROOT);
        $this->_DotENV->load();

        $this->_URI = $_ENV["API_URI"];
    }

    /**
     * Get headers
     *
     * @param $curl = curl_init() from parent method
     */
    private function headers($curl)
    {
        $token = Cookie::get("accessToken");

        $headers   = array();
        $headers[] = "Content-type: application/json";
        $headers[] = "Authorization: bearer $token";

        // Send headers
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    }

    /**
     * Set Curl method
     *
     * @param $curl     = curl_init() from parent method
     * @param $method   = POST|PUT|GET
     * @param $url      = Request url. (defined in the .env file)
     * @param $data     = false|array
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
     * @param string $method    = POST|PUT|GET
     * @param string $url       = Request url (defined in the .env file)
     * @param array $data
     */
    protected function apiCall($method, $url, $data = false)
    {
        $url = ($this->_URI . $url);

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

        // Separate headers from body
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
}