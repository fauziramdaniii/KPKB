<?php
use Migrations\AbstractMigration;

class CreateTableAlbums2 extends AbstractMigration
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
        $table = $this->table('albums');
		$table->addColumn('name', 'string', [
            'limit' => 50,
            'default' => null,
            'null' => true,
        ]);
        $table->create();
    }
}
