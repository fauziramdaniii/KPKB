<?php
use Migrations\AbstractSeed;

/**
 * Educations seed.
 */
class EducationsSeed extends AbstractSeed
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
                'name' => 'SD',
            ],
            [
                'id' => '2',
                'name' => 'SMP',
            ],
            [
                'id' => '3',
                'name' => 'SMA',
            ],
            [
                'id' => '4',
                'name' => 'D1',
            ],
            [
                'id' => '5',
                'name' => 'D3',
            ],
            [
                'id' => '6',
                'name' => 'S1',
            ],
            [
                'id' => '7',
                'name' => 'S2',
            ],
        ];

        $table = $this->table('educations');
        $table->insert($data)->save();
    }
}
