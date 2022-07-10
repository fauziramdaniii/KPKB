<?php
use Migrations\AbstractMigration;

class AlterTableCards1 extends AbstractMigration
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
        $table->addColumn('card_number', 'string', [
            'limit' => 15,
            'default' => null,
            'null' => true,
            'after' => 'id',
        ]);
        $table->update();
    }
}
