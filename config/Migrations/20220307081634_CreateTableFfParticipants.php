<?php
use Migrations\AbstractMigration;

class CreateTableFfParticipants extends AbstractMigration
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
        $table = $this->table('ff_participants');
		
		$table->addColumn('game_id', 'integer', [
            'default' => null,
            'null' => true,
        ]);
		$table->addColumn('team_name', 'string', [
            'limit' => 150,
            'null' => false,
        ]);
		$table->addColumn('document', 'string', [
            'limit' => 255,
            'null' => false,
        ]);
		$table->addColumn('status', 'integer', [
            'default' => '0',
            'null' => true,
			'comment' => '0: pending, 1: approved, 2: reject'
        ]);
		$table->addColumn('created', 'datetime', [
            'null' => true,
        ]);
		
        $table->create();
    }
}
