<?php

namespace App\Http\Controllers;

use App\Services\CustomerService;

/**
 * Class CustomerController
 * @package App\Http\Controllers
 */
class CustomerController extends Controller
{
    /**
     * @param CustomerService $service
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function createCustomer(CustomerService $service)
    {
        $response = $service->create();
        return response($response);
    }

    /**
     * @param CustomerService $service
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function createOrder(CustomerService $service)
    {
        $response = $service->createOrder();
        return response($response);
    }
}
