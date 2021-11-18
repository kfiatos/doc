<?php

namespace App\Service\Sorter;

use App\Entity\Slot;
use Doctrine\Common\Collections\ArrayCollection;

class SlotDurationDescendingSorter implements SlotsSorterInterface
{
    /**
     * @param $slots Slot[]
     * @return array
     */
    public function sort(array $slots): array
    {
        usort($slots, function($slot1, $slot2) {
            $slot1duration = $slot1->getEndTime()->getTimestamp() - $slot1->getStartTime()->getTimestamp();
            $slot2duration = $slot2->getEndTime()->getTimestamp() - $slot2->getStartTime()->getTimestamp();

            return $slot1duration < $slot2duration ? 1 : -1;
        });

        return $slots;
    }

}