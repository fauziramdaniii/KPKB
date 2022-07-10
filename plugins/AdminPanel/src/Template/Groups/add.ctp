<?php
$this->Html->css(['/admin-assets/plugins/custom/jstree/jstree.bundle'],['block' => true]);
$this->Html->script(['/admin-assets/plugins/custom/jstree/jstree.bundle'],['block' => true]);
?>

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
                        <h3 class="kt-portlet__head-title">Add New Group</h3>
                    </div>
                </div>
                <?= $this->Form->create($group, ['class' => 'kt-form', 'templates' => 'AdminPanel.app_form', 'novalidate']); ?>
                <div class="kt-portlet__body">
                    <?php
                        echo $this->Flash->render();
                        $this->Form->setConfig('errorClass', 'is-invalid');
                        $default_class = 'form-control';
                        echo $this->Form->controls([
                            'name' => ['class' => $default_class],
                        ], ['fieldset' => false])
                    ?>

                    <div class="m-form__actions m-form__actions">
                        <div class="row">
                            <div class="col-lg-10 ml-lg-auto">
                                <div id="m_tree_3" class="tree-demo"></div>
                            </div>
                        </div>
                    </div>
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
                <?= $this->Form->hidden('aros_acos', ['id' => 'aros_acos']); ?>
                <?= $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>

<?php $this->append('script'); ?>
<script>
    var tree = $('#m_tree_3').jstree({
        'plugins': ["wholerow", "checkbox", "types", "changed"],
        'core': {
            "themes" : {
                "responsive": false
            },
            'data': <?= json_encode($aco, JSON_PRETTY_PRINT); ?>
        },
        "types" : {
            "default" : {
                "icon": "la la-bars"
            },
            "file" : {
                "icon": "la la-bars"
            }
        },
    }).on("changed.jstree", function (e, d) {
        // console.log(d.node)
    });

    $("#form-groups").submit(function(e){
        e.preventDefault();
        $("#aros_acos").val(tree.jstree("get_selected").join(','));
        this.submit();
    });


</script>

<?php $this->end(); ?>