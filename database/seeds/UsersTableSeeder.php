<?php
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {

    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        DB::table('users')->delete();

        $users = array(
            ['id' => 1, 'name' => 'User 1', 'email' => 'user1@com', 'password' => bcrypt('123456'), 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => 2, 'name' => 'User 2', 'email' => 'user2@com', 'password' => bcrypt('123456'), 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => 3, 'name' => 'User 3', 'email' => 'user3@com', 'password' => bcrypt('123456'), 'created_at' => new DateTime, 'updated_at' => new DateTime],
        );

        //// Uncomment the below to run the seeder
        DB::table('users')->insert($users);
    }

}