<?php

namespace App\Service\Sorter;

use Doctrine\Common\Collections\ArrayCollection;

interface SlotsSorterInterface
{
    public function sort(array $slots): array;
}