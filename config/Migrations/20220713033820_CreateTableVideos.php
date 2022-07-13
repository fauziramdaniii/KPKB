<?php
use Migrations\AbstractMigration;

class CreateTableVideos extends AbstractMigration
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
        $table = $this->table('videos');
		$table->addColumn('title', 'string', [
            'limit' => 255,
            'null' => false,
        ]);
		$table->addColumn('description', 'text', [
            'default' => null,
            'limit' => 11,
            'null' => false
        ]);
		$table->addColumn('embed', 'text', [
            'default' => null,
            'limit' => 11,
            'null' => false
        ]);
		$table->addColumn('created', 'datetime', [
            'null' => true,
        ]);
		$table->addColumn('modified', 'datetime', [
            'null' => true,
        ]);
        $table->create();
    }
}
