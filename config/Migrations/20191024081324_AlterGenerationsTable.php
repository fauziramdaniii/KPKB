<?php
use Migrations\AbstractMigration;

class AlterGenerationsTable extends AbstractMigration
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
        $table = $this->table('generations');

        $table->removeColumn('parent_id');
        $table->removeColumn('lft');
        $table->removeColumn('rght');

        $table->update();
    }
}
