<?php
use Migrations\AbstractMigration;

class CreateTableCustomerPeriods extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('customer_periods');

        $table->addColumn('customer_id', 'integer', [
            'limit' => 11,
            'default' => null,
            'null' => true
        ]);

        $table->addColumn('start', 'date', [
            'default' => null,
            'null' => false
        ]);
        $table->addColumn('end', 'date', [
            'default' => null,
            'null' => false
        ]);
        $table->addColumn('total_omset', 'float', [
            'default' => 0,
            'null' => true,
        ]);
        $table->addColumn('rank_id', 'integer', [
            'limit' => 11,
            'default' => null,
            'null' => false
        ]);
        $table->addColumn('flag', 'integer', [
            'limit' => 1,
            'default' => 0,
            'null' => false,
            'comment' => '0 : perhitungan belum mencukupi, 1 perhitungan mencukupi, 2:expired'
        ]);
        $table->create();
    }
}
