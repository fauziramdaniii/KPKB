<?php
use Migrations\AbstractMigration;

class CreateTableSuppliers extends AbstractMigration
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
        $table = $this->table('suppliers');

        $table->addColumn('name', 'string', [
            'limit' => 50,
            'null' => false
        ]);
        $table->addColumn('address', 'text', [
            'default' => null,
            'null' => true
        ]);
        $table->addColumn('email', 'string', [
            'null' => false,
            'limit' => 50
        ]);
        $table->addColumn('phone', 'string', [
            'null' => false,
            'limit' => 10
        ]);
        $table->create();
    }
}
