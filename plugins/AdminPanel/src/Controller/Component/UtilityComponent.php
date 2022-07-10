<?php
namespace AdminPanel\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

/**
 * Utility component
 */
class UtilityComponent extends Component
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function getIpAddress()
    {
        $client  = env('HTTP_CF_CONNECTING_IP');
        $forward = env('HTTP_X_FORWARDED_FOR');
        $remote  = env('REMOTE_ADDR');

        if(filter_var($client, FILTER_VALIDATE_IP))
        {
            $ip = $client;
        }
        elseif(filter_var($forward, FILTER_VALIDATE_IP))
        {
            $ip = $forward;
        }
        else
        {
            $ip = $remote;
        }

        return $ip;
    }
}
