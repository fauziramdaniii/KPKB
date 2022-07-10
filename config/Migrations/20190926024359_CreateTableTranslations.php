<?php
use Migrations\AbstractMigration;

class CreateTableTranslations extends AbstractMigration
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
        $table = $this->table('i18n');
        $table->addColumn('locale', 'string', [
            'default' => null,
            'limit' => 6,
            'null' => true,
        ]);
        $table->addColumn('model', 'string', [
            'default' => null,
            'limit' => 150,
            'null' => true,
        ]);
        $table->addColumn('foreign_key', 'integer', [
            'default' => null,
            'limit' => 10,
            'null' => true,
        ]);
        $table->addColumn('field', 'string', [
            'default' => null,
            'limit' => 150,
            'null' => true,
        ]);
        $table->addColumn('content', 'text', [
            'default' => null,
            'null' => true,
            'collation' => 'utf8mb4_unicode_ci'
        ]);
        $table->addIndex(['locale', 'model', 'foreign_key', 'field'], ['unique' => true]);
        $table->addIndex(['model', 'foreign_key', 'field']);
        $table->create();
    }
}
