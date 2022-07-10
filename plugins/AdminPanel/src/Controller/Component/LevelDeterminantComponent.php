<?php
namespace AdminPanel\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Core\Configure;
use Cake\Database\Expression\QueryExpression;
use Cake\I18n\Date;
use Cake\I18n\Time;
use Cake\ORM\Query;
use Cake\ORM\TableRegistry;

/**
 * LevelDeterminant component
 * @property \AdminPanel\Model\Table\CustomersTable $Customers
 * @property \AdminPanel\Model\Table\CustomerPeriodsTable $CustomerPeriods
 * @property \AdminPanel\Model\Table\CustomerPeriodDetailsTable $CustomerPeriodDetails
 * @property \AdminPanel\Model\Table\NetworksTable $Networks
 * @property \AdminPanel\Model\Table\OrdersTable $Orders
 * @property \AdminPanel\Model\Table\RanksTable $Ranks
 * @property \AdminPanel\Model\Table\CustomerRanksTable $CustomerRanks
 * @property \AdminPanel\Model\Table\EventsTable $Events
 */
class LevelDeterminantComponent extends Component
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];


    public function initialize(array $config)
    {
        $this->_defaultConfig = array_replace($this->_defaultConfig, $config);
        parent::initialize($config);

        $this->Customers = TableRegistry::get('AdminPanel.Customers');
        $this->CustomerPeriods = TableRegistry::get('AdminPanel.CustomerPeriods');
        $this->CustomerPeriodDetails = TableRegistry::get('AdminPanel.CustomerPeriodDetails');
        $this->Networks = TableRegistry::get('AdminPanel.Networks');
        $this->Orders = TableRegistry::get('AdminPanel.Orders');
        $this->Ranks = TableRegistry::get('AdminPanel.Ranks');
        $this->Events = TableRegistry::get('AdminPanel.Events');
        $this->CustomerRanks = TableRegistry::get('AdminPanel.CustomerRanks');


    }

    /**
     * @param $customer_id
     * @param $start
     * @param $end
     * @param int $stokType
     * @param boolean $exclude_independent_star
     * @return int
     */
    public function sumOrder($customer_id,  $start, $end, $stokType = 2, $exclude_independent_star = true)
    {
        $sum = 0;
        $order = $this->Orders->find();
        $order = $order->select([
            'total_summary' => $order->func()->sum('base_price')
        ])
        ->where([
            'customer_id' => $customer_id,
            'order_status_id' => 3,
            'stock_type' => $stokType,
        ])
        ->where(function(QueryExpression $exp) use ($start, $end) {
            return $exp->between(
                'confirm_date',
                $start,
                $end
            );
        })
        ->first();

        if ($order) {
            $independent_star_omset = Configure::read('independent_start.min_omset', 750000000);
            if ($exclude_independent_star && $stokType == 2 && $order->total_summary > $independent_star_omset) {
                $sum += 0;
            } else {
                $sum += $order->total_summary;
            }

        }

        return $sum;
    }

    public function omsetByRange(\AdminPanel\Model\Entity\Network $network,  $start,  $end, $stokType = 2, $exclude_independent_star = true)
    {

        $omset = $this->sumOrder($network->customer_id, $start, $end, $stokType, $exclude_independent_star);

        $networks = $this->Networks->find('children', ['for' => $network->id]);
        if (!$networks->isEmpty()) {
            /**
             * @var \AdminPanel\Model\Entity\Network[] $networks
             */
            foreach($networks as $child) {
                /*
                debug([
                    'id' => $child->customer_id,
                    'total' => $this->Networks->childCount($child)
                ]);
                */
                /*
                $totalChild = $this->Networks->childCount($child);
                if ($totalChild > 0) {
                    $omset += $this->omsetByRange($child, $start, $end, $stokType);
                } else {
                    $omset += $this->sumOrder($child->customer_id, $start, $end, $stokType);
                }
                */
                $omset += $this->sumOrder($child->customer_id, $start, $end, $stokType, $exclude_independent_star);
            }
        }

        return $omset;
    }

    /**
     * @param $total_omset
     * @param \AdminPanel\Model\Entity\Customer $customer
     * @return array|int[]
     */
    public function omsetRule($total_omset, \AdminPanel\Model\Entity\Customer $customer)
    {
        //check omset rule
        $current = [
            'rank_id' => 1,
            'amount' => 36000000,
        ];
        $omsetRule = Configure::read('sales_min');
        if ($omsetRule && is_array($omsetRule) && count($omsetRule) > 0) {
            krsort($omsetRule);
            foreach($omsetRule as $rank_id => $omset) {
                if ($total_omset >= $omset) {
                    $current = [
                        'rank_id' => $rank_id,
                        'amount' => $omset,
                    ];
                    break;
                }
            }
        }

        return $current;
    }

    public function targetTotal($order_id)
    {
        $order = $this->Orders->get($order_id, [
            'contain' => [
                'Customers' => [
                    'Networks'
                ]
            ]
        ]);

        $eventPresent = Configure::read('event_present');
        if ($order) {
            $path = $this->Customers->Networks->find('path', ['for' => $order->customer->network->id])
                ->contain([
                    'Customers'
                ]);

            if (!$path->isEmpty()) {
                $path = array_reverse($path->toArray());
                $blocking_ranks = [];
                /**
                 * @var \AdminPanel\Model\Entity\Network[] $path
                 */
                foreach($path as $child) {

//                    if (in_array($child->customer->rank_id, $blocking_ranks)) {
//                        continue;
//                    }

                    //break away TODO perlu di cek current dan customer yg di trigger
//                    if ($child->customer->rank_id < $order->customer->rank_id) {
//                        continue;
//                    }

//                    array_push($blocking_ranks, $child->customer->rank_id);


                    /**
                     * @var \AdminPanel\Model\Entity\CustomerPeriod $findPeriod
                     */
                    $findPeriod = $this->CustomerPeriods->find()
                        ->where(function($query){
                            return $query->lte('start',Date::now()->format('Y-m-d'))
                                ->gte('end',Date::now()->format('Y-m-d'));
                        })->where([
                            'customer_id' => $child->customer_id,
                        ])
                        ->first();

                    if ($findPeriod) {
                        //hitung omset
                        /* hitung omset sendiri */
                        $total_omset = $findPeriod->total_omset + $order->base_price; //TODO base_price
//                        $rules = $this->omsetRule($total_omset, $child->customer);

                        //target omset terpenuhi
                        $findPeriod->total_omset = $total_omset;
                        if ($order->total >= 36000000 && $child->customer->rank_id > 1) {

                            /*
                                proses pengecekkan absensi,
                                cek jumlah downline jika OK maka update ke stockist member tsb, dan ganti peringkatnya
                            */

//                            $eventPresents = false;
//                            $eventCategories = $eventPresent[$child->customer->rank_id];
//                            foreach($eventCategories as $eventCategory){
//                                $eventPresents = $this->presentOfEvent($child->customer->id, $eventCategory);
//                                if($eventPresents == false){
//                                    break;
//                                }
//                            }
//
//                            $directActive = $this->directActive($child->customer->id, $child->customer->rank_id);
//                            if($eventPresents && $directActive){
//                                /* set ke stockist dan update peringkat */
                                $this->Customers->query()
                                    ->update()
                                    ->set([
                                        'customer_type_id' => 2,
                                    ])->where([
                                        'id' => $child->customer->id
                                    ])
                                    ->execute();
//
//                                $customerRankEntity = $this->CustomerRanks->newEntity([
//                                    'customer_id' => $child->customer->id,
//                                    'rank_id' => ($child->customer->rank_id + 1),
//                                ]);
//                                $this->CustomerRanks->save($customerRankEntity);
//
//                                $findPeriod->flag = 1;
//                            }

                        }


                        if ($this->CustomerPeriods->save($findPeriod)) {
                            $PeriodDetailEntity = $this->CustomerPeriodDetails->newEntity([
                                'customer_period_id' => $findPeriod->id,
                                'order_id' => $order->id,
                                'amount' => $order->base_price,
                                'created' => $order->confirm_date,
                            ]);
                            $this->CustomerPeriodDetails->save($PeriodDetailEntity);
                        }

                    }

                }
            }

        }
    }


    /**
     * @param $customer_id
     * @param null $order_id
     * @param bool $recursive
     * @param array $block_ranks
     */
    public function omset($customer_id, $order_id  = null, $recursive = false, $block_ranks = [])
    {
        /**
         * @var \AdminPanel\Model\Entity\Customer $customer
         * @var \AdminPanel\Model\Entity\Order $order
         * @var \AdminPanel\Model\Entity\CustomerPeriod $findPeriod
         */

        $eventPresent = Configure::read('event_present');
        $customer = $this->Customers->find()
            ->contain([
                'Networks'
            ])
            ->where(['Customers.id' => $customer_id])
            ->first();

        $order = $this->Orders->get($order_id, [
            'contain' => ['Customers']
        ]);



        //check Network has parent_id
        $customerParent = null;
        if ($parent_id = $customer->network->parent_id) {

            //get customer_id from parent_id
            /**
             * @var \AdminPanel\Model\Entity\Network $customerParent
             */
            $customerParent = $this->Networks->find()
                ->contain([
                    'Customers'
                ])
                ->where([
                    'Networks.id' => $parent_id
                ])
                ->first();
        }
        //end check Network has parent_id
        //debug($block_ranks);


        //check jika sudah ada daftar dalam block_ranks
        if ($recursive && in_array($customer->rank_id, $block_ranks) && $customerParent) {
            $this->omset($customerParent->customer->id, $order_id, true, $block_ranks);
            return;
        }

        //break away check peringkat ref dengan order id
        if ($recursive && $customer->rank_id > $order->customer->rank_id && $customerParent) {
            $this->omset($customerParent->customer->id, $order_id, true, $block_ranks);
            return;
        }

        if ($customer && $customer->rank_id <= 5 ) {

            $findPeriod = $this->CustomerPeriods->find()
                ->where(function($query){
                    return $query->lte('start',Date::now()->format('Y-m-d'))
                        ->gte('end',Date::now()->format('Y-m-d'));
            })->where([
                'customer_id' => $customer_id,
//                'rank_id' => $customer->rank_id,
            ])
            ->whereInList('flag',[0,1])
            ->first();

            if(!empty($findPeriod)) {


                /* hitung omset sendiri */
                $total_omset = $findPeriod->total_omset + $order->total;


                //check omset rule
                $current = [
                    'rank_id' => 1,
                    'flag' => 0
                ];
                $omsetRule = Configure::read('sales_min');
                if ($omsetRule && is_array($omsetRule) && count($omsetRule) > 0) {
                    krsort($omsetRule);
                    foreach($omsetRule as $rank_id => $omset) {
                        if ($total_omset >= $omset && $rank_id > $customer->rank_id) {
                            $current = [
                                'rank_id' => $rank_id,
                                'flag' => 1
                            ];
                            break;
                        }
                    }
                }



                $updatePeriode = $this->CustomerPeriods->query()
                    ->update()
                    ->set([
                        'total_omset' => $total_omset,
                    ])->where([
                        'id' => $findPeriod->id
                    ]);

                if ($current['flag'] == 1) {
                    $updatePeriode->set([
                        'flag' => $current['flag']
                    ]);

                    /*
                    //block process rank here and set block rank
                    if (!in_array($customer->rank_id, $block_ranks)) {
                        array_push($block_ranks, $customer->rank_id);
                        debug('insert rank ' . $customer->rank_id);
                    }
                    */

                    $eventPresents = false;
                    $eventCategories = $eventPresent[$customer->rank_id + 1];
                    foreach($eventCategories as $eventCategory){
                        $eventPresents = $this->presentOfEvent($customer->id, $eventCategory);
                        if($eventPresents == false){
                            break;
                        }
                    }

                    $directActive = $this->directActive($customer->id, ($customer->rank_id + 1));
//                    debug([
//                        $customer->id,
//                        $eventCategories,
//                        $current['rank_id'],
//                        $customer->rank_id,
//                        $eventPresents,
//                        $directActive,
//                    ]);
                    if($eventPresents && $directActive){
                        /* set ke stockist dan update peringkat */
                        $this->Customers->query()
                            ->update()
                            ->set([
                                'customer_type_id' => 2,
                                'rank_id' => $customer->rank_id + 1,
                            ])->where([
                                'id' => $customer->id
                            ])
                            ->execute();

                        $customerRankEntity = $this->CustomerRanks->newEntity([
                            'customer_id' => $customer->id,
                            'rank_id' => $customer->rank_id + 1,
                        ]);
                        $this->CustomerRanks->save($customerRankEntity);
                    }

                }


                $updatePeriode->execute();


                //block process rank here and set block rank
                if (!in_array($customer->rank_id, $block_ranks) && $total_omset > 0) {
                    array_push($block_ranks, $customer->rank_id);
                }

                $PeriodDetailEntity = $this->CustomerPeriodDetails->newEntity([
                    'customer_period_id' => $findPeriod->id,
                    'order_id' => $order->id,
                    'amount' => $order->total,
                    'created' => $order->confirm_date,
                ]);

                if($this->CustomerPeriodDetails->save($PeriodDetailEntity)){
                    if ($customerParent) {
                        $this->omset($customerParent->customer->id, $order_id, true, $block_ranks);
                    }

                }

            }else{

                /*
                 * create baru
                 * ketika create berarti kudu di update periode sebelumnya menjadi 2 artinya
                 * periode perhitungan sebelumnya kadaluarsa dari tanggal periode
                */

                $this->CustomerPeriods->query()
                    ->update()
                    ->set([
                        'flag' => 2,
                    ])->where([
                        'customer_id' => $customer_id,
                        'flag' => 0,
                    ])
                    ->execute();

                //default flag
                $flag = 0;

                //check omset rule
                $omsetRule = Configure::read('sales_min');
                if ($omsetRule && is_array($omsetRule) && count($omsetRule) > 0) {
                    krsort($omsetRule);
                    $current = [
                        'rank_id' => 1,
                        'flag' => $flag
                    ];
                    foreach($omsetRule as $rank_id => $omset) {
                        if ($order->total >= $omset && $rank_id > $customer->rank_id) {
                            $current = [
                                'rank_id' => $rank_id,
                                'flag' => 1
                            ];
                            break;
                        }
                    }

                    if ($current['flag'] == 1) {
                        $flag = 1;

                        /*
                        //block process rank
                        if (!in_array($customer->rank_id, $block_ranks)) {
                            array_push($block_ranks, $customer->rank_id);
                        }*/

                        $eventPresents = false;
                        $eventCategories = $eventPresent[$customer->rank_id + 1];
                        foreach($eventCategories as $eventCategory){
                            $eventPresents = $this->presentOfEvent($customer->id, $eventCategory);
                            if($eventPresents == false){
                                break;
                            }
                        }

                        $directActive = $this->directActive($customer->id, ($customer->rank_id + 1));
//                    debug([
//                        $customer->id,
//                        $eventCategories,
//                        $current['rank_id'],
//                        $customer->rank_id,
//                        $eventPresents,
//                        $directActive,
//                    ]);
                        if($eventPresents && $directActive){
                            /* set ke stockist dan update peringkat */
                            $this->Customers->query()
                                ->update()
                                ->set([
                                    'customer_type_id' => 2,
                                    'rank_id' => $customer->rank_id + 1,
                                ])->where([
                                    'id' => $customer->id
                                ])
                                ->execute();

                            $customerRankEntity = $this->CustomerRanks->newEntity([
                                'customer_id' => $customer->id,
                                'rank_id' => $customer->rank_id + 1,
                            ]);
                            $this->CustomerRanks->save($customerRankEntity);
                        }

                    }


                }

                /* save new periods */
                $start = $customer->active_date;
                $end = Date::now($start)->modify('+90 days')->format('Y-m-d');
                $PeriodEntity = $this->CustomerPeriods->newEntity([
                    'customer_id' => $customer_id,
                    'start' => $start,
                    'end' => $end,
                    'total_omset' => $order->total,
                    'rank_id' => $customer->rank_id,
                    'flag' => $flag
                ]);

                if($this->CustomerPeriods->save($PeriodEntity)){
                    $PeriodDetailEntity = $this->CustomerPeriodDetails->newEntity([
                        'customer_period_id' => $PeriodEntity->id,
                        'order_id' => $order_id,
                        'amount' => $order->total,
                        'created' => $order->confirm_date,
                    ]);

                    if($this->CustomerPeriodDetails->save($PeriodDetailEntity)){
                        if ($customerParent) {
                            $this->omset($customerParent->customer->id, $order_id, true, $block_ranks);
                        }

                    }

                }
            }
        }

    }



    public function presentOfEvent($customer_id, $category_id = null){

        /**
         * @var \AdminPanel\Model\Entity\Event $events
         */
        $events = $this->Events->find()
            ->contain([
                'EventAttendances' => function (Query $q) use ($customer_id) {
                    return $q->where([
                        'EventAttendances.customer_id' => $customer_id,
                        'EventAttendances.present' => 1,
                    ]);
                }
            ])
            ->where([
                'Events.event_category_id' => $category_id
            ])->first();
        if(!empty($events->event_attendances)){
            return true;
        }else{
            return false;
        }
    }

    public function directActive($customer_id, $rank_id){

        $direct = Configure::read('direct_active');
        $direct = $direct[$rank_id];
        /**
         * @var \AdminPanel\Model\Entity\Customer $count
         */
        $count = $this->Customers->find()
            ->where([
                'Customers.refferal_id' => $customer_id,
                'Customers.is_active' => 1,
                'Customers.rank_id' => $direct['rank_key'],
            ])->count();
        if($count >= $direct['total']){
            return true;
        }else{
            return false;
        }
    }

}
