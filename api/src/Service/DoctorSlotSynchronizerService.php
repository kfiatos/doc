<?php

namespace App\Service;

use App\Dto\DoctorApiDataDto;
use App\Entity\Doctor;
use App\Entity\Slot;
use App\Service\Client\DoctorApiClientInterface;
use App\Service\Sorter\SlotDurationDescendingSorter;
use GuzzleHttp\Exception\RequestException;
use Psr\Log\LoggerInterface;

class DoctorSlotSynchronizerService
{
    public function __construct(
        private DoctorApiClientInterface $client,
        private DoctorStorageService $doctorStorageService,
        private SlotStorageService $slotStorageService,
        private LoggerInterface $logger
    )
    {}

    /**
     * @return array|DoctorApiDataDto[]
     */
    private function getDoctors(): array
    {
        return $this->client->getDoctors();
    }

    private function getDoctorSlots(string $doctorId): array
    {
        try {
            return $this->client->getDoctorSlots($doctorId);
        } catch (RequestException $exception) {
            $this->logger->error(sprintf('Getting slots for doctor id %s failed because of: %s', $doctorId, $exception->getMessage()));
            return [];
        }
    }

    public function synchronizeDoctors(): void
    {
        $doctors = $this->getDoctors();

        //this should be divided into chunks or otherwise parametrized for better performance/scalability
        foreach ($doctors as $doctorDto) {
            $doctorEntity = Doctor::createFromApiDto($doctorDto);
            $doctorEntity = $this->doctorStorageService->store($doctorEntity);
            $slots = $this->getDoctorSlots($doctorEntity->getApiId());
            foreach ($slots as $slotDto) {
                $slotEntity = Slot::createFromApiResponseDto($slotDto);
                $slotEntity->setDoctor($doctorEntity);
                $this->slotStorageService->store($slotEntity);
            }
        }
    }
}