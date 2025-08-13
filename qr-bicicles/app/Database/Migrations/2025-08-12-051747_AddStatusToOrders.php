<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddStatusToOrders extends Migration
{
    public function up()
    {
        $this->forge->addColumn('orders', [
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'default' => 'pending',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('orders', 'status');
    }
}
