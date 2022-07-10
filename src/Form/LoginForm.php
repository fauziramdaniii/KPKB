<?php
/**
 * Created by PhpStorm.
 * User: ridwan
 * Date: 17/11/2018
 * Time: 9:30
 */

namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

class LoginForm extends Form
{
    /**
     * @param Schema $schema
     * @return Schema
     */
    protected function _buildSchema(Schema $schema)
    {
        return $schema->addField('email', ['type' => 'string'])
            ->addField('password', ['type' => 'string']) ;
    }

    /**
     * @param Validator $validator
     * @return Validator
     */
    protected function _buildValidator(Validator $validator)
    {
        $validator->add('password', 'length', [
            'rule' => ['minLength', 6],
            'message' => __('A password is required')
        ])->add('email', 'format', [
            'rule' => 'email',
            'message' => __('A valid email address is required'),
        ]);

        return $validator;
    }

    /**
     * @param array $data
     * @return bool
     */
    protected function _execute(array $data)
    {
        // Send an email.
        return true;
    }
}