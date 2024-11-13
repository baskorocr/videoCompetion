<?php

namespace App\services;
use Illuminate\Support\Str;
use Exception;


class TripayServices
{
    public function channel()
    {
        try {
            $apiKey = config('tripay.api_key');


            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_FRESH_CONNECT => true,
                CURLOPT_URL => 'https://tripay.co.id/api-sandbox/merchant/payment-channel',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER => false,
                CURLOPT_HTTPHEADER => ['Authorization: Bearer ' . $apiKey],
                CURLOPT_FAILONERROR => false,
                CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4
            ));

            $response = curl_exec($curl);

            $error = curl_error($curl);



            curl_close($curl);

            if ($error) {
                throw new Exception("cURL Error: " . $error);
            }

            $response = json_decode($response)->data;

            return $response ? $response : 'No data found';
        } catch (Exception $e) {
            // Log the error or handle it in a way that suits your application


            return 'Error: ' . $e->getMessage();
        }
    }

    public function requestTransaction($method, $karya, $donation, $name, $email)
    {

        try {


            $apiKey = config('tripay.api_key');
            $privateKey = config('tripay.private_key');
            $merchantCode = config('tripay.merchant_key');
            $merchantRef = 'INV' . time();

            $data = [
                'method' => $method,
                'merchant_ref' => $merchantRef,
                'amount' => $donation,
                'customer_name' => $name,
                'customer_email' => $email,

                'order_items' => [
                    [
                        'name' => $karya,
                        'price' => $donation,
                        'quantity' => 1,
                    ],
                ],

                // 'return_url' => 'http://ddp.dharmap.com/batik/redirect/success',
                'expired_time' => (time() + (24 * 60 * 60)), // 24 hours
                'signature' => hash_hmac('sha256', $merchantCode . $merchantRef . $donation, $privateKey)
            ];

            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_FRESH_CONNECT => true,
                CURLOPT_URL => 'https://tripay.co.id/api-sandbox/transaction/create',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER => false,
                CURLOPT_HTTPHEADER => ['Authorization: Bearer ' . $apiKey],
                CURLOPT_FAILONERROR => false,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => http_build_query($data),
                CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4
            ]);

            $response = curl_exec($curl);
            $error = curl_error($curl);


            curl_close($curl);

            if ($error) {
                throw new Exception("cURL Error: " . $error);
            }


            return $response ?: 'No response received';
        } catch (Exception $e) {
            // Log the error or handle it in a way that suits your application

            return 'Error: ' . $e->getMessage();
        }
    }


    public function detailTransaction($ref)
    {


        try {
            $apiKey = config('tripay.api_key');

            $payload = ['reference' => $ref];

            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_FRESH_CONNECT => true,
                CURLOPT_URL => 'https://tripay.co.id/api-sandbox/transaction/detail?' . http_build_query($payload),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER => false,
                CURLOPT_HTTPHEADER => ['Authorization: Bearer ' . $apiKey],
                CURLOPT_FAILONERROR => false,
                CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4
            ]);

            $response = curl_exec($curl);
            $error = curl_error($curl);

            curl_close($curl);


            if ($error) {
                throw new Exception("cURL Error: " . $error);
            }

            $response = json_decode($response)->data;

            return $response ?: 'No response received';



        } catch (Exception $e) {
            // Log the error or handle it in a way that suits your application

            return 'Error: ' . $e->getMessage();
        }




    }
}