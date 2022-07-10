<?php
use Migrations\AbstractMigration;

class CreateTableLiveBagans extends AbstractMigration
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
        $table = $this->table('live_bagans');
		
		$table->addColumn('game_id', 'integer', [
            'default' => null,
            'null' => true,
        ]);
		$table->addColumn('name', 'string', [
            'limit' => 150,
            'null' => false,
        ]);
		$table->addColumn('embed', 'text', [
            'default' => null,
            'null' => false,
			'collation' => 'utf8mb4_unicode_ci'
        ]);
		$table->addColumn('link', 'text', [
            'default' => null,
            'null' => false,
			'collation' => 'utf8mb4_unicode_ci'
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
