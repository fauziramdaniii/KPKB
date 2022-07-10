<?php
use Migrations\AbstractSeed;

/**
 * Suppliers seed.
 */
class SuppliersSeed extends AbstractSeed
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
                'name' => 'Jakarta',
                'address' => 'Werehouse Jakarta',
                'email' => 'jakarta@gmail.com',
                'phone' => '0811205255',
            ],
            [
                'id' => '2',
                'name' => 'Bandung',
                'address' => 'Werehouse Bandung',
                'email' => 'bandung@gmail.com',
                'phone' => '0812345678',
            ],
        ];

        $table = $this->table('suppliers');
        $table->insert($data)->save();
    }
}
