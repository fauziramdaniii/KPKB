<?php
use Migrations\AbstractMigration;

class CreateTableSlides extends AbstractMigration
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
        $table = $this->table('slides');
		$table->addColumn('title', 'string', [
            'limit' => 150,
            'null' => true,
        ]);
		$table->addColumn('subtitle', 'string', [
            'limit' => 200,
            'null' => true,
        ]);
		$table->addColumn('image', 'string', [
            'limit' => 255,
            'null' => false,
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
