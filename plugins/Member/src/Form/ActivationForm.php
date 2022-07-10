<?php


namespace Member\Form;


use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

class ActivationForm extends Form
{
    /**
     * @param Schema $schema
     * @return Schema
     */
    protected function _buildSchema(Schema $schema)
    {
        return $schema->addField('serial', ['type' => 'string'])
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
        ])->add('serial', 'length', [
            'rule' => ['minLength', 10],
            'message' => __('A serial is required')
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
