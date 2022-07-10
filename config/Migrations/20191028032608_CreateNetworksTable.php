<?php
use Migrations\AbstractMigration;

class CreateNetworksTable extends AbstractMigration
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
        $table = $this->table('networks');

        $table->addColumn('customer_id', 'integer', [
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('parent_id', 'integer', [
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('lft', 'integer', [
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('rght', 'integer', [
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('level', 'integer', [
            'default' => null,
            'null' => true,
        ]);


        $table->addIndex('customer_id');
        $table->addIndex('parent_id');

        $table->create();
    }
}
