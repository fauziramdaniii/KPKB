<?php
use Migrations\AbstractMigration;

class AlterTableKkSubmissions8 extends AbstractMigration
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
		$table->addColumn('classification_id', 'integer', [
            'default' => null,
            'null' => true,
			'after' => 'customer_id'
        ]);
		$table->removeColumn('status_pembuatan');
		$table->removeColumn('bukti1_image_id');
		$table->removeColumn('bukti2_image_id');
		$table->removeColumn('bukti3_image_id');
		$table->removeColumn('bukti4_image_id');
		$table->removeColumn('bukti5_image_id');
        $table->update();
    }
}
