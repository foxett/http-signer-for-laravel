<?php

namespace foxett\HttpSignerForLaravel;

class HttpSigner
{
    public function signData(array $data) : string
    {
        $sortedData = $this->sortData($data);
        $stringData = $this->convertToString($sortedData);
        $key = config('http-signer.key');
        $signature = hash_hmac('sha256', $stringData, $key);

        return $signature;
    }

    public function checkSignature(array $data, string $signature) : bool
    {

        return $this->signData($data) === $signature;
    }

    private function sortData(array $data) : array
    {
        $order = config('http-signer.order');

        switch ($order){
            case 'ask':
                sort($data);
                break;
            case 'desc':
                rsort($data);
                break;
            default:
                sort($data);
        }

        return $data;
    }

    private function convertToString(array $data) : string
    {
        return serialize($data) . config('http-signer.salt');
    }
}