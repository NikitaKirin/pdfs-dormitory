<?php

declare(strict_types=1);

namespace App\Console\Commands\User;

use App\Models\User;
use Illuminate\Console\Command;

class CreateUserCommand extends Command
{
    protected $signature = 'user:create';

    protected $description = 'Create the new user';

    public function handle(): int
    {
        $user = User::query()->create([
            'name' => $this->ask('Name'),
            'email' => $this->ask('E-mail'),
            'password' => $this->ask('Password')
        ]);

        $this->warn("ID: $user->id");

        $this->info('User successfully created');

        return Command::SUCCESS;
    }
}
