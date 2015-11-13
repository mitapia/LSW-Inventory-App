<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => '1',
            'name' => 'SysAdmin',
            'username' => 'sysadmin',
            'password' => bcrypt('L@r@velFr@mew0rk51'),
        ]);

        DB::table('permissions')->insert([
            'user_id' => '1',
            'name' => 'admin',
        ]);
    }
}
