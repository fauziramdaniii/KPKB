<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $page
 */
?>


<div class="pages view large-9 medium-8 columns content">
    <div class="table-responsive">
    <table class="table table-hover table-striped">
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($page->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Slug') ?></th>
            <td><?= h($page->slug) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Pages Title Translation') ?></th>
            <td><?= $page->has('title_translation') ? $this->Html->link($page->title_translation->id, ['controller' => 'Pages_title_translation', 'action' => 'view', $page->title_translation->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Pages Content Translation') ?></th>
            <td><?= $page->has('content_translation') ? $this->Html->link($page->content_translation->id, ['controller' => 'Pages_content_translation', 'action' => 'view', $page->content_translation->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($page->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Enable') ?></th>
            <td><?= $this->Number->format($page->enable) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($page->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($page->modified) ?></td>
        </tr>
    </table>
    </div>
</div>
