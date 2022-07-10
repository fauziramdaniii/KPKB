<?php
use Migrations\AbstractMigration;

class AlterTableAddressSubmissions3 extends AbstractMigration
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
        $table = $this->table('address_submissions');
		$table->addColumn('customer_id', 'integer', [
            'default' => null,
            'null' => true,
			'after' => 'id'
        ])->addIndex('customer_id');
        $table->update();
    }
}
