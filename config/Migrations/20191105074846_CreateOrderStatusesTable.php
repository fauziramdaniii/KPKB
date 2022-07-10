<?php
use Migrations\AbstractMigration;

class CreateOrderStatusesTable extends AbstractMigration
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
        $table = $this->table('order_statuses');

        $table->addColumn('name', 'string', [
            'default' => null,
            'limit' => 150,
            'null' => true,
        ]);


        $table->create();
    }
}
