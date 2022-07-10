<?php
namespace AdminPanel\Model\Entity;

use Cake\ORM\Behavior\Translate\TranslateTrait;
use Cake\ORM\Entity;

/**
 * Faq Entity
 *
 * @property int $id
 * @property string $faq_category_id
 * @property string $question
 * @property string $answer
 *
 * @property \AdminPanel\Model\Entity\FaqCategory $faq_category
 */
class Faq extends Entity
{

    use TranslateTrait;
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
        'faq_category_id' => true,
        'question' => true,
        'answer' => true,
        'faq_category' => true,
        '_translations' => true
    ];
}
