<?php
namespace AdminPanel\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Utility\Text;
use Cake\Validation\Validator;

/**
 * PesParticipants Model
 *
 * @property \AdminPanel\Model\Table\GamesTable&\Cake\ORM\Association\BelongsTo $Games
 * @property &\Cake\ORM\Association\BelongsTo $ParticipantStatuses
 *
 * @method \AdminPanel\Model\Entity\PesParticipant get($primaryKey, $options = [])
 * @method \AdminPanel\Model\Entity\PesParticipant newEntity($data = null, array $options = [])
 * @method \AdminPanel\Model\Entity\PesParticipant[] newEntities(array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\PesParticipant|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\PesParticipant saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\PesParticipant patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\PesParticipant[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\PesParticipant findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PesParticipantsTable extends Table
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

        $this->setTable('pes_participants');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'bukti_vaksin' => [
                // Ensure the default filesystem writer writes using
                // our S3 adapter
//                'filesystem' => [
//                    'adapter' => $adapter,
//                ],
                // This can also be in a class that implements
                // the TransformerInterface or any callable type.
                'transformer' => function (\Cake\Datasource\RepositoryInterface $table, \Cake\Datasource\EntityInterface $entity, $data, $field, $settings) {
                    $filename = Text::slug($entity->name, '_');
                    // get the extension from the file
                    // there could be better ways to do this, and it will fail
                    // if the file has no extension
                    $extension = pathinfo($data['name'], PATHINFO_EXTENSION);
                    // Store the thumbnail in a temporary file
                    $tmp = $filename . '_vaksin.' . $extension;
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
            'ktp' => [
                // Ensure the default filesystem writer writes using
                // our S3 adapter
//                'filesystem' => [
//                    'adapter' => $adapter,
//                ],
                // This can also be in a class that implements
                // the TransformerInterface or any callable type.
                'transformer' => function (\Cake\Datasource\RepositoryInterface $table, \Cake\Datasource\EntityInterface $entity, $data, $field, $settings) {
                    $filename = Text::slug($entity->name, '_');
                    // get the extension from the file
                    // there could be better ways to do this, and it will fail
                    // if the file has no extension
                    $extension = pathinfo($data['name'], PATHINFO_EXTENSION);
                    // Store the thumbnail in a temporary file
                    $tmp = $filename . '_ktp.' . $extension;
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
            ->scalar('name')
            ->maxLength('name', 100)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('phone')
            ->maxLength('phone', 50)
            ->requirePresence('phone', 'create')
            ->notEmptyString('phone');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email');

//        $validator
//            ->scalar('ktp')
//            ->maxLength('ktp', 255)
//            ->requirePresence('ktp', 'create')
//            ->notEmptyString('ktp');

        $validator
            ->requirePresence('ktp', 'create')
            ->notEmptyFile('ktp', true);

//        $validator
//            ->scalar('bukti_vaksin')
//            ->maxLength('bukti_vaksin', 255)
//            ->requirePresence('bukti_vaksin', 'create')
//            ->notEmptyString('bukti_vaksin');

        $validator
            ->requirePresence('bukti_vaksin', 'create')
            ->notEmptyFile('bukti_vaksin', true);

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
