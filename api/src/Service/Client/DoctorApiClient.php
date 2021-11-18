<?php

namespace App\Service\Client;

use App\Dto\DoctorApiDataDto;
use App\Dto\DoctorSlotApiDataDto;
use GuzzleHttp\Client;

class DoctorApiClient implements DoctorApiClientInterface
{
    public function __construct(
        private Client $client,
        private DoctorApiCredentialsProvider $credentialsProvider
    ){}

    /**
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getDoctors(): array
    {
        $result = [];

        //no error validation, just happy path - support for failed request needs to be added
        $data = $this->getApiData('doctors');

        foreach ($data as $doctorData) {
            $result[] = DoctorApiDataDto::createFromApiResponse($doctorData);
        }

        return $result;
    }

    public function getDoctorSlots(string $doctorId): array
    {
        $result = [];

        //no error validation, just happy path - support for failed request needs to be added
        $data = $this->getApiData(sprintf('doctors/%s/slots', $doctorId));

        foreach ($data as $doctorSlotData) {
            $result[] = DoctorSlotApiDataDto::createFromApiResponse($doctorSlotData);
        }

        return $result;
    }

    /**
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function getApiData(string $endpoint): array
    {
        //no error validation, just happy path - support for failed request needs to be added
        $response = $this->client->get(sprintf('%s/%s', $this->credentialsProvider->getApiUrl(), $endpoint), [
            'auth' => [
                $this->credentialsProvider->getApiUsername(),
                $this->credentialsProvider->getApiPassword()
            ]
        ]);

        $data = json_decode($response->getBody()->getContents(), true);

        return $data;
    }

}