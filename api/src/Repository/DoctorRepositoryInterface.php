<?php

namespace App\Repository;

use App\Entity\Doctor;

interface DoctorRepositoryInterface
{
    /**
     * @param Doctor $doctor
     * @return void
     */
    public function save(Doctor $doctor): void;

    public function findByApiId(string $apiId): ?Doctor;
}