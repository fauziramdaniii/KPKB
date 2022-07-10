<?php
use Migrations\AbstractSeed;

/**
 * CustomerTypes seed.
 */
class CustomerTypesSeed extends AbstractSeed
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
                'name' => 'Member',
            ],
            [
                'id' => '2',
                'name' => 'Stockist',
            ],
        ];

        $table = $this->table('customer_types');
        $table->insert($data)->save();
    }
}
