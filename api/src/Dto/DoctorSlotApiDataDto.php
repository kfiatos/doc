<?php

namespace App\Dto;

class DoctorSlotApiDataDto
{
    public function __construct(
        private string $startTime,
        private string $endTime
    ){}

    /**
     * @param array $data
     * @return static
     */
    public static function createFromApiResponse(array $data): self
    {
        return new self(
            $data['start'],
            $data['end']
        );
    }

    /**
     * @return string
     */
    public function getStartTime(): string
    {
        return $this->startTime;
    }

    /**
     * @return string
     */
    public function getEndTime(): string
    {
        return $this->endTime;
    }
}