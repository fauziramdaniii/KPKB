<?php

namespace Accounts\Error;

use Cake\Error\ExceptionRenderer;
use Cake\Core\Exception\Exception;
use Cake\Core\Configure;

/**
 * Class AppExceptionRenderer
 * @package Rest\Error
 * @see \Cake\Http\Response::$_statusCodes for error code
 */
class AppExceptionRenderer extends ExceptionRenderer
{
    /**
     * @var bool|mixed
     */
    protected $debug = false;

    //public $template = '';

    /**
     * AppExceptionRenderer constructor.
     * @param Exception $exception
     * @param \Cake\Http\ServerRequest|null $request
     */
    public function __construct($exception)
    {
        parent::__construct($exception);
        $this->debug = Configure::read('debug');
    }





    public function render()
    {
        $exception = $this->error;
        $code = $this->_code($exception);
        $method = $this->_method($exception);
        $unwrapped = $this->_unwrap($exception);


        if ($this->_getController()->request->getParam('plugin') === 'Accounts') {
            $response = $this->_getController()->getResponse();
            return $response->withType('application/json')
                ->withAddedHeader('Access-Control-Allow-Origin', '*')
                ->withStatus($code)
                ->withStringBody(json_encode([
                    'status' => 'ERROR',
                    'code' => $code,
                    'message' => $exception->getMessage()
                ]));
        }


        return parent::render();
    }




}
