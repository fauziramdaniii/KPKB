<?php
namespace AdminPanel\Controller;

use AdminPanel\Controller\AppController;
use Cake\Database\Expression\QueryExpression;
use Cake\Core\Configure;
use Cake\I18n\Time;

/**
 * Suppliers Controller
 * @property \AdminPanel\Model\Table\OrderDetailsTable $OrderDetails
 * @property \AdminPanel\Model\Table\CustomersTable $Customers
 * @property \AdminPanel\Model\Table\ProductsTable $Products
 * @property \AdminPanel\Model\Table\ProductCategoriesTable $ProductCategories
 * @property \AdminPanel\Model\Table\TransactionMutationsTable $TransactionMutations
 * @property \AdminPanel\Model\Table\OrdersTable $Orders
 * @property \AdminPanel\Model\Table\TransactionTypesTable $TransactionTypes
 * @property \AdminPanel\Model\Table\NetworksTable $Networks
 * @property \AdminPanel\Model\Table\CashPointsTable $CashPoints
 * @property \AdminPanel\Model\Table\CashPointClaimsTable $CashPointClaims
 * @property \AdminPanel\Model\Table\KtpSubmissionsTable $KtpSubmissions
 * @property \AdminPanel\Model\Table\KkSubmissionsTable $KkSubmissions
 * @property \AdminPanel\Model\Table\KiaSubmissionsTable $KiaSubmissions
 * @property \AdminPanel\Model\Table\AddressSubmissionsTable $AddressSubmissions
 * @property \AdminPanel\Model\Table\ClassificationsTable $Classifications
 *
 * @method \AdminPanel\Model\Entity\Supplier[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ReportsController extends AppController
{

    public function initialize()
    {
        parent::initialize();

        $this->loadModel('AdminPanel.OrderDetails');
        $this->loadModel('AdminPanel.Customers');
        $this->loadModel('AdminPanel.Products');
        $this->loadModel('AdminPanel.ProductCategories');
        $this->loadModel('AdminPanel.TransactionMutations');
        $this->loadModel('AdminPanel.TransactionTypes');
        $this->loadModel('AdminPanel.Orders');
        $this->loadModel('AdminPanel.Networks');
        $this->loadModel('AdminPanel.CashPoints');
        $this->loadModel('AdminPanel.CashPointClaims');
        $this->loadModel('AdminPanel.KtpSubmissions');
        $this->loadModel('AdminPanel.KiaSubmissions');
        $this->loadModel('AdminPanel.KkSubmissions');
        $this->loadModel('AdminPanel.AddressSubmissions');
        $this->loadModel('AdminPanel.Classifications');
    }


    public function ktp(){

        $date = date('Y-m-d'). ' - '.date('Y-m-d');

        if($this->request->getData('daterange')){
            $date = $this->request->getData('daterange');
        }

        $date = explode(' - ', $date);

        $ktps = $this->Classifications->find('all')
            ->where(['Classifications.type' => 'ktp'])
            ->map(function(\AdminPanel\Model\Entity\Classification $row) use($date){
                $row->total = $this->KtpSubmissions->find()
                    ->where(['KtpSubmissions.classification_id' => $row->id])
                    ->where(function($exp) use($date){
                        return $exp->between('KtpSubmissions.created', $date[0].' 00:00:00', $date[1].' 23:59:59');
                    })
                    ->count();
                return $row;
            })
            ->toArray();

//        $ktps = $this->KtpSubmissions->find()
//            ->select([
//                'pemula' => $this->KtpSubmissions->find()
//                    ->where(['KtpSubmissions.status_pembuatan' => 'Pemula'])
//                    ->where(function($exp) use($date){
//                        return $exp->between('KtpSubmissions.created', $date[0].' 00:00:00', $date[1].' 23:59:59');
//                    })
//                    ->count(),
//                'cetak' => $this->KtpSubmissions->find()
//                    ->where(['KtpSubmissions.status_pembuatan' => 'Cetak'])
//                    ->where(function($exp) use($date){
//                        return $exp->between('KtpSubmissions.created', $date[0].' 00:00:00', $date[1].' 23:59:59');
//                    })
//                    ->count(),
//            ])
//
//            ->first();

        $data_ktp = $this->KtpSubmissions->find()
            ->select()
            ->contain(['SubmissionStatuses', 'Classifications']);

        $data_ktp->where(function($exp) use ($date) {
            return $exp->between('KtpSubmissions.created', $date[0].' 00:00:00', $date[1].' 23:59:59');
        });

        $data_ktp = $data_ktp->toArray();
        $this->set(compact('data_ktp', 'ktps'));
    }

    public function kk(){

        $date = date('Y-m-d'). ' - '.date('Y-m-d');

        if($this->request->getData('daterange')){
            $date = $this->request->getData('daterange');
        }

        $date = explode(' - ', $date);

        $kks = $this->Classifications->find('all')
            ->where(['Classifications.type' => 'kk'])
            ->map(function(\AdminPanel\Model\Entity\Classification $row) use($date){
                $row->total = $this->KkSubmissions->find()
                    ->where(['KkSubmissions.classification_id' => $row->id])
                    ->where(function($exp) use($date){
                        return $exp->between('KkSubmissions.created', $date[0].' 00:00:00', $date[1].' 23:59:59');
                    })
                    ->count();
                return $row;
            })
            ->toArray();

//        $kks = $this->KkSubmissions->find()
//            ->select([
//                'pecahkk' => $this->KkSubmissions->find()
//                    ->where(['KkSubmissions.status_pembuatan' => 'PecahKK'])
//                    ->where(function($exp) use($date){
//                        return $exp->between('KkSubmissions.created', $date[0].' 00:00:00', $date[1].' 23:59:59');
//                    })
//                    ->count(),
//                'perubahandata' => $this->KkSubmissions->find()
//                    ->where(['KkSubmissions.status_pembuatan' => 'PerubahanData'])
//                    ->where(function($exp) use($date){
//                        return $exp->between('KkSubmissions.created', $date[0].' 00:00:00', $date[1].' 23:59:59');
//                    })
//                    ->count(),
//                'cetak' => $this->KkSubmissions->find()
//                    ->where(['KkSubmissions.status_pembuatan' => 'Cetak'])
//                    ->where(function($exp) use($date){
//                        return $exp->between('KkSubmissions.created', $date[0].' 00:00:00', $date[1].' 23:59:59');
//                    })
//                    ->count(),
//                'baru' => $this->KkSubmissions->find()
//                    ->where(['KkSubmissions.status_pembuatan' => 'Baru'])
//                    ->where(function($exp) use($date){
//                        return $exp->between('KkSubmissions.created', $date[0].' 00:00:00', $date[1].' 23:59:59');
//                    })
//                    ->count(),
//                'tambahdata' => $this->KkSubmissions->find()
//                    ->where(['KkSubmissions.status_pembuatan' => 'TambahData'])
//                    ->where(function($exp) use($date){
//                        return $exp->between('KkSubmissions.created', $date[0].' 00:00:00', $date[1].' 23:59:59');
//                    })
//                    ->count(),
//            ])
//
//            ->first();

        $data_kk = $this->KkSubmissions->find()
            ->select()
            ->contain(['SubmissionStatuses', 'Classifications']);

        $data_kk->where(function($exp) use ($date) {
            return $exp->between('KkSubmissions.created', $date[0].' 00:00:00', $date[1].' 23:59:59');
        });

        $data_kk = $data_kk->toArray();
        $this->set(compact('data_kk', 'kks'));
    }

    public function kia(){

        $date = date('Y-m-d'). ' - '.date('Y-m-d');

        if($this->request->getData('daterange')){
            $date = $this->request->getData('daterange');
        }

        $date = explode(' - ', $date);

        $kia = $this->Classifications->find('all')
            ->where(['Classifications.type' => 'kia'])
            ->map(function(\AdminPanel\Model\Entity\Classification $row) use($date){
                $row->total = $this->KiaSubmissions->find()
                    ->where(['KiaSubmissions.classification_id' => $row->id])
                    ->where(function($exp) use($date){
                        return $exp->between('KiaSubmissions.created', $date[0].' 00:00:00', $date[1].' 23:59:59');
                    })
                    ->count();
                return $row;
            })
            ->toArray();

//        $kia = $this->KiaSubmissions->find()
//            ->select([
//                'dibawah' => $this->KiaSubmissions->find()
//                    ->where(['KiaSubmissions.status_pembuatan' => '<5 tahun'])
//                    ->where(function($exp) use($date){
//                        return $exp->between('KiaSubmissions.created', $date[0].' 00:00:00', $date[1].' 23:59:59');
//                    })
//                    ->count(),
//                'diatas' => $this->KiaSubmissions->find()
//                    ->where(['KiaSubmissions.status_pembuatan' => '>5 tahun'])
//                    ->where(function($exp) use($date){
//                        return $exp->between('KiaSubmissions.created', $date[0].' 00:00:00', $date[1].' 23:59:59');
//                    })
//                    ->count()
//            ])
//
//            ->first();

        $data_kia = $this->KiaSubmissions->find()
            ->select()
            ->contain(['SubmissionStatuses', 'Classifications']);

        $data_kia->where(function($exp) use ($date) {
            return $exp->between('KiaSubmissions.created', $date[0].' 00:00:00', $date[1].' 23:59:59');
        });

        $data_kia = $data_kia->toArray();
        $this->set(compact('data_kia', 'kia'));
    }

    public function pindahAlamat(){

        $date = date('Y-m-d'). ' - '.date('Y-m-d');

        if($this->request->getData('daterange')){
            $date = $this->request->getData('daterange');
        }

        $date = explode(' - ', $date);

        $alamat = $this->Classifications->find('all')
            ->where(['Classifications.type' => 'address'])
            ->map(function(\AdminPanel\Model\Entity\Classification $row) use($date){
                $row->total = $this->AddressSubmissions->find()
                    ->where(['AddressSubmissions.classification_id' => $row->id])
                    ->where(function($exp) use($date){
                        return $exp->between('AddressSubmissions.created', $date[0].' 00:00:00', $date[1].' 23:59:59');
                    })
                    ->count();
                return $row;
            })
            ->toArray();

//        $alamat = $this->AddressSubmissions->find()
//            ->select([
//                'pindah' => $this->AddressSubmissions->find()
//                    ->where(['AddressSubmissions.status' => 'Pindah'])
//                    ->where(function($exp) use($date){
//                        return $exp->between('AddressSubmissions.created', $date[0].' 00:00:00', $date[1].' 23:59:59');
//                    })
//                    ->count(),
//                'datang' => $this->AddressSubmissions->find()
//                    ->where(['AddressSubmissions.status' => 'Datang'])
//                    ->where(function($exp) use($date){
//                        return $exp->between('AddressSubmissions.created', $date[0].' 00:00:00', $date[1].' 23:59:59');
//                    })
//                    ->count()
//            ])
//
//            ->first();

        $data_alamat = $this->AddressSubmissions->find()
            ->select()
            ->contain(['SubmissionStatuses', 'Classifications']);

        $data_alamat->where(function($exp) use ($date) {
            return $exp->between('AddressSubmissions.created', $date[0].' 00:00:00', $date[1].' 23:59:59');
        });

        $data_alamat = $data_alamat->toArray();
        $this->set(compact('data_alamat', 'alamat'));
    }

    public function sales(){

        $date = $this->request->getData('date', (Time::now())->addWeek(-1)->addDay(1)->format('Y-m-d') . ' - ' . (Time::now())->format('Y-m-d'));
        $dates = explode(' - ',$date);
        $start = date('Y-m-d',strtotime($dates[0]));
        $end = date('Y-m-d',strtotime($dates[1]));


        $period = new \DatePeriod(
            new \DateTime($start),
            new \DateInterval('P1D'),
            new \DateTime($end)
        );

        $listDates = [];
        foreach ($period as $key => $dates) {
            $listDates[$key] = $dates->format("Y-m-d");
        }
        $listDates[] = $end;

        $orders = $this->OrderDetails->find()
            ->select([
                'data' => 'Products.name',
                'total' => $this->OrderDetails->find()->func()->sum('OrderDetails.qty'),
                'date' => $this->OrderDetails->find()->func()->date_format([
                    'OrderDetails.created' => 'identifier',
                    "'%Y-%m-%d'" => 'literal'
                ])
            ])
            ->contain([
                'Orders',
                'Products'
            ])
            ->where(function($exp) use($start,$end ){
                return $exp->between('Orders.confirm_date', $start.' 00:00:00', $end.' 23:59:59');
            })
            ->where([
                'Orders.order_status_id' => 3,
            ])
            ->group(['date', 'OrderDetails.product_id'])
            ->orderAsc('date')
            ->toArray();

        $products = $this->Products->find('list')->orderAsc('id')->toArray();

        $reports = [];
        foreach($listDates as $key => $value){
            $reports[$key]['date'] =  $value;
            foreach($products as $product){
                $reports[$key][str_replace(' ', '_', $product)] =  0;
                foreach($orders as $order){
                    if(($order['data'] == $product) && ($order['date'] == $reports[$key]['date'])){
                        $reports[$key][str_replace(' ', '_', $product)] =  $order['total'];
                    }
                }
            }
        }

        $product_list = [];
        foreach($products as $product){
            $product_list[str_replace(' ', '_', $product)] =  $product;
        }

        $data_order = $this->OrderDetails->find()
            ->select([
                'data' => 'Products.name',
                'price' => 'Products.price',
                'total' => $this->OrderDetails->find()->func()->sum('OrderDetails.qty'),
//                'date' => $this->OrderDetails->find()->func()->date_format([
//                    'OrderDetails.created' => 'identifier',
//                    "'%Y-%m-%d'" => 'literal'
//                ])
            ])
            ->contain([
                'Orders',
                'Products'
            ])
            ->where(function($exp) use($start,$end ){
                return $exp->between('Orders.confirm_date', $start.' 00:00:00', $end.' 23:59:59');
            })
            ->where([
                'Orders.order_status_id' => 3,
            ])
            ->group(['OrderDetails.product_id'])
            ->orderAsc('OrderDetails.product_id')
            ->toArray();

        $total_order = [];
        $total_sales = 0;
        foreach ($data_order as $key => $value){
            $total_order[$key]['product'] = $value->data;
            $total_order[$key]['price'] = $value->price;
            $total_order[$key]['total'] = $value->total;

            $sales = $value->price * $value->total;

            $total_sales += $sales;
        }
//        debug($total_order);

        $this->set(compact('reports','product_list','date','total_order','total_sales'));
    }

    public function salesby(){

        $date = $this->request->getData('date', (Time::now())->addWeek(-1)->addDay(1)->format('Y-m-d') . ' - ' . (Time::now())->format('Y-m-d'));
        $dates = explode(' - ',$date);
        $start = date('Y-m-d',strtotime($dates[0]));
        $end = date('Y-m-d',strtotime($dates[1]));

		$data = $this->Orders->find('all')
			->select();
		$data->contain([
			'OrderStatuses',
			'OrderConfirmations' => [
				'Images',
				'CustomerBanks' => [
					'Banks'
				]
			],
			'Customers',
			'Provinces',
			'Subdistricts',
			'Cities',
			'OrderDetails' => [
				'Products',
				'OrderDetailSerials' => [
					'Cards'
				],
			],
		])
		->where(['OrderStatuses.name' => 'complete'])
		->where(function($exp) use($start,$end ){
			return $exp->between('Orders.confirm_date', $start.' 00:00:00', $end.' 23:59:59');
		});

		$data->map(function (\AdminPanel\Model\Entity\Order $row) {
                if($row->order_confirmation){
                    $path = explode(DS,$row->order_confirmation->image->dir);
                    unset($path[0]);
                    $path = implode('/',$path);
                    $row->order_confirmation->image->dir = $path;
                }
                return $row;
            });
		$data = $data->toArray();

        $this->set(compact('date','data'));
    }


    public function bonus(){

        //$type_transaction_filtering = [1,2,9]; // sementara seharusnya kemungkinan 10 Bonus karir & 11 Bonus group
        $type_transaction_filtering = [2]; // sementara seharusnya kemungkinan 10 Bonus karir & 11 Bonus group


        $date = $this->request->getData('date', (Time::now())->addWeek(-1)->addDay(1)->format('Y-m-d') . ' - ' . (Time::now())->format('Y-m-d'));
        $dates = explode(' - ',$date);
        $start = date('Y-m-d',strtotime($dates[0]));
        $end = date('Y-m-d',strtotime($dates[1]));


        $period = new \DatePeriod(
            new \DateTime($start),
            new \DateInterval('P1D'),
            new \DateTime($end)
        );

        $listDates = [];
        foreach ($period as $key => $dates) {
            $listDates[$key] = $dates->format("Y-m-d");
        }
        $listDates[] = $end;

        $cashpoints = $this->CashPoints->find()
            ->select([
                'total' => $this->CashPoints->find()->func()->sum('CashPoints.cash_point'),
                'date' => $this->CashPoints->find()->func()->date_format([
                    'CashPoints.created' => 'identifier',
                    "'%Y-%m-%d'" => 'literal'
                ])
            ])
            ->contain([
                'Products',
                'Customers',
                'FromCustomers',
                'CashPointClaims'
            ])
            ->where(function($exp) use($start,$end ){
                return $exp->between('CashPoints.created', $start.' 00:00:00', $end.' 23:59:59');
            })
//            ->where([
//                'Orders.order_status_id' => 3,
//            ])
            ->group(['date'])
            ->orderAsc('date')
            ->toArray();

        $transaction_type = $this->TransactionTypes->find('list')->orderAsc('id')->where(['id IN ' => $type_transaction_filtering])->toArray();

        $reports = [];
        foreach($listDates as $key => $value){
            $reports[$key]['date'] =  $value;
            foreach($transaction_type as $transaction_name){
                $reports[$key][str_replace(' ', '_', $transaction_name)] =  0;
                foreach($cashpoints as $cashpoint){
                    if($cashpoint['date'] == $reports[$key]['date']){
                        $reports[$key][str_replace(' ', '_', $transaction_name)] =  $cashpoint['total'];
                    }
                }
            }
        }

        $total_cashpoint = $this->CashPoints->find()
            ->select([
                'total' => $this->CashPoints->find()->func()->sum('CashPoints.cash_point'),
            ])
            ->contain([
                'Products',
                'Customers',
                'FromCustomers',
                'CashPointClaims'
            ])
            ->toArray();

        $cashpoints_claim = $this->CashPoints->find()
            ->select([
                'total' => $this->CashPoints->find()->func()->sum('CashPoints.cash_point')
            ])
            ->contain([
                'Products',
                'Customers',
                'FromCustomers',
                'CashPointClaims'
            ])
            ->where(function($exp) use($start,$end ){
                return $exp->between('CashPoints.created', $start.' 00:00:00', $end.' 23:59:59');
            })
            ->where(function ($exp) {
                return $exp->isNotNull('CashPoints.cash_point_claim_id');
            })
            ->toArray();

        $cashpoints_notclaim = $this->CashPoints->find()
            ->select([
                'total' => $this->CashPoints->find()->func()->sum('CashPoints.cash_point')
            ])
            ->contain([
                'Products',
                'Customers',
                'FromCustomers',
                'CashPointClaims'
            ])
            ->where(function($exp) use($start,$end ){
                return $exp->between('CashPoints.created', $start.' 00:00:00', $end.' 23:59:59');
            })
            ->where(function ($exp) {
                return $exp->isNull('CashPoints.cash_point_claim_id');
            })
            ->toArray();

        $list_total_cashpoint = [];
        foreach($transaction_type as $type){
            $list_total_cashpoint['Total'] =  $total_cashpoint[0]['total'];
            $list_total_cashpoint['Claim'] =  $cashpoints_claim[0]['total'];
            $list_total_cashpoint['notClaim'] =  $cashpoints_notclaim[0]['total'];
        }


//        $mutations = $this->TransactionMutations->find();
//        $transaction = $mutations
//            ->select([
//                'total' => $mutations->func()->sum('TransactionMutations.amount'),
//                'date' => $mutations->func()->date_format([
//                    'TransactionMutations.created' => 'identifier',
//                    "'%Y-%m-%d'" => 'literal'
//                ]),
//                'type' => 'TransactionTypes.name'
//            ])
//            ->contain([
//                'Transactions' => [
//                    'TransactionTypes'
//                ]
//            ])
//            ->where(function($exp) use($start,$end ){
//                return $exp->between('TransactionMutations.created', $start.' 00:00:00', $end.' 23:59:59');
//            })
//            ->where([
//                'Transactions.transaction_type_id IN ' => $type_transaction_filtering,
//            ])
//            ->group(['date', 'Transactions.transaction_type_id'])
//            ->orderAsc('date')
//            ->toArray();
//
//
//
//        $transaction_type = $this->TransactionTypes->find('list')->orderAsc('id')->where(['id IN ' => $type_transaction_filtering])->toArray();

//
//        $reports = [];
//        foreach($listDates as $key => $value){
//            $reports[$key]['date'] =  $value;
//            foreach($transaction_type as $transaction_name){
//                $reports[$key][str_replace(' ', '_', $transaction_name)] =  0;
//                foreach($transaction as $trx){
//                    if(($trx['type'] == $transaction_name) && ($trx['date'] == $reports[$key]['date'])){
//                        $reports[$key][str_replace(' ', '_', $transaction_name)] =  $trx['total'];
//                    }
//                }
//            }
//        }
//
        $transaction_list = [];
        foreach($transaction_type as $type){
            $transaction_list[str_replace(' ', '_', $type)] =  $type;
        }

        $this->set(compact('reports','date', 'transaction_list', 'list_total_cashpoint'));
    }


}
