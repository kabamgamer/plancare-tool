<?php

namespace PlanCare;

class Services extends \API\CallAPI
{
    /**
     * Methods to get PlanCare services
     *
     * @param null $request = Optional: int(id)
     * @return array|mixed
     */
    public function get($request = null)
    {
        return $this->apiCall("GET", "/plancareServices/" . $request);
    }

    /**
     * Method for creating a service
     *
     * @param $serviceName  = string(serviceName)
     * @param $customerId   = int(id)
     *
     * @return array|mixed
     */
    public function create($serviceName, $customerId)
    {
        $data = [
            "name" => $serviceName,
            "customer" => $customerId
        ];

        return $this->apiCall("POST", "/plancareServices/forCustomer", $data);
    }

    /**
     * Method for updating service properties
     *
     * @param $serviceId        = int(id)
     * @param $serviceAddress   = string(API-url)
     * @param $apiKey           = string(API-key)
     * @param $username         = string(API-username)
     * @param $password         = string(API-password)
     *
     * @return array|mixed
     */
    public function update($serviceId, $serviceAddress, $apiKey, $username, $password)
    {
        $data = [
            "rest_service_address"  => $serviceAddress,
            "rest_api_key"          => $apiKey,
            "username"              => $username,
            "password"              => $password
        ];

        return $this->apiCall("PUT", "/plancareServices/$serviceId", $data);
    }

    /**
     * Method to get PlanCare version
     *
     * @param $id = int(serviceId)
     * @return array|mixed
     */
    public function getVersion($id)
    {
        $data = [
            "method" => "getPlancareversionsPlancareversion"
        ];
        return $this->apiCall("POST", "/plancareServices/$id/executeOnConnector", $data);
    }
}