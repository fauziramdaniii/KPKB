<?php
use Migrations\AbstractMigration;

class AlterTableKiaSubmissions5 extends AbstractMigration
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
		$table->addColumn('status_pembuatan', 'string', [
            'limit' => 50,
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
		$table->addColumn('bukti3_image_id', 'integer', [
            'default' => null,
            'null' => true,
			'after' => 'bukti2_image_id',
        ]);
		$table->addColumn('bukti4_image_id', 'integer', [
            'default' => null,
            'null' => true,
			'after' => 'bukti3_image_id',
        ]);
		$table->addColumn('modified', 'datetime', [
            'null' => true,
			'after' => 'created'
        ]);
        $table->update();
    }
}
