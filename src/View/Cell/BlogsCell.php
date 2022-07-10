<?php
namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Blogs cell
 * @property \AdminPanel\Model\Table\BlogsTable $Blogs
 */
class BlogsCell extends Cell
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
        $this->loadModel('AdminPanel.Blogs');
    }

    /**
     * Default display method.
     *
     * @return void
     */
    public function display()
    {
    }

    public function latest($limit = 3)
    {
        $blogs = $this->Blogs->find()
            ->orderDesc('Blogs.id')
            ->limit($limit);

        $this->set(compact('blogs'));
		return $this;
    }
}
