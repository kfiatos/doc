<?php

namespace App\Service\Client;

class DoctorApiCredentialsProvider
{
    public function __construct(
        private string $apiUrl,
        private string $apiUsername,
        private string $apiPassword,
    ){}

    /**
     * @return string
     */
    public function getApiUrl(): string
    {
        return $this->apiUrl;
    }

    /**
     * @return string
     */
    public function getApiUsername(): string
    {
        return $this->apiUsername;
    }

    /**
     * @return string
     */
    public function getApiPassword(): string
    {
        return $this->apiPassword;
    }
}