<?php
use Migrations\AbstractMigration;

class CreateTablePesParticipants extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('pes_participants');
		
		$table->addColumn('game_id', 'integer', [
            'default' => null,
            'null' => true,
        ]);
		$table->addColumn('name', 'string', [
            'limit' => 100,
            'null' => false,
        ]);
		$table->addColumn('phone', 'string', [
            'limit' => 50,
            'null' => false,
        ]);
		$table->addColumn('email', 'string', [
            'limit' => 150,
            'null' => false,
        ]);
		$table->addColumn('ktp', 'string', [
            'limit' => 255,
            'null' => false,
        ]);
		$table->addColumn('bukti_vaksin', 'string', [
            'limit' => 255,
            'null' => false,
        ]);
		$table->addColumn('status', 'integer', [
            'default' => null,
            'null' => true,
			'comment' => '0: pending, 1: approved, 2: reject'
        ]);
		$table->addColumn('created', 'datetime', [
            'null' => true,
        ]);
		
        $table->create();
    }
}
