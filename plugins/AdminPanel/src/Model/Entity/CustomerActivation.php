<?php
namespace AdminPanel\Model\Entity;

use Cake\ORM\Entity;

/**
 * CustomerActivation Entity
 *
 * @property int $id
 * @property int|null $customer_id
 * @property int|null $customer_bank_id
 * @property string|null $destination_bank
 * @property float|null $amount
 * @property \Cake\I18n\FrozenTime|null $confirmation_date
 * @property int|null $image_id
 * @property string|null $note
 * @property int|null $status
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \AdminPanel\Model\Entity\Customer $customer
 * @property \AdminPanel\Model\Entity\CustomerBank $customer_bank
 * @property \AdminPanel\Model\Entity\Image $image
 */
class CustomerActivation extends Entity
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
        'customer_id' => true,
        'customer_bank_id' => true,
        'destination_bank' => true,
        'amount' => true,
        'confirmation_date' => true,
        'image_id' => true,
        'note' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'customer' => true,
        'customer_bank' => true,
        'image' => true,
    ];
}
