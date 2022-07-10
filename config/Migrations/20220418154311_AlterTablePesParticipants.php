<?php
use Migrations\AbstractMigration;

class AlterTablePesParticipants extends AbstractMigration
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
        $table = $this->table('pes_participants');
		$table->addColumn('participant_status_id', 'string', [
            'limit' => 15,
            'null' => false,
			'after' => 'bukti_vaksin',
        ]);
		$table->addColumn('modified', 'datetime', [
            'null' => true,
			'after' => 'created',
        ]);
		$table->removeColumn('status');
        $table->update();
    }
}
