<?php

namespace App\Command;

use App\Service\DoctorSlotSynchronizerService;
use App\Service\DoctorStorageService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:synchronize-doctors',
    description: 'Synchronize data (doctors with corresponding slots) with doctors api',
)]
class SynchronizeSlotsCommand extends Command
{
    private DoctorSlotSynchronizerService $doctorSlotSynchronizerService;
    private DoctorStorageService $doctorStorageService;

    public function __construct(
        DoctorSlotSynchronizerService $doctorSlotSynchronizerService,
        DoctorStorageService $doctorStorageService,
        string $name = null
    ){
        $this->doctorSlotSynchronizerService = $doctorSlotSynchronizerService;
        parent::__construct($name);
    }

    protected function configure(): void
    {
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        //happy path, error handling needs to be added
        //good idea would be to implement way of synchronizing only specific doctor for ex: by external api id
        $this->doctorSlotSynchronizerService->synchronizeDoctors();

        return Command::SUCCESS;
    }
}
