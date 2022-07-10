<?php
use Migrations\AbstractMigration;

class CreateTableRequirements extends AbstractMigration
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
        $table = $this->table('requirements');
		$table->addColumn('classification_id', 'integer', [
            'default' => null,
            'null' => true,
        ]);
		$table->addColumn('name', 'string', [
            'limit' => 100,
            'null' => false,
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
