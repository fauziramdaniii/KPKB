<?php
use Migrations\AbstractMigration;

class CreateTableFaqs2 extends AbstractMigration
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
        $table = $this->table('faqs');
		$table->addColumn('faq_category_id', 'string', [
            'default' => null,
        ]);
        $table->addColumn('question', 'string', [
            'default' => null,
            'limit' => 150,
            'null' => false,
            'collation' => 'utf8mb4_unicode_ci'
        ]);
        $table->addColumn('answer', 'text', [
            'default' => null,
            'null' => false,
            'collation' => 'utf8mb4_unicode_ci'
        ]);
        $table->create();
    }
}
