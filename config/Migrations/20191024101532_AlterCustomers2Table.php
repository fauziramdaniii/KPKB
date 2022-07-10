<?php
use Migrations\AbstractMigration;

class AlterCustomers2Table extends AbstractMigration
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

        $table->addColumn('balance', 'float', [
            'default' => 0,
            'null' => true,
            'after' => 'is_active',
        ]);

        $table->update();
    }
}
