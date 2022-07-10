<?php
use Migrations\AbstractSeed;

/**
 * Galleries seed.
 */
class GalleriesSeed extends AbstractSeed
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
                'id' => '3',
                'album_id' => '1',
                'image_id' => '3',
                'title' => NULL,
                'slug' => NULL,
                'created' => '2019-11-04 10:27:44',
            ],
            [
                'id' => '4',
                'album_id' => '2',
                'image_id' => '4',
                'title' => NULL,
                'slug' => NULL,
                'created' => '2019-11-04 10:29:48',
            ],
            [
                'id' => '5',
                'album_id' => '2',
                'image_id' => '5',
                'title' => NULL,
                'slug' => NULL,
                'created' => '2019-11-04 10:29:48',
            ],
        ];

        $table = $this->table('galleries');
        $table->insert($data)->save();
    }
}
