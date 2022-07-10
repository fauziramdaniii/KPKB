<?php
use Migrations\AbstractMigration;

class CreateTableCustomerVerifications extends AbstractMigration
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
        $table = $this->table('customer_verifications');

        $table->addColumn('customer_id', 'integer', [
            'limit' => 11,
            'null' => false,
        ]);

        $table->addColumn('personal', 'integer', [
            'limit' => 1,
            'null' => false,
            'default' => 0,
        ]);
        $table->addColumn('phone', 'integer', [
            'limit' => 1,
            'null' => false,
            'default' => 0,
        ]);
        $table->addColumn('identity', 'integer', [
            'limit' => 1,
            'null' => false,
            'default' => 0,
        ]);
        $table->addColumn('address', 'integer', [
            'limit' => 1,
            'null' => false,
            'default' => 0,
        ]);
        $table->addColumn('tax', 'integer', [
            'limit' => 1,
            'null' => false,
            'default' => 0,
        ]);
        $table->create();
    }
}
