<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RolesMigration extends Migration
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
            'title' => [
                'type'              => 'VARCHAR',
                'constraint'        => '16',
                'null'              => false,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('roles', true);
    }

    public function down()
    {
        $this->forge->dropTable('roles', true);
    }
}
