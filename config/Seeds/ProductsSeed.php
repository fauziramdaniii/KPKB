<?php
use Migrations\AbstractSeed;

/**
 * Products seed.
 */
class ProductsSeed extends AbstractSeed
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
                'card_type_id' => '2',
                'name' => 'HIPRO',
                'sku' => '001-01',
                'product_unit_id' => '1',
                'description' => 'HIPRO',
                'price' => '1200000',
                'stokist_price' => '0',
                'point' => '50',
                'on_sales' => '1',
                'weight' => '330',
            ],
            [
                'id' => '2',
                'card_type_id' => '2',
                'name' => 'HIPRO POWDER 50 gr',
                'sku' => '001-02',
                'product_unit_id' => '1',
                'description' => 'HIPRO POWDER 50 gr	',
                'price' => '6000',
                'stokist_price' => '0',
                'point' => '50',
                'on_sales' => '1',
                'weight' => '330',
            ],
            [
                'id' => '3',
                'card_type_id' => '2',
                'name' => 'HIPRO POWDER 100 gr',
                'sku' => '001-03',
                'product_unit_id' => '1',
                'description' => 'HIPRO POWDER 100 gr',
                'price' => '10000',
                'stokist_price' => '0',
                'point' => '50',
                'on_sales' => '1',
                'weight' => '330',
            ],
            [
                'id' => '4',
                'card_type_id' => '2',
                'name' => 'Hipro Mix 100 gr (Hidroponik)',
                'sku' => '001-03',
                'product_unit_id' => '1',
                'description' => 'Hipro Mix 100 gr (Hidroponik)',
                'price' => '12500',
                'stokist_price' => '0',
                'point' => '50',
                'on_sales' => '1',
                'weight' => '330',
            ],
        ];

        $table = $this->table('products');
        $table->insert($data)->save();
    }
}
