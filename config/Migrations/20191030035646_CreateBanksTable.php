<?php
use Migrations\AbstractMigration;

class CreateBanksTable extends AbstractMigration
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
        $table = $this->table('banks');

        $table->addColumn('code', 'string', [
            'limit' => 4,
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('name', 'string', [
            'limit' => 150,
            'default' => null,
            'null' => true,
        ]);

        $table->create();
    }
}
