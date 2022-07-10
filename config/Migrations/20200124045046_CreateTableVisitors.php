<?php
use Migrations\AbstractMigration;

class CreateTableVisitors extends AbstractMigration
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
        $table = $this->table('visitors');

        $table->addColumn('ip', 'string', [
            'default' => null,
            'null' => true,
            'limit' => 15,
        ]);

        $table->addColumn('city', 'string', [
            'default' => null,
            'null' => true,
            'limit' => 50,
        ]);

        $table->addColumn('region', 'string', [
            'default' => null,
            'null' => true,
            'limit' => 50,
        ]);

        $table->addColumn('country_name', 'string', [
            'default' => null,
            'null' => true,
            'limit' => 30,
        ]);

        $table->addColumn('country_code', 'string', [
            'default' => null,
            'null' => true,
            'limit' => 5,
        ]);

        $table->addColumn('latitude', 'float', [
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('longitude', 'float', [
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('asn', 'string', [
            'default' => null,
            'null' => true,
            'limit' => 30,
        ]);

        $table->addColumn('organisation', 'string', [
            'default' => null,
            'null' => true,
            'limit' => 150,
        ]);



        $table->addIndex(['ip']);


        $table->create();
    }
}
