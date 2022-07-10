<?php
/**
 * Created by PhpStorm.
 * User: ridwan
 * Date: 22/11/2018
 * Time: 19:48
 */

namespace AdminPanel\Lib;
use Acl\AclExtras;


class AclSync extends AclExtras
{

    /**
     * @param string $msg
     * @return bool
     */
    public function out($msg)
    {
        return false;
    }
}