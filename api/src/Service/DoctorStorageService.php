<?php

namespace App\Service;

use App\Entity\Doctor;
use App\Repository\DoctorRepositoryInterface;
use PhpParser\Comment\Doc;

class DoctorStorageService
{
    /**
     * @var DoctorRepositoryInterface
     */
    private $doctorRepository;

    /**
     * @param DoctorRepositoryInterface $doctorRepository
     */
    public function __construct(DoctorRepositoryInterface $doctorRepository)
    {
        $this->doctorRepository = $doctorRepository;
    }

    /**
     * @param Doctor $doctor
     * @return Doctor
     */
    public function store(Doctor $doctor): Doctor
    {
        if ($doctor = $this->doctorRepository->findByApiId($doctor->getApiId())) {
            return $doctor;
        }

        $this->doctorRepository->save($doctor);
        return $doctor;
    }
}