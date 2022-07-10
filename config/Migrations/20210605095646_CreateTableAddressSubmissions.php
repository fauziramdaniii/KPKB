<?php
use Migrations\AbstractMigration;

class CreateTableAddressSubmissions extends AbstractMigration
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
        $table = $this->table('address_submissions');
		
        $table->addColumn('name', 'string', [
            'limit' => 100,
            'null' => false,
        ]);
		$table->addColumn('nik', 'string', [
            'limit' => 50,
            'null' => false,
        ]);
		$table->addColumn('original_address', 'string', [
            'default' => null,
            'null' => false,
        ]);
		$table->addColumn('destination_address', 'string', [
            'default' => null,
            'null' => false,
        ]);
		$table->addColumn('status', 'string', [
            'limit' => 15,
            'null' => false,
            'comment' => 'P: Pindah, D: Datang'
        ]);
		$table->addColumn('description', 'string', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('created', 'datetime', [
            'null' => true,
        ]);
        $table->create();
    }
}
