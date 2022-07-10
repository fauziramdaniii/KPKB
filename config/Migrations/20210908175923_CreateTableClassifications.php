<?php
use Migrations\AbstractMigration;

class CreateTableClassifications extends AbstractMigration
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
        $table = $this->table('classifications');
		$table->addColumn('name', 'string', [
            'limit' => 100,
            'null' => false,
        ]);
		$table->addColumn('slug', 'string', [
            'default' => null,
            'limit' => 255,
        ]);
		$table->addColumn('type', 'string', [
            'limit' => 50,
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
