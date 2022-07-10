<?php
namespace AdminPanel\Controller;

use AdminPanel\Controller\AppController;
use Cake\Core\Configure;
use Cake\Database\Expression\QueryExpression;
use Cake\I18n\Time;

/**
 * Statements Controller
 *
 * @property \AdminPanel\Model\Table\CustomerStatementsTable $CustomerStatements
 * @method \AdminPanel\Model\Entity\Statement[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StatementsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('AdminPanel.CustomerStatements');
    }

    public function process()
    {
        //$this->disableAutoRender();
        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');
            $status = $this->request->getData('status');
            $ids = $this->request->getData('ids');

            switch ($status) {
                case '1': //transferred

                    foreach($ids as $vals) {
                        $statement = $this->CustomerStatements->get($vals);
                        $statement->status = $status;
                        $this->CustomerStatements->save($statement);
                    }

                break;
            }

            $result = ['ok'];
            return $this->response->withType('application/json')
                ->withStringBody(json_encode($result));
        }
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {

        $cutoff = Configure::read('StatementCutoffDate', '05');

        $date = (Time::parse(date('Y-m-' . $cutoff)));

        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');

            $pagination = $this->request->getData('pagination');
            $sort = $this->request->getData('sort');
            $query = $this->request->getData('query');
            $status = $this->request->getData('status');

            $statement_date = $date;
            if (isset($query['statement_date'])) {
                list($month, $year) = explode('/', $query['statement_date']);
                $statement_date = (Time::create($year, $month, $cutoff)); //$query['statement_date'];
                unset($query['statement_date']);
            }



            $type = [
                'pending' => 0,
                'transferred' => 1,
                'failed' => 2
            ];
            $status = $type[$status];
            /** custom default query : select, where, contain, etc. **/
            $data = $this->CustomerStatements->find('all')
                ->select();
            $data->contain([
                'Customers',
                'CustomerStatementDetails' => [
                    'CashPointClaims'
                ]
            ]);

            if ($query && is_array($query)) {
                if (isset($query['generalSearch'])) {
                    $search = $query['generalSearch'];
                    unset($query['generalSearch']);
                    /**
                    custom field for general search
                    ex : 'Users.email LIKE' => '%' . $search .'%'
                     **/
                    $data->where(['OR' => [
                        'Customers.username LIKE' => '%' . $search .'%',
                        'Customers.email LIKE' => '%' . $search .'%',
                        'CustomerStatements.bank_name LIKE' => '%' . $search .'%',
                        'CustomerStatements.bank_city LIKE' => '%' . $search .'%',
                        'CustomerStatements.bank_branch LIKE' => '%' . $search .'%',
                        'CustomerStatements.bank_account_name LIKE' => '%' . $search .'%',
                        'CustomerStatements.bank_account_number LIKE' => '%' . $search .'%',
                    ]]);
                }
                $data->where($query);
            }


            if (isset($status)) {
                $data->where(['CustomerStatements.status' => $status]);
            }

            if ($statement_date) {
                $data->where(function(QueryExpression $exp) use ($statement_date) {
                    return $exp->between(
                        'statement_date',
                        $statement_date->copy()->addMonths(-1)->addDays(1)->format('Y-m-d'),
                        $statement_date->copy()->format('Y-m-d')
                    );
                });
            }

            if (isset($sort['field']) && isset($sort['sort'])) {
                $data->order([$sort['field'] => $sort['sort']]);
            }

            if (isset($pagination['perpage']) && is_numeric($pagination['perpage'])) {
                $data->limit($pagination['perpage']);
            }
            if (isset($pagination['page']) && is_numeric($pagination['page'])) {
                $data->page($pagination['page']);
            }

            $total = $data->count();

            $data = $data->map(function (\AdminPanel\Model\Entity\CustomerStatement $row) {
//                $path = explode(DS,$row->order_confirmation->image->dir);
//                unset($path[0]);
//                $path = implode('/',$path);
//                $row->order_confirmation->image->dir = $path;
                return $row;
            });

            $result = [];
            $result['data'] = $data->toArray();


            $result['meta'] = array_merge((array) $pagination, (array) $sort);
            $result['meta']['total'] = $total;


            return $this->response->withType('application/json')
                ->withStringBody(json_encode($result));
        }

        $statusTypes = [
            '0' => 'Pending',
            '1' => 'Transferred',
            // '2' => 'Failed'
        ];


        $this->set(compact('statusTypes', 'date'));

    }


    /**
     * @throws \Exception
     */
    public function export()
    {
        $cutoff = Configure::read('StatementCutoffDate', '05');

        $date = (Time::parse(date('Y-m-' . $cutoff)));

        $sort = $this->request->getQuery('sort');
        $query = $this->request->getQuery('query');
        $status = $this->request->getQuery('status');

        try {
            $export = $this->ExportExcel->init(null, false)
                ->addHeader([
                    'id',
                    'Username',
                    'Full Name',
                    'Bank',
                    'Account Name',
                    'Account Number',
                    'Statement Date',
                    'Total',
                    'Status'
                ]);

            $statement_date = $date;
            if (isset($query['statement_date'])) {
                list($month, $year) = explode('/', $query['statement_date']);
                $statement_date = (Time::create($year, $month, $cutoff)); //$query['statement_date'];
                unset($query['statement_date']);
            }

            $type = [
                'pending' => 0,
                'transferred' => 1,
                'failed' => 2
            ];
            $status = $type[$status];
            /** custom default query : select, where, contain, etc. **/
            $data = $this->CustomerStatements->find('all')
                ->select();
            $data->contain([
                'Customers',
                'CustomerStatementDetails' => [
                    'CashPointClaims'
                ]
            ]);

            if ($query && is_array($query)) {
                if (isset($query['generalSearch'])) {
                    $search = $query['generalSearch'];
                    unset($query['generalSearch']);
                    /**
                    custom field for general search
                    ex : 'Users.email LIKE' => '%' . $search .'%'
                     **/
                    $data->where(['OR' => [
                        'Customers.username LIKE' => '%' . $search .'%',
                        'Customers.email LIKE' => '%' . $search .'%',
                        'CustomerStatements.bank_name LIKE' => '%' . $search .'%',
                        'CustomerStatements.bank_city LIKE' => '%' . $search .'%',
                        'CustomerStatements.bank_branch LIKE' => '%' . $search .'%',
                        'CustomerStatements.bank_account_name LIKE' => '%' . $search .'%',
                        'CustomerStatements.bank_account_number LIKE' => '%' . $search .'%',
                    ]]);
                }
                $data->where($query);
            }

            if (isset($status)) {
                $data->where(['CustomerStatements.status' => $status]);
            }

            if ($statement_date) {
                $data->where(function(QueryExpression $exp) use ($statement_date) {
                    return $exp->between(
                        'statement_date',
                        $statement_date->copy()->addMonths(-1)->addDays(1)->format('Y-m-d'),
                        $statement_date->copy()->format('Y-m-d')
                    );
                });
            }

            if (isset($sort['field']) && isset($sort['sort'])) {
                $data->order([$sort['field'] => $sort['sort']]);
            }

            $statusTypes = [
                '0' => 'Pending',
                '1' => 'Transferred',
                '2' => 'Failed'
            ];

            $data = $data
                ->map(function(\AdminPanel\Model\Entity\CustomerStatement $row) use ($export, $statusTypes) {
                    $export->addRow([
                        $row->id,
                        $row->customer->username,
                        $row->customer->first_name,
                        $row->bank_name,
                        $row->bank_account_name,
                        (string) $row->bank_account_number,
                        $row->statement_date instanceof \Cake\I18n\FrozenDate ? $row->statement_date->format('Y-m-d') : '-',
                        $row->total,
                        $statusTypes[$row->status]
                    ], true);
                    return $row;
                })
                ->toArray();

            return $export->close();
        } catch (\Exception $e) {
            throw  new \Exception($e->getMessage());
        }

    }


}
