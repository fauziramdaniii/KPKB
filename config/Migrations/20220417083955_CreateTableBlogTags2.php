<?php
use Migrations\AbstractMigration;

class CreateTableBlogTags2 extends AbstractMigration
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
        $table = $this->table('blog_tags');
		$table->addColumn('blog_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false
        ]);
        $table->addColumn('tag_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false
        ]);
        $table->create();
    }
}
