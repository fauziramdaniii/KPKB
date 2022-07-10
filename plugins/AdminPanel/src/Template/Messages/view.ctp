<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $message
 */
?>


<div class="suppliers view large-9 medium-8 columns content">
    <div class="table-responsive">
    <table class="table table-hover table-striped">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($message->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($message->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Message') ?></th>
            <td><?= h($message->message) ?></td>
        </tr>
    </table>
    </div>
</div>
