<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\ORM\TableRegistry;

/**
 * Statistic component
 * @property \AdminPanel\Model\Table\VisitorsTable $Visitors
 */
class StatisticComponent extends Component
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];


    public function initialize(array $config)
    {
    }

    public function onlineLog(){
//        $ip = '103.119.63.66';
        $ip = env('HTTP_X_FORWARDED_FOR');
        $this->Visitors = TableRegistry::get('AdminPanel.Visitors');
        if (!in_array($ip, ['::1', '127.0.0.1', null])) {

            $exists = $this->Visitors->find()
                ->where([
                    'ip' => $ip
                ])
                ->count();
            if ($exists == 0) {
                $ip = json_decode(file_get_contents(
                    'https://api.ipdata.co/'.$ip.'?api-key=d3941e87e91ccde61c9a9d0a488f3ceee2cead61fabfaa2de8087e64'
                ), true);
                if ($ip && isset($ip['ip'])) {
                        $entity = $this->Visitors->newEntity($ip);
                        $entity->asn = $ip['asn']['asn'];
                        $entity->organisation = $ip['asn']['name'];
                        $this->Visitors->save($entity);
                }
            }
        }
        return true;
    }
}
