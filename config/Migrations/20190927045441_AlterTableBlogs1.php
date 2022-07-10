<?php
use Migrations\AbstractMigration;

class AlterTableBlogs1 extends AbstractMigration
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
        $table = $this->table('blogs');
        $table->changeColumn('status', 'integer', [
            'null' => true,
            'default' => 0,
            'limit' => 1,
        ]);
        $table->update();
    }
}
