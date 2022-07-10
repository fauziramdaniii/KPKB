<?php
use Migrations\AbstractSeed;

/**
 * CardTypes seed.
 */
class CardTypesSeed extends AbstractSeed
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
                'name' => 'Registrations',
            ],
            [
                'id' => '2',
                'name' => 'Repeat Orders',
            ],
        ];

        $table = $this->table('card_types');
        $table->insert($data)->save();
    }
}
