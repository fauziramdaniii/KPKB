<?php
use Migrations\AbstractMigration;

class CreateTablePersons extends AbstractMigration
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
        $table = $this->table('persons');
		
		$table->addColumn('name', 'string', [
            'limit' => 100,
            'null' => false,
        ]);
		$table->addColumn('position', 'string', [
            'limit' => 100,
            'null' => false,
        ]);
		$table->addColumn('image', 'string', [
            'limit' => 255,
            'null' => true,
        ]);
		
        $table->create();
    }
}
