<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 * @property \AdminPanel\Model\Table\PagesTable $Pages
 */
class ProductsController extends AppController
{


    public function initialize()
    {
        parent::initialize();
        $this->loadModel('AdminPanel.Products');
        $this->loadModel('AdminPanel.ProductCategories');
        $this->loadModel('AdminPanel.ProductImages');
    }


    public function index()
    {
		$this->viewBuilder()->setLayout('pages');

		// $title = 'Produk - Produk Zensei';
		// $this->set('Title', $title);
		// $subtitle = 'Zensei Indonesia';
		// $this->set('Subtitle', $subtitle);
        // $products = $this->Products->find('all')
			// ->select();
        // $products->contain(['ProductCategories']);

        // $this->set(compact('products'));

    }


	public function detail($id = null)
    {
        $this->viewBuilder()->setLayout('pages');

        $product = $this->Products->find()
			->where([
                'Products.id' => $id
            ])
			->contain([
				'ProductUnits'
			])
			->first();

        $this->set(compact('product'));

    }


}
