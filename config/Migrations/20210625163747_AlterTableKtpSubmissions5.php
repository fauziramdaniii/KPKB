<?php
use Migrations\AbstractMigration;

class AlterTableKtpSubmissions5 extends AbstractMigration
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
		$table->addColumn('status_pembuatan', 'string', [
            'limit' => 15,
            'null' => false,
			'after' => 'submission_status_id',
        ]);
		$table->addColumn('bukti1_image_id', 'integer', [
            'default' => null,
            'null' => true,
			'after' => 'status_pembuatan',
        ]);
		$table->addColumn('bukti2_image_id', 'integer', [
            'default' => null,
            'null' => true,
			'after' => 'bukti1_image_id',
        ]);
        $table->update();
    }
}
