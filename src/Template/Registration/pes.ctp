<section id="page-title" class="text-light" style="background-image:url('<?= $this->Url->build('/front-assets-new/images/kategori/PES.jpg'); ?>'); background-size: cover; background-position: center center;">
    <div class="container">
        <div class="bg-overlay"></div>
        <div class="page-title">
            <h1>PES 2021</h1>
            <span>Pro Evolution Soccer</span>
        </div>
        <div class="breadcrumb">
            <ul>
                <li><a href="<?= $this->Url->build(['controller' => 'Home', 'action' => 'index' ]); ?>">Beranda</a>
                </li>
                <li><a href="#">Pendaftaran</a>
                </li>
                <li class="active"><a href="<?= $this->Url->build(['controller' => 'Registration', 'action' => 'pes' ]); ?>">PES 2021</a>
                </li>
            </ul>
        </div>
    </div>
</section>
<section id="page-content">
    <div class="container">
        <div class="row">
            <div class="content col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <span class="h4">Pendaftaran Peserta Kategori Console (PES 2021)</span>
                    </div>
                    <div class="card-body">
<!--                        <div role="alert" class="alert alert-danger alert-dismissible mb-5">-->
<!--                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span> </button>-->
<!--                            <strong><i class="fa fa-info-circle"></i> Peringatan!</strong><br /> <br/> Pendaftaran Telah Ditutup! Terima Kasih Telah Berpartisipasi Dalam Piala Gubernur Esport Jawa Barat Ini! -->
<!--                        </div>-->
<!--                        <form id="form1" class="form-validate">-->

                        <?php echo $this->Form->create('Registration',['url' => ['action' => 'pes'], 'id' => 'form1', 'class' => 'form-validate', 'type' => 'file']);?>
                            <?= $this->Flash->render(); ?>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="username">Nama Lengkap</label>
                                    <input type="text" class="form-control" name="name" placeholder="Masukan Nama Lengkap" required>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Masukan Email" required>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="email">Nomor Telepon</label>
                                    <input type="text" class="form-control" name="phone" placeholder="Masukan Nomor Telepon" required>
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="form-label w-100">Foto KTP</label>
                                    <input type="file" name="ktp" required>
                                    <small class="form-text text-muted">Upload Foto KTP.</small>
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="form-label w-100">Foto Bukti Vaksin Ke - 2</label>
                                    <input type="file" name="bukti_vaksin" required>
                                    <small class="form-text text-muted">Upload Foto Bukti Vaksin Ke - 2.</small>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="terms_conditions" id="terms_conditions" class="custom-control-input" value="1" required>
                                    <label class="custom-control-label" for="terms_conditions">Saya telah membaca dan setuju untuk menyerahkan data pribadi sebagai <a href="<?= $this->Url->build(['controller' => 'Tournament', 'action' => 'registrationRules' ]); ?>">Syarat Pendaftaran</a>.</label>
                                </div>
                            </div>
                            <button type="submit" class="btn m-t-30 mt-3">Submit</button>
<!--                        </form>-->
                        <?php echo $this->Form->end();?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $this->append('script'); ?>
<script>
    $('form').submit(function(){
        $(this).find('button[type=submit]').prop('disabled', true);
        //return false; // return false stops the from from actually submitting.. this is only for demo purposes
    });

</script>
<?php $this->end(); ?>
