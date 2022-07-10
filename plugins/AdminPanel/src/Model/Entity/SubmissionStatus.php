<?php
namespace AdminPanel\Model\Entity;

use Cake\ORM\Entity;

/**
 * SubmissionStatus Entity
 *
 * @property int $id
 * @property string $name
 *
 * @property \AdminPanel\Model\Entity\KiaSubmission[] $kia_submissions
 * @property \AdminPanel\Model\Entity\KkSubmission[] $kk_submissions
 * @property \AdminPanel\Model\Entity\KtpSubmission[] $ktp_submissions
 */
class SubmissionStatus extends Entity
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
        'name' => true,
        'kia_submissions' => true,
        'kk_submissions' => true,
        'ktp_submissions' => true,
    ];
}
