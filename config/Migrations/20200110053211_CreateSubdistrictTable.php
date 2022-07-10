<?php
use Migrations\AbstractMigration;

class CreateSubdistrictTable extends AbstractMigration
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
        $table = $this->table('subdistricts');

        $table->addColumn('city_id', 'integer', [
            'null' => true,
            'default' => null
        ])->addIndex('city_id');

        $table->addColumn('name', 'string', [
            'default' => null,
            'null' => true,
        ]);


        $table->create();
    }
}
