<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ReportsMigration extends Migration
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
            'post_id' => [
                'type'              => 'INT',
                'constraint'        => '11',
                'unsigned'          => true,
                'null'              => false,
            ],
            'user_id' => [
                'type'              => 'INT',
                'constraint'        => '11',
                'unsigned'          => true,
                'null'              => false,
            ],
            'reason' => [
                'type'              => 'VARCHAR',
                'constraint'        => '256',
                'null'              => false,
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('post_id', 'posts', 'id');
        $this->forge->addForeignKey('user_id', 'users', 'id');
        $this->forge->createTable('reports', true);
    }

    public function down()
    {
        $this->forge->dropTable('reports', true);
    }
}
