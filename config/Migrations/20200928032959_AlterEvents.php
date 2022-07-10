<?php
use Migrations\AbstractMigration;

class AlterEvents extends AbstractMigration
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
        $table = $this->table('events');

        $table->addColumn('event_category_id', 'integer', [
            'default' => null,
            'null' => true,
            'after' => 'id',
        ])
        ->addIndex('event_category_id');


        $table->addColumn('location', 'string', [
            'default' => null,
            'null' => true,
            'after' => 'description',
        ]);

        $table->update();
    }
}
