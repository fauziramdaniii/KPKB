<?php
namespace AdminPanel\Model\Table;

use Cake\Database\Expression\QueryExpression;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Utility\Text;
use Cake\Validation\Validator;

/**
 * Customers Model
 *
 * @property \AdminPanel\Model\Table\CountriesTable|\Cake\ORM\Association\BelongsTo $Countries
 * @property \AdminPanel\Model\Table\CustomerTypesTable|\Cake\ORM\Association\BelongsTo $CustomerTypes
 * @property \AdminPanel\Model\Table\NetworksTable|\Cake\ORM\Association\HasOne $Networks
 * @property \AdminPanel\Model\Table\NetworksTable|\Cake\ORM\Association\HasOne $CustomerContacts
 * @property \AdminPanel\Model\Table\CustomerBanksTable|\Cake\ORM\Association\HasOne $CustomerBanks
 * @property \AdminPanel\Model\Table\CustomerAddressTable|\Cake\ORM\Association\HasMany $CustomerAddress
 * @property \AdminPanel\Model\Table\CountriesTable|\Cake\ORM\Association\BelongsTo $HeirCountries
 * @property \AdminPanel\Model\Table\EducationsTable|\Cake\ORM\Association\BelongsTo $Educations
 * @property \AdminPanel\Model\Table\ReligionsTable|\Cake\ORM\Association\BelongsTo $Religions
 *
 * @method \AdminPanel\Model\Entity\Customer get($primaryKey, $options = [])
 * @method \AdminPanel\Model\Entity\Customer newEntity($data = null, array $options = [])
 * @method \AdminPanel\Model\Entity\Customer[] newEntities(array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Customer|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\Customer|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\Customer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Customer[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Customer findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CustomersTable extends Table
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

        $this->setTable('customers');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'avatar' => [
                // Ensure the default filesystem writer writes using
                // our S3 adapter
//                'filesystem' => [
//                    'adapter' => $adapter,
//                ],
                'nameCallback' => function ($tableObj, $entity, $data, $field, $settings) {
                    $ext = substr(strrchr($data['name'], '.'), 1);
                    return str_replace('-', '', Text::uuid()) . '.' . 'jpg'; //strtolower($ext);
                },
                // This can also be in a class that implements
                // the TransformerInterface or any callable type.
                'transformer' => function (\Cake\Datasource\RepositoryInterface $table,
                                           \Cake\Datasource\EntityInterface $entity,
                                           $data, $field, $settings) {
                    // get the extension from the file
                    // there could be better ways to do this, and it will fail
                    // if the file has no extension
                    $extension = pathinfo($data['name'], PATHINFO_EXTENSION);
                    // Store the thumbnail in a temporary file
                    $tmp = tempnam(sys_get_temp_dir(), 'upload') . '.' . $extension;
                    // Use the Imagine library to DO THE THING
                    $size = new \Imagine\Image\Box(40, 40);
                    $mode = \Imagine\Image\ImageInterface::THUMBNAIL_OUTBOUND;
                    $imagine = new \Imagine\Gd\Imagine();
                    // Save that modified file to our temp file

                    $save = false;

                    try {
                        $save = $imagine->open($data['tmp_name'])
                            ->thumbnail($size, $mode)
                            ->save($tmp);
                    } catch(\Exception $e) {
                        //debug($e->getMessage());exit;
                    }

                    if ($save && $entity->isDirty('avatar')) {
                        $original = $entity->getOriginal('avatar');
                        $path = WWW_ROOT . 'files' . DS . 'Customers' . DS . $field . DS;
                        if ($original && file_exists($path . $original)) {
                            unlink($path . $original);
                        }
                        if ($original && file_exists($path . 'thumbnail-' . $original)) {
                            unlink($path . 'thumbnail-' . $original);
                        }
                    }


                    // Now return the original *and* the thumbnail
                    return [
                        $data['tmp_name'] => $data['name'],
                        $tmp => 'thumbnail-' . $data['name'],
                    ];
                },
                'deleteCallback' => function ($path, $entity, $field, $settings) {
                    // When deleting the entity, both the original and the thumbnail will be removed
                    // when keepFilesOnDelete is set to false

                    return [
                        $path . $entity->{$field}
                    ];
                },
                'keepFilesOnDelete' => false
            ],
        ]);

        $this->belongsTo('Countries', [
            'foreignKey' => 'country_id',
            'joinType' => 'INNER',
            'className' => 'AdminPanel.Countries'
        ]);

        $this->belongsTo('HeirCountries', [
            'foreignKey' => 'heir_country_id',
            'joinType' => 'LEFT',
            'className' => 'AdminPanel.Countries'
        ]);

        $this->belongsTo('RefferalCustomers', [
            'className' => 'AdminPanel.Customers',
            'foreignKey' => 'refferal_id'
        ]);

        /*
        $this->belongsTo('Cards', [
            'className' => 'AdminPanel.Cards',
            'foreignKey' => 'card_id'
        ]);
        */

        $this->hasOne('Networks', [
            'foreignKey' => 'customer_id',
            'className' => 'AdminPanel.Networks'
        ]);

        $this->belongsTo('CustomerTypes', [
            'className' => 'AdminPanel.CustomerTypes',
            'foreignKey' => 'customer_type_id'
        ]);
        $this->hasOne('CustomerAddress', [
            'foreignKey' => 'customer_id',
            'className' => 'AdminPanel.CustomerAddress'
        ]);
        $this->hasOne('CustomerContacts', [
            'foreignKey' => 'customer_id',
            'className' => 'AdminPanel.CustomerContacts'
        ]);

        $this->hasOne('CustomerBanks', [
            'foreignKey' => 'customer_id',
            'className' => 'AdminPanel.CustomerBanks'
        ])->setConditions(function(QueryExpression $exp) {
            return $exp->isNull('deleted');
        });

        $this->belongsTo('Religions', [
            'className' => 'AdminPanel.Religions',
            'foreignKey' => 'religion_id'
        ]);

        $this->belongsTo('Educations', [
            'className' => 'AdminPanel.Educations',
            'foreignKey' => 'education_id'
        ]);

        /*
        $this->belongsTo('Ranks', [
            'className' => 'AdminPanel.Ranks',
            'foreignKey' => 'rank_id'
        ]);

        $this->belongsTo('VipRanks', [
            'className' => 'AdminPanel.Ranks',
            'foreignKey' => 'vip_rank_id'
        ]);
        */

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
            ->allowEmptyString('id', 'create');

