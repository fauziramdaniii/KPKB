<?php
namespace AdminPanel\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Settings Model
 *
 * @method \AdminPanel\Model\Entity\Setting get($primaryKey, $options = [])
 * @method \AdminPanel\Model\Entity\Setting newEntity($data = null, array $options = [])
 * @method \AdminPanel\Model\Entity\Setting[] newEntities(array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Setting|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\Setting saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\Setting patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Setting[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Setting findOrCreate($search, callable $callback = null, $options = [])
 */
class SettingsTable extends Table
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

        $this->setTable('settings');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'image' => []
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
            ->scalar('title_slide')
            ->maxLength('title_slide', 50)
            ->allowEmptyString('title_slide');

        $validator
            ->scalar('description_slide')
            ->maxLength('description_slide', 150)
            ->allowEmptyString('description_slide');

        $validator
            ->scalar('title_section1')
            ->maxLength('title_section1', 50)
            ->requirePresence('title_section1', 'create')
            ->notEmptyString('title_section1');

        $validator
            ->scalar('shadow_title_section1')
            ->maxLength('shadow_title_section1', 50)
            ->requirePresence('shadow_title_section1', 'create')
            ->notEmptyString('shadow_title_section1');

        $validator
            ->scalar('description_section1')
            ->maxLength('description_section1', 150)
            ->requirePresence('description_section1', 'create')
            ->notEmptyString('description_section1');

        $validator
            ->scalar('icon_process1_section1')
            ->maxLength('icon_process1_section1', 50)
            ->requirePresence('icon_process1_section1', 'create')
            ->notEmptyString('icon_process1_section1');

        $validator
            ->scalar('title_process1_section1')
            ->maxLength('title_process1_section1', 50)
            ->requirePresence('title_process1_section1', 'create')
            ->notEmptyString('title_process1_section1');

        $validator
            ->scalar('description_process1_section1')
            ->maxLength('description_process1_section1', 150)
            ->requirePresence('description_process1_section1', 'create')
            ->notEmptyString('description_process1_section1');

        $validator
            ->scalar('icon_process2_section1')
            ->maxLength('icon_process2_section1', 50)
            ->requirePresence('icon_process2_section1', 'create')
            ->notEmptyString('icon_process2_section1');

        $validator
            ->scalar('title_process2_section1')
            ->maxLength('title_process2_section1', 50)
            ->requirePresence('title_process2_section1', 'create')
            ->notEmptyString('title_process2_section1');

        $validator
            ->scalar('description_process2_section1')
            ->maxLength('description_process2_section1', 150)
            ->requirePresence('description_process2_section1', 'create')
            ->notEmptyString('description_process2_section1');

        $validator
            ->scalar('icon_process3_section1')
            ->maxLength('icon_process3_section1', 50)
            ->requirePresence('icon_process3_section1', 'create')
            ->notEmptyString('icon_process3_section1');

        $validator
            ->scalar('title_process3_section1')
            ->maxLength('title_process3_section1', 50)
            ->requirePresence('title_process3_section1', 'create')
            ->notEmptyString('title_process3_section1');

        $validator
            ->scalar('description_process3_section1')
            ->maxLength('description_process3_section1', 150)
            ->requirePresence('description_process3_section1', 'create')
            ->notEmptyString('description_process3_section1');

        $validator
//            ->scalar('image')
            ->requirePresence('image', 'create')
            ->allowEmptyFile('image', true);

        $validator
            ->scalar('link_promo_video')
            ->maxLength('link_promo_video', 255)
            ->requirePresence('link_promo_video', 'create')
            ->notEmptyString('link_promo_video');

        $validator
            ->scalar('title_promo_video')
            ->maxLength('title_promo_video', 100)
            ->allowEmptyString('title_promo_video');

        $validator
            ->scalar('description_promo_video')
            ->maxLength('description_promo_video', 150)
            ->allowEmptyString('description_promo_video');

        return $validator;
    }
}
