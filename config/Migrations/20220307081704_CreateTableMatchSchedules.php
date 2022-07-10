<?php
use Migrations\AbstractMigration;

class CreateTableMatchSchedules extends AbstractMigration
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
        $table = $this->table('match_schedules');
		
		$table->addColumn('game_id', 'integer', [
            'default' => null,
            'null' => true,
        ]);
		$table->addColumn('team_name_1', 'string', [
            'limit' => 150,
            'null' => false,
        ]);
		$table->addColumn('score_team_1', 'integer', [
            'default' => null,
            'null' => true,
        ]);
		$table->addColumn('team_name_2', 'string', [
            'limit' => 150,
            'null' => false,
        ]);
		$table->addColumn('score_team_2', 'integer', [
            'default' => null,
            'null' => true,
        ]);
		$table->addColumn('match_time', 'datetime', [
            'null' => false,
        ]);
		$table->addColumn('description', 'string', [
            'default' => null,
            'null' => true,
        ]);
		$table->addColumn('status', 'integer', [
            'default' => null,
            'null' => true,
			'comment' => '0: belum bertanding, 1: sudah selesai'
        ]);
		$table->addColumn('created', 'datetime', [
            'null' => true,
        ]);
		$table->addColumn('modified', 'datetime', [
            'null' => true,
        ]);
		
		
        $table->create();
    }
}
