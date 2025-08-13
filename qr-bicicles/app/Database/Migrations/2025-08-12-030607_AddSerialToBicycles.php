<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSerialToBicycles extends Migration
{
    public function up()
    {
        $this->forge->addColumn('bicycles', [
            'serial' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('bicycles', 'serial');
    }
}
