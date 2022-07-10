<section id="page-title" class="text-light" style="background-image:url('<?= $this->Url->build('/front-assets-new/TentangKami_2.png'); ?>'); background-size: cover; background-position: center center;">
        <div class="bg-overlay"></div>
        <div class="page-title">
            <h1>Cara Pendaftaran</h1>
            <span>Piala Gubernur Jawa Barat</span>
        </div>
        <div class="breadcrumb">
            <ul>
                <li><a href="<?= $this->Url->build(['controller' => 'Home', 'action' => 'index' ]); ?>">Beranda</a>
                </li>
                <li class="active"><a href="<?= $this->Url->build(['controller' => 'Tournament', 'action' => 'registrationMethod' ]); ?>">Cara Pendaftaran</a>
                </li>
            </ul>
        </div>
    </div>
</section>
<style>
    .list1 li{
        margin-left: 10px;
        margin-bottom: 20px;
    }
    ol img{
        max-width: 500px;
    }
    .list2 li{
        margin-left: 20px;
        margin-top: 10px;
    }
    .list3 li{
        margin-left: 20px;
        margin-top: 10px;
    }
</style>
<section>
    <div class="container">
        <div class="heading-text heading-section text-center">
            <h2>Cara Pendaftaran</h2>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div>
                    Berikut cara pendaftaran untuk menjadi peserta pada kompetisi Piala Gubernur Esport Jawa Barat Tahun 2022 :
                </div>
                <br />
                <ol class="list1">
                    <li>
                        Pilih salah satu cabor sesuai dengan yang diminati pada menu "Pendaftaran" dengan cara klik menu yang dipilih. <br/>
                        <a title="Image" data-lightbox="image" href="<?= $this->Url->build('/front-assets-new/step1.png'); ?>" class="btn btn-light m-20"><img alt="Image" src="<?= $this->Url->build('/front-assets-new/step1.png'); ?>" /></a>

                    </li>
                    <li>
                        Jika cabor yang dipilih adalah <b>PES 2021</b>, akan muncul tampilan seperti gambar dibawah ini (Gambar ini merupakan formulir dari cabor PES 2021).<br/>
                        <a title="Image" data-lightbox="image" href="<?= $this->Url->build('/front-assets-new/step2.png'); ?>" class="btn btn-light m-20"><img alt="Image" src="<?= $this->Url->build('/front-assets-new/step2.png'); ?>" /></a>
                    </li>
                    <li>
                        Jika muncul tampilan formulir seperti ini, lengkapi formulir dengan keterangan sebagai berikut :
                        <ul class="list-icon list-icon-uncheck list-icon-colored list2">
                            <li>Nama Lengkap : Isi kolom nama lengkap dengan nama lengkap anda.</li>
                            <li>Email : Isi kolom email dengan email aktif anda.</li>
                            <li>Nomor Telepon : Isi kolom nomor telepon dengan nomor telepon aktif anda. Dengan format pengisian : 08xxxxxxxxxx</li>
                            <li>Foto KTP : Isi kolom Foto KTP dengan foto KTP anda dengan jelas dan usahakan informasi dari KTP semuanya terlihat. <b>Format foto yang dikirim .jpg</b> .</li>
                            <li>Foto Bukti Vaksin Ke 2 : Isi kolom Foto Bukti Vaksin dengan hasil foto surat bukti vaksin ke-2 atau hasil screenshot dari aplikasi peduli lindungi (Identitas dari bukti vaksin harus sesuai dengan nama lengkap). <b>Format foto yang dikirim .jpg</b> .</li>
                        </ul>
                    </li>
                    <li>
                        Jika cabor yang dipilih adalah <b>selain PES 2021</b>, akan muncul tampilan seperti gambar dibawah ini (Gambar ini merupakan formulir dari cabor selain PES 2021). <br/>
                        <a title="Image" data-lightbox="image" href="<?= $this->Url->build('/front-assets-new/step3.png'); ?>" class="btn btn-light m-20"><img alt="Image" src="<?= $this->Url->build('/front-assets-new/step3.png'); ?>" /></a>
                    </li>
                    <li>
                        Jika yang muncul tampilan formulir seperti ini, lengkapi formulir dengan keterangan sebagai berikut :
                        <ul class="list-icon list-icon-uncheck list-icon-colored list2">
                            <li>Nama Tim : Isi kolom nama tim dengan nama tim anda.</li>
                            <li>Penanggung Jawab Tim : Isi kolom ini dengan nama penanggung jawab tim anda sebagai perwakilan dari tim yang bersangkutan.</li>
                            <li>Nomor Telepon Penanggung Jawab : Isi kolom ini dengan nomor telepon penanggung jawab tim anda. Dengan format pengisian : 08xxxxxxxxxx</li>
                            <li>Email Penanggung Jawab : Isi kolom ini dengan email aktif penanggung jawab tim anda.</li>
                            <li>Upload File Data Tim : Isi kolom ini dengan cara :
                                <ul class="list-icon list-icon-uncheck list-icon-colored list3">
                                    <li>Download terlebih dahulu file template yang telah disediakan pada tombol dibawah ini.<br/>
                                        <a title="Image" data-lightbox="image" href="<?= $this->Url->build('/front-assets-new/step5.png'); ?>" class="btn btn-light m-20"><img alt="Image" src="<?= $this->Url->build('/front-assets-new/step5.png'); ?>" /></a>
                                    </li>
                                    <li>Lalu isi file .docx tersebut dengan data diri anggota tim anda sesuai dengan format pengisian yang telah dicontohkan.</li>
                                    <li>Jika sudah diisi sesuai format, save nama file dengan nama tim anda. <b>Contoh : Jabar Esport.docx</b></li>
                                    <li>Setelah itu, upload kembali file .docx yang sudah diisi dengan data diri anggota tim anda <b>dengan format .docx</b></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        Setelah semua kolom dilengkapi, maka selanjutnya centang kolom dibawah ini sebagai persetujuan dari pihak pendaftar bahwa bersedia menyerahkan data pribadi sebagai Syarat Pendaftaran untuk mengikuti kompetisi ini.<br/>
                        <a title="Image" data-lightbox="image" href="<?= $this->Url->build('/front-assets-new/step21.png'); ?>" class="btn btn-light m-20"><img alt="Image" src="<?= $this->Url->build('/front-assets-new/step21.png'); ?>" /></a>
                    </li>
                    <li>Jika semua kolom sudah dilengkapi, selanjutnya klik tombol "SUBMIT" untuk mengirim data diri.</li>
                    <li>
                        Jika pendaftaran berhasil, maka akan muncul tampilan seperti dibawah ini. <br/>
                        <a title="Image" data-lightbox="image" href="<?= $this->Url->build('/front-assets-new/step4.png'); ?>" class="btn btn-light m-20"><img alt="Image" src="<?= $this->Url->build('/front-assets-new/step4.png'); ?>" /></a>
                    </li>
                    <li>Setelah berhasil melakukan pendaftaran, tunggu konfirmasi selanjutnya dari pihak penyelenggara melalui email / nomor telepon yang dicantumkan.</li>
                </ol>
            </div>
        </div>
    </div>
</section>
