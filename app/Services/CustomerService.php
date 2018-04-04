<?php

namespace App\Services;

use GuzzleHttp\Client;

class CustomerService
{
    private $client;
    private $baseUrl;

    public function __construct()
    {
        $this->client = new Client();
        $this->baseUrl = 'http://159.65.107.158/api/v1/';
    }

    public function create()
    {
        $response = $this->client->post($this->baseUrl . 'customers', [
            'form_params' => [
                "login" => 'testLogin10',
                "password" => 'testPassowrd'
            ]
        ]);

        return $response->getBody();
    }

    public function createOrder()
    {
        $newCustomer = json_decode($this->create());
        $newPhoto = $this->client->post($this->baseUrl . 'customers/' . $newCustomer->id . '/photo', [
            'multipart' => [
                [
                    'name' => 'customer_id',
                    'contents' => $newCustomer->id
                ],
                [
                    'name' => 'image',
                    'contents' => fopen('../storage/app/public/course.png', 'r')
                ]
            ]
        ]);
        $data = [
            'customer_id' => $newCustomer->id,
            'items' => [
                [
                    'photo_id' => json_decode($newPhoto->getBody())->id,
                    'qty' => 1,
                    'format_id' => 1,
                    'addons' => [
                        [
                            'id' => 1,
                            'qty' => 1
                        ]
                    ]
                ]
            ],
            'delivery' => [
                "country" => "Germany",
                "city" => "Munich",
                "phone" => "55-66-77",
                "zip_code" => 12345,
                "name" => "Wolter",
                "street" => "Some street"
            ]
        ];

        $response = $this->client->post($this->baseUrl . 'customers/' . $newCustomer->id . '/orders', [
            'form_params' => $data
        ]);
        return $response->getBody();
    }
}