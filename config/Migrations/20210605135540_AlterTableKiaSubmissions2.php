<?php
use Migrations\AbstractMigration;

class AlterTableKiaSubmissions2 extends AbstractMigration
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
		$table->addColumn('note', 'string', [
            'default' => null,
            'null' => true,
			'after' => 'submission_status_id'
        ]);
        $table->update();
    }
}
