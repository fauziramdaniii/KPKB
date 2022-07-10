<?php
use Migrations\AbstractMigration;

class AlterCustomerRewards extends AbstractMigration
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

        $table->addColumn('status', 'integer', [
            'default' => 1,
            'null' => true,
            'after' => 'reward_id',
            'comment' => '1 pending, 2: success'
        ])->addIndex('status');

        $table->update();
    }
}
