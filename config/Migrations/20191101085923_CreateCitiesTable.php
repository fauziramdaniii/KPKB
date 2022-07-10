<?php
use Migrations\AbstractMigration;

class CreateCitiesTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('cities');

        $table->addColumn('province_id', 'integer', [
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('name', 'string', [
            'limit' => 200,
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('type', 'string', [
            'limit' => 200,
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('postal_code', 'integer', [
            'limit' => 4,
            'default' => null,
            'null' => true,
        ]);

        $table->create();
    }
}
