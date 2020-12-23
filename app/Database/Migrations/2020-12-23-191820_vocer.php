<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Vocer extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => TRUE,
				'auto_increment' => TRUE
			],
			'id_akun'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '225',
			],
			'id_user'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '225',
				'null'           => TRUE,
			],
			'nominal'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '225',
			],
			'ket'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '225',
			],
			'created_at'       => [
				'type'           => 'DATETIME',
				'null'           => TRUE,
			],
			'updated_at'       => [
				'type'           => 'DATETIME',
				'null'           => TRUE,
			],

		]);
		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('voucher');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('voucher');
	}
}
