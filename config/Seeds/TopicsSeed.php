<?php
use Migrations\AbstractSeed;

/**
 * Topics seed.
 */
class TopicsSeed extends AbstractSeed
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
                'name' => 'Latest News',
            ],
            [
                'id' => '2',
                'name' => 'Product Updates',
            ],
        ];

        $table = $this->table('topics');
        $table->insert($data)->save();
    }
}
