<?php

namespace App\Console\Commands;

use App\Services\ReminderService;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:cek-pengingat')]
#[Description('Memeriksa dan membuat pengingat perjalanan serta perawatan kendaraan.')]
class CekPengingat extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(ReminderService $reminderService): int
    {
        $created = $reminderService->sendDueReminders();
        $this->info("{$created} pengingat baru dibuat.");

        return self::SUCCESS;
    }
}
