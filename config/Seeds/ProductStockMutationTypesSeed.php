<?php
use Migrations\AbstractSeed;

/**
 * ProductStockMutationTypes seed.
 */
class ProductStockMutationTypesSeed extends AbstractSeed
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
                'name' => 'Penambahan',
            ],
            [
                'id' => '2',
                'name' => 'Pengurangan',
            ],
        ];

        $table = $this->table('product_stock_mutation_types');
        $table->insert($data)->save();
    }
}
