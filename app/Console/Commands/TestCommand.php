<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to test things';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        /** @var User $user */
        $user = User::find(1);

        if ($user->can('user.access')) {
            echo $user->name . ' can access himself' . PHP_EOL;
        }

        if ($user->can('user.update')) {
            echo $user->name . ' can update himself' . PHP_EOL;
        }

        if ($user->can('user.access_other')) {
            echo $user->name . ' can access other users' . PHP_EOL;
        }

        if ($user->cant('user.access_other')) {
            echo $user->name . ' cannot access other users' . PHP_EOL;
        }
    }
}
