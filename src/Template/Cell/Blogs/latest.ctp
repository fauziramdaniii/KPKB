<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $withdrawals
 * @var boolean $is_first_customer
 * @var \AdminPanel\Model\Entity\Blog[] $blogs
 * nevix
 */
?>
<ul class="no-list-style">
    <?php foreach($blogs as $blog): ?>
    <li class="clearfix">
		<?php
		$blog_image = $blog->get('image') ?
			$this->Url->build('/files/Blogs/image/' . $blog->get('image'))
			: $this->Url->build('/files/Blogs/image/placeholder.jpg');
		if ($blog_image) :
		?>
		<a href="<?= $this->Url->build(['controller' => 'News', 'action' => 'view', $blog->get('slug')]); ?>" class="widget-posts-img"><img src="<?= $blog_image;?>" class="respimg" alt=""></a>
		<?php endif; ?>
        <div class="widget-posts-descr">
            <a href="<?= $this->Url->build(['controller' => 'News', 'action' => 'view', $blog->get('slug')]); ?>" title=""><?= $blog->title; ?></a>
            <span class="widget-posts-date"><i class="fal fa-calendar"></i> <?= $blog->created->format('d M Y'); ?></span>
        </div>
    </li>
    <?php endforeach; ?>
</ul>
