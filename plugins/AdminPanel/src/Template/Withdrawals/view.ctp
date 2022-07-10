<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $withdrawal
 */
?>


<div class="withdrawals view large-9 medium-8 columns content">
    <div class="table-responsive">
    <table class="table table-hover table-striped">
        <tr>
            <th scope="row"><?= __('Customer') ?></th>
            <td><?= $withdrawal->has('customer') ? $this->Html->link($withdrawal->customer->id, ['controller' => 'Customers', 'action' => 'view', $withdrawal->customer->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Bank Name') ?></th>
            <td><?= h($withdrawal->bank_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Bank City') ?></th>
            <td><?= h($withdrawal->bank_city) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Bank Branch') ?></th>
            <td><?= h($withdrawal->bank_branch) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Bank Account Name') ?></th>
            <td><?= h($withdrawal->bank_account_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Bank Account Number') ?></th>
            <td><?= h($withdrawal->bank_account_number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Customer Bank') ?></th>
            <td><?= $withdrawal->has('customer_bank') ? $this->Html->link($withdrawal->customer_bank->id, ['controller' => 'CustomerBanks', 'action' => 'view', $withdrawal->customer_bank->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Withdrawal Status') ?></th>
            <td><?= $withdrawal->has('withdrawal_status') ? $this->Html->link($withdrawal->withdrawal_status->name, ['controller' => 'WithdrawalStatuses', 'action' => 'view', $withdrawal->withdrawal_status->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Transaction') ?></th>
            <td><?= $withdrawal->has('transaction') ? $this->Html->link($withdrawal->transaction->id, ['controller' => 'Transactions', 'action' => 'view', $withdrawal->transaction->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Note') ?></th>
            <td><?= h($withdrawal->note) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($withdrawal->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount') ?></th>
            <td><?= $this->Number->format($withdrawal->amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($withdrawal->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($withdrawal->modified) ?></td>
        </tr>
    </table>
    </div>
</div>
