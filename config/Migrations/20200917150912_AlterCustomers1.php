<?php
use Migrations\AbstractMigration;

class AlterCustomers1 extends AbstractMigration
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
        $table = $this->table('customers');


        $table->addColumn('upline_id', 'integer', [
            'default' => null,
            'null' => true,
            'after' => 'refferal_id',
        ])->addIndex('upline_id');

        $table->addColumn('identity_number', 'string', [
            'default' => null,
            'null' => true,
            'limit' => 20,
            'after' => 'card_id',
        ]);

        $table->addColumn('name_birth_mother', 'string', [
            'default' => null,
            'null' => true,
            'limit' => 50,
            'after' => 'heir_relation',
        ]);

        $table->update();
    }
}
