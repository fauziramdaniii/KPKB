<?php
use Migrations\AbstractMigration;

class CreateTableTopics extends AbstractMigration
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
        $table = $this->table('topics');
        $table->addColumn('name', 'string', [
            'default' => null,
            'limit' => 150,
            'null' => false,
            'collation' => 'utf8mb4_unicode_ci'
        ]);
        $table->create();
    }
}
