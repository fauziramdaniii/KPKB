<?php
use Migrations\AbstractMigration;

class CreateTableGenerations extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('generations');
		$table->addColumn('parent_id', 'integer', [
            'default' => null,
			'limit' => 11,
			'null' => true
        ]);
		$table->addColumn('lft', 'integer', [
			'limit' => 11,
			'null' => false
        ]);
		$table->addColumn('rght', 'integer', [
			'limit' => 11,
			'null' => false
        ]);
		$table->addColumn('customer_id', 'integer', [
            'default' => null,
			'limit' => 11,
			'null' => true
        ]);
		$table->addColumn('refferal_id', 'integer', [
            'default' => null,
			'limit' => 11,
			'null' => true
        ]);
		$table->addColumn('level', 'integer', [
			'default' => '1',
			'limit' => 11,
			'null' => false
        ]);
        $table->addColumn('created', 'datetime', [

        ]);
        $table->create();
    }
}
