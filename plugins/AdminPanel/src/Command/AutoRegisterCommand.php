<?php
namespace AdminPanel\Command;

use Cake\Console\Arguments;
use Cake\Console\Command;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;
use Cake\I18n\Time;

/**
 * @property \AdminPanel\Model\Table\CustomersTable $Customers
 * @property \AdminPanel\Model\Table\CustomerBanksTable $CustomerBanks
 * @property \AdminPanel\Model\Table\GenerationsTable $Generations
 * @property \AdminPanel\Model\Table\ProvincesTable $Provinces
 * @property \AdminPanel\Model\Table\CitiesTable $Cities
 * @property \AdminPanel\Model\Table\SubdistrictsTable $Subdistricts
 * AutoRegister command.
 */
class AutoRegisterCommand extends Command
{


    public function initialize()
    {
        parent::initialize();
        $this->loadModel('AdminPanel.Customers');
        $this->loadModel('AdminPanel.Generations');
        $this->loadModel('AdminPanel.Provinces');
        $this->loadModel('AdminPanel.Cities');
        $this->loadModel('AdminPanel.Subdistricts');
        $this->loadModel('AdminPanel.CustomerBanks');
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
        $parser->addOption('total', [
            'short' => 't',
            'help' => 'total 100',
            'default' => 10
        ]);
        return $parser;
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
        $total = $args->getOption('total');
//         $total = 1;

        //$date = Time::parse('2019-06-01 09:00:00');

        for($i = 1; $i <= $total; $i++) {
            $refferal = $this->Customers->find()
                ->order('rand()')
                ->first();


            $customer = $this->Customers->newEntity();
            $customer->refferal_id = $refferal ? $refferal->id : null;
//            $customer->refferal_id = 4;


            $validator = $this->Customers->getValidator('default');

            $validator->remove('no_kk')
                ->remove('img_kk')
                ->remove('no_npwp')
                ->remove('img_npwp');

            $faker = \Faker\Factory::create();
            $customer->username = $faker->userName;
            $customer->first_name = $faker->firstName;
            $customer->last_name = $faker->lastName;
            $customer->email = $faker->email;
            $customer->password = 'Admin123';

            $customer->balance = 0;
//            $customer->wildcard = 0;
//            $customer->point = 0; // testing random point

//            $customer->marriage_id = 1;
//            $customer->gender = 1;

            $customer->is_active = 1;
            $customer->rank_id = null;

            if ($this->Customers->save($customer)) {
                $this->Generations->saving(
                    $customer->refferal_id,
                    $customer->id
                );

                //processing network
                $this->Customers->Networks->saving($customer->refferal_id, $customer->id);

                $address = $this->Customers->CustomerAddress->newEntity();
                $address->customer_id = $customer->id;
                $address->receiver_name = $faker->firstName;
                $address->receiver_phone = $faker->phoneNumber;

                $province = $this->Provinces->find()
                    ->order('rand()')
                    ->first();

                if ($province) {
                    $address->province_id = $province->id;
                    $address->address = $faker->address;
                    $address->primary = 1;

                    $city = $this->Cities->find()
                        ->where([
                            'province_id' => $province->id
                        ])
                        ->order('rand()')
                        ->first();

                    if ($city) {
                        $address->city_id = $city->id;

                        $district = $this->Subdistricts->find()
                            ->where([
                                'city_id' => $city->id
                            ])
                            ->order('rand()')
                            ->first();

                        if ($district) {
                            $address->subdistrict_id = $district->id;
                        }

                    }

                }

                $this->Customers->CustomerAddress->save($address);

                $customerBank = $this->CustomerBanks->newEntity();
                $customerBank->customer_id = $customer->id;
                $customerBank->bank_id = 6;
                $customerBank->branch = 'Jakarta';
                $customerBank->city = 'jakarta';
                $customerBank->account_name = 'test user';
                $customerBank->account_number = '123456789';

                $this->CustomerBanks->save($customerBank);
            } else {
                $io->error('error create customer');
                $io->error($customer->getErrors());
            }



        }

    }
}
