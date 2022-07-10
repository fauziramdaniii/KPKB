<?php
use Migrations\AbstractSeed;

/**
 * Groups seed.
 */
class GroupsSeed extends AbstractSeed
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
                'name' => 'Administrator',
                'created' => '2019-01-10 05:01:45',
                'modified' => '2019-01-10 05:01:45',
                'level' => '1',
            ],
        ];

        $table = $this->table('groups');
        $table->insert($data)->save();
    }
}
