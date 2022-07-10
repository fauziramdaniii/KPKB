<?php
use Migrations\AbstractMigration;

class CreateCustomerRewards extends AbstractMigration
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
        $table = $this->table('customer_rewards');


        $table->addColumn('customer_id', 'integer', [
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('reward_id', 'integer', [
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => true,
        ]);

        $table->addIndex('customer_id');
        $table->addIndex('reward_id');

        $table->create();
    }
}
