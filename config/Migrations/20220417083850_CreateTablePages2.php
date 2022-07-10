<?php
use Migrations\AbstractMigration;

class CreateTablePages2 extends AbstractMigration
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
        $table = $this->table('pages');
		$table->addColumn('title', 'string', [
            'default' => null,
            'limit' => 200,
            'null' => false,
			'collation' => 'utf8mb4_unicode_ci'
        ]);
        $table->addColumn('slug', 'string', [
            'default' => null,
            'limit' => 200,
            'null' => false,
        ]);
        $table->addColumn('content', 'text', [
            'default' => null,
            'null' => false,
			'collation' => 'utf8mb4_unicode_ci'
        ]);
        $table->addColumn('enable', 'integer', [
            'default' => null,
            'limit' => 1,
            'null' => false,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->create();
    }
}
