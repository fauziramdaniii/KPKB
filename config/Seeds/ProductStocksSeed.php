<?php
use Migrations\AbstractSeed;

/**
 * ProductStocks seed.
 */
class ProductStocksSeed extends AbstractSeed
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
                'product_id' => '1',
                'supplier_id' => '1',
                'quantity' => '0',
            ],
            [
                'id' => '2',
                'product_id' => '2',
                'supplier_id' => '1',
                'quantity' => '0',
            ],
            [
                'id' => '3',
                'product_id' => '3',
                'supplier_id' => '1',
                'quantity' => '0',
            ],
            [
                'id' => '4',
                'product_id' => '4',
                'supplier_id' => '1',
                'quantity' => '0',
            ],
            [
                'id' => '5',
                'product_id' => '1',
                'supplier_id' => '2',
                'quantity' => '0',
            ],
            [
                'id' => '6',
                'product_id' => '2',
                'supplier_id' => '2',
                'quantity' => '0',
            ],
            [
                'id' => '7',
                'product_id' => '3',
                'supplier_id' => '2',
                'quantity' => '0',
            ],
            [
                'id' => '8',
                'product_id' => '4',
                'supplier_id' => '2',
                'quantity' => '0',
            ],
        ];

        $table = $this->table('product_stocks');
        $table->insert($data)->save();
    }
}
