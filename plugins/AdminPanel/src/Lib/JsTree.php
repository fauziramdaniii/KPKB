<?php
/**
 * Created by PhpStorm.
 * User: ridwan
 * Date: 22/11/2018
 * Time: 21:17
 */

namespace AdminPanel\Lib;
use Acl\Model\Table\ArosTable;
use Cake\ORM\TableRegistry;

/**
 * Class JsTree
 * @property \Cake\ORM\Table $Aro;
 * @package AdminPanel\Lib
 */
class JsTree
{

    protected static $_aro_id = null;
    private static $_instance = null;
    protected static $Acl = null;
    protected static $_tree = [];

    /**
     * @param array $tree
     * @param array $view
     * @return array
     */
    public function format($tree = [], $view = [])
    {
        if ($view === []) {
            $view = [
                'id' => 'id',
                'text' => 'alias',
                'icon' => '',
                'state' => [
                    'opened' => true,
                    'disabled' => false,
                    'selected' => false
                ]
            ];
        }
        if ($tree === []) {
            $tree = self::$_tree;
        }
        $out = [];
        foreach($tree as $key => $val) {
            if (in_array($val->alias, ['login', 'logout'])) continue;
            $item = [];
            foreach($view as $k => $v) {
                if (is_string($v) && !empty($v) && isset($val[$v])) {
                    $item[$k] = $val[$v];
                } else {
                    $item[$k] = $v;
                }
            }


            if (self::$_aro_id) {
                $item['state']['selected'] = $this->Acl()->check(self::$_aro_id, $val['id']);
            }

            if (is_array($val['children']) && count($val['children']) > 0) {
                $item['children'] = self::format($val['children'], $view);
            }
            $out[] = $item;
        }
        return $out;
    }

    /**
     * @param \Acl\Controller\Component\AclComponent $acl
     * @return JsTree|null
     */
    static public function register(\Acl\Controller\Component\AclComponent $acl)
    {
        if (self::$_instance === null) {
            self::$_instance = new self;
        }
        self::$_tree = $acl->Aco
            ->find('threaded')->toArray();
        self::$Acl = $acl;
        return self::$_instance;
    }

    /**
     *
     * @return \Acl\Controller\Component\AclComponent;
     */
    public function Acl()
    {
        return self::$Acl;
    }

    /**
     * @param $params
     * @return JsTree
     */
    public function setAllow($params)
    {
        if($params) {
            $params = explode(',', $params);
            $params = array_map('trim', $params);
            if (is_array($params) && count($params) > 0) {
                //process
                //delete not in array
                $perms = TableRegistry::get('aros_acos');
                $perms->query()
                    ->delete()
                    ->where(['aro_id' => self::$_aro_id])
                    ->where(function (\Cake\Database\Expression\QueryExpression $exp) use($params) {
                        return $exp->notIn('aco_id', $params);
                    })
                    ->execute();

                foreach($params as $aco) {
                    $this->Acl()->allow(self::$_aro_id, $aco);
                }

            }
        }
        return $this;
    }

    /**
     * @param $id
     * @return JsTree
     */
     public function setRole($id)
    {
        $q = $this->Acl()->Aro->find()
            ->where([
                'model' => 'Groups',
                'foreign_key' => $id
            ]);
        if (!$q->isEmpty()) {
            $data = $q->first();
            self::$_aro_id = $data->id;
        }

        return $this;
    }
}