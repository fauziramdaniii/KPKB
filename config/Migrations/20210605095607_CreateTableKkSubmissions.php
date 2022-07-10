<?php
use Migrations\AbstractMigration;

class CreateTableKkSubmissions extends AbstractMigration
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
        $table = $this->table('kk_submissions');
        
		$table->addColumn('name', 'string', [
            'limit' => 100,
            'null' => false,
        ]);
		$table->addColumn('no_kk', 'string', [
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
