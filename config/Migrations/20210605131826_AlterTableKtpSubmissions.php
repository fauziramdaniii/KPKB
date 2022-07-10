<?php
use Migrations\AbstractMigration;

class AlterTableKtpSubmissions extends AbstractMigration
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
        $table = $this->table('ktp_submissions');
		$table->addColumn('taker', 'string', [
            'limit' => 50,
			'default' => null,
            'null' => true,
			'after' => 'applicant'
        ]);
		$table->addColumn('submission_status_id', 'integer', [
            'default' => null,
            'null' => true,
			'after' => 'taker'
        ]);
        $table->update();
    }
}
