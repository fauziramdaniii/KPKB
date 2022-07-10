<?php
use Migrations\AbstractMigration;

class CreateCardsTable extends AbstractMigration
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

        $table->addColumn('serial', 'string', [
            'limit' => 15,
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('pin', 'string', [
            'limit' => 15,
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('card_status_id', 'integer', [
            'limit' => 4,
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('card_type_id', 'integer', [
            'limit' => 4,
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => true,
        ]);

        $table->addIndex('serial', [
            'unique' => true
        ]);

        $table->addIndex('card_status_id');
        $table->addIndex('card_type_id');

        $table->create();
    }
}
