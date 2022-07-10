<?php
use Migrations\AbstractMigration;

class CreateTableGalleries extends AbstractMigration
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
        $table = $this->table('galleries');

        $table->addColumn('album_id', 'integer', [
            'limit' => 11,
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('image_id', 'integer', [
            'limit' => 11,
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('title', 'string', [
            'limit' => 150,
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('slug', 'string', [
            'limit' => 200,
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('created', 'datetime');
        $table->create();
    }
}
