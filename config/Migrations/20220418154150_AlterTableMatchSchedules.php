<?php
use Migrations\AbstractMigration;

class AlterTableMatchSchedules extends AbstractMigration
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
		$table->addColumn('match_status_id', 'string', [
            'limit' => 15,
            'null' => false,
			'after' => 'description',
        ]);
		$table->addColumn('map', 'string', [
            'default' => null,
            'limit' => 50,
            'null' => true,
			'after' => 'score_team_2'
        ]);
		$table->removeColumn('status');
        $table->update();
    }
}
