<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Access Control</h3>
            <span class="kt-subheader__separator kt-hidden"></span>
            <div class="kt-subheader__breadcrumbs">
                <?= $this->Breadcrumb->display($BreadCrumbCrumbs);?>
            </div>
        </div>
    </div>
</div>
<!-- end:: Subheader -->

<!-- begin:: Content -->
<div class="kt-container  kt-grid__item kt-grid__item--fluid">
    <div class="row">
        <div class="col-lg-12">

            <div class="kt-portlet kt-portlet--height-fluid">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">Add New User</h3>
                    </div>
                </div>
                <?= $this->Form->create($user, ['class' => 'kt-form', 'templates' => 'AdminPanel.app_form', 'novalidate']); ?>
                <div class="kt-portlet__body">

                    <?php
                        echo $this->Flash->render();
                        $default_class = 'form-control';
                        $this->Form->setConfig('errorClass', 'is-invalid');
                        echo $this->Form->controls([
                            'email' => ['class' => $default_class],
                            'password' => ['type' => 'password','class' => $default_class],
                            'repeat_password' => ['type' => 'password', 'class' => $default_class, 'required' => false],
                            'group_id' => ['class' => $default_class, 'empty' => 'Select'],
                            'user_status_id' => ['class' => $default_class, 'empty' => 'Select', 'options' => $user_status],
                            'first_name' => ['class' => $default_class],
                            'last_name' => ['class' => $default_class]
                        ], ['fieldset' => false])
                    ?>


                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-2">
                            </div>
                            <div class="col-10">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?= $this->Form->end(); ?>
            </div>

        </div>
    </div>
</div>
<!-- end:: Content -->

<?php $this->append('script'); ?>
<script>
    $('select').selectpicker();
</script>
<?php $this->end(); ?>