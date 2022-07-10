<?php
use Migrations\AbstractSeed;

/**
 * TransactionTypes seed.
 */
class TransactionTypesSeed extends AbstractSeed
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
                'name' => 'Network Reward',
            ],
            [
                'id' => '2',
                'name' => 'Cash Back',
            ],
            [
                'id' => '3',
                'name' => 'Withdrawal',
            ],
            [
                'id' => '4',
                'name' => 'Fee',
            ],
            [
                'id' => '5',
                'name' => 'Refund',
            ],
            [
                'id' => '6',
                'name' => 'Un Alocated Bonus',
            ],
            [
                'id' => '7',
                'name' => 'Transfer',
            ],
            [
                'id' => '8',
                'name' => 'Received',
            ],
            [
                'id' => '9',
                'name' => 'Reward Member',
            ],
            [
                'id' => '10',
                'name' => 'Pending Bonus independent Star',
            ],
            [
                'id' => '11',
                'name' => 'Break Away',
            ],
            [
                'id' => '12',
                'name' => 'Bonus Promotion Rank',
            ],
        ];

        $table = $this->table('transaction_types');
        $table->insert($data)->save();
    }
}
