<?php
use Migrations\AbstractSeed;

/**
 * Religions seed.
 */
class ReligionsSeed extends AbstractSeed
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
                'name' => 'Islam',
            ],
            [
                'id' => '2',
                'name' => 'Protestan',
            ],
            [
                'id' => '3',
                'name' => 'Katolik',
            ],
            [
                'id' => '4',
                'name' => 'Hindu',
            ],
            [
                'id' => '5',
                'name' => 'Buddha',
            ],
            [
                'id' => '6',
                'name' => 'Khonghucu',
            ],
        ];

        $table = $this->table('religions');
        $table->insert($data)->save();
    }
}
