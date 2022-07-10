<?php
use Migrations\AbstractSeed;

/**
 * ProductUnits seed.
 */
class ProductUnitsSeed extends AbstractSeed
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
                'name' => 'Box',
            ],
        ];

        $table = $this->table('product_units');
        $table->insert($data)->save();
    }
}
