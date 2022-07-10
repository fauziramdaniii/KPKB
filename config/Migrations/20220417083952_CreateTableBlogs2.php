<?php
use Migrations\AbstractMigration;

class CreateTableBlogs2 extends AbstractMigration
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
        $table = $this->table('blogs');
		$table->addColumn('title', 'string', [
            'default' => null,
            'limit' => 255,
        ]);
        $table->addColumn('slug', 'string', [
            'default' => null,
            'limit' => 255,
        ]);
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
        $table->changeColumn('status', 'integer', [
            'null' => true,
            'default' => 0,
            'limit' => 1,
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
