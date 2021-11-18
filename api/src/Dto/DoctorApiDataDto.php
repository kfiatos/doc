<?php

namespace App\Dto;

class DoctorApiDataDto
{
    private string $apiId;
    private string $name;

    /**
     * @param string $apiId
     * @param string $name
     */
    public function __construct(string $apiId, string $name)
    {
        $this->apiId = $apiId;
        $this->name = $name;
    }

    /**
     * @param array $data
     * @return static
     */
    public static function createFromApiResponse(array $data): self
    {
        return new self(
            $data['id'],
            $data['name']
        );
    }

    /**
     * @return string
     */
    public function getApiId(): string
    {
        return $this->apiId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}