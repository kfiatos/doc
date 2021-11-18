<?php

namespace App\Service\Client;

interface DoctorApiClientInterface
{
    public function getDoctors(): array;

    public function getDoctorSlots(string $doctorId): array;
}