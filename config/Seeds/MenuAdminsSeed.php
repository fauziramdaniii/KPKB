<?php
use Migrations\AbstractSeed;

/**
 * MenuAdmins seed.
 */
class MenuAdminsSeed extends AbstractSeed
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
                'parent_id' => NULL,
                'name' => 'Dashboard',
                'controller' => 'Dashboard',
                'action' => 'index',
                'icon' => 'kt-menu__link-icon flaticon-line-graph',
                'lft' => '9',
                'rght' => '10',
            ],
            [
                'id' => '2',
                'parent_id' => '5',
                'name' => 'Access Control',
                'controller' => '',
                'action' => '',
                'icon' => 'kt-menu__link-bullet kt-menu__link-bullet--line',
                'lft' => '64',
                'rght' => '70',
            ],
            [
                'id' => '3',
                'parent_id' => '2',
                'name' => 'Users',
                'controller' => 'Users',
                'action' => 'index',
                'icon' => 'kt-menu__link-bullet kt-menu__link-bullet--line',
                'lft' => '65',
                'rght' => '69',
            ],
            [
                'id' => '4',
                'parent_id' => '2',
                'name' => 'Groups',
                'controller' => 'Groups',
                'action' => 'index',
                'icon' => 'kt-menu__link-bullet kt-menu__link-bullet--line',
                'lft' => '67',
                'rght' => '68',
            ],
            [
                'id' => '5',
                'parent_id' => NULL,
                'name' => 'Configurations',
                'controller' => '',
                'action' => '',
                'icon' => 'kt-menu__link-icon flaticon-settings',
                'lft' => '63',
                'rght' => '83',
            ],
            [
                'id' => '14',
                'parent_id' => '5',
                'name' => 'Menu Admin',
                'controller' => 'MenuAdmins',
                'action' => 'index',
                'icon' => 'kt-menu__link-bullet kt-menu__link-bullet--line',
                'lft' => '71',
                'rght' => '72',
            ],
            [
                'id' => '25',
                'parent_id' => '5',
                'name' => 'Products Config',
                'controller' => '',
                'action' => '',
                'icon' => 'kt-menu__link-bullet kt-menu__link-bullet--line',
                'lft' => '73',
                'rght' => '80',
            ],
            [
                'id' => '26',
                'parent_id' => '25',
                'name' => 'Werehouse',
                'controller' => 'Suppliers',
                'action' => 'index',
                'icon' => 'kt-menu__link-bullet kt-menu__link-bullet--line',
                'lft' => '74',
                'rght' => '75',
            ],
            [
                'id' => '27',
                'parent_id' => '25',
                'name' => 'Products',
                'controller' => 'Products',
                'action' => 'index',
                'icon' => 'kt-menu__link-bullet kt-menu__link-bullet--line',
                'lft' => '76',
                'rght' => '77',
            ],
            [
                'id' => '28',
                'parent_id' => '25',
                'name' => 'Product Unit',
                'controller' => 'ProductUnits',
                'action' => 'index',
                'icon' => 'kt-menu__link-bullet kt-menu__link-bullet--line',
                'lft' => '78',
                'rght' => '79',
            ],
            [
                'id' => '30',
                'parent_id' => NULL,
                'name' => 'Customers',
                'controller' => '',
                'action' => '',
                'icon' => 'kt-menu__link-icon  flaticon-list-2',
                'lft' => '29',
                'rght' => '38',
            ],
            [
                'id' => '33',
                'parent_id' => NULL,
                'name' => 'Income & Mutations',
                'controller' => '',
                'action' => '',
                'icon' => 'kt-menu__link-icon   flaticon-suitcase',
                'lft' => '49',
                'rght' => '54',
            ],
            [
                'id' => '34',
                'parent_id' => '30',
                'name' => 'List Customers',
                'controller' => 'Customers',
                'action' => 'index',
                'icon' => 'kt-menu__link-bullet kt-menu__link-bullet--line',
                'lft' => '30',
                'rght' => '31',
            ],
            [
                'id' => '35',
                'parent_id' => '33',
                'name' => 'List Bonuses',
                'controller' => 'TransactionMutations',
                'action' => 'index',
                'icon' => 'kt-menu__link-bullet kt-menu__link-bullet--line',
                'lft' => '50',
                'rght' => '51',
            ],
            [
                'id' => '36',
                'parent_id' => '33',
                'name' => 'List Withdrawals',
                'controller' => 'Withdrawals',
                'action' => 'index',
                'icon' => 'kt-menu__link-bullet kt-menu__link-bullet--line',
                'lft' => '52',
                'rght' => '53',
            ],
            [
                'id' => '44',
                'parent_id' => '30',
                'name' => 'List Testimonial',
                'controller' => 'Testimonials',
                'action' => 'index',
                'icon' => 'kt-menu__link-bullet kt-menu__link-bullet--line',
                'lft' => '32',
                'rght' => '33',
            ],
            [
                'id' => '45',
                'parent_id' => '5',
                'name' => 'Zone Config',
                'controller' => 'Provinces',
                'action' => 'index',
                'icon' => 'kt-menu__link-bullet kt-menu__link-bullet--line',
                'lft' => '81',
                'rght' => '82',
            ],
            [
                'id' => '46',
                'parent_id' => NULL,
                'name' => 'Products',
                'controller' => '',
                'action' => '',
                'icon' => 'kt-menu__link-icon flaticon-cart',
                'lft' => '39',
                'rght' => '48',
            ],
            [
                'id' => '47',
                'parent_id' => '46',
                'name' => 'Order Products',
                'controller' => 'Orders',
                'action' => 'index',
                'icon' => 'kt-menu__link-bullet kt-menu__link-bullet--line',
                'lft' => '40',
                'rght' => '41',
            ],
            [
                'id' => '48',
                'parent_id' => '46',
                'name' => 'Product Stocks',
                'controller' => 'ProductStocks',
                'action' => 'index',
                'icon' => 'kt-menu__link-bullet kt-menu__link-bullet--line',
                'lft' => '42',
                'rght' => '43',
            ],
            [
                'id' => '49',
                'parent_id' => '46',
                'name' => 'Product Stock Mutations',
                'controller' => 'ProductStockMutations',
                'action' => 'index',
                'icon' => 'kt-menu__link-bullet kt-menu__link-bullet--line',
                'lft' => '44',
                'rght' => '45',
            ],
            [
                'id' => '53',
                'parent_id' => NULL,
                'name' => 'Reports',
                'controller' => '',
                'action' => '',
                'icon' => 'kt-menu__link-icon flaticon-graph',
                'lft' => '55',
                'rght' => '62',
            ],
            [
                'id' => '54',
                'parent_id' => '53',
                'name' => 'Total Sales',
                'controller' => 'Reports',
                'action' => 'sales',
                'icon' => 'kt-menu__link-bullet kt-menu__link-bullet--line',
                'lft' => '56',
                'rght' => '57',
            ],
            [
                'id' => '55',
                'parent_id' => '53',
                'name' => 'Sales Users',
                'controller' => 'Reports',
                'action' => 'salesby',
                'icon' => 'kt-menu__link-bullet kt-menu__link-bullet--line',
                'lft' => '58',
                'rght' => '59',
            ],
            [
                'id' => '56',
                'parent_id' => '53',
                'name' => 'Income Reports',
                'controller' => 'Reports',
                'action' => 'bonus',
                'icon' => 'kt-menu__link-bullet kt-menu__link-bullet--line',
                'lft' => '60',
                'rght' => '61',
            ],
            [
                'id' => '57',
                'parent_id' => '46',
                'name' => 'Product Serials',
                'controller' => 'Cards',
                'action' => 'index',
                'icon' => 'kt-menu__link-bullet kt-menu__link-bullet--line',
                'lft' => '46',
                'rght' => '47',
            ],
            [
                'id' => '58',
                'parent_id' => NULL,
                'name' => 'CMS',
                'controller' => '',
                'action' => '',
                'icon' => 'kt-menu__link-icon flaticon-symbol',
                'lft' => '11',
                'rght' => '28',
            ],
            [
                'id' => '59',
                'parent_id' => '58',
                'name' => 'Pages',
                'controller' => 'Pages',
                'action' => 'index',
                'icon' => 'kt-menu__link-bullet kt-menu__link-bullet--line',
                'lft' => '12',
                'rght' => '13',
            ],
            [
                'id' => '60',
                'parent_id' => '58',
                'name' => 'Blogs',
                'controller' => 'Blogs',
                'action' => 'index',
                'icon' => 'kt-menu__link-bullet kt-menu__link-bullet--line',
                'lft' => '14',
                'rght' => '15',
            ],
            [
                'id' => '61',
                'parent_id' => '58',
                'name' => 'Tags',
                'controller' => 'Tags',
                'action' => 'index',
                'icon' => 'kt-menu__link-bullet kt-menu__link-bullet--line',
                'lft' => '16',
                'rght' => '17',
            ],
            [
                'id' => '62',
                'parent_id' => '58',
                'name' => 'Topics',
                'controller' => 'Topics',
                'action' => 'index',
                'icon' => 'kt-menu__link-bullet kt-menu__link-bullet--line',
                'lft' => '18',
                'rght' => '19',
            ],
            [
                'id' => '63',
                'parent_id' => '58',
                'name' => 'Gallery',
                'controller' => 'Galleries',
                'action' => 'index',
                'icon' => 'kt-menu__link-bullet kt-menu__link-bullet--line',
                'lft' => '20',
                'rght' => '21',
            ],
            [
                'id' => '64',
                'parent_id' => '30',
                'name' => 'Statements Bonus',
                'controller' => 'Statements',
                'action' => 'index',
                'icon' => 'kt-menu__link-bullet kt-menu__link-bullet--line',
                'lft' => '34',
                'rght' => '35',
            ],
            [
                'id' => '65',
                'parent_id' => '58',
                'name' => 'Beranda Setting',
                'controller' => 'Settings',
                'action' => 'index',
                'icon' => 'kt-menu__link-bullet kt-menu__link-bullet--line',
                'lft' => '22',
                'rght' => '27',
            ],
            [
                'id' => '66',
                'parent_id' => '65',
                'name' => 'Setting',
                'controller' => 'Settings',
                'action' => 'index',
                'icon' => 'kt-menu__link-bullet kt-menu__link-bullet--line',
                'lft' => '23',
                'rght' => '24',
            ],
            [
                'id' => '67',
                'parent_id' => '65',
                'name' => 'Slide',
                'controller' => 'Slides',
                'action' => 'index',
                'icon' => 'kt-menu__link-bullet kt-menu__link-bullet--line',
                'lft' => '25',
                'rght' => '26',
            ],
            [
                'id' => '68',
                'parent_id' => '30',
                'name' => 'Request Activation',
                'controller' => 'Activations',
                'action' => 'index',
                'icon' => 'kt-menu__link-bullet kt-menu__link-bullet--line',
                'lft' => '36',
                'rght' => '37',
            ],
        ];

        $table = $this->table('menu_admins');
        $table->insert($data)->save();
    }
}