<?php
use Migrations\AbstractSeed;

/**
 * Provinces seed.
 */
class ProvincesSeed extends AbstractSeed
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
                'name' => 'Bali',
                'zone' => '1',
            ],
            [
                'id' => '2',
                'name' => 'Bangka Belitung',
                'zone' => '2',
            ],
            [
                'id' => '3',
                'name' => 'Banten',
                'zone' => '1',
            ],
            [
                'id' => '4',
                'name' => 'Bengkulu',
                'zone' => '2',
            ],
            [
                'id' => '5',
                'name' => 'DI Yogyakarta',
                'zone' => '1',
            ],
            [
                'id' => '6',
                'name' => 'DKI Jakarta',
                'zone' => '1',
            ],
            [
                'id' => '7',
                'name' => 'Gorontalo',
                'zone' => '4',
            ],
            [
                'id' => '8',
                'name' => 'Jambi',
                'zone' => '2',
            ],
            [
                'id' => '9',
                'name' => 'Jawa Barat',
                'zone' => '1',
            ],
            [
                'id' => '10',
                'name' => 'Jawa Tengah',
                'zone' => '1',
            ],
            [
                'id' => '11',
                'name' => 'Jawa Timur',
                'zone' => '1',
            ],
            [
                'id' => '12',
                'name' => 'Kalimantan Barat',
                'zone' => '2',
            ],
            [
                'id' => '13',
                'name' => 'Kalimantan Selatan',
                'zone' => '2',
            ],
            [
                'id' => '14',
                'name' => 'Kalimantan Tengah',
                'zone' => '1',
            ],
            [
                'id' => '15',
                'name' => 'Kalimantan Timur',
                'zone' => '2',
            ],
            [
                'id' => '16',
                'name' => 'Kalimantan Utara',
                'zone' => '3',
            ],
            [
                'id' => '17',
                'name' => 'Kepulauan Riau',
                'zone' => '3',
            ],
            [
                'id' => '18',
                'name' => 'Lampung',
                'zone' => '1',
            ],
            [
                'id' => '19',
                'name' => 'Maluku',
                'zone' => '4',
            ],
            [
                'id' => '20',
                'name' => 'Maluku Utara',
                'zone' => '4',
            ],
            [
                'id' => '21',
                'name' => 'Nanggroe Aceh Darussalam (NAD)',
                'zone' => '4',
            ],
            [
                'id' => '22',
                'name' => 'Nusa Tenggara Barat (NTB)',
                'zone' => '3',
            ],
            [
                'id' => '23',
                'name' => 'Nusa Tenggara Timur (NTT)',
                'zone' => '3',
            ],
            [
                'id' => '24',
                'name' => 'Papua',
                'zone' => '4',
            ],
            [
                'id' => '25',
                'name' => 'Papua Barat',
                'zone' => '4',
            ],
            [
                'id' => '26',
                'name' => 'Riau',
                'zone' => '2',
            ],
            [
                'id' => '27',
                'name' => 'Sulawesi Barat',
                'zone' => '3',
            ],
            [
                'id' => '28',
                'name' => 'Sulawesi Selatan',
                'zone' => '3',
            ],
            [
                'id' => '29',
                'name' => 'Sulawesi Tengah',
                'zone' => '3',
            ],
            [
                'id' => '30',
                'name' => 'Sulawesi Tenggara',
                'zone' => '4',
            ],
            [
                'id' => '31',
                'name' => 'Sulawesi Utara',
                'zone' => '4',
            ],
            [
                'id' => '32',
                'name' => 'Sumatera Barat',
                'zone' => '2',
            ],
            [
                'id' => '33',
                'name' => 'Sumatera Selatan',
                'zone' => '2',
            ],
            [
                'id' => '34',
                'name' => 'Sumatera Utara',
                'zone' => '2',
            ],
            [
                'id' => '37',
                'name' => 'tangerang',
                'zone' => '1',
            ],
        ];

        $table = $this->table('provinces');
        $table->insert($data)->save();
    }
}
