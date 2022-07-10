<?php
use Migrations\AbstractMigration;

class AlterTableMatchSchedules2 extends AbstractMigration
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
		$table->addColumn('name', 'string', [
            'default' => null,
            'limit' => 100,
            'null' => true,
			'after' => 'game_id'
        ]);
        $table->update();
    }
}
