<?php

namespace App\Entity;

use App\Dto\DoctorSlotApiDataDto;
use App\Repository\SlotRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * @ORM\Entity(repositoryClass=SlotRepository::class)
 * @ORM\Table(uniqueConstraints={@UniqueConstraint(name="doctor_slot_start_time_idx", columns={"doctor_id", "start_time"})})
 */
class Slot
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startTime;

    /**
     * @ORM\Column(type="datetime")
     */
    private $endTime;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Doctor", inversedBy="slots", cascade={"persist"})
     */
    private $doctor;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartTime(): ?\DateTimeInterface
    {
        return $this->startTime;
    }

    public function setStartTime(\DateTimeInterface $startTime): self
    {
        $this->startTime = $startTime;

        return $this;
    }

    public function getEndTime(): ?\DateTimeInterface
    {
        return $this->endTime;
    }

    public function setEndTime(\DateTimeInterface $endTime): self
    {
        $this->endTime = $endTime;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDoctor()
    {
        return $this->doctor;
    }

    /**
     * @param mixed $doctor
     */
    public function setDoctor(Doctor $doctor): void
    {
        $this->doctor = $doctor;
    }

    /**
     * @param DoctorSlotApiDataDto $dto
     * @return static
     * @throws \Exception
     */
    public static function createFromApiResponseDto(DoctorSlotApiDataDto $dto): self
    {
        $slot = new self();
        $slot->setStartTime(new \DateTime($dto->getStartTime()));
        $slot->setEndTime(new \DateTime($dto->getEndTime()));

        return  $slot;
    }
}
