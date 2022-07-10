<?php
use Migrations\AbstractMigration;

class CreateTestimonials extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('testimonials');

        $table->addColumn('customer_id', 'integer', [
            'default' => null,
            'null' => true,
        ])->addIndex('customer_id');

        $table->addColumn('approved', 'boolean', [
            'default' => 0,
        ]);

        $table->addColumn('message', 'text', [
            'default' => null,
            'null' => true,
        ]);


        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => true,
        ]);


        $table->create();
    }
}
