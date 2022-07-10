<?php
use Migrations\AbstractMigration;

class CreateTableBlogs extends AbstractMigration
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
        $table = $this->table('blogs');

        $table->addColumn('topic_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false
        ]);
        $table->addColumn('user_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false
        ]);
        $table->addColumn('content', 'text', [
            'default' => null,
            'limit' => 11,
            'null' => false
        ]);
        $table->addColumn('view', 'integer', [
            'default' => null,
            'null' => false
        ]);
        $table->addColumn('image', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false
        ]);
        $table->addColumn('status', 'string', [
            'default' => null,
            'limit' => 3,
            'null' => false
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null
        ]);
        $table->create();
    }
}
