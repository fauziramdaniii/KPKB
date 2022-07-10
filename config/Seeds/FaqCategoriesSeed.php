<?php
use Migrations\AbstractSeed;

/**
 * FaqCategories seed.
 */
class FaqCategoriesSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => '1',
                'name' => 'How to order?',
            ],
            [
                'id' => '2',
                'name' => 'Return order',
            ],
        ];

        $table = $this->table('faq_categories');
        $table->insert($data)->save();
    }
}
