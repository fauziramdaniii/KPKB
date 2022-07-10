<?php
use Migrations\AbstractMigration;

class AlterTableBlogs extends AbstractMigration
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
        $table->addColumn('title', 'string', [
            'default' => null,
            'limit' => 255,
            'after' => 'id',
        ]);
        $table->addColumn('slug', 'string', [
            'default' => null,
            'limit' => 255,
            'after' => 'title',
        ]);
        $table->update();
    }
}
