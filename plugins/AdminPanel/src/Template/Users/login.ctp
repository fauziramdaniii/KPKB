<div class="kt-login-v2__container">
    <div class="text-center mt-5 p-5">
        <?= $this->Html->image('/admin-assets/media/logos/logo-white.jpeg', array('height' => 'auto', 'width' => '150px')); ?>
    </div>
    <div class="kt-login-v2__title">
        <h3>Admin Panel</h3>
    </div>

    <?= $this->Form->create(null, ['class' => 'kt-login-v2__form kt-form', 'autocomplete' => 'off']); ?>
    <?= $this->Flash->render() ?>
    <div class="form-group">
        <input class="form-control" type="text" placeholder="Email" name="email" autocomplete="off">
    </div>
    <div class="form-group">
        <input class="form-control" type="password" placeholder="Password" name="password" autocomplete="off">
    </div>


    <div class="kt-login-v2__actions">
        <button type="submit" class="btn btn-brand btn-block btn-elevate btn-pill">Masuk</button>
    </div>
    <?= $this->Form->end(); ?>



</div>