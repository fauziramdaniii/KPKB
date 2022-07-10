<?php
use Migrations\AbstractMigration;

class CreateTableGames extends AbstractMigration
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
        $table = $this->table('games');
		
		$table->addColumn('name', 'string', [
            'limit' => 50,
            'null' => false,
        ]);
		$table->addColumn('max_participant', 'integer', [
            'default' => 0,
            'null' => true,
        ]);
        $table->create();
    }
}