//        $validator
//            ->integer('country_id')
//            ->allowEmptyString('country_id', false);

        $validator
            ->scalar('username')
            ->alphaNumeric('username', __('Please enter alphaNumeric format'))
            ->lengthBetween('username', [6, 16], __('Please enter 6 - 16 characters'))
            ->requirePresence('username', 'create')
            ->allowEmptyString('username', false, __('Please enter a valid username'));

        $validator
            ->email('email','')
            ->requirePresence('email', 'create')
            ->allowEmptyString('email', false,  __('Please enter a valid email'));

        $validator
            ->scalar('first_name')
            ->regex('first_name', '/^[A-Z]+$/i', 'Please enter a valid name')
            ->minLength('first_name', 1, __('Please enter a valid name'))
            ->requirePresence('first_name', 'create')
            ->allowEmptyString('first_name', false,  __('Please enter a valid name'));

        $validator
            ->scalar('last_name')
            ->regex('last_name', '/^[A-Z]+$/i', 'Please enter a valid name')
            ->minLength('last_name', 1, __('Please enter a valid name'))
            ->requirePresence('last_name', 'create')
            ->allowEmptyString('last_name', false,  __('Please enter a valid name'));

        $validator
            ->scalar('phone')
            ->minLength('phone', 5,  __('Please enter a valid phone'))
            ->maxLength('phone', 15,  __('Please enter a valid phone'))
            ->regex('phone', '/^(08+[0-9]{8,11}|02+[0-9]{7,10})$/', __('Please enter a valid phone number'))
            ->requirePresence('phone', 'create')
            ->allowEmptyString('phone', false,  __('Please enter a valid phone'));

        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->regex('password', '/^(?=^.{6,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/',
                __( 'password min 6 char at least one uppercase letter, one lowercase letter and one number'))
            ->requirePresence('password', 'create')
            ->allowEmptyString('password', false,  __('Please enter a valid password'));

        $validator
            ->allowEmptyArray('avatar', false,  __('Please upload a avatar.'));


        $validator
            ->requirePresence('heir', 'create')
            ->regex('heir', '/^[a-z0-9 \.\-]+/i');

        $validator
            ->requirePresence('heir_relation', 'create')
            ->regex('heir_relation', '/^[a-z0-9 \.\-]+/i');



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
        $rules->add($rules->isUnique(['username']));
        $rules->add($rules->isUnique(['email']));
//        $rules->add($rules->isUnique(['phone']));
        //$rules->add($rules->isUnique(['card_id']));
        $rules->add($rules->existsIn(['country_id'], 'Countries'));
        $rules->add($rules->existsIn(['refferal_id'], 'RefferalCustomers'));
        $rules->add($rules->existsIn(['religion_id'], 'Religions'));
        $rules->add($rules->existsIn(['education_id'], 'Educations'));
        //$rules->add($rules->existsIn(['card_id'], 'Cards'));

        return $rules;
    }

    public function validationPassword(Validator $validator)
    {
        $validator
            ->lengthBetween('password', [6, 20], 'password min 6 - 20 character')
            ->notEqualToField('password', 'current_password', __( 'New password cannot match with your current password'))
            ->regex('password', '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$/',
                __( 'password min 6 char at least one uppercase letter, one lowercase letter and one number'));

        $validator
            ->equalToField('repeat_password', 'password', __( 'Repeat password does not match with your password'))
            ->notEqualToField('repeat_password', 'current_password', __( 'Repeat password cannot match with your current password'))
            ->allowEmptyString('repeat_password', function ($context) {
                return !isset($context['data']['password']);
            });
        return $validator;
    }

    public function validationPasswords(Validator $validator)
    {
        $validator
            ->lengthBetween('password', [6, 20], __('password min 6 - 20 character'))
            ->regex('password', '/^(?=^.{6,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/',
                __( 'password min 6 char at least one uppercase letter, one lowercase letter and one number'));

        $validator
            ->equalToField('repeat_password', 'password', __('Confirmation password does not match with your password'))
            ->allowEmptyString('repeat_password', function ($context) {
                return !isset($context['data']['password']);
            });
        return $validator;
    }
}
