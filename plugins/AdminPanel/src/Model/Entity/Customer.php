<?php
namespace AdminPanel\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

/**
 * Customer Entity
 *
 * @property int $id
 * @property string $username
 * @property int $refferal_id
 * @property int $upline_id
 * @property int $card_id
 * @property \Cake\I18n\FrozenTime $dob
 * @property string $identity_number
 * @property string $npwp
 * @property string $email
 * @property string $first_name
 * @property string $last_name
 * @property int $country_id
 * @property string $phone
 * @property string $password
 * @property string $activation_code
 * @property string $avatar
 * @property int $is_active
 * @property int $customer_type_id
 * @property int $rank_id
 * @property int $vip_rank_id
 * @property boolean $is_vip
 * @property int $religion_id
 * @property int $education_id
 * @property string $heir
 * @property string $heir_relation
 * @property string $heir_address
 * @property int $heir_country_id
 * @property string $name_birth_mother
 * @property float $balance
 * @property \Cake\I18n\FrozenTime $active_date
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $last_login
 *
 * @property \AdminPanel\Model\Entity\Country $country
 * @property \AdminPanel\Model\Entity\Country $heir_country
 * @property \AdminPanel\Model\Entity\Network $network
 * @property \AdminPanel\Model\Entity\CustomerBank $customer_bank
 * @property \AdminPanel\Model\Entity\Religion $religion
 * @property \AdminPanel\Model\Entity\Education $education
 */
class Customer extends Entity
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
        'username' => true,
        'refferal_id' => true,
        'upline_id' => true,
        'card_id' => true,
        'dob' => true,
        'identity_number' => true,
        'npwp' => true,
        'email' => true,
        'first_name' => true,
        'last_name' => true,
        'country_id' => true,
        'phone' => true,
        'password' => true,
        'activation_code' => true,
        'avatar' => true,
        'is_active' => true,
        'customer_type_id' => true,
        'rank_id' => true,
        'vip_rank_id' => true,
        'is_vip' => true,
        'religion_id' => true,
        'education_id' => true,
        'heir' => true,
        'heir_relation' => true,
        'heir_address' => true,
        'heir_country_id' => true,
        'name_birth_mother' => true,
        'created' => true,
        'last_login' => true,
        'country' => true,
        'active_date' => true,
        'customer_bank' => true,
        'heir_country' => true,
        'religion' => true,
        'education' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
    protected $_virtual = ['full_name'];

    protected function _getFullName()
    {
        return $this->first_name . '  ' . $this->last_name;
    }

    protected function _setPassword($password)
    {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher)->hash($password);
        }
    }
}
