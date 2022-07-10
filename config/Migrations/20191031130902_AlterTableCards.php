<?php
use Migrations\AbstractMigration;

class AlterTableCards extends AbstractMigration
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
        $table = $this->table('cards');
        $table->addColumn('product_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true,
            'after' => 'card_status_id',
        ]);
        $table->update();
    }
}
