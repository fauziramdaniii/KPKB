<?php
use Migrations\AbstractMigration;

class CreateTableKtpRequirements extends AbstractMigration
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
        $table = $this->table('ktp_requirements');
		$table->addColumn('ktp_submission_id', 'integer', [
            'default' => null,
            'null' => true,
        ]);
		$table->addColumn('image_id', 'integer', [
            'default' => null,
            'null' => true,
        ]);
		$table->addColumn('created', 'datetime', [
            'null' => true,
        ]);
        $table->create();
    }
}
