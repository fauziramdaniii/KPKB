<?php
use Migrations\AbstractSeed;

/**
 * Images seed.
 */
class ImagesSeed extends AbstractSeed
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
                'name' => 'b48c4557cbe9481d912346438d1e8298.jpg',
                'dir' => 'webroot/files/Images/name/2019/11/',
                'size' => '114485',
                'type' => 'image/png',
                'created' => '2019-11-01 10:34:34',
            ],
            [
                'id' => '2',
                'name' => '95fb9839e1404280ac040304671f2ef4.jpg',
                'dir' => 'webroot/files/Images/name/2019/11/',
                'size' => '78097',
                'type' => 'image/png',
                'created' => '2019-11-01 10:38:20',
            ],
            [
                'id' => '3',
                'name' => 'd50b488f0e19453d9cfb3a5497cfef4f.jpg',
                'dir' => 'webroot/files/Images/name/2019/11/',
                'size' => '16327',
                'type' => 'image/jpeg',
                'created' => '2019-11-04 10:27:44',
            ],
            [
                'id' => '4',
                'name' => '9571cab215a54fbaa2b58c766e0163dc.jpg',
                'dir' => 'webroot/files/Images/name/2019/11/',
                'size' => '16327',
                'type' => 'image/jpeg',
                'created' => '2019-11-04 10:29:48',
            ],
            [
                'id' => '5',
                'name' => '1c4f9b89c30a4a6293f8c51d157fa64b.jpg',
                'dir' => 'webroot/files/Images/name/2019/11/',
                'size' => '16327',
                'type' => 'image/jpeg',
                'created' => '2019-11-04 10:29:48',
            ],
            [
                'id' => '6',
                'name' => '94776d5871894d3f97796b4a8619ccb4.jpg',
                'dir' => 'webroot/files/Images/name/2019/11/',
                'size' => '297031',
                'type' => 'image/jpeg',
                'created' => '2019-11-12 08:27:00',
            ],
            [
                'id' => '7',
                'name' => '0528a28c70ab4dc7aba385ac036945d7.jpg',
                'dir' => 'webroot/files/Images/name/2019/11/',
                'size' => '297031',
                'type' => 'image/jpeg',
                'created' => '2019-11-13 06:40:29',
            ],
        ];

        $table = $this->table('images');
        $table->insert($data)->save();
    }
}
