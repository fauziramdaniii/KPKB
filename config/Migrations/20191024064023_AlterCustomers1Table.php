<?php
use Migrations\AbstractMigration;

class AlterCustomers1Table extends AbstractMigration
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

        $table->addColumn('card_id', 'integer', [
            'default' => null,
            'null' => true,
            'after' => 'refferal_id',
        ]);

        $table->addIndex('card_id', [
            'unique' => true
        ]);

        $table->update();
    }
}
