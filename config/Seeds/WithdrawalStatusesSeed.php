<?php
use Migrations\AbstractSeed;

/**
 * WithdrawalStatuses seed.
 */
class WithdrawalStatusesSeed extends AbstractSeed
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
                'name' => 'Pending',
            ],
            [
                'id' => '2',
                'name' => 'Success',
            ],
            [
                'id' => '3',
                'name' => 'Failed',
            ],
        ];

        $table = $this->table('withdrawal_statuses');
        $table->insert($data)->save();
    }
}
