<?php
use Migrations\AbstractMigration;

class AlterTableAddressSubmissions extends AbstractMigration
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
        $table = $this->table('address_submissions');
		$table->addColumn('bukti1_image_id', 'integer', [
            'default' => null,
            'null' => true,
			'after' => 'status',
        ]);
		$table->addColumn('modified', 'datetime', [
            'null' => true,
			'after' => 'created'
        ]);
		$table->addColumn('submission_status_id', 'integer', [
            'default' => null,
            'null' => true,
			'after' => 'description'
        ]);
		$table->addColumn('note', 'string', [
            'default' => null,
            'null' => true,
			'after' => 'submission_status_id'
        ]);
		
        $table->update();
    }
}
