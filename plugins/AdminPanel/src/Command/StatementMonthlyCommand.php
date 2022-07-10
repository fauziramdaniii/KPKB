<?php
namespace AdminPanel\Command;

use AdminPanel\Model\Entity\Transaction;
use AdminPanel\Model\Entity\TransactionType;
use Cake\Console\Arguments;
use Cake\Console\Command;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;
use Cake\Core\Configure;
use Cake\Database\Expression\QueryExpression;
use Cake\I18n\Time;
use \AdminPanel\Model\Entity\CustomerStatement;
use AdminPanel\Model\Entity\Customer;

/**
 * StatementMonthly command.
 * @property \AdminPanel\Model\Table\CustomerStatementDetailsTable $CustomerStatementDetails
 * @property \AdminPanel\Model\Table\CustomerStatementsTable $CustomerStatements
 * @property \AdminPanel\Model\Table\CashPointClaimsTable $CashPointClaims
 * @property \AdminPanel\Model\Table\CashPointsTable $CashPoints
 * @property \AdminPanel\Model\Table\TransactionsTable $Transactions
 */
class StatementMonthlyCommand extends Command
{

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('AdminPanel.CustomerStatementDetails');
        $this->loadModel('AdminPanel.CustomerStatements');
        $this->loadModel('AdminPanel.CashPointClaims');
        $this->loadModel('AdminPanel.CashPoints');
        $this->loadModel('AdminPanel.Transactions');
    }

    /**
     * Hook method for defining this command's option parser.
     *
     * @see https://book.cakephp.org/3.0/en/console-and-shells/commands.html#defining-arguments-and-options
     *
     * @param \Cake\Console\ConsoleOptionParser $parser The parser to be defined
     * @return \Cake\Console\ConsoleOptionParser The built parser.
     */
    public function buildOptionParser(ConsoleOptionParser $parser)
    {
        $parser = parent::buildOptionParser($parser);

        $parser->addOption('date', [
            'short' => 'd',
            'help' => 'date of start to insert periode',
            'default' => (Time::now())->addDays(-1)->format('Y-m-d')
        ]);

        return $parser;
    }

    protected function setBank(CustomerStatement & $statement, Customer $customer)
    {
        if ($customer && $customer->customer_bank) {
            $statement->bank_name = $customer->customer_bank->bank->name;
            $statement->bank_city = $customer->customer_bank->city;
            $statement->bank_branch = $customer->customer_bank->branch;
            $statement->bank_account_name = $customer->customer_bank->account_name;
            $statement->bank_account_number = $customer->customer_bank->account_number;
        }
    }

    /**
     * Implement this method with your command's logic.
     *
     * @param \Cake\Console\Arguments $args The command arguments.
     * @param \Cake\Console\ConsoleIo $io The console io
     * @return null|int The exit code or null for success
     */
    public function execute(Arguments $args, ConsoleIo $io)
    {

        $date = $args->getOption('date');

        $date = Time::parse($date);



        $minimumClaim = Configure::read('MinimumClaim', 100000);
        $fee = Configure::read('Withdrawal.fee', 6500);


        //hitung bonus omset order
        $cash_points = $this->CashPoints->find();
        $cash_points = $cash_points
            ->select([
                'point' => $cash_points->func()->sum('cash_point'),
                'CashPoints.customer_id',
                'Customers.id',
                'Customers.balance',
                'CustomerBanks.bank_id',
                'CustomerBanks.city',
                'CustomerBanks.branch',
                'CustomerBanks.account_name',
                'CustomerBanks.account_number',
                'Banks.name',
            ])
            //->enableAutoFields()
            ->contain([
                'Customers' => [
                    'CustomerBanks' => [
                        'Banks'
                    ]
                ]
            ])
            //->whereNull('cash_point_claim_id')
            ->where(function(QueryExpression $q) use ($date) {
                return $q->between(
                    'confirm_date',
                    $date->copy()->addMonths(-1)->addDays(1)->format('Y-m-d'),
                    $date->format('Y-m-d')
                );
            })
            ->group('CashPoints.customer_id');

        if (!$cash_points->isEmpty()) {
            /**
             * @var \AdminPanel\Model\Entity\CashPoint[] $cash_points
             */
            foreach($cash_points as $cash_point) {
                if (!$cash_point->customer_id) continue;
                if (($cash_point->point + $cash_point->customer->balance) < $minimumClaim) {
                    if ($cash_point->point > 0) {
                        $this->Transactions->create(
                            TransactionType::RECEIVED,
                            $cash_point->customer_id,
                            $cash_point->point,
                            'Pending bonus'
                        );
                    }
                    continue;
                };

                $cash_point_balance = $cash_point->customer->balance;

                $statement = $this->CustomerStatements->newEntity([
                    'customer_id' => $cash_point->customer_id,
                    'amount' => $cash_point->point + $cash_point_balance,
                    'total' => $cash_point->point + $cash_point_balance - $fee,
                    'point' => $cash_point->point,
                    'fee' => $fee,
                    'statement_date' => $date->format('Y-m-d')
                ]);

                $this->setBank($statement, $cash_point->customer);

                if ($this->CustomerStatements->save($statement)) {
                    if ($cash_point_balance > 0) {
                        $this->Transactions->create(
                            TransactionType::WITHDRAWAL,
                            $cash_point->customer_id,
                            $cash_point_balance * -1,
                            'Withdrawal statement'
                        );
                    }
                }
            }
        }


        //bonus claim atau bonus pensiun tiap bulan
        //$date = Time::now()->addMonth(1)->format('Y-m-01');
        $statementIndex = Configure::read('StatementIndex',0.0075);
        $claims = $this->CashPointClaims->find()
            ->contain([
                'Customers' => [
                    'CustomerBanks' => [
                        'Banks'
                    ]
                ]
            ])
            ->where(function (QueryExpression $q) use($date) {
                return $q->lte('claim_date', $date->format('Y-m-d'))
                    ->gte('expired_date', $date->format('Y-m-d'));
            });

        /**
         * @var \AdminPanel\Model\Entity\CashPointClaim[] $claims
         */
        foreach($claims as $claim) {

            $statement = $this->CustomerStatements->find()
                ->where([
                    'customer_id' => $claim->customer_id,
                    'statement_date' => $date->format('Y-m-d')
                ])
                ->first();

            $total = floor($claim->total * $statementIndex);

            if (!$statement) {
                $statement = $this->CustomerStatements->newEntity([
                    'customer_id' => $claim->customer_id,
                    'amount' => 0,
                    'statement_date' => $date->format('Y-m-d')
                ]);

                $this->setBank($statement, $claim->customer);

            }

            //check header total
            if ($statement->total == 0) {
                $total -= $fee;
                $statement->fee = $fee;
            }

            $statement->total += $total;
            $this->CustomerStatements->save($statement);

            $sequence = $this->CustomerStatementDetails->find()
                ->where([
                    'cash_point_claim_id' => $claim->id
                ])
                ->count();

             $statementDetail = $this->CustomerStatementDetails->newEntity([
                'customer_id' => $claim->customer_id,
                'customer_statement_id' => $statement->id,
                'cash_point_claim_id' => $claim->id,
                'year' => $date->format('Y'),
                'month' => $date->format('m'),
                'amount' => $total,
                'sequence' => ++$sequence
             ]);



             $this->CustomerStatementDetails->save($statementDetail);

        }

    }
}
