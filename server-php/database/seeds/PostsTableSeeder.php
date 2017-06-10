<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->delete();
        $posts = array(
            ['id' => 1, 'title' => 'My First Post', 'content' => 'This is my first post content.', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => 2, 'title' => 'My Second Post', 'content' => 'This is my second post content.', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => 3, 'title' => 'My Third Post', 'content' => 'This is my third post content.', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => 4, 'title' => 'My Fourth Post', 'content' => 'This is my fourth post content.', 'created_at' => new DateTime, 'updated_at' => new DateTime]
        );
        DB::table('posts')->insert($posts);

        DB::table('users')->delete();
        $users = array(
            ['id' => 1, 'name' => 'admin', 'email' => 'admin@admin.com', 'password' => bcrypt('admin'), 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => 2, 'name' => 'test', 'email' => 'test@test.com', 'password' => bcrypt('test'), 'created_at' => new DateTime, 'updated_at' => new DateTime]

        );
        DB::table('users')->insert($users);
        DB::table('balance')->delete();
        $balance = array(
            ['id' => 1, 'user_id' => '1', 'available_amount' => '100.00','pinky' => '1.00', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => 2, 'user_id' => '2', 'available_amount' => '10.00','pinky' => '1.00', 'created_at' => new DateTime, 'updated_at' => new DateTime]
        );
        DB::table('balance')->insert($balance);
    }
}
