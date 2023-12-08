<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PostsMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'              => 'INT',
                'constraint'        => '11',
                'unsigned'          => true,
                'null'              => false,
                'auto_increment'    => true,
            ],
            'user_id' => [
                'type'              => 'INT',
                'constraint'        => '11',
                'unsigned'          => true,
                'null'              => false,
            ],
            'content' => [
                'type'              => 'VARCHAR',
                'constraint'        => '256',
                'null'              => false,
            ],
            'category_id' => [
                'type'              => 'INT',
                'constraint'        => '11',
                'unsigned'          => true,
                'null'              => false,
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id');
        $this->forge->addForeignKey('category_id', 'categories', 'id');
        $this->forge->createTable('posts', true);
    }

    public function down()
    {
        $this->forge->dropTable('posts', true);
    }
}
