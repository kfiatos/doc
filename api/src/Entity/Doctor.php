<?php

namespace App\Entity;

use App\Dto\DoctorApiDataDto;
use App\Repository\DoctorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\DocBlock\Tags\See;

/**
 * @ORM\Entity(repositoryClass=DoctorRepository::class)
 */
class Doctor
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $apiId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="boolean")
     */
    private $available = false;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Slot", mappedBy="doctor")
     */
    private $slots;

    /**
     * @param ArrayCollection $slots
     */
    public function __construct($slots = [])
    {
        $this->slots = $slots;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getApiId()
    {
        return $this->apiId;
    }

    /**
     * @param mixed $apiId
     */
    public function setApiId($apiId): void
    {
        $this->apiId = $apiId;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getAvailable(): ?bool
    {
        return $this->available;
    }

    public function setAvailable(bool $available): self
    {
        $this->available = $available;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getSlots(): ArrayCollection
    {
        return $this->slots;
    }

    /**
     * @param ArrayCollection $slots
     */
    public function setSlots(ArrayCollection $slots): void
    {
        $this->slots = $slots;
    }

    public function addSlot(Slot $slot): void
    {
        if (!$this->slots->contains($slot)) {
            $this->slots[] = $slot;
            $slot->setDoctor($this);
        }
    }

    public function removeSlot(Slot $slot): void
    {
        if ($this->slots->contains($slot)) {
            $this->slots->removeElement($slot);
        }
    }

    /**
     * @param DoctorApiDataDto $dto
     * @return static
     */
    public static function createFromApiDto(DoctorApiDataDto $dto): self
    {
        $doctor = new self();
        $doctor->setApiId($dto->getApiId());
        $doctor->setName($dto->getName());

        return $doctor;
    }
}

