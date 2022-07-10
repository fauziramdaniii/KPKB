<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $topic
 */
?>


<div class="topics view large-9 medium-8 columns content">
    <div class="table-responsive">
    <table class="table table-hover table-striped">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($topic->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($topic->id) ?></td>
        </tr>
    </table>
    </div>
</div>
