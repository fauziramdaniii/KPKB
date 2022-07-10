<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $menuAdmin
 */
?>


<div class="menuAdmins view large-9 medium-8 columns content">
    <div class="table-responsive">
    <table class="table table-hover table-striped">
        <tr>
            <th scope="row"><?= __('Parent Menu Admin') ?></th>
            <td><?= $menuAdmin->has('parent_menu_admin') ? $this->Html->link($menuAdmin->parent_menu_admin->name, ['controller' => 'MenuAdmins', 'action' => 'view', $menuAdmin->parent_menu_admin->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($menuAdmin->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Controller') ?></th>
            <td><?= h($menuAdmin->controller) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Action') ?></th>
            <td><?= h($menuAdmin->action) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($menuAdmin->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Icon') ?></th>
            <td><?= $this->Number->format($menuAdmin->icon) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Lft') ?></th>
            <td><?= $this->Number->format($menuAdmin->lft) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rght') ?></th>
            <td><?= $this->Number->format($menuAdmin->rght) ?></td>
        </tr>
    </table>
    </div>
</div>
