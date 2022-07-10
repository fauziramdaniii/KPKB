<?php
use Migrations\AbstractMigration;

class AlterTableCustomers1 extends AbstractMigration
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
        $table->addColumn('avatar', 'string', [
            'default' => null,
            'null' => true,
            'limit' => 255,
            'after' => 'activation_code',
        ]);
        $table->addColumn('dob', 'date', [
            'default' => null,
            'null' => true,
            'after' => 'last_name',
        ]);
        $table->update();
    }
}
