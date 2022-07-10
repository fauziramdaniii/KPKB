<?php
use Migrations\AbstractSeed;

/**
 * CardStatuses seed.
 */
class CardStatusesSeed extends AbstractSeed
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
                'name' => 'Active',
            ],
            [
                'id' => '2',
                'name' => 'Used',
            ],
            [
                'id' => '3',
                'name' => 'Inactive',
            ],
            [
                'id' => '4',
                'name' => 'Ready to use',
            ],
        ];

        $table = $this->table('card_statuses');
        $table->insert($data)->save();
    }
}
