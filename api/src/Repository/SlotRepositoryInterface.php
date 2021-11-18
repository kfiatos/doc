<?php

namespace App\Repository;

use App\Entity\Doctor;
use App\Entity\Slot;

Interface SlotRepositoryInterface
{
    public function save(Slot $slot): void;

    public function findByDoctorAndStartAndEndTime(
        Doctor $doctor,
        \DateTimeInterface $startTime,
        \DateTimeInterface $endTime
    ): ?Slot;
}