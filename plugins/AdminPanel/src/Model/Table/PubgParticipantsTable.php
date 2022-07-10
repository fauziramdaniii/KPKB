<?php
namespace AdminPanel\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Utility\Text;
use Cake\Validation\Validator;

/**
 * PubgParticipants Model
 *
 * @property \AdminPanel\Model\Table\GamesTable&\Cake\ORM\Association\BelongsTo $Games
 * @property &\Cake\ORM\Association\BelongsTo $ParticipantStatuses
 *
 * @method \AdminPanel\Model\Entity\PubgParticipant get($primaryKey, $options = [])
 * @method \AdminPanel\Model\Entity\PubgParticipant newEntity($data = null, array $options = [])
 * @method \AdminPanel\Model\Entity\PubgParticipant[] newEntities(array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\PubgParticipant|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\PubgParticipant saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\PubgParticipant patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\PubgParticipant[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\PubgParticipant findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PubgParticipantsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('pubg_participants');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'document' => [
                // Ensure the default filesystem writer writes using
                // our S3 adapter
//                'filesystem' => [
//                    'adapter' => $adapter,
//                ],
                // This can also be in a class that implements
                // the TransformerInterface or any callable type.
                'transformer' => function (\Cake\Datasource\RepositoryInterface $table, \Cake\Datasource\EntityInterface $entity, $data, $field, $settings) {
                    $filename = Text::slug($entity->team_name, '_');
                    // get the extension from the file
                    // there could be better ways to do this, and it will fail
                    // if the file has no extension
                    $extension = pathinfo($data['name'], PATHINFO_EXTENSION);
                    // Store the thumbnail in a temporary file
                    $tmp = $filename . '.' . $extension;
//                    // Use the Imagine library to DO THE THING
//                    $size = new \Imagine\Image\Box(40, 40);
//                    $mode = \Imagine\Image\ImageInterface::THUMBNAIL_INSET;
//                    $imagine = new \Imagine\Gd\Imagine();
//                    // Save that modified file to our temp file
//                    $imagine->open($data['tmp_name'])
//                        ->thumbnail($size, $mode)
//                        ->save($tmp);
//                    // Now return the original *and* the thumbnail

                    $data['name'] = $tmp;
                    return [
                        $data['tmp_name'] => $tmp,
//                        $tmp => 'thumbnail-' . $data['name'],
                    ];
                },
            ],
        ]);

        $this->addBehavior('Timestamp');

        $this->belongsTo('Games', [
            'foreignKey' => 'game_id',
            'className' => 'AdminPanel.Games',
        ]);
        $this->belongsTo('ParticipantStatuses', [
            'foreignKey' => 'participant_status_id',
            'joinType' => 'INNER',
            'className' => 'AdminPanel.ParticipantStatuses',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('team_name')
            ->maxLength('team_name', 150)
            ->requirePresence('team_name', 'create')
            ->notEmptyString('team_name');

        $validator
            ->scalar('person_in_charge')
            ->maxLength('person_in_charge', 150)
            ->requirePresence('person_in_charge', 'create')
            ->notEmptyString('person_in_charge');

        $validator
            ->scalar('phone')
            ->maxLength('phone', 20)
            ->requirePresence('phone', 'create')
            ->notEmptyString('phone');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email');

//        $validator
//            ->scalar('document')
//            ->maxLength('document', 255)
//            ->requirePresence('document', 'create')
//            ->notEmptyString('document');

        $validator
            ->requirePresence('document', 'create')
            ->notEmptyFile('document', true);

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        //$rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['game_id'], 'Games'));
        $rules->add($rules->existsIn(['participant_status_id'], 'ParticipantStatuses'));

        return $rules;
    }
}
