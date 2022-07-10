<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $withdrawals
 * @var boolean $is_first_customer
 * @var \AdminPanel\Model\Entity\Blog[] $blogs
 * nevix
 */
?>
<ul>
	<?php foreach($products as $product) : ?>
		<li><a href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'detail', $product->id])?>"><?= $product->name; ?></a></li>
	<?php endforeach;?>
</ul>