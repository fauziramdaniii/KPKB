<?php
namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Products cell
 */
class ProductsCell extends Cell
{
    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    /**
     * Initialization logic run at the end of object construction.
     *
     * @return void
     */
    public function initialize()
    {
		$this->loadModel('AdminPanel.Products');
    }

    /**
     * Default display method.
     *
     * @return void
     */
    public function display()
    {
    }
	
	public function allproduct()
    {
		$products = $this->Products->find()
            ->orderDesc('Products.id');

        $this->set(compact('products'));
		return $this;
    }
}
