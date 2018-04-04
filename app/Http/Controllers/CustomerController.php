<?php

namespace App\Http\Controllers;

use App\Services\CustomerService;

class CustomerController extends Controller
{
    public function createCustomer(CustomerService $service)
    {
        $response = $service->create();
        return response($response);
    }

    public function createOrder(CustomerService $service)
    {
        $response = $service->createOrder();
        return response($response);
    }
}
