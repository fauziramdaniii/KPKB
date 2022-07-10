<?php
namespace AdminPanel\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Utility\Text;
use Cake\Core\Configure;
use Intervention\Image\ImageManagerStatic as Image;

/**
 * Images Model
 * @property \AdminPanel\Model\Table\ImagesTable|\Cake\ORM\Association\HasMany $Images
 *
 * @method \AdminPanel\Model\Entity\Image get($primaryKey, $options = [])
 * @method \AdminPanel\Model\Entity\Image newEntity($data = null, array $options = [])
 * @method \AdminPanel\Model\Entity\Image[] newEntities(array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Image|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\Image|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\Image patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Image[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Image findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ImagesTable extends Table
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

        $this->setTable('images');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'name' => [
                'fields' => [
                    'dir' => 'dir', // defaults to `dir`
                    'size' => 'size', // defaults to `size`
                    'type' => 'type', // defaults to `type`
                ],
                'path' => 'webroot{DS}files{DS}{model}{DS}{field}{DS}{year}{DS}{month}{DS}',
                'nameCallback' => function ($tableObj, $entity, $data, $field, $settings) {
                    $ext = substr(strrchr($data['name'], '.'), 1);
                    return str_replace('-', '', Text::uuid()) . '.' . 'jpg'; //strtolower($ext);
                },
                'transformer' =>  function ($table, \AdminPanel\Model\Entity\Image $entity, $data, $field, $settings) {

                    $tmp_name = tempnam(sys_get_temp_dir(), 'upload') . '.' . 'jpg'; //force convert to jpg

                    $img = Image::make($data['tmp_name']);

                    $img->save($tmp_name);
                    $data['tmp_name'] = $tmp_name;

                    return [
                        $data['tmp_name'] => $data['name'],
                    ];
                },
                'deleteCallback' => function ($path, $entity, $field, $settings) {
                    return [
                        $path . $entity->{$field}
                    ];
                },
                'keepFilesOnDelete' => false
            ],
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
            ->allowEmptyString('id', 'create');

//        $validator
//            ->scalar('name')
//            ->maxLength('name', 100)
//            ->allowEmptyString('name');
//
//        $validator
//            ->scalar('dir')
//            ->maxLength('dir', 255)
//            ->allowEmptyString('dir');
//
//        $validator
//            ->integer('size')
//            ->allowEmptyString('size');
//
//        $validator
//            ->scalar('type')
//            ->maxLength('type', 150)
//            ->allowEmptyString('type');

        return $validator;
    }

}
