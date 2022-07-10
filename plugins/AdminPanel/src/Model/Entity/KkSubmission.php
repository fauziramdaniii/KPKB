<?php
namespace AdminPanel\Model\Entity;

use Cake\ORM\Entity;

/**
 * KkSubmission Entity
 *
 * @property int $id
 * @property int|null $customer_id
 * @property int|null $classification_id
 * @property string $name
 * @property string $no_kk
 * @property string|null $address
 * @property string $applicant
 * @property string|null $taker
 * @property int|null $submission_status_id
 * @property string|null $note
 * @property \Cake\I18n\FrozenDate|null $tanggal_pengajuan_berkas
 * @property \Cake\I18n\FrozenDate|null $tanggal_pengambilan_berkas
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \AdminPanel\Model\Entity\Customer $customer
 * @property \AdminPanel\Model\Entity\SubmissionStatus $submission_status
 * @property \AdminPanel\Model\Entity\Image $image
 */
class KkSubmission extends Entity
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
        'classification_id' => true,
        'name' => true,
        'no_kk' => true,
        'address' => true,
        'applicant' => true,
        'taker' => true,
        'submission_status_id' => true,
        'note' => true,
        'tanggal_pengajuan_berkas' => true,
        'tanggal_pengambilan_berkas' => true,
        'created' => true,
        'modified' => true,
        'customer' => true,
        'submission_status' => true,
        'image' => true,
    ];
}
