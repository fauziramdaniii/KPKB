<?php
use Migrations\AbstractMigration;

class CreateEventAttendances extends AbstractMigration
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
        $table = $this->table('event_attendances');

        $table->addColumn('event_id', 'integer', [
            'default' => null,
            'null' => true
        ])->addIndex('event_id');

        $table->addColumn('customer_id', 'integer', [
            'default' => null,
            'null' => true
        ])->addIndex('customer_id');

        $table->addColumn('confirm', 'integer', [
            'default' => 0,
            'null' => true,
            'comment' => '0: pending, 1: yes, 2: may, 3 no'
        ]);

        $table->addColumn('present', 'boolean', [
            'default' => 0,
            'null' => true,
            'comment' => '0: no, 1: attendance / hadir'
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
