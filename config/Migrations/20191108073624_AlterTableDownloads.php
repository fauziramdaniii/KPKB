<?php
use Migrations\AbstractMigration;

class AlterTableDownloads extends AbstractMigration
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
        $table = $this->table('downloads');

        $table->addColumn('description', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
            'after' => 'title',
        ]);
        $table->update();
    }
}
