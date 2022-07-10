<?php
use Migrations\AbstractMigration;

class AlterTableCustomers2 extends AbstractMigration
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
        $table = $this->table('customers');
        $table->addColumn('active_date', 'date', [
            'default' => null,
            'null' => true,
            'after' => 'balance',
        ]);
        $table->update();
    }
}
