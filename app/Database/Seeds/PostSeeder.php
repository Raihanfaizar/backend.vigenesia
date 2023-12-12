<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run()
    {
        $posts = [
            [
                'content'       => 'Rava 3 kunci kesuksesan usaha doa dan orang dalam',
                'user_id'       => '2',
                'category_id'   => '1',
            ],
            [
                'content' => 'Bima mana ada aku cuek apalagi colek colek kamu',
                'user_id' => '5',
                'category_id'   => '1',
            ],
            [
                'content' => 'Rista gitar ku petik bass ku betot, hai nona cantik bass ku betot',
                'user_id' => '4',
                'category_id'   => '1',
            ],
            [
                'content' => 'Buduy bermimpilah setinggi langit sampai kamu nabrak satelit',
                'user_id' => '6',
                'category_id'   => '1',
            ],
            [
                'content' => 'Rehan Emyu harus trebel 2025',
                'user_id' => '3',
                'category_id'   => '1',
            ],
            [
                'content' => 'Iki apapun yang terjadi makan solusinya',
                'user_id' => '7',
                'category_id'   => '1',
            ],
        ];

        foreach ($posts as $post) {
            $this->db->table('posts')->insert($post);
        }
    }
}
