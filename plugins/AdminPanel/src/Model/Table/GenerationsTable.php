<?php
namespace AdminPanel\Model\Table;

use Cake\Core\Configure;
use Cake\ORM\Locator\TableLocator;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Generations Model
 *
 * @property \AdminPanel\Model\Table\GenerationsTable|\Cake\ORM\Association\BelongsTo $ParentGenerations
 * @property \AdminPanel\Model\Table\CustomersTable|\Cake\ORM\Association\BelongsTo $Customers
 * @property \AdminPanel\Model\Table\RefferalsTable|\Cake\ORM\Association\BelongsTo $Refferals
 * @property \AdminPanel\Model\Table\GenerationsTable|\Cake\ORM\Association\HasMany $ChildGenerations
 *
 * @method \AdminPanel\Model\Entity\Generation get($primaryKey, $options = [])
 * @method \AdminPanel\Model\Entity\Generation newEntity($data = null, array $options = [])
 * @method \AdminPanel\Model\Entity\Generation[] newEntities(array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Generation|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\Generation saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\Generation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Generation[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Generation findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 * @mixin \Cake\ORM\Behavior\TreeBehavior
 */
class GenerationsTable extends Table
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

        $this->setTable('generations');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        //$this->addBehavior('Tree');

        $this->belongsTo('ParentGenerations', [
            'className' => 'AdminPanel.Generations',
            'foreignKey' => 'parent_id'
        ]);
        $this->belongsTo('Customers', [
            'foreignKey' => 'customer_id',
            'className' => 'AdminPanel.Customers'
        ]);
        $this->belongsTo('Refferals', [
            'foreignKey' => 'refferal_id',
            'className' => 'AdminPanel.Customers'
        ]);
        $this->hasMany('ChildGenerations', [
            'className' => 'AdminPanel.Generations',
            'foreignKey' => 'parent_id'
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

        $validator
            ->integer('level')
            ->allowEmptyString('level', false);

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
        $rules->add($rules->existsIn(['parent_id'], 'ParentGenerations'));
        $rules->add($rules->existsIn(['customer_id'], 'Customers'));
        $rules->add($rules->existsIn(['refferal_id'], 'Refferals'));

        return $rules;
    }

    public function saving($refferal_id, $customer_id, \Closure $callback = null)
    {
        $count = $this->Customers->find()
            ->count();

        if ($count > 0) {
            $entity = $this->newEntity([
               'customer_id' => $customer_id,
               'refferal_id' => $refferal_id,
               'level' => 1
            ]);
            if ($this->save($entity)) {
                if ($callback) {
                    call_user_func($callback, $entity);
                }
                $find = $this->find()
                    ->where([
                        'customer_id' => $refferal_id
                    ]);
                if (!$find->isEmpty()) {
                    /**
                     * @var \AdminPanel\Model\Entity\Generation[] $find
                     */
                    $this->getConnection()->begin();
                    foreach($find as $generation) {
                        $entity = $this->newEntity([
                            'customer_id' => $customer_id,
                            'refferal_id' => $generation->get('refferal_id'),
                            'level' => intval($generation->get('level')) + 1
                        ]);
                        if ($this->save($entity) && $callback) {
                            call_user_func($callback, $entity);
                        }
                    }
                    $this->getConnection()->commit();
                }
            }
        }
    }


    public function calcRankTreeVip($customer_id, \Closure $callback = null)
    {
        $networkTable = (new TableLocator())->get('AdminPanel.Networks');
        $customerVipRankTable = (new TableLocator())->get('AdminPanel.CustomerVipRanks');
        $customerRewardTable = (new TableLocator())->get('AdminPanel.CustomerRewards');
        $rewardTable = (new TableLocator())->get('AdminPanel.Rewards');

        $current = $networkTable->find()
            ->select('Networks.id')
            ->where([
                'Networks.customer_id' => $customer_id
            ])
            ->first();


        $rankConfig = Configure::read('Rank');


        if ($current) {
            /**
             * @var \AdminPanel\Model\Entity\Network[] $paths
             */
            $paths = $networkTable->find('path', ['for' => $current->id])
                ->contain('Customers');
            foreach($paths as $path) {
                if ($path->customer_id == $customer_id) continue;

                //calc here
                $ranks = $this->levelCountVip($path->customer_id);
//                if($ranks['rank_id'] != 2){
//                    continue;
//                }
                //debug($ranks);
                if ($ranks && $path->customer && $path->customer instanceof \AdminPanel\Model\Entity\Customer) {
                    if ($path->customer->vip_rank_id != $ranks['rank_id']) {
                        $path->customer->vip_rank_id = $ranks['rank_id'];
                        if ($this->Customers->save($path->customer)) {
                            $customerVipRankEntity = $customerVipRankTable->newEntity([
                                'customer_id' => $path->customer->id,
                                'rank_id' => $path->customer->rank_id
                            ]);
                            $customerVipRankTable->save($customerVipRankEntity);

                            //process rewards
                            $reward = $rewardTable->find()
                                ->where([
                                    'rank_id' => $path->customer->rank_id
                                ])
                                ->first();

                            if ($reward) {
                                $exists = $customerRewardTable->find()
                                    ->where([
                                        'customer_id' => $path->customer->id,
                                        'reward_id' => $reward->id
                                    ])
                                    ->first();

                                if (!$exists) {
                                    $customerReward = $customerRewardTable->newEntity([
                                        'customer_id' => $path->customer->id,
                                        'reward_id' => $reward->id
                                    ]);

                                    $customerRewardTable->save($customerReward);

                                }

                            }
                            //process rewards
                        }
                    }
                }

                if ($callback && $ranks) {
                    call_user_func($callback, $ranks);
                }
            }
        }

        //$crumbs = $categories->find('path', ['for' => $nodeId]);

        //debug($networkTable);
    }

    public function levelCountVip($customer_id)
    {

        $rankConfig = Configure::read('Rank', []);

        $data = $this->find();
        $line = $data
            ->contain(['Customers'])
            ->where([
                'Generations.refferal_id' => $customer_id,
                'Generations.level' => 1,
                'Customers.is_vip' => 1,

            ])
            ->count();

        $qualified_line = [];
        foreach($rankConfig as $rank_id => $config) {

            foreach($config['condition'] as $conditionIndex => $condition) {
                $target_line = $condition['line'];
                if($line >= $target_line){
                    $qualified_line[$rank_id]['condition'] = $config['condition'];
                    $qualified_line[$rank_id]['min_line'] = !empty($condition['min_perline']) ? $condition['min_perline'] : floor($condition['total'] / $condition['line']);
//                    $qualified_line[$rank_id]['total_target'] = $condition['total'];
                    $qualified_line[$rank_id]['key_target'] = $condition['target_key'];
                    $qualified_line[$rank_id]['qualified'] = true;
                    $qualified_line[$rank_id]['name'] = $config['name'];
                }
            }

        }


        if($qualified_line){
//            $qualified_line = array_reverse($qualified_line, true);
            $data = $data
                ->select([
                    'level',
                    'total' => $data->func()->count('Generations.level'),
                    'customer_id' => 'Generations.refferal_id',
                    'network_id' => 'Networks.id',
                    'customers' => "(GROUP_CONCAT(Generations.customer_id))"
                ])
                // ->enableAutoFields(true)
                ->leftJoinWith('Customers')
                ->leftJoin(['Networks' => 'networks'], [
                    'Networks.customer_id = Generations.refferal_id'
                ])
                ->where([
                    'Generations.refferal_id' => $customer_id,
                    'Generations.level' => 1,
                    'Customers.is_vip' => 1,
                ])
                ->whereNotNull('Customers.vip_rank_id')
                ->group(['Generations.level'])
                ->map(function(\AdminPanel\Model\Entity\Generation $row) use($customer_id, $rankConfig) {

                    $customer_ids = array_filter(explode(',', $row->customers));

                    $row->data = [];
                    $customerGeneration1 = [];
                    foreach($customer_ids as $k => $cust_id) {
                        $row->data[$k]['cust_id'] = $cust_id;
                        foreach($rankConfig as $key => $ranks){
                            foreach($ranks['condition'] as $conditionIndex => $condition) {
                                $customers = $this->find();
                                $customers = $customers
                                    ->select([
                                        'Customers.vip_rank_id',
                                        'VipRanks.name',
                                        'Generations.refferal_id',
                                        'total' => $customers->func()->count('vip_rank_id'),
                                        //'networks' => "(GROUP_CONCAT(Networks.id ORDER BY Networks.lft))"
                                    ])
                                    ->contain([
                                        'Customers' => [
                                            'VipRanks'
                                        ]
                                    ])
                                    ->where([
                                        'Generations.refferal_id' => $cust_id,
                                    ])
                                    ->whereNotNull('vip_rank_id')
                                    ->group(['Customers.vip_rank_id'])
                                    ->toArray();


                                /**
                                 * @var \AdminPanel\Model\Entity\Customer $gen1
                                 */
                                $gen1 = $this->Customers->find()
                                    ->select(['Customers.id', 'Customers.vip_rank_id', 'VipRanks.name'])
                                    ->contain([
                                        'VipRanks'
                                    ])
                                    ->where([
                                        'Customers.id' => $cust_id
                                    ])->first();



                                if ($gen1) {

                                    $current = [
                                        'id' => $gen1->id,
                                        'rank_id' => $gen1->vip_rank_id,
                                        'ranks' => []
                                    ];

                                    /**
                                     * @var \AdminPanel\Model\Entity\Generation[] $customers
                                     */
                                    foreach($customers as $customer) {
                                        if ($customer->refferal_id == $gen1->id) {
                                            $current['ranks'][]  = [
                                                'rank_id' => $customer->customer->vip_rank_id,
                                                'rank_name' => $customer->customer->vip_rank->name,
                                                'total' => $customer->total + ($customer->customer->vip_rank_id == $gen1->vip_rank_id ? 1 : 0)
                                            ];
                                        }
                                    }

                                    $nowRank = [
                                        'rank_id' => $gen1->rank_id,
                                        'rank_name' => $gen1->vip_rank->name,
                                        'total' => 1
                                    ];

                                    if (count($current['ranks']) == 0) {
                                        $current['ranks'][] = $nowRank;
                                    } else {
                                        $search = array_search($gen1->vip_rank_id, array_column($current['ranks'], 'rank_id'));
                                        if ($search === false) {
                                            $current['ranks'][] = $nowRank;
                                        }
                                    }

                                }
                            }

                        }
                        $customerGeneration1[] = $current;

                    }

                    foreach($row->data as $key => $vals){
                        $row->data[$key]['total'] = [];
                        for($i=1;$i<=4;$i++){
                            $row->data[$key]['total'][$i]['total'] = @$customerGeneration1[$key]['ranks'][$i-1]['total'] ? @$customerGeneration1[$key]['ranks'][$i-1]['total'] : 0;
                        }
                    }


                    return $row->data;
                })->first();




            $qualified = [];
            foreach($qualified_line as $key => $vals){
                foreach($vals['condition'] as $keys => $config){
                    $average = !empty($config['min_line']) ? $config['min_line'] : floor($config['total'] / $config['line']);
                    $key_target = $config['target_key'];
                    $acumulation = [];
                    foreach($data as $value){
                        $acumulation[] = $value['total'][$key_target]['total'];
                    }

                    rsort($acumulation);
                    $lastKey = 0;
                    foreach($acumulation as $k => $value){
                        if($k > ($config['line']-2)){
                            $lastKey += $value;
                            unset($acumulation[$k]);
                        }
                    }
                    $acumulation[$config['line']-1] = $lastKey;
                    $ok_qualified = [];
                    $status = true;

                    $total_total = 0;
                    foreach($acumulation as $value){
                        $total_total += $value;
                    }
                    foreach($acumulation as $value){
                        if((count($acumulation) >= $config['line']) && ($value >= $average) && ($total_total >= $config['total'])){
                            $ok_qualified['rank_id'] = $key;
                            $ok_qualified['customer_id'] = $customer_id;
                        }else{
                            $status = false;
                        }

                    }

                    if($status){
                        $qualified = $ok_qualified;
                    }
                }
            }


            return $qualified;
        }
    }

    public function calcRankTree($customer_id, \Closure $callback = null)
    {
        $networkTable = (new TableLocator())->get('AdminPanel.Networks');
        $customerRankTable = (new TableLocator())->get('AdminPanel.CustomerRanks');

        $current = $networkTable->find()
            ->select('Networks.id')
            ->where([
                'Networks.customer_id' => $customer_id
            ])
            ->first();


        $rankConfig = Configure::read('Rank');


        if ($current) {
            /**
             * @var \AdminPanel\Model\Entity\Network[] $paths
             */
            $paths = $networkTable->find('path', ['for' => $current->id])
                ->contain('Customers');
            foreach($paths as $path) {
                if ($path->customer_id == $customer_id) continue;

                //calc here
                $ranks = $this->levelCount($path->customer_id);
//                if($ranks['rank_id'] != 2){
//                    continue;
//                }
                //debug($ranks);
                if ($ranks && $path->customer && $path->customer instanceof \AdminPanel\Model\Entity\Customer) {
                    if ($path->customer->rank_id != $ranks['rank_id']) {
                        $path->customer->rank_id = $ranks['rank_id'];
                        if ($this->Customers->save($path->customer)) {
                            $customerRankEntity = $customerRankTable->newEntity([
                                'customer_id' => $path->customer->id,
                                'rank_id' => $path->customer->rank_id
                            ]);
                            $customerRankTable->save($customerRankEntity);
                        }
                    }
                }

                if ($callback && $ranks) {
                    call_user_func($callback, $ranks);
                }
            }
        }

        //$crumbs = $categories->find('path', ['for' => $nodeId]);

        //debug($networkTable);
    }

    public function levelCount($customer_id)
    {

        $rankConfig = Configure::read('Rank', []);

        $data = $this->find();
        $line = $data
            ->where([
                'Generations.refferal_id' => $customer_id,
                'Generations.level' => 1
            ])
            ->count();

        $qualified_line = [];
        foreach($rankConfig as $rank_id => $config) {

            foreach($config['condition'] as $conditionIndex => $condition) {
                $target_line = $condition['line'];
                if($line >= $target_line){
                    $qualified_line[$rank_id]['condition'] = $config['condition'];
                    $qualified_line[$rank_id]['min_line'] = !empty($condition['min_perline']) ? $condition['min_perline'] : floor($condition['total'] / $condition['line']);
//                    $qualified_line[$rank_id]['total_target'] = $condition['total'];
                    $qualified_line[$rank_id]['key_target'] = $condition['target_key'];
                    $qualified_line[$rank_id]['qualified'] = true;
                    $qualified_line[$rank_id]['name'] = $config['name'];
                }
            }

        }

        if($qualified_line){
//            $qualified_line = array_reverse($qualified_line, true);
            $data = $data
                ->select([
                    'level',
                    'total' => $data->func()->count('Generations.level'),
                    'customer_id' => 'Generations.refferal_id',
                    'network_id' => 'Networks.id',
                    'customers' => "(GROUP_CONCAT(Generations.customer_id))"
                ])
                // ->enableAutoFields(true)
                ->leftJoinWith('Customers')
                ->leftJoin(['Networks' => 'networks'], [
                    'Networks.customer_id = Generations.refferal_id'
                ])
                ->where([
                    'Generations.refferal_id' => $customer_id,
                    'Generations.level' => 1
                ])
                ->whereNotNull('Customers.rank_id')
                ->group(['Generations.level'])
                ->map(function(\AdminPanel\Model\Entity\Generation $row) use($customer_id, $rankConfig) {

                    $customer_ids = array_filter(explode(',', $row->customers));

                    $row->data = [];
                    $customerGeneration1 = [];
                    foreach($customer_ids as $k => $cust_id) {
                        $row->data[$k]['cust_id'] = $cust_id;
                        foreach($rankConfig as $key => $ranks){
                            foreach($ranks['condition'] as $conditionIndex => $condition) {
                                    $customers = $this->find();
                                    $customers = $customers
                                        ->select([
                                            'Customers.rank_id',
                                            'Ranks.name',
                                            'Generations.refferal_id',
                                            'total' => $customers->func()->count('rank_id'),
                                            //'networks' => "(GROUP_CONCAT(Networks.id ORDER BY Networks.lft))"
                                        ])
                                        ->contain([
                                            'Customers' => [
                                                'Ranks'
                                            ]
                                        ])
                                        ->where([
                                            'Generations.refferal_id' => $cust_id,
                                        ])
                                        ->whereNotNull('rank_id')
                                        ->group(['Customers.rank_id'])
                                        ->toArray();


                                    /**
                                     * @var \AdminPanel\Model\Entity\Customer $gen1
                                     */
                                    $gen1 = $this->Customers->find()
                                        ->select(['Customers.id', 'Customers.rank_id', 'Ranks.name'])
                                        ->contain([
                                            'Ranks'
                                        ])
                                        ->where([
                                            'Customers.id' => $cust_id
                                        ])->first();



                                if ($gen1) {

                                    $current = [
                                        'id' => $gen1->id,
                                        'rank_id' => $gen1->rank_id,
                                        'ranks' => []
                                    ];

                                    /**
                                     * @var \AdminPanel\Model\Entity\Generation[] $customers
                                     */
                                    foreach($customers as $customer) {
                                        if ($customer->refferal_id == $gen1->id) {
                                            $current['ranks'][]  = [
                                                'rank_id' => $customer->customer->rank_id,
                                                'rank_name' => $customer->customer->rank->name,
                                                'total' => $customer->total + ($customer->customer->rank_id == $gen1->rank_id ? 1 : 0)
                                            ];
                                        }
                                    }

                                    $nowRank = [
                                        'rank_id' => $gen1->rank_id,
                                        'rank_name' => $gen1->rank->name,
                                        'total' => 1
                                    ];

                                    if (count($current['ranks']) == 0) {
                                        $current['ranks'][] = $nowRank;
                                    } else {
                                        $search = array_search($gen1->rank_id, array_column($current['ranks'], 'rank_id'));
                                        if ($search === false) {
                                            $current['ranks'][] = $nowRank;
                                        }
                                    }

                                }
                            }

                        }
                        $customerGeneration1[] = $current;

                    }

                    foreach($row->data as $key => $vals){
                        $row->data[$key]['total'] = [];
                        for($i=1;$i<=4;$i++){
                            $row->data[$key]['total'][$i]['total'] = @$customerGeneration1[$key]['ranks'][$i-1]['total'] ? @$customerGeneration1[$key]['ranks'][$i-1]['total'] : 0;
                        }
                    }


                    return $row->data;
                })->first();

            $qualified = [];
            foreach($qualified_line as $key => $vals){
                foreach($vals['condition'] as $keys => $config){
                    $average = !empty($config['min_line']) ? $config['min_line'] : floor($config['total'] / $config['line']);
                    $key_target = $config['target_key'];
                    $acumulation = [];
                    foreach($data as $value){
                        $acumulation[] = $value['total'][$key_target]['total'];
                    }

                    rsort($acumulation);
                    $lastKey = 0;
                    foreach($acumulation as $k => $value){
                        if($k > ($config['line']-2)){
                            $lastKey += $value;
                            unset($acumulation[$k]);
                        }
                    }
                    $acumulation[$config['line']-1] = $lastKey;
                    $ok_qualified = [];
                    $status = true;

                    $total_total = 0;
                    foreach($acumulation as $value){
                        $total_total += $value;
                    }
                    foreach($acumulation as $value){
                        if((count($acumulation) >= $config['line']) && ($value >= $average) && ($total_total >= $config['total'])){
                            $ok_qualified['rank_id'] = $key;
                            $ok_qualified['customer_id'] = $customer_id;
                        }else{
                            $status = false;
                        }

                    }

                    if($status){
                        $qualified = $ok_qualified;
                    }
                }
            }


            return $qualified;
        }
    }
}
