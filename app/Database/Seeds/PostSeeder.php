<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run()
    {
        $posts = [
            [
                'content'       => 'Kelvin ipsum dolor sit amet, consectetur adipiscing elit. Etiam nisi neque, convallis nec magna et, condimentum imperdiet augue. Etiam a nisi sed risus pharetra condimentum at a diam. Quisque pretium ante eget volutpat luctus. Nam eu nunc magna.',
                'user_id'       => '2',
                'category_id'   => '1',
            ],
            [
                'content' => 'Gilang ipsum dolor sit amet, consectetur adipiscing elit. Etiam nisi neque, convallis nec magna et, condimentum imperdiet augue. Etiam a nisi sed risus pharetra condimentum at a diam. Quisque pretium ante eget volutpat luctus. Nam eu nunc magna.',
                'user_id' => '3',
                'category_id'   => '3',
            ],
            [
                'content' => 'Ajeng ipsum dolor sit amet, consectetur adipiscing elit. Etiam nisi neque, convallis nec magna et, condimentum imperdiet augue. Etiam a nisi sed risus pharetra condimentum at a diam. Quisque pretium ante eget volutpat luctus. Nam eu nunc magna.',
                'user_id' => '4',
                'category_id'   => '3',
            ],
            [
                'content' => 'Eka 1 ipsum dolor sit amet, consectetur adipiscing elit. Etiam nisi neque, convallis nec magna et, condimentum imperdiet augue. Etiam a nisi sed risus pharetra condimentum at a diam. Quisque pretium ante eget volutpat luctus. Nam eu nunc magna.',
                'user_id' => '5',
                'category_id'   => '1',
            ],
            [
                'content' => 'Eka 2 ipsum dolor sit amet, consectetur adipiscing elit. Etiam nisi neque, convallis nec magna et, condimentum imperdiet augue. Etiam a nisi sed risus pharetra condimentum at a diam. Quisque pretium ante eget volutpat luctus. Nam eu nunc magna.',
                'user_id' => '5',
                'category_id'   => '2',
            ],
            [
                'content' => 'Eka 3 ipsum dolor sit amet, consectetur adipiscing elit. Etiam nisi neque, convallis nec magna et, condimentum imperdiet augue. Etiam a nisi sed risus pharetra condimentum at a diam. Quisque pretium ante eget volutpat luctus. Nam eu nunc magna.',
                'user_id' => '5',
                'category_id'   => '1',
            ],
        ];

        foreach ($posts as $post) {
            $this->db->table('posts')->insert($post);
        }
    }
}
