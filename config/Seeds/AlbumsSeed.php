<?php
use Migrations\AbstractSeed;

/**
 * Albums seed.
 */
class AlbumsSeed extends AbstractSeed
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
                'name' => 'Products',
            ],
            [
                'id' => '2',
                'name' => 'Conversation',
            ],
        ];

        $table = $this->table('albums');
        $table->insert($data)->save();
    }
}
