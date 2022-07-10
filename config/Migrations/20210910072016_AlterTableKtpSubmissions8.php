<?php
use Migrations\AbstractMigration;

class AlterTableKtpSubmissions8 extends AbstractMigration
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
		$table->addColumn('classification_id', 'integer', [
            'default' => null,
            'null' => true,
			'after' => 'customer_id'
        ]);
		$table->removeColumn('status_pembuatan');
		$table->removeColumn('bukti1_image_id');
		$table->removeColumn('bukti2_image_id');
        $table->update();
    }
}
