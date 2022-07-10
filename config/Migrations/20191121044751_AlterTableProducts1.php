<?php
use Migrations\AbstractMigration;

class AlterTableProducts1 extends AbstractMigration
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
        $table = $this->table('products');

        $table->addColumn('card_type_id', 'integer', [
            'limit' => 1,
            'default' => 2,
            'after' => 'id',
        ]);
        $table->update();
    }
}
