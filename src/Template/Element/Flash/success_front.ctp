<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div role="alert" class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span> </button>
    <strong><i class="fa fa-check-circle"></i> Berhasil!</strong> <?php echo $message; ?>
</div>
