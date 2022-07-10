<?php
use Migrations\AbstractMigration;

class CreateEvents extends AbstractMigration
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

        $table->addColumn('title', 'string', [
            'default' => null,
            'limit' => 50,
            'null' => true,
        ]);

        $table->addColumn('description', 'string', [
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('start', 'datetime', [
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('end', 'datetime', [
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('classname', 'string', [
            'default' => null,
            'null' => true,
            'comment' => 'for coloring calendar'
        ]);

        $table->addColumn('user_id', 'integer', [
            'default' => null,
            'null' => true
        ]);


        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => true,
        ]);

        $table->create();
    }
}
