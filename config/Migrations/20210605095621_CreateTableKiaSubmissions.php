<?php
use Migrations\AbstractMigration;

class CreateTableKiaSubmissions extends AbstractMigration
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
        $table = $this->table('kia_submissions');
		
		$table->addColumn('name', 'string', [
            'limit' => 100,
            'null' => false,
        ]);
		$table->addColumn('nik', 'string', [
            'limit' => 50,
            'null' => false,
        ]);
		$table->addColumn('address', 'string', [
            'default' => null,
            'null' => true,
        ]);
		$table->addColumn('applicant', 'string', [
            'limit' => 50,
            'null' => false,
        ]);
        $table->addColumn('created', 'datetime', [
            'null' => true,
        ]);
        $table->create();
    }
}
