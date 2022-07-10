<?php
use Migrations\AbstractSeed;

/**
 * OrderStatuses seed.
 */
class OrderStatusesSeed extends AbstractSeed
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
                'name' => 'Pending',
            ],
            [
                'id' => '2',
                'name' => 'Waiting',
            ],
            [
                'id' => '3',
                'name' => 'Complete',
            ],
            [
                'id' => '4',
                'name' => 'Failed',
            ],
            [
                'id' => '5',
                'name' => 'Expired',
            ],
        ];

        $table = $this->table('order_statuses');
        $table->insert($data)->save();
    }
}
