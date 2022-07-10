<?php
use Migrations\AbstractSeed;

/**
 * EventCategories seed.
 */
class EventCategoriesSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => '1',
                'name' => 'Training Level 1',
                'created' => '2020-10-08 09:33:55',
                'modified' => '2020-10-08 09:33:55',
            ],
            [
                'id' => '2',
                'name' => 'Training Level 2',
                'created' => '2020-10-08 09:34:05',
                'modified' => '2020-10-08 09:34:05',
            ],
            [
                'id' => '3',
                'name' => 'Training Level 3',
                'created' => '2020-10-08 09:34:13',
                'modified' => '2020-10-08 09:34:13',
            ],
        ];

        $table = $this->table('event_categories');
        $table->insert($data)->save();
    }
}
