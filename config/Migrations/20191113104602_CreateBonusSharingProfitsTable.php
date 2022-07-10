<?php
use Migrations\AbstractMigration;

class CreateBonusSharingProfitsTable extends AbstractMigration
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
        $table = $this->table('bonus_sharing_profits');

        $table->addColumn('customer_id', 'integer', [
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('year', 'integer', [
            'limit' => 4,
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('month', 'integer', [
            'limit' => 2,
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('total', 'float', [
            'default' => 0,
            'null' => true,
        ]);


        $table->addIndex(['customer_id', 'year', 'month']);


        $table->create();
    }
}
