<?php
use Migrations\AbstractMigration;

class DropCustom extends AbstractMigration
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
            'albums',
            'banks',
            'blogs',
            'blog_tags',
            'cards',
            'card_statuses',
            'card_types',
            'customer_banks',
            'customer_types',
            'downloads',
            'download_categories',
            'events',
            'event_attendances',
            'event_categories',
            'faqs',
            'faq_categories',
            'galleries',
            'generations',
            'networks',
            'orders',
            'order_confirmations',
            'order_details',
            'order_statuses',
            'pages',
            'products',
            'product_stocks',
            'product_stock_mutations',
            'product_stock_mutation_transactions',
            'product_stock_mutation_types',
            'product_units',
            'suppliers',
            'tags',
            'topics',
            'transactions',
            'transaction_mutations',
            'transaction_types',
            'transfers',
            'withdrawals',
            'withdrawal_statuses',
        ];

        foreach ($tables as $table){
            $model = $this->table($table);
            $model->drop()->save();
        }
    }
}
