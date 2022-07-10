<?php
use Migrations\AbstractMigration;

class AlterTableKtpSubmissions6 extends AbstractMigration
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
		$table->addColumn('modified', 'datetime', [
            'null' => true,
			'after' => 'created'
        ]);
        $table->update();
    }
}
