<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $faq
 */
?>


<div class="faqs view large-9 medium-8 columns content">
    <div class="table-responsive">
    <table class="table table-hover table-striped">
        <tr>
            <th scope="row"><?= __('Faq Category') ?></th>
            <td><?= $faq->has('faq_category') ? $this->Html->link($faq->faq_category->name, ['controller' => 'FaqCategories', 'action' => 'view', $faq->faq_category->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Question') ?></th>
            <td><?= h($faq->question) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Faqs Question Translation') ?></th>
            <td><?= $faq->has('question_translation') ? $this->Html->link($faq->question_translation->id, ['controller' => 'Faqs_question_translation', 'action' => 'view', $faq->question_translation->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Faqs Answer Translation') ?></th>
            <td><?= $faq->has('answer_translation') ? $this->Html->link($faq->answer_translation->id, ['controller' => 'Faqs_answer_translation', 'action' => 'view', $faq->answer_translation->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($faq->id) ?></td>
        </tr>
    </table>
    </div>
</div>
