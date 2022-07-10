<?php
use Migrations\AbstractMigration;

class AlterTableValorantParticipants extends AbstractMigration
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
        $table = $this->table('valorant_participants');
		$table->addColumn('person_in_charge', 'string', [
            'limit' => 150,
            'null' => false,
			'after' => 'team_name'
        ]);
		$table->addColumn('phone', 'string', [
            'limit' => 20,
            'null' => false,
			'after' => 'person_in_charge'
        ]);
		$table->addColumn('email', 'string', [
            'limit' => 150,
            'null' => false,
			'after' => 'phone'
        ]);
		$table->addColumn('participant_status_id', 'string', [
            'limit' => 15,
            'null' => false,
			'after' => 'document',
        ]);
		$table->addColumn('modified', 'datetime', [
            'null' => true,
			'after' => 'created',
        ]);
		$table->removeColumn('status');
        $table->update();
    }
}
