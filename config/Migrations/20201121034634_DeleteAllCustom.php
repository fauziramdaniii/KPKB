<?php
use Migrations\AbstractMigration;

class DeleteAllCustom extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $tables = [
            'bonus_sharing_profits',
            'bonus_shelters',
            'bonus_shelter_logs',
            'customer_periods',
            'customer_period_details',
            'customer_ranks',
            'customer_rewards',
            'customer_stocks',
            'customer_stock_mutations',
            'customer_stock_mutation_transactions',
            'customer_verifications',
            'customer_vip_ranks',
            'daily_customer_periods',
            'customer_activations',
            'visitors',
            'customer_contacts',
            'installments',
            'ranks',
            'repeat_orders',
            'rewards',
            'testimonials',
            'order_detail_serials'
        ];

        foreach ($tables as $table){
            $model = $this->table($table);
            $model->drop()->save();
        }
    }
}
