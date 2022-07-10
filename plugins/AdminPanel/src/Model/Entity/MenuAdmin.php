<?php
namespace AdminPanel\Model\Entity;

use Cake\ORM\Entity;

/**
 * MenuAdmin Entity
 *
 * @property int $id
 * @property int|null $parent_id
 * @property string|null $name
 * @property string|null $controller
 * @property string|null $action
 * @property int|null $icon
 * @property int|null $lft
 * @property int|null $rght
 *
 * @property \AdminPanel\Model\Entity\ParentMenuAdmin $parent_menu_admin
 * @property \AdminPanel\Model\Entity\ChildMenuAdmin[] $child_menu_admins
 */
class MenuAdmin extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'parent_id' => true,
        'name' => true,
        'controller' => true,
        'action' => true,
        'icon' => true,
        'lft' => true,
        'rght' => true,
        'parent_menu_admin' => true,
        'child_menu_admins' => true
    ];
}
