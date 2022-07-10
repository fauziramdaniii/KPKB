<?php
use Migrations\AbstractMigration;

class CreateRewards extends AbstractMigration
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
        $table = $this->table('rewards');

        $table->addColumn('rank_id', 'integer', [
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('image', 'string', [
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('description', 'text', [
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

        $table->addIndex('rank_id');

        $table->create();
    }
}
