<?php
use Migrations\AbstractMigration;

class AlteTableCards extends AbstractMigration
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
        $table = $this->table('cards');


        $table->addColumn('stockist_id', 'integer', [
            'default' => null,
            'null' => true,
            'after' => 'pin',
            'comment' => 'refer ke customer tipe stokis',
        ])->addIndex('stockist_id');

        $table->addColumn('customer_id', 'integer', [
            'default' => null,
            'null' => true,
            'after' => 'stockist_id',
            'comment' => 'refer ke customer activation',
        ])->addIndex('customer_id');


        $table->update();
    }
}
