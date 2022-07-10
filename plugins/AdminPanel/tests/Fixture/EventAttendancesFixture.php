<?php
namespace AdminPanel\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EventAttendancesFixture
 */
class EventAttendancesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'event_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'customer_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'confirm' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => '0', 'comment' => '0: pending, 1: yes, 2: may, 3 no', 'precision' => null, 'autoIncrement' => null],
        'present' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => '0', 'comment' => '0: no, 1: attendance / hadir', 'precision' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'event_id' => ['type' => 'index', 'columns' => ['event_id'], 'length' => []],
            'customer_id' => ['type' => 'index', 'columns' => ['customer_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'latin1_swedish_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd
    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'id' => 1,
                'event_id' => 1,
                'customer_id' => 1,
                'confirm' => 1,
                'present' => 1,
                'created' => '2020-09-25 08:28:28',
                'modified' => '2020-09-25 08:28:28',
            ],
        ];
        parent::init();
    }
}
