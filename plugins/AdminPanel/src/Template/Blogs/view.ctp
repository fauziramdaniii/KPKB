<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $blog
 */
?>


<div class="blogs view large-9 medium-8 columns content">
    <div class="table-responsive">
    <table class="table table-hover table-striped">
        <tr>
            <th scope="row"><?= __('Topic') ?></th>
            <td><?= $blog->has('topic') ? $this->Html->link($blog->topic->name, ['controller' => 'Topics', 'action' => 'view', $blog->topic->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $blog->has('user') ? $this->Html->link($blog->user->id, ['controller' => 'Users', 'action' => 'view', $blog->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Image') ?></th>
            <td><?= h($blog->image) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($blog->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('View') ?></th>
            <td><?= $this->Number->format($blog->view) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($blog->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($blog->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($blog->modified) ?></td>
        </tr>
    </table>
    </div>
</div>
