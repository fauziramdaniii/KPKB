<?php
use Migrations\AbstractMigration;

class CreateTableCountry extends AbstractMigration
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
        $table = $this->table('countries');

        $table->addColumn('iso', 'string', [
            'limit' => 2,
            'null' => false,
        ]);
        $table->addColumn('name', 'string', [
            'limit' => 80,
            'null' => false,
        ]);
        $table->addColumn('nicename', 'string', [
            'limit' => 80,
            'null' => false,
        ]);
        $table->addColumn('iso3', 'string', [
            'limit' => 3,
            'null' => false,
        ]);
        $table->addColumn('numcode', 'integer', [
            'limit' => 6,
            'null' => false,
        ]);
        $table->addColumn('phonecode', 'integer', [
            'limit' => 5,
            'null' => false,
        ]);
        $table->create();
    }
}
