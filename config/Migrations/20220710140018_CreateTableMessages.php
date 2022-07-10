<?php
use Migrations\AbstractMigration;

class CreateTableMessages extends AbstractMigration
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
        $table = $this->table('messages');
		$table->addColumn('name', 'string', [
            'limit' => 150,
            'null' => false,
        ]);
		$table->addColumn('email', 'string', [
            'limit' => 200,
            'null' => false,
        ]);
		$table->addColumn('subject', 'string', [
            'limit' => 150,
            'null' => false,
        ]);
		$table->addColumn('message', 'text', [
            'default' => null,
            'limit' => 11,
            'null' => false
        ]);
		$table->addColumn('created', 'datetime', [
            'null' => true,
        ]);
        $table->create();
    }
}
