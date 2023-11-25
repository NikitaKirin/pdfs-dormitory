<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Gate;

class CreatePermissionsCommand extends Command
{
    protected $signature = 'permissions:create';

    protected $description = 'Create permissions by policy classes';

    public function handle(): int
    {
        $this->warn('Starting to generate permissions');

        $this->createPolicyPermissions();

        $this->createAdminRole();

        $this->info('Permissions was created successfully!');

        return Command::SUCCESS;
    }

    private function createAdminRole(): void
    {
        $role = Role::firstOrCreate([
            'title' => 'Администратор',
        ]);
        $role->permissions()->saveMany(Permission::all());
        $role->save();
    }

    private function createPolicyPermissions(): void
    {
        $policies = Gate::policies();

        foreach ($policies as $model => $policy) {
            $methods = $this->getPolicyMethods($policy);

            foreach ($methods as $method) {
                Permission::query()
                    ->firstOrCreate([
                        'action' => $method,
                        'model' => $model,
                    ]);
            }
        }
    }

    private function getPolicyMethods(string $policy): array
    {
        $methods = get_class_methods($policy);

        return array_filter($methods, function (string $method) {
            return !in_array($method, [
                'denyWithStatus',
                'denyAsNotFound',
            ]);
        });
    }
}
