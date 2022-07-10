<?php
use Migrations\AbstractMigration;

class AlterTableKtpSubmissions7 extends AbstractMigration
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
		$table->addColumn('tanggal_pengajuan_berkas', 'date', [
            'null' => true,
			'after' => 'note'
        ]);
		$table->addColumn('tanggal_pengambilan_berkas', 'date', [
            'null' => true,
			'after' => 'tanggal_pengajuan_berkas'
        ]);
        $table->update();
    }
}
