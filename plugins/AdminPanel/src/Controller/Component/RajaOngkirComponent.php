<?php
namespace AdminPanel\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Http\Client;
use Cake\Core\Configure;

/**
 * RajaOngkir component
 */
class RajaOngkirComponent extends Component
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
    protected $key = null;
    protected $defaultRequest = [];

    public function initialize(array $config)
    {
        parent::initialize($config);
        if (array_key_exists('key', $config)) {
            $this->key = $config['key'];
        } else {
            $this->key = Configure::read('Rajaongkir.key');
        }

        $hosts = parse_url(Configure::read('Rajaongkir.url'));


        $this->defaultRequest = [
            'headers' => [
                'key' => $this->key
            ]
        ];

        $this->defaultRequest += $hosts;


    }

    /**
     * @return mixed
     */
    protected function getbase()
    {
        return $this->defaultRequest['path'];
    }

    /**
     * @param null $url
     * @return string
     */
    protected function setPath($url = null)
    {
        return rtrim($this->getbase(), '/') . $url;
    }

    /**
     * @param null $id
     * @return mixed
     */
    public function getProvince($id = null)
    {
        $http = new Client($this->defaultRequest);
        $query = isset($id) ? ['id' => $id] : null;
        $response = $http->get($this->setPath('/province'), $query);
        if ($response->getStatusCode() == 200) {
            return json_decode($response->getBody()->getContents(), true);
        }
    }

    /**
     * @param null $province_id
     * @param null $city_id
     * @return mixed
     */
    public function getCity($province_id = null, $city_id = null)
    {
        $http = new Client($this->defaultRequest);
        $query = isset($province_id) || isset($city_id) ? ['province' => $province_id, 'id' => $city_id] : null;
        $response = $http->get($this->setPath('/city'), $query);
        if ($response->getStatusCode() == 200) {
            return json_decode($response->getBody()->getContents(), true);
        }
    }


    /**
     * @param null $city_id
     * @param null $id
     * @return mixed
     */
    public function getSubdistrict($city_id = null, $id = null)
    {
        $http = new Client($this->defaultRequest);
        $query = isset($city_id) || isset($id) ? ['city' => $city_id, 'id' => $id] : null;
        $response = $http->get($this->setPath('/subdistrict'), $query);
        if ($response->getStatusCode() == 200) {
            return json_decode($response->getBody()->getContents(), true);
        }
    }

    /**
     * Method “cost” digunakan untuk mengetahui tarif pengiriman (ongkos kirim) dari dan ke kecamatan tujuan tertentu
     * dengan berat tertentu pula.
     * courier code jne, pos, tiki, rpx, esl, pcp, pandu, wahana, sicepat, jnt, pahala, cahaya, sap, jet,
     * indah, dse, slis, first, ncs, star, ninja, lion, idl.
     *
     * @param $origin integer
     * @param $origin_type string
     * @param $destination integer
     * @param $destination_type string
     * @param $courier string bulk using jne:pos:tiki
     * @param $weight integer
     * @param null $length
     * @param null $height
     * @param null $width
     * @return mixed
     */
    public function cost($origin, $origin_type, $destination, $destination_type, $courier, $weight, $length = null, $height = null, $width = null)
    {
        $http = new Client($this->defaultRequest);
        $request = [
            'origin' => $origin,
            'originType' => $origin_type,
            'destination' => $destination,
            'destinationType' => $destination_type,
            'courier' => $courier,
            'weight' => $weight
        ];

        if (!empty($length) && !empty($height) && !empty($width)) {
            $request += [
                'length' => $length,
                'height' => $height,
                'width' => $width
            ];
        }

        $response = $http->post($this->setPath('/cost'), $request);
        if ($response->getStatusCode() == 200) {
            return json_decode($response->getBody()->getContents(), true);
        }
    }

    public function waybill($awb, $courier){

        $http = new Client($this->defaultRequest);
        $request = [
            'waybill' => $awb,
            'courier' => $courier,
        ];
        $response = $http->post($this->setPath('/waybill'), $request);
        if ($response->getStatusCode() == 200) {
            return json_decode($response->getBody()->getContents(), true);
        }
    }

}
