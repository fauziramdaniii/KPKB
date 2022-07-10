<?php
use Migrations\AbstractMigration;

class CreateTableKiaRequirements extends AbstractMigration
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
        $table = $this->table('kia_requirements');
		$table->addColumn('kia_submission_id', 'integer', [
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
