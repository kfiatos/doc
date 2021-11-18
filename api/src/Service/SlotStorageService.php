<?php

namespace App\Service;

use App\Entity\Slot;
use App\Repository\SlotRepositoryInterface;

class SlotStorageService
{
    public function __construct(private SlotRepositoryInterface $slotRepository)
    {}

    /**
     * @param Slot $slot
     * @return Slot
     */
    public function store(Slot $slot): Slot
    {
        if ($slot = $this->slotRepository->findByDoctorAndStartAndEndTime($slot->getDoctor(), $slot->getStartTime(), $slot->getEndTime())) {
            return $slot;
        }

        $this->slotRepository->save($slot);
        return $slot;
    }
}