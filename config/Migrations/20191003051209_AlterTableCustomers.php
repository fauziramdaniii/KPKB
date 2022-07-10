<?php
use Migrations\AbstractMigration;

class AlterTableCustomers extends AbstractMigration
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
        $table = $this->table('customers');
        $table->addColumn('timeout', 'datetime', [
            'default' => null,
            'null' => true,
            'after' => 'last_login',
        ]);
        $table->update();
    }
}
