<?php
use Migrations\AbstractMigration;

class CreateOrderDetailSerialsTable extends AbstractMigration
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
        $table = $this->table('order_detail_serials');

        $table->addColumn('order_detail_id', 'integer', [
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('card_id', 'integer', [
            'default' => null,
            'null' => true,
        ]);

        $table->addIndex('order_detail_id');
        $table->addIndex('card_id');


        $table->create();
    }
}
