<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        foreach (config('sidebar.menu') as $key => $menu) {
            if (Permission::where('name', $menu['id'])->count() == 0) {
                Permission::create(['name' => $menu['id']]);
                if (!empty($menu['sub_menu'])) {
                    $this->submenu($menu);
                }
            }
        }
    }

    private function submenu($menu)
    {
        foreach ($menu['sub_menu'] as $key => $sub) {
            if (Permission::where('name', $sub['id'])->count() == 0) {
                Permission::create(['name' => $sub['id']]);
                if (!empty($sub['sub_menu'])) {
                    $this->submenu($sub);
                }
            }
        }
    }
}
