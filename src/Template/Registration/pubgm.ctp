<section id="page-title" class="text-light" style="background-image:url('<?= $this->Url->build('/front-assets-new/images/kategori/PUBG.jpg'); ?>'); background-size: cover; background-position: center center;">
    <div class="container">
        <div class="bg-overlay"></div>
        <div class="page-title">
            <h1>PUBG Mobile</h1>
            <span>Player Unknown's Battlegrounds Mobile</span>
        </div>
        <div class="breadcrumb">
            <ul>
                <li><a href="<?= $this->Url->build(['controller' => 'Home', 'action' => 'index' ]); ?>">Beranda</a>
                </li>
                <li><a href="#">Pendaftaran</a>
                </li>
                <li class="active"><a href="<?= $this->Url->build(['controller' => 'Registration', 'action' => 'pubgm' ]); ?>">PUBG Mobile</a>
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
                        <span class="h4">Pendaftaran Peserta Kategori Mobile (PUBG Mobile)</span>
                    </div>
                    <div class="card-body">
                        <div role="alert" class="alert alert-danger alert-dismissible mb-5">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span> </button>
                            <strong><i class="fa fa-info-circle"></i> Peringatan!</strong><br /> <br/> Pendaftaran Telah Ditutup! Terima Kasih Telah Berpartisipasi Dalam Piala Gubernur Esport Jawa Barat Ini! </div>
                        <?php /*
                        <?php echo $this->Form->create('Registration',['url' => ['action' => 'pubgm'], 'id' => 'form1', 'class' => 'form-validate', 'type' => 'file']);?>
                        <?= $this->Flash->render(); ?>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="username">Nama Tim</label>
                                    <input type="text" class="form-control" name="team_name" placeholder="Masukan Nama Tim" required>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="username">Penanggung Jawab Tim</label>
                                    <input type="text" class="form-control" name="person_in_charge" placeholder="Masukan Nama Penanggung Jawab Tim" required>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="username">Nomor Telepon Penanggung Jawab</label>
                                    <input type="text" class="form-control" name="phone" placeholder="Masukan Nomor Telepon" required>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="username">Email Penanggung Jawab</label>
                                    <input type="text" class="form-control" name="email" placeholder="Masukan Email" required>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="email">Template File Data Tim</label>
                                    <a href="<?= $this->Url->build('/template-file/Template Data Tim (PUBG Mobile).docx'); ?>" class="btn btn-outline"><i class="fa fa-download"></i> Download</a>
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="form-label w-100">Upload File Data Tim (File Ms.Word)</label>
                                    <input type="file" name="document" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="terms_conditions" id="terms_conditions" class="custom-control-input" value="1" required>
                                    <label class="custom-control-label" for="terms_conditions">Saya telah membaca dan setuju untuk menyerahkan data pribadi sebagai <a href="<?= $this->Url->build(['controller' => 'Tournament', 'action' => 'registrationRules' ]); ?>">Syarat Pendaftaran</a>.</label>
                                </div>
                            </div>
                            <button type="submit" class="btn m-t-30 mt-3">Submit</button>
                        <?php echo $this->Form->end();?>
                        */ ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
