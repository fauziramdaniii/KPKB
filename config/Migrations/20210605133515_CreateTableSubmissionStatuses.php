<?php
use Migrations\AbstractMigration;

class CreateTableSubmissionStatuses extends AbstractMigration
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
        $table = $this->table('submission_statuses');
		$table->addColumn('name', 'string', [
            'default' => null,
            'limit' => 150,
            'null' => false,
        ]);
        $table->create();
    }
}
