<?php

namespace PlanCare;

class Customers extends \API\CallAPI
{
    /**
     * Methods to get Customers
     *
     * @param null $request     = Optional: int(id)
     * @return array|mixed      = Customer data
     */
    public function get($request = null)
    {
        return $this->apiCall("GET", "/customers/$request");
    }

    /**
     * Method to create a customer
     *
     * @param $name = string(customerName)
     * @return array|mixed
     */
    public function create($name)
    {
        $data = [
            "name" => $name
        ];
        return $this->apiCall("POST", "/customers", $data);
    }
}