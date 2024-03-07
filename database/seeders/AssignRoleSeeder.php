<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Laratrust\Models\Permission;
use Laratrust\Models\Role;

class AssignRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdminRole = Role::create([
            'name' => 'super-admin',
            'display_name' => 'Super Admin',
            'description' => 'Super Admin Role',
        ]);
        $user = User::where('nid', '29805180200352')->first();
        if ($user) {
            $user->addRole($superAdminRole);
        }
        $adminRole = Role::create([
            'name' => 'admin',
            'display_name' => 'Admin',
            'description' => 'Admin Role',
        ]);
        $studentRole = Role::create([
            'name' => 'student',
            'display_name' => 'Student',
            'description' => 'Student Role',
        ]);

        $permission = [
            [
                'name' => 'category-edit',
                'display_name' => 'Category Edit',
                'description' => 'Category Edit'
            ],
            [
                'name' => 'category-delete',
                'display_name' => 'Category Delete',
                'description' => 'Category Delete'
            ],
            [
                'name' => 'category-create',
                'display_name' => 'Category Create',
                'description' => 'Category Create'
            ],
            [
                'name' => 'question-edit',
                'display_name' => 'Question Edit',
                'description' => 'Question Edit'
            ],
            [
                'name' => 'question-delete',
                'display_name' => 'Question Delete',
                'description' => 'Question Delete'
            ],
            [
                'name' => 'question-create',
                'display_name' => 'Question Create',
                'description' => 'Question Create'
            ],
            [
                'name' => 'lookup-create',
                'display_name' => 'Lookup Create',
                'description' => 'Lookup Create'
            ],
            [
                'name' => 'lookup-edit',
                'display_name' => 'Lookup Edit',
                'description' => 'Lookup Edit'
            ],
            [
                'name' => 'lookup-delete',
                'display_name' => 'Lookup Delete',
                'description' => 'Lookup Delete'
            ],
        ];

        foreach ($permission as $value) {
            Permission::create($value);
        }

        // assign all permissions to super admin
        $superAdminRole->syncPermissions(Permission::all());
    }
}
