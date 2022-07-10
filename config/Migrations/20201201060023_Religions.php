<?php
use Migrations\AbstractMigration;

class Religions extends AbstractMigration
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
        $table = $this->table('religions');

        $table->addColumn('name', 'string', [
            'default' => null,
            'null' => true,
        ]);

        $table->create();
    }
}
