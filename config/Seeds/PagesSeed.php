<?php
use Migrations\AbstractSeed;

/**
 * Pages seed.
 */
class PagesSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => '1',
                'title' => 'About Company',
                'slug' => 'about-company',
                'content' => '<div class="row p-b-50">
<div class="row team-members">
<div class="col-lg-8">
<div class="heading-text heading-section">
<h2>PT. DWI SUKMA MITRA ROTAMA</h2>
</div>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lacus viverra vitae congue eu consequat ac felis donec et. Integer eget aliquet nibh praesent tristique magna. Aliquam etiam erat velit scelerisque in. Enim ut sem viverra aliquet. Gravida neque convallis a cras semper auctor neque vitae. Cras ornare arcu dui vivamus arcu felis. Pulvinar pellentesque habitant morbi tristique senectus et. Amet luctus venenatis lectus magna. Ullamcorper a lacus vestibulum sed arcu. Vitae nunc sed velit dignissim sodales ut eu sem.</p>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lacus viverra vitae congue eu consequat ac felis donec et. Integer eget aliquet nibh praesent tristique magna. Aliquam etiam erat velit scelerisque in. Enim ut sem viverra aliquet. Gravida neque convallis a cras semper auctor neque vitae. Cras ornare arcu dui vivamus arcu felis. Pulvinar pellentesque habitant morbi tristique senectus et. Amet luctus venenatis lectus magna. Ullamcorper a lacus vestibulum sed arcu. Vitae nunc sed velit dignissim sodales ut eu sem.</p>
<div class="blockquote m-t-20">
<p>Art is the only serious thing in the world. And the artist is the only person who is never serious.</p>
<small>by <cite>Oscar Wilde</cite></small> 
</div>
</div>
<div class="col-lg-4">
<div class="team-member m-0">
<div class="team-image">
<img src="assets/images/team/9.jpg">
</div>
<div class="team-desc">
<h3>Babang Tamvan</h3>
<span>CEO Dwi Sukma Mitra Rotama</span>
<p>The most happiest time of the day!. Praesent tristique hendrerit ex ut laoreet. </p>
<div class="align-center">
<a class="btn btn-xs btn-slide btn-light" href="#">
<i class="fab fa-facebook-f"></i>
<span>Facebook</span>
</a>
<a class="btn btn-xs btn-slide btn-light" href="#" data-width="100">
<i class="fab fa-twitter"></i>
<span>Twitter</span>
</a>
<a class="btn btn-xs btn-slide btn-light" href="#" data-width="118">
<i class="fab fa-instagram"></i>
<span>Instagram</span>
</a>
<a class="btn btn-xs btn-slide btn-light" href="mailto:#" data-width="80">
<i class="far fa-envelope"></i>
<span>Mail</span>
</a>
</div>
</div>
</div>
</div>
</div>
<div style="background-image:url(assets/images/parallax/7.jpg); width: 100%;" class="call-to-action p-t-100 p-b-100 background-image m-t-50 m-b-50">
<div class="container">
<div class="row">
<div class="col-lg-10">
<h3 class="text-light">
Join by April 27 and <span>Win $200</span> in Programs and
Services
</h3>
<p class="text-light">
This is a simple hero unit, a simple call-to-action-style
component for calling extra attention to featured content.
</p>
</div>
<div class="col-lg-2">
<a class="btn btn-light btn-outline">Call us now!</a>
</div>
</div>
</div>
</div>
<div class="col-lg-12">
<div class="row">
<div class="col-lg-6">
<h3>Kenapa harus kami ?</h3>
<ul>
<li>Produknya adalah salah satu sektor yang membantu Negara dalam hal penghasilan pajak.</li>
<li>Tidak perlu product knowledge dalam memasarkannya.</li>
<li>Memanfaatkan market smokers yang luas dan repeat order yang sangat tinggi.</li>
<li>Kolaborasi konsep Konvensional &amp; bisnis e-commerce.</li>
<li>Menjadi Perusahaan distributor terbesar dalam bentuk Komunitas yang menikmati &amp; memasarkan Produk Rotama.</li>
</ul>
</div>
<div class="col-lg-6">
<h3>Visi Perusahaan</h3>
<ul>
<li>Mengubah paradigma Konsumtif menjadi lapangan usaha yang berpenghasilan tinggi.</li>
<li>Menciptakan pasar   aktif melalui system bagi hasil kepada semua mitra komunitas yang terdiri dari penikmat &amp; penjual Rotama yang telah bergabung didalamnya.</li>
<li>Disadari atau tidak; mendorong para Smoker agar gemar menabung melalui system Prosentase Repeat Order pembelanjaan mitra.</li>
<li>Mendorong mitra memiliki passive income yang dapat diwariskan.</li>
<li>Membantu pemerintah dalam upaya meminimalisir pengagngguran.</li>
<li>Menggerakkan sektor bisnis indonesia melalui produk lokal hasil karya anak bangsa.</li>
</ul>
</div>
</div>
</div>
</div>',
                'enable' => '1',
                'created' => '2019-10-10 20:09:20',
                'modified' => '2019-10-29 08:28:15',
            ],
            [
                'id' => '2',
                'title' => 'About Rotama',
                'slug' => 'about-rotama',
                'content' => '<div class="heading-text heading-section text-center">
<h2>ROTAMA</h2>
<img src="../assets/images/rokok/factory.jpg" class="img-fluid rounded" alt="">
<br>
<br>
<br>
<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lacus viverra vitae congue eu consequat ac felis donec et. Integer eget aliquet nibh praesent tristique magna. Aliquam etiam erat velit scelerisque in. Enim ut sem viverra aliquet. Gravida neque convallis a cras semper auctor neque vitae. Cras ornare arcu dui vivamus arcu felis. Pulvinar pellentesque habitant morbi tristique senectus et. Amet luctus venenatis lectus magna. Ullamcorper a lacus vestibulum sed arcu. Vitae nunc sed velit dignissim sodales ut eu sem.</span>
<br>
<span>ROTAMA adalah nama Merk rokok yang berasal dan diproduksi PR. Makmur di Tasikmalaya Jawa Barat sehingga disingkat menjadi  RO TA MA (Rokok Tasik Malaya).<br> Saat ini  Rotama memproduksi 4 Varian Brand yang terdiri dari: </span>
</div>
<div class="row team-members m-b-40">
<div class="col-lg-3">
<div class="team-member">
<div class="team-image">
<img src="../assets/images/rokok/aksa.jpg">
</div>
<div class="team-desc">
<h3>Rotama Aksa</h3>
<span>Varian Filter</span>
<p>The most happiest time of the day!. Praesent tristique hendrerit ex ut laoreet. </p>
<div class="align-center">
<a class="btn btn-xs btn-slide btn-light" href="#">
<i class="fab fa-facebook-f"></i>
<span>Facebook</span>
</a>
<a class="btn btn-xs btn-slide btn-light" href="#" data-width="100">
<i class="fab fa-twitter"></i>
<span>Twitter</span>
</a>
<a class="btn btn-xs btn-slide btn-light" href="#" data-width="118">
<i class="fab fa-instagram"></i>
<span>Instagram</span>
</a>
<a class="btn btn-xs btn-slide btn-light" href="mailto:#" data-width="80">
<i class="far fa-envelope"></i>
<span>Mail</span>
</a>
</div>
</div>
</div>
</div>
<div class="col-lg-3">
<div class="team-member">
<div class="team-image">
<img src="../assets/images/rokok/koper.jpg">
</div>
<div class="team-desc">
<h3>Rotama Koper</h3>
<span>Varian Kretek</span>
<p>The most happiest time of the day!. Praesent tristique hendrerit ex ut laoreet. </p>
<div class="align-center">
<a class="btn btn-xs btn-slide btn-light" href="#">
<i class="fab fa-facebook-f"></i>
<span>Facebook</span>
</a>
<a class="btn btn-xs btn-slide btn-light" href="#" data-width="100">
<i class="fab fa-twitter"></i>
<span>Twitter</span>
</a>
<a class="btn btn-xs btn-slide btn-light" href="#" data-width="118" style="width: 28px;">
<i class="fab fa-instagram"></i>
<span>Instagram</span>
</a>
<a class="btn btn-xs btn-slide btn-light" href="mailto:#" data-width="80">
<i class="far fa-envelope"></i>
<span>Mail</span>
</a>
</div>
</div>
</div>
</div>
<div class="col-lg-3">
<div class="team-member">
<div class="team-image">
<img src="../assets/images/rokok/pulen.jpg">
</div>
<div class="team-desc">
<h3>Rotama Pulen</h3>
<span>Varian Kretek</span>
<p>The most happiest time of the day!. Praesent tristique hendrerit ex ut laoreet. </p>
<div class="align-center">
<a class="btn btn-xs btn-slide btn-light" href="#">
<i class="fab fa-facebook-f"></i>
<span>Facebook</span>
</a>
<a class="btn btn-xs btn-slide btn-light" href="#" data-width="100">
<i class="fab fa-twitter"></i>
<span>Twitter</span>
</a>
<a class="btn btn-xs btn-slide btn-light" href="#" data-width="118" style="width: 28px;">
<i class="fab fa-instagram"></i>
<span>Instagram</span>
</a>
<a class="btn btn-xs btn-slide btn-light" href="mailto:#" data-width="80">
<i class="far fa-envelope"></i>
<span>Mail</span>
</a>
</div>
</div>
</div>
</div>
<div class="col-lg-3">
<div class="team-member">
<div class="team-image">
<img src="../assets/images/rokok/arsen.jpg">
</div>
<div class="team-desc">
<h3>Rotama Arsen</h3>
<span>Varian Filter</span>
<p>The most happiest time of the day!. Praesent tristique hendrerit ex ut laoreet. </p>
<div class="align-center">
<a class="btn btn-xs btn-slide btn-light" href="#">
<i class="fab fa-facebook-f"></i>
<span>Facebook</span>
</a>
<a class="btn btn-xs btn-slide btn-light" href="#" data-width="100">
<i class="fab fa-twitter"></i>
<span>Twitter</span>
</a>
<a class="btn btn-xs btn-slide btn-light" href="#" data-width="118" style="width: 28px;">
<i class="fab fa-instagram"></i>
<span>Instagram</span>
</a>
<a class="btn btn-xs btn-slide btn-light" href="mailto:#" data-width="80">
<i class="far fa-envelope"></i>
<span>Mail</span>
</a>
</div>
</div>
</div>
</div>
</div>',
                'enable' => '1',
                'created' => '2019-10-23 03:53:58',
                'modified' => '2019-10-31 09:31:52',
            ],
            [
                'id' => '3',
                'title' => 'Register Package',
                'slug' => 'register-package',
                'content' => '<div class="heading-text heading-line text-center">
<h3>Daftar + Belanja 1 slop Rotama mix = Rp.200.000,-</h3>
</div>

<div class="row m-t-80 m-b-40">
<div class="col-lg-5 col-m-t-40">
<img src="/assets/images/pages/register.png" width="100%" height="auto">
</div>
<div class="col-lg-7 ">
<h4>
Mendapatkan paket :
</h4>
<ol>
<li>1 Slop Rotama</li>
<li>Id Card Kemitraan</li>
<li>Virtual Office (Peluang Bisnis)</li>
<li>Pelatihan Edukasi marketing entrepreneur</li>
<li>Menawarkan beberapa potensi keuntungan dari peluang bisnis diantaranya:
<ul>
<li>Komisi promosi 19 generasi (mingguan) </li>
<li>Komisi belanja pribadi 35% dari rabat belanja pribadi (bulanan) </li>
<li>Komisi jenjang karir total 60% dari Omzet Rabat Group (bulanan) </li>
<li>Komisi peringkat KACAB 5% dari rabat nasional (bulanan) </li>
<li>Komisi Rp.50/bungkus untuk KACAB dari omzet cabang tersebut (Real Time) </li>
<li>Komisi Stokis dari paket registrasi Rp.10.000/paket Dan Rp.100/bungkus Dari belanja ulang (Real Time)</li>
</ul>
</li>
</ol>
<p></p>
</div>
</div>

<div class="call-to-action p-t-50 p-b-50 call-to-action-dark">
<div class="container">
<div class="row">
<div class="col-lg-10">
<h2 class="text-light">
Bergabung sekarang bersama kami
</h2>
<p class="text-light">
MEngubah Pengeluaran Menjadi Sumber Penghasilan.
</p>
</div>
<div class="col-lg-2">
<a class="btn btn-light btn-outline" href="https://rotama.nevsky.tech/sign-up">Sign Up</a>
</div>
</div>
</div>
</div>',
                'enable' => '1',
                'created' => '2019-10-23 06:01:14',
                'modified' => '2019-11-08 08:46:38',
            ],
            [
                'id' => '4',
                'title' => 'Privacy Policies',
                'slug' => 'privacy-policies',
                'content' => '<style type="text/css">
.bold{font-weight: 700; margin-bottom: 20px;}
.normal{font-weight: normal !important;}
p{font-family: Nunito,Helvetica,Arial,sans-serif; color: #565656;}
</style>

<div class="heading-text heading-line text-center">
<h4>Kebijakan dan Privasi</h4>
</div>

<p>Adanya Kebijakan Privasi ini adalah komitmen nyata dari PT. Dwi Sukma Mitra Rotama untuk menghargai dan melindungi setiap data atau informasi pribadi Pengguna situs www.gardukita.com, situs-situs turunannya, serta aplikasi gawai PT.Dwi Sukma Mitra Rotama (selanjutnya disebut sebagai "Situs").</p>
<p>Kebijakan Privasi ini (beserta syarat-syarat penggunaan dari situs PT.Dwi Sukma Mitra Rotama sebagaimana tercantum dalam "Syarat &amp; Ketentuan" dan informasi lain yang tercantum di Situs) menetapkan dasar atas perolehan, pengumpulan, pengolahan, penganalisisan, penampilan, pembukaan, dan/atau segala bentuk pengelolaan yang terkait dengan data atau informasi yang Pengguna berikan kepada PT.Dwi Sukma Mitra Rotama atau yang PT.Dwi Sukma Mitra Rotama kumpulkan dari Pengguna, termasuk data pribadi Pengguna, baik pada saat Pengguna melakukan pendaftaran di Situs, mengakses Situs, maupun mempergunakan layanan-layanan pada Situs (selanjutnya disebut sebagai "data").</p>
<p>Dengan mengakses dan/atau mempergunakan layanan PT.Dwi Sukma Mitra Rotama, Pengguna menyatakan bahwa setiap data Pengguna merupakan data yang benar dan sah, serta Pengguna memberikan persetujuan kepada PT.Dwi Sukma Mitra Rotama untuk memperoleh, mengumpulkan, menyimpan, mengelola dan mempergunakan data tersebut sebagaimana tercantum dalam Kebijakan Privasi maupun Syarat dan Ketentuan PT.Dwi Sukma Mitra Rotama.</p>
<br>
<ol type="A">
<li class="bold">
<h5>Perolehan dan Pengumpulan Data Pengguna</h5>
<ol type="1" class="normal">
<li class="normal">PT.Dwi Sukma Mitra Rotama.mengumpulkan data Pengguna dengan tujuan untuk memproses transaksi Pengguna, mengelola dan memperlancar proses penggunaan Situs, serta tujuan-tujuan lainnya selama diizinkan oleh peraturan perundang-undangan yang berlaku;</li>
<li class="normal">Data yang diserahkan secara mandiri oleh Pengguna, termasuk namun tidak terbatas pada data yang diserahkan pada saat Pengguna;</li>
<li class="normal">Membuat atau memperbarui akun PT.Dwi Sukma Mitra Rotama., termasuk diantaranya nama pengguna (username), alamat email, nomor telepon, password, alamat, foto, dan lain-lain;</li>
<li class="normal">Menghubungi PT.Dwi Sukma Mitra Rotama.termasuk melalui layanan konsumen; </li>
<li class="normal">Mengisi survei yang dikirimkan oleh PT.Dwi Sukma Mitra Rotama.atau atas nama PT.Dwi Sukma Mitra Rotama.</li>
<li class="normal">Melakukan interaksi dengan Pengguna lainnya melalui fitur pesan, diskusi produk, ulasan, rating, Pusat Resolusi dan sebagainya; </li>
<li class="normal">Mempergunakan layanan-layanan pada Situs, termasuk data transaksi yang detil, diantaranya jenis, jumlah dan/atau keterangan dari produk atau layanan yang dibeli, alamat pengiriman, kanal pembayaran yang digunakan, jumlah transaksi, tanggal dan waktu transaksi, serta detil transaksi lainnya; </li>
<li class="normal">Mengisi data-data pembayaran pada saat Pengguna melakukan aktivitas transaksi pembayaran melalui Situs, termasuk namun tidak terbatas pada data rekening bank, kartu kredit, virtual account, instant payment, internet banking, gerai ritel; dan/atau </li>
<li class="normal">Menggunakan fitur yang membutuhkan izin akses terhadap perangkat Pengguna. </li>
<li class="normal">Data yang terekam pada saat Pengguna mempergunakan Situs, termasuk namun tidak terbatas pada: </li>
<li class="normal">
Data lokasi riil atau perkiraannya seperti alamat IP, lokasi Wi-Fi, geo-location, dan sebagainya;
<ol type="i">
<li>Data berupa waktu dari setiap aktivitas Pengguna, termasuk aktivitas pendaftaran, login, transaksi, dan lain sebagainya;</li>
<li>Data penggunaan atau preferensi Pengguna, diantaranya interaksi Pengguna dalam menggunakan Situs, pilihan yang disimpan, serta pengaturan yang dipilih. Data tersebut diperoleh menggunakan cookies, pixel tags, dan teknologi serupa yang menciptakan dan mempertahankan pengenal unik; </li>
<li>Data perangkat, diantaranya jenis perangkat yang digunakan untuk mengakses Situs, termasuk model perangkat keras, sistem operasi dan versinya, perangkat lunak, nama file dan versinya, pilihan bahasa, pengenal perangkat unik, pengenal iklan, nomor seri, informasi gerakan perangkat, dan/atau informasi jaringan seluler; </li>
<li>Data catatan (log), diantaranya catatan pada server yang menerima data seperti alamat IP perangkat, tanggal dan waktu akses, fitur aplikasi atau laman yang dilihat, proses kerja aplikasi dan aktivitas sistem lainnya, jenis peramban, dan/atau situs atau layanan pihak ketiga yang Anda gunakan sebelum berinteraksi dengan Situs. </li>
</ol>
</li>
<li class="normal">
Data yang diperoleh dari sumber lain, termasuk:
<ol type="i">
<li>Mitra usaha <strong>PT. Dwi Sukma Mitra Rotama</strong> yang turut membantu dalam mengembangkan dan menyajikan Mitra usaha <strong>PT. Dwi Sukma Mitra Rotama</strong> tempat Pengguna membuat atau mengakses akun www.gardukita.com, seperti layanan media social. </li>
<li>Penyedia layanan pemasaran; </li>
<li>Sumber yang tersedia secara umum.</li>
</ol>
PT. Dwi Sukma Mitra Rotama dapat menggabungkan data yang diperoleh dari sumber tersebut dengan data lain yang dimilikinya.
</li>
</ol>
</li>
<li class="bold">
<h5>Penggunaan Data </h5>
<p>
<strong>PT. Dwi Sukma Mitra Rotama</strong>  dapat menggunakan keseluruhan atau sebagian data yang diperoleh dan dikumpulkan dari Pengguna sebagaimana disebutkan dalam bagian sebelumnya untuk hal-hal sebagai berikut:
</p>
<ol type="a" class="normal">
<li class="normal">Memproses segala bentuk permintaan, aktivitas maupun transaksi yang dilakukan oleh Pengguna melalui Situs, termasuk untuk keperluan pengiriman produk kepada Pengguna. </li>
<li class="normal">
Penyediaan fitur-fitur untuk memberikan, mewujudkan, memelihara dan memperbaiki produk dan layanan kami, termasuk:
<ol type="i">
<li>Menawarkan layanan promosi melalui media social seperti Channel Youtube dll.</li>
<li>Melakukan kegiatan internal yang diperlukan untuk menyediakan layanan pada situs/aplikasi www.gardukita.com, seperti pemecahan masalah software, bug, permasalahan operasional, melakukan analisis data, pengujian, dan penelitian, dan untuk memantau dan menganalisis kecenderungan penggunaan dan aktivitas.</li>
</ol>
</li>
<li class="normal">
Membantu Pengguna pada saat berkomunikasi dengan Layanan Pelanggan PT. Dwi Sukma Mitra Rotama, diantaranya untuk:
<ol type="i">
<li>Memeriksa dan mengatasi permasalahan Pengguna; </li>
<li>Mengarahkan pertanyaan Pengguna kepada petugas Layanan Pelanggan yang tepat untuk mengatasi permasalahan; dan</li>
<li>Mengawasi dan memperbaiki tanggapan Layanan Pelanggan gardukita.</li>
</ol>
</li>
<li class="normal">Menghubungi Pengguna melalui email, surat, telepon, fax, dan lain-lain, termasuk namun tidak terbatas, untuk membantu dan/atau menyelesaikan proses transaksi maupun proses penyelesaian kendala.</li>
<li class="normal">Menggunakan informasi yang diperoleh dari Pengguna untuk tujuan penelitian, analisis, pengembangan dan pengujian produk guna meningkatkan keamanan dan keamanan layanan-layanan pada Situs, serta mengembangkan fitur dan produk baru.</li>
<li class="normal">Menginformasikan kepada Pengguna terkait produk, layanan, promosi, studi, survei, berita, perkembangan terbaru, acara dan lain-lain, baik melalui Situs maupun melalui media lainnya. gardukita juga dapat menggunakan informasi tersebut untuk mempromosikan dan memproses kontes dan undian, memberikan hadiah, serta menyajikan iklan dan konten yang relevan tentang layanan gardukita dan mitra usahanya. </li>
<li class="normal">Melakukan monitoring ataupun investigasi terhadap transaksi-transaksi mencurigakan atau transaksi yang terindikasi mengandung unsur kecurangan atau pelanggaran terhadap Syarat dan Ketentuan atau ketentuan hukum yang berlaku, serta melakukan tindakan-tindakan yang diperlukan sebagai tindak lanjut dari hasil monitoring atau investigasi transaksi tersebut. </li>
<li class="normal">Dalam keadaan tertentu, gardukita mungkin perlu untuk menggunakan ataupun mengungkapkan data Pengguna untuk tujuan penegakan hukum atau untuk pemenuhan persyaratan hukum dan peraturan yang berlaku, termasuk dalam hal terjadinya sengketa atau proses hukum antara Pengguna dan gardukita.</li>
</ol>
</li>
<li class="bold">
<h5>Pengungkapan Data Pribadi Pengguna</h5>
<p>Gardukita menjamin tidak ada penjualan, pengalihan, distribusi atau meminjamkan data pribadi Anda kepada pihak ketiga lain, tanpa terdapat izin dari Anda, kecuali dalam hal-hal sebagai berikut: </p>
<ol type="a" class="normal">
<li class="normal">Dibutuhkan adanya pengungkapan data Pengguna kepada mitra atau pihak ketiga lain yang membantu gardukita dalam menyajikan layanan pada Situs dan memproses segala bentuk aktivitas Pengguna dalam Situs, termasuk memproses transaksi, verifikasi pembayaran, pengiriman produk, dan lain-lain.</li>
<li class="normal">Gardukita dapat menyediakan informasi yang relevan kepada mitra usaha sesuai dengan persetujuan Pengguna untuk menggunakan layanan mitra usaha, termasuk diantaranya aplikasi atau situs lain yang telah saling mengintegrasikan API atau layanannya, atau mitra usaha yang mana Gardukita telah bekerjasama untuk mengantarkan promosi, kontes, atau layanan yang dikhususkan </li>
<li class="normal">Dibutuhkan adanya komunikasi antara mitra usaha Gardukita (seperti penyedia logistik, pembayaran, dan lain-lain) dengan Pengguna dalam hal penyelesaian kendala maupun hal-hal lainnya. </li>
<li class="normal">Gardukita dapat menyediakan informasi yang relevan kepada vendor, konsultan, mitra pemasaran, firma riset, atau penyedia layanan sejenis.</li>
<li class="normal">Pengguna menghubungi Gardukita melalui media publik seperti blog, media sosial, dan fitur tertentu pada Situs, komunikasi antara Pengguna dan Gardukita mungkin dapat dilihat secara publik. </li>
<li class="normal">Gardukita dapat membagikan informasi Pengguna kepada anak perusahaan dan afiliasinya untuk membantu memberikan layanan atau melakukan pengolahan data untuk dan atas nama Gardukita. </li>
<li class="normal">Gardukita mengungkapkan data Pengguna dalam upaya mematuhi kewajiban hukum dan/atau adanya permintaan yang sah dari aparat penegak hukum. </li>
</ol>
</li>
<li class="bold">
<h5>Pilihan Pengguna dan Transparansi</h5> 
<ol type="a" class="normal">
<li class="normal">Setelah transaksi jual beli melalui Gardukita berhasil, Penjual maupun Pembeli memiliki kesempatan untuk memberikan penilaian dan ulasan terhadap satu sama lain. Informasi ini mungkin dapat dilihat secara publik dengan persetujuan Pengguna.</li>
<li class="normal">Pengguna dapat mengakses dan mengubah informasi berupa alamat email, nomor telepon, tanggal lahir, jenis kelamin, daftar alamat, metode pembayaran, dan rekening bank melalui fitur Pengaturan pada Situs.</li>
<li class="normal">Pengguna dapat menarik diri dari informasi atau notifikasi berupa buletin, ulasan, diskusi produk, pesan pribadi, atau pesan pribadi dari Admin yang dikirimkan oleh Gardukita melalui fitur Pengaturan pada Situs. Gardukita tetap dapat mengirimkan pesan atau email berupa keterangan transaksi atau informasi terkait akun Pengguna.</li>
<li class="normal">Sejauh diizinkan oleh ketentuan yang berlaku, Pengguna dapat menghubungi Gardukita untuk melakukan penarikan persetujuan terhadap perolehan, pengumpulan, penyimpanan, pengelolaan dan penggunaan data Pengguna. Apabila terjadi demikian maka Pengguna memahami konsekuensi bahwa Pengguna tidak dapat menggunakan layanan Situs maupun layanan Gardukita lainnya.</li>
</ol>
</li>
<li class="bold">
<h5>Pembaruan Kebijakan Privasi</h5>
<p>Gardukita dapat sewaktu-waktu melakukan perubahan atau pembaruan terhadap Kebijakan Privasi ini. gardukitra menyarankan agar Pengguna membaca secara seksama dan memeriksa halaman Kebijakan Privasi ini dari waktu ke waktu untuk mengetahui perubahan apapun. Dengan tetap mengakses dan menggunakan layanan Situs maupun layanan Gardukita lainnya, maka Pengguna dianggap menyetujui perubahan-perubahan dalam Kebijakan Privasi.</p> 
</li>
</ol>
',
                'enable' => '1',
                'created' => '2019-10-25 06:14:30',
                'modified' => '2019-10-29 04:47:58',
            ],
            [
                'id' => '5',
                'title' => 'Term & Condition',
                'slug' => 'term-and-condition',
                'content' => '<style type="text/css">
.bold{font-weight: 700; margin-bottom: 20px;}
.normal{font-weight: normal !important;}
p{font-family: Nunito,Helvetica,Arial,sans-serif; color: #565656;}
</style>

<div class="heading-text heading-line text-center">
<h4>Syarat &amp; Ketentuan</h4>
<small>Selamat datang di <strong>www.gardukita.com.</strong></small>
</div>

<p>Syarat &amp; ketentuan yang ditetapkan di bawah ini mengatur pemakaian jasa yang ditawarkan oleh PT. Dwi Sukma Mitra Rotama terkait penggunaan situs www.gardukita.com. Pengguna disarankan membaca dengan seksama karena dapat berdampak kepada hak dan kewajiban Pengguna di bawah hukum. </p>
<p>Dengan mendaftar dan/atau menggunakan situs www.gardukita.com, maka pengguna dianggap telah membaca, mengerti, memahami dan menyetujui semua isi dalam Syarat &amp; ketentuan. Syarat &amp; ketentuan ini merupakan bentuk kesepakatan yang dituangkan dalam sebuah perjanjian yang sah antara Pengguna dengan PT. Dwi Sukma Mitra Rotama. Jika pengguna tidak menyetujui salah satu, sebagian, atau seluruh isi Syarat &amp; ketentuan, maka pengguna tidak diperkenankan menggunakan layanan di www.gardukita.com. </p>
<br>
<ol type="A">
<li class="bold">
<h5>Definisi</h5>
<ol type="1" class="normal">
<li class="normal">PT. Dwi Sukma Mitra Rotama adalah suatu perseroan terbatas yang menjalankan kegiatan usaha jasa web portal www.gardukita.com, yakni situs penjualan Barang yang dijual oleh penjual terdaftar. Selanjutnya disebut gardukita.</li>
<li class="normal">Situs PT. Dwi Sukma Mitra Rotama adalah www.gardukita.com.</li>
<li class="normal">Syarat &amp; ketentuan adalah perjanjian antara Pengguna dan PT. Dwi Sukma Mitra Rotama yang berisikan seperangkat peraturan yang mengatur hak, kewajiban, tanggung jawab pengguna dan Gardukita serta tata cara penggunaan sistem layanan gardukita.</li>
<li class="normal">Pengguna adalah pihak yang menggunakan layanan Gardukita, termasuk namun tidak terbatas pada pembeli, penjual maupun pihak lain yang sekedar berkunjung ke Situs gardukita.</li>
<li class="normal">Pembeli adalah Pengguna terdaftar yang melakukan permintaan atas Barang yang dijual oleh PT. Dwi Sukma Mitra Rotama di Situs gardukita.com</li>
<li class="normal">Barang adalah benda yang berwujud / memiliki fisik Barang yang dapat diantar / memenuhi kriteria pengiriman oleh perusahaan jasa pengiriman Barang. </li>
<li class="normal">Saldo Penghasilan adalah fasilitas penampungan sementara atas dana milik Penjual (bukan fasilitas penyimpanan dana), yang disediakan Gardukita untuk menampung dana hasil menjalankan hak usaha di PT. Dwi Sukma Mitra. Dana ini hanya dapat ditarik ke akun bank yang terdaftar dan dapat digunakan kembali untuk melakukan pembelian pada Situs Gardukita.</li>
<li class="normal">Feed adalah fitur pada Situs/Aplikasi Gardukita yang menampilkan konten dari Penjual, KOL, atau pihak lainnya terkait Barang tertentu.</li>
<li class="normal">Key Opinion Leaders atau KOL adalah pihak yang mempromosikan Barang atau Penjual tertentu melalui Feed. </li>
<li class="normal">Rekening Resmi PT. Dwi Sukma Mitra Rotama adalah rekening yang mutlak untuk bertransaksi dengan mitra (member).</li>
</ol>
</li>
<li class="bold">
<h5>Kode Etik</h5>
<ol type="1" class="normal">
<li class="normal">Mitra bersedia mempromosikan produk yang ditawarkan oleh perusahaan serta menjaga nama baik perusahaan maupun individu yang terkait dengan kegiatan bisnis gardukita.</li>
<li class="normal">Seluruh mitra menyetujui dan memahami tentang penerapan biaya pendaftaran serta perubahan harga-harga produk yang ditawarkan</li>
<li class="normal">Bagi Mitra yang sudah memiliki peringkat supervisor keatas bersedia untuk tidak menjalankan bisnis serupa walaupun dengan produk yang berbeda.</li>
<li class="normal">Mitra boleh menghibahkan keanggotaan dengan cara mengajukan secara tertulis guna untuk menggantikan ahli waris dan nomor rekening penerima komisi.</li>
</ol>
</li>
<li class="bold">
<h5>Akun, Saldo Penghasilan, Password dan Keamanan</h5>
<ol type="a" class="normal">
<li class="normal">Pengguna dengan ini menyatakan bahwa pengguna adalah orang yang cakap dan mampu untuk mengikatkan dirinya dalam sebuah perjanjian yang sah menurut hukum.</li>
<li class="normal">gardukita memungut biaya pendaftaran kepada Pengguna tutuannya untuk memaksimalkan layanan bisnis kemitraan dengan pola dari kita oleh kita untuk kita.</li>
<li class="normal">
Pengguna yang telah mendaftar berhak bertindak sebagai:
<ul>
<li>Pembeliâ€‹</li>
<li>Penjual, dengan memanfaatkan layanan Afiliasi. </li>
</ul>
</li>
<li class="normal">Gardukita tanpa pemberitahuan terlebih dahulu kepada Pengguna, memiliki kewenangan untuk melakukan tindakan yang perlu atas setiap dugaan pelanggaran atau pelanggaran Syarat &amp; ketentuan dan/atau hukum yang berlaku, yakni tindakan berupa teguran lisan, surat peringatan, sampai penghapusan akun pengguna. </li>
<li class="normal">Gardukita memiliki kewenangan untuk menutup afiliasi atau akun Pengguna baik sementara maupun permanen apabila didapati adanya tindakan kecurangan dalam bertransaksi dan/atau pelanggaran terhadap syarat dan ketentuan gardukita. Pengguna menyetujui bahwa Gardukita berhak melakukan tindakan lain yang diperlukan terkait hal tersebut, termasuk namun tidak terbatas pada menolak pengajuan pembukaan akun yang baru apabila ditemukan kesamaan data. </li>
<li class="normal">Pengguna dilarang untuk menciptakan dan/atau menggunakan perangkat, software, fitur dan/atau alat lainnya yang bertujuan untuk melakukan manipulasi pada sistem Gardukita, termasuk aktivitas lain yang secara wajar dapat dinilai sebagai tindakan manipulasi sistem. </li>
<li class="normal">Saldo komisi dapat dilakukan penarikan dana (withdrawal) ke rekening bank yang terdaftar pada akun Pengguna. </li>
<li class="normal">Saldo Penghasilan hanya berasal dari komisi affiliate pada Situs Gardukita dan tidak bisa dilakukan penambahan secara sendiri (top up). </li>
<li class="normal">Gardukita memiliki kewenangan untuk melakukan pembekuan Saldo Penghasilan Pengguna apabila ditemukan / diduga adanya tindak kecurangan dalam bertransaksi dan/atau pelanggaran terhadap syarat dan ketentuan Gardukita. </li>
<li class="normal">Pengguna memiliki hak untuk mengubah nama akun, kecuali nomor rekening dan ahli waris. </li>
<li class="normal">Pengguna bertanggung jawab secara pribadi untuk menjaga kerahasiaan akun dan password untuk semua aktivitas yang terjadi dalam akun Pengguna.</li>
<li class="normal">Gardukita tidak akan meminta username, password maupun kode SMS verifikasi atau kode OTP milik akun Pengguna untuk alasan apapun, oleh karena itu Gardukita menghimbau Pengguna agar tidak memberikan data tersebut maupun data penting lainnya kepada pihak yang mengatasnamakan Gardukita atau pihak lain yang tidak dapat dijamin keamanannya. </li>
<li class="normal">Pengguna setuju untuk memastikan bahwa Pengguna keluar dari akun di akhir setiap sesi dan memberitahu Gardukita jika ada penggunaan tanpa izin atas sandi atau akun Pengguna. </li>
<li class="normal">Pengguna dengan ini menyatakan bahwa Gardukita tidak bertanggung jawab atas kerugian ataupun kendala yang timbul atas penyalahgunaan akun Pengguna yang diakibatkan oleh kelalaian Pengguna, termasuk namun tidak terbatas pada meminjamkan atau memberikan akses akun kepada pihak lain, mengakses link atau tautan yang diberikan oleh pihak lain, memberikan atau memperlihatkan kode verifikasi (OTP), password atau email kepada pihak lain, maupun kelalaian Pengguna lainnya yang mengakibatkan kerugian ataupun kendala pada akun Pengguna. </li>
</ol>
</li>
<li class="bold">
<h5>Transaksi Pembelian</h5>
<ol type="a" class="normal">
<li class="normal">Pembeli wajib bertransaksi melalui prosedur transaksi yang telah ditetapkan oleh Gardukita. Pembeli melakukan pembayaran dengan menggunakan metode pembayaran yang sebelumnya telah dipilih oleh Pembeli, dan kemudian Gardukita akan meneruskan dana ke pihak admin penyedia barang.</li>
<li class="normal">
Saat melakukan pembelian Barang, Pembeli menyetujui bahwa:
<ol type="a">
<li>Pembeli bertanggung jawab untuk membaca, memahami, dan menyetujui informasi/deskripsi keseluruhan Barang (termasuk didalamnya namun tidak terbatas pada warna, kualitas, fungsi, dan lainnya) sebelum membuat tawaran atau komitmen untuk membeli.</li>
<li>Pengguna masuk ke dalam kontrak yang mengikat secara hukum untuk membeli Barang ketika Pengguna membeli barang tsb.</li>
</ol>
</li>
<li class="normal">Pembeli memahami dan menyetujui bahwa ketersediaan stok Barang merupakan tanggung jawab Penjual yang menawarkan Barang tersebut. Terkait ketersediaan stok Barang dapat berubah sewaktu-waktu, sehingga dalam keadaan stok Barang kosong, maka gardukita akan menolak order, dan pembayaran atas barang yang dipesan.</li>
<li class="normal">Pembeli memahami sepenuhnya dan menyetujui bahwa segala transaksi yang dilakukan antara member dan perusahaan selain melalui Rekening Resmi PT. Dwi Sukma Mitra Rotama dan/atau tanpa sepengetahuan gardukita (melalui fasilitas/jaringan pribadi, pengiriman pesan, pengaturan transaksi khusus diluar situs gardukita atau upaya lainnya) adalah merupakan tanggung jawab pribadi dari Pembeli. </li>
<li class="normal">Konfirmasi pembayaran dengan setoran tunai wajib disertai dengan berita pada slip setoran berupa nomor invoice dan nama. Konfirmasi pembayaran dengan setoran tunai tanpa keterangan tidak akan diproses oleh Gardukita. </li>
<li class="normal">Pembeli menyetujui untuk tidak memberitahukan atau menyerahkan bukti pembayaran dan/atau data pembayaran kepada pihak lain selain gardukita. Dalam hal terjadi kerugian akibat pemberitahuan atau penyerahan bukti pembayaran dan/atau data pembayaran oleh Pembeli kepada pihak lain, maka hal tersebut akan menjadi tanggung jawab Pembeli. </li>
<li class="normal">Member wajib melakukan konfirmasi penerimaan Barang, setelah menerima kiriman Barang yang dibeli. </li>
<li class="normal">Member memahami dan menyetujui bahwa setiap klaim yang dilayangkan setelah adanya konfirmasi / konfirmasi otomatis penerimaan Barang adalah bukan menjadi tanggung jawab gardukita. Kerugian yang timbul setelah adanya konfirmasi/konfirmasi otomatis penerimaan Barang menjadi tanggung jawab Pembeli secara pribadi. </li>
<li class="normal">Apabila Pembeli memilih menggunakan metode pembayaran transfer bank, maka total pembayaran akan ditambahkan kode unik untuk mempermudah proses verifikasi. Dalam hal pembayaran telah diverifikasi maka kode unik akan dikembalikan ke Saldo Refund Pembeli. </li>
<li class="normal">Pembeli memahami sepenuhnya dan menyetujui bahwa invoice yang diterbitkan adalah atas nama Penjual. </li>
</ol>
</li>
<li class="bold">
<h5>Komisi </h5>
<p>Gardukita memberlakukan system pembayaran komisi dengan minimum transfer Rp.100.000 dan akan dikenakan biaya layanan untuk mitra yang sudah mendapatkan komisi diatas 2 juta rupiah. </p>
</li>
<li class="bold">
<h5>Harga</h5>
<ol type="a" class="normal">
<li class="normal">Harga Barang yang terdapat dalam situs gardukita adalah harga yang ditetapkan oleh perusahaan. Dan dilarang memanipulasi harga barang dengan cara apapun.</li>
<li class="normal">Biaya pendaftaran dan harga barang tersebut sewaktu waktu bias berubah seiring adanya kenaikan bahan baku atau kebijakan adanya regulasi pemerintah.</li>
<li class="normal">Pembeli memahami dan menyetujui bahwa kesalahan keterangan harga dan informasi lainnya yang disebabkan tidak terbaharuinya atau terlambat updeta halaman situs gardukita.</li>
<li class="normal">Situs Gardukita untuk saat ini hanya melayani transaksi jual beli Barang dalam mata uang Rupiah. </li>
</ol>
</li>
<li class="bold">
<h5>Tarif Pengiriman</h5>
<p>
Mitra memahami dan mengerti bahwa perusahaan telah melakukan usaha sebaik mungkin dalam memberikan informasi tarif pengiriman kepada Pembeli berdasarkan lokasi secara akurat, namun gardukita tidak dapat menjamin keakuratan data tersebut dengan yang ada pada cabang setempat.<br>
Mitra memahami dan menyetujui bahwa selisih biaya pengiriman Barang adalah di luar tanggung jawab Perusahaan, dan oleh karena itu, adalah kebijakan penjual sendiri untuk membatalkan atau tetap melakukan pengiriman Barang.
</p>
</li>
<li class="bold">
<h5>Konten </h5>
<ol type="a" class="normal">
<li class="normal">Setiap mitra bersedia membantu mempromosikan konten channel promosi perusahaan demi kepentingan bersama antara perusahaan dan mitra.</li>
<li class="normal">Konten atau materi yang akan ditampilkan atau ditayangkan pada Situs/Aplikasi Gardukita melalui Feed akan tunduk pada Ketentuan Situs, peraturan hukum, serta etika pariwara yang berlaku.</li>
<li class="normal">KOL, Pengguna atau pihak lainnya yang menggunakan fitur Feed bertanggungjawab penuh terhadap konten  </li>
</ol>
</li>
<li class="bold">
<h5>Promo</h5>
<p>Gardukita sewaktu-waktu dapat mengadakan kegiatan promosi (selanjutnya disebut sebagai â€œPromoâ€) dengan Syarat dan Ketentuan yang mungkin berbeda pada masing-masing kegiatan Promo. Pengguna dihimbau untuk membaca dengan seksama Syarat dan Ketentuan Promo tersebut. </p>
</li>
<li class="bold">
<h5>Pengiriman Barang</h5>
</li><li class="normal">Pengiriman Barang dari perusahaan hanya dilakukan kepada stokist dan cabang resmi. </li>
<li class="normal">Biaya pengiriman gratis hanya bagi member/stokit/cabang dengan kuntiti tertentu.</li>
<li class="normal">Selama masa promosi perusahaan akan melayani pesanan member biasa dengan syarat minimum kuantity. </li>
<li class="normal">Setiap ketentuan berkenaan dengan proses pengiriman Barang adalah wewenang sepenuhnya penyedia jasa layanan pengiriman Barang.</li>
<li class="normal">Jasa pengiriman barang hanya akan dilakukan melalui jasa pengiriman yang sudah kerjasama dengan perusahaan.</li>

<li class="bold">
<h5>Penarikan Dana</h5>
<p>Penarikan dana sesama bank akan diproses dalam waktu 1x24 jam hari kerja, sedangkan penarikan dana antar bank akan diproses dalam waktu 2x24 jam hari kerja. </p>
</li>
<li class="bold">
<h5>Pelepasan</h5>
<p>Jika Anda memiliki perselisihan dengan satu atau lebih member, Anda melepaskan Gardukita (termasuk Induk Perusahaan, Direktur, dan karyawan) dari klaim dan tuntutan atas kerusakan dan kerugian (aktual dan tersirat) dari setiap jenis dan sifatnya , yang dikenal dan tidak dikenal, yang timbul dari atau dengan cara apapun berhubungan dengan sengketa posisi jaringan dan perekrutan mitra juga jual beri produk <strong>PT. Dwi Sukma Mitra Rotama.</strong></p>
</li>
<li class="bold">
<h5>Ganti Rugi</h5>
<p>Mitra akan melepaskan Gardukita dari tuntutan ganti rugi dan menjaga perusahaan (termasuk Induk Perusahaan, direktur, dan karyawan) dari setiap klaim atau tuntutan, termasuk biaya hukum yang wajar, yang dilakukan oleh pihak ketiga yang timbul dalam hal Anda melanggar Perjanjian ini, penggunaan Layanan Gardukita yang tidak semestinya dan/ atau pelanggaran Anda terhadap hukum atau hak-hak pihak ketiga. </p>
</li>
<li class="bold">
<h5>Pilihan Hukum</h5>
<p>Perjanjian ini akan diatur oleh dan ditafsirkan sesuai dengan hukum Republik Indonesia, tanpa memperhatikan pertentangan aturan hukum. Anda setuju bahwa tindakan hukum apapun atau sengketa yang mungkin timbul dari, berhubungan dengan, atau berada dalam cara apapun berhubungan dengan situs dan/atau Perjanjian ini akan diselesaikan secara eksklusif dalam yurisdiksi pengadilan Republik Indonesia.</p>
</li>
<li class="bold">
<h5>Pembaharuan</h5>
<p>Syarat &amp; ketentuan mungkin diubah dan/atau diperbaharui dari waktu ke waktu tanpa pemberitahuan sebelumnya. perusahaan menyarankan agar anda membaca secara seksama dan memeriksa halaman Syarat &amp; ketentuan ini dari waktu ke waktu untuk mengetahui perubahan apapun. Dengan tetap mengakses dan menggunakan layanan Gardukita, maka pengguna dianggap menyetujui perubahan-perubahan dalam Syarat &amp; Ketentuan. </p>
</li>
</ol>',
                'enable' => '1',
                'created' => '2019-10-25 11:16:52',
                'modified' => '2019-10-29 04:46:25',
            ],
            [
                'id' => '6',
                'title' => 'Generation Bonus ',
                'slug' => 'generation-bonus',
                'content' => '<div class="heading-text heading-line text-center m-b-80">
<h3>Simulasi komisi 19 generasi</h3>
</div>
<table class="table table-bordered table-striped">
<thead>
<tr>
<th></th>
<th class="text-center">
<strong>Komisi</strong>
</th>
<th class="text-center">
<strong>Simulasi 5 Duplikasi</strong>
</th>
<th class="text-center">
<strong>Total Komisi</strong>
</th>
</tr>
</thead>
<tbody>
<tr>
<th class="text-nowrap" scope="row">Gen-1</th>
<td class="text-center"><code>Rp. 25.000</code></td>
<td class="text-center"><code>5</code></td>
<td class="text-center"><code>Rp. 125.000</code></td>
</tr>
<tr>
<th class="text-nowrap" scope="row">Gen-2</th>
<td class="text-center"><code>Rp. 5.000</code></td>
<td class="text-center"><code>25</code></td>
<td class="text-center"><code>Rp. 125.000</code></td>
</tr>
<tr>
<th class="text-nowrap" scope="row">Gen-3</th>
<td class="text-center"><code>Rp. 3.000</code></td>
<td class="text-center"><code>125</code></td>
<td class="text-center"><code>Rp. 375.000</code></td>
</tr>
<tr>
<th class="text-nowrap" scope="row">Gen-4</th>
<td class="text-center"><code>Rp. 1.000</code></td>
<td class="text-center"><code>625</code></td>
<td class="text-center"><code>Rp. 1.250.000</code></td>
</tr>
<tr>
<th class="text-nowrap" scope="row">Gen-5</th>
<td class="text-center"><code>Rp. 1.000</code></td>
<td class="text-center"><code>3.125 </code></td>
<td class="text-center"><code>Rp. 3.125.000 </code></td>
</tr>
<tr>
<th class="text-nowrap" scope="row">Gen-6</th>
<td class="text-center"><code>Rp. 1.000</code></td>
<td class="text-center"><code>15.625</code></td>
<td class="text-center"><code>Rp. 15.625.000</code></td>
</tr>
<tr>
<th class="text-nowrap" scope="row">Gen-7</th>
<td class="text-center"><code>Rp. 1.000</code></td>
<td class="text-center"><code>78.125 </code></td>
<td class="text-center"><code>Rp. 78.125.000</code></td>
</tr>
<tr>
<th class="text-nowrap" scope="row">Gen-8</th>
<td class="text-center"><code>Rp. 1.000</code></td>
<td class="text-center"><code>390.625 </code></td>
<td class="text-center"><code>Rp. 390.625.000</code></td>
</tr>
<tr>
<th class="text-nowrap" scope="row">Gen-9</th>
<td class="text-center"><code>Rp. 1.000</code></td>
<td class="text-center"><code>390.625</code></td>
<td class="text-center"><code>Rp. 390.625.000</code></td>
</tr>
<tr>
<th class="text-nowrap" scope="row">Gen-10</th>
<td class="text-center"><code>Rp. 1.000</code></td>
<td class="text-center"><code>390.625</code></td>
<td class="text-center"><code>Rp. 390.625.000</code></td>
</tr>
<tr>
<th class="text-nowrap" scope="row">Gen-11</th>
<td class="text-center"><code>Rp. 1.000</code></td>
<td class="text-center"><code>390.625</code></td>
<td class="text-center"><code>Rp. 390.625.000</code></td>
</tr>
<tr>
<th class="text-nowrap" scope="row">Gen-12</th>
<td class="text-center"><code>Rp. 1.000</code></td>
<td class="text-center"><code>390.625</code></td>
<td class="text-center"><code>Rp. 390.625.000</code></td>
</tr>
<tr>
<th class="text-nowrap" scope="row">Gen-13</th>
<td class="text-center"><code>Rp. 1.000</code></td>
<td class="text-center"><code>390.625</code></td>
<td class="text-center"><code>Rp. 390.625.000</code></td>
</tr>
<tr>
<th class="text-nowrap" scope="row">Gen-14</th>
<td class="text-center"><code>Rp. 1.000</code></td>
<td class="text-center"><code>390.625</code></td>
<td class="text-center"><code>Rp. 390.625.000</code></td>
</tr>
<tr>
<th class="text-nowrap" scope="row">Gen-15</th>
<td class="text-center"><code>Rp. 1.000</code></td>
<td class="text-center"><code>390.625</code></td>
<td class="text-center"><code>Rp. 390.625.000</code></td>
</tr>
<tr>
<th class="text-nowrap" scope="row">Gen-16</th>
<td class="text-center"><code>Rp. 1.000</code></td>
<td class="text-center"><code>390.625</code></td>
<td class="text-center"><code>Rp. 390.625.000</code></td>
</tr>
<tr>
<th class="text-nowrap" scope="row">Gen-17</th>
<td class="text-center"><code>Rp. 1.000</code></td>
<td class="text-center"><code>390.625</code></td>
<td class="text-center"><code>Rp. 390.625.000</code></td>
</tr>
<tr>
<th class="text-nowrap" scope="row">Gen-18</th>
<td class="text-center"><code>Rp. 1.000</code></td>
<td class="text-center"><code>390.625</code></td>
<td class="text-center"><code>Rp. 390.625.000</code></td>
</tr>
<tr>
<th class="text-nowrap" scope="row">Gen-19</th>
<td class="text-center"><code>Rp. 1.000</code></td>
<td class="text-center"><code>390.625</code></td>
<td class="text-center"><code>Rp. 390.625.000</code></td>
</tr>
</tbody>
</table>',
                'enable' => '1',
                'created' => '2019-11-05 05:17:17',
                'modified' => '2019-11-08 08:46:25',
            ],
            [
                'id' => '7',
                'title' => 'Career Opportunity',
                'slug' => 'career-opportunity',
                'content' => '<div class="heading-text heading-line text-center m-b-60">
<h3>Jenjang Karir</h3>
</div>

<div class="row">
<div class="content col-lg-12">
<div class="accordion">
<div class="ac-item ac-active">
<h5 class="ac-title">Komisi jenjang karir bagi hasil</h5>
<div class="row ac-content">
<div class="col-lg-7" style="display: flex; height: 300px; align-items: center;">
<ul class="list-icon list-icon-plus list-icon-colored">
<li>User = 35% dari Rabat belanja pribadi </li>
<li>Reseller = 25% dari Rabat Omzet Group </li>
<li>Supervisor = 20% dari Rabat Omzet Group </li>
<li>Manager = 15% dari Rabat Omzet Group</li>
<li>Kacab= 5% dari Rabat Omzet Nasional + Rp.50 /bks dari omzet cabang </li>
</ul>
</div>
<div class="col-lg-5">
<img src="/assets/images/pages/growth.png" width="100%">
</div>
</div>
</div>
<div class="ac-item">
<h5 class="ac-title">Syarat Jenjang Karir</h5>
<div class="ac-content" style="display: none;">
<ul class="list-icon list-icon-colored">
<li>User = Belanja ulang minimal 1 slop </li>
<li>Reseller = Memiliki 30 User minimal di 3 group/line </li>
<li>Supervisor = Memiliki 6 Reseller minimal di 4 Group/line </li>
<li>Manager = Memiliki 8 Supervisor minimal di 5 Group/line </li>
<li>Kacab= Memiliki 10 Manager minimal di 5 Group/line </li>
</ul>
</div>
</div>
</div>
</div>
</div>

<br>
<br>

<div>
<div class="heading-text heading-line text-center m-b-60">
<h4>Simulasi sharing profit jenjang karir jika membeli 1 bungkus / hari atau belanja 3 slop / bulan </h4>
</div>
<table class="table table-bordered table-striped">
<thead>
<tr>
<th class="text-center">
<strong>PERINGKAT</strong>
</th>
<th class="text-center">
<strong>GROUP </strong>
</th>
<th class="text-center">
<strong>PRODUK TERJUAL</strong>
</th>
<th class="text-center">
<strong>LABA KOTOR</strong>
</th>
<th class="text-center">
<strong>PROSENTASE</strong>
</th>
<th class="text-center">
<strong>KEUNTUNGAN</strong>
</th>
</tr>
</thead>
<tbody>
<tr>
<th class="text-center" scope="row">USER</th>
<td class="text-center"><code></code></td>
<td class="text-center"><code>30 Bks</code></td>
<td class="text-center"><code>Rp. 42.000</code></td>
<td class="text-center"><code>35% x OP</code></td>
<td class="text-center"><code>Rp. 14.700 / Bulan</code></td>
</tr>
<tr>
<th class="text-center" scope="row">RESELLER</th>
<td class="text-center"><code>30 Orang</code></td>
<td class="text-center"><code>900 Bks</code></td>
<td class="text-center"><code>Rp. 1.260.000</code></td>
<td class="text-center"><code>25% x OG</code></td>
<td class="text-center"><code>Rp. 315.000 / Bulan</code></td>
</tr>
<tr>
<th class="text-center" scope="row">SUPERVISOR</th>
<td class="text-center"><code>180 Orang</code></td>
<td class="text-center"><code>5.400 Bks</code></td>
<td class="text-center"><code>Rp. 7.560.000</code></td>
<td class="text-center"><code>20% x OG</code></td>
<td class="text-center"><code>Rp. 1.512.000 / Bulan</code></td>
</tr>
<tr>
<th class="text-center" scope="row">MANAGER</th>
<td class="text-center"><code>1.440 Orang</code></td>
<td class="text-center"><code>43.200  Bks</code></td>
<td class="text-center"><code>Rp. 60.480.000 </code></td>
<td class="text-center"><code>15% x OG</code></td>
<td class="text-center"><code>Rp. 9.072.000 / Bulan</code></td>
</tr>
<tr>
<th class="text-center" scope="row">KACAB</th>
<td class="text-center"><code>14.400 Orang</code></td>
<td class="text-center"><code>432.000  Bks</code></td>
<td class="text-center"><code>Rp. 604.800.000 </code></td>
<td class="text-center"><code>5% x ON</code></td>
<td class="text-center"><code>Rp. 30.240.000 / Bulan</code></td>
</tr>
</tbody>
</table>

<br>

<div class="blockquote">
<span>Komisi tsb akan didapatkan dari omzet belanja ulang, dimana hasil rabat belanja ulang tsb akan dibagikan kepada seluruh mitra pedagang yang sudah menduduki posisi jenjang karir tersebut, berikut adalah simulasi bagi hasil apabila mitra memiliki 5 group aktif belanja tiap bulannya. </span>
</div>
</div>',
                'enable' => '1',
                'created' => '2019-11-05 05:52:50',
                'modified' => '2019-11-08 08:47:53',
            ],
            [
                'id' => '8',
                'title' => 'Stockist & Branch Commisions',
                'slug' => 'stockist-and-branch-commisions',
                'content' => '<div class="heading-text heading-line text-center">
<h3>Komisi Stockist &amp; Cabang</h3>
</div>
<div class="row m-t-80 m-b-40">
<div class="col-lg-5 col-m-t-40">
<img src="assets/images/pages/stockist.png" width="100%" height="auto">
</div>
<div class="col-lg-7">
<h5 class="ac-title">Komisi Stockist &amp; Cabang</h5>
<div>
<ol>
<li>Stokis mendapatkan discount paket register sebesar Rp.7500/paket setiap belanja kepusat.</li>
<li>Stokis mendapatkan discount repeat order Rp.100/bungkus setiap belanja kepusat. </li>
<li>Cabang mendapatkan discount paket registrasi Rp.2500/paket setiap belanja kepusat </li>
<li>Cabang mendapatkan discount repeat order Rp.50 /bungkus setiap belanja kepusat.</li>
</ol>
</div>
</div>
</div>',
                'enable' => '1',
                'created' => '2019-11-05 06:34:29',
                'modified' => '2019-11-08 08:48:18',
            ],
            [
                'id' => '9',
                'title' => 'Rotama Aksa',
                'slug' => 'rotama-aksa',
                'content' => '<div class="row team-members team-members-left team-members-shadow m-b-40">
<div class="col-lg-12">
<div class="team-member">
<div class="team-image">
<img src="/assets/images/rokok/aksa.jpg">
</div>
<div class="team-desc">
<h3>Rotama Aksa</h3>
<span>Varian Filter</span>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lacus viverra vitae congue eu consequat ac felis donec et. Integer eget aliquet nibh praesent tristique magna. Aliquam etiam erat velit scelerisque in. Enim ut sem viverra aliquet. Gravida neque convallis a cras semper auctor neque vitae. Cras ornare arcu dui vivamus arcu felis. Pulvinar pellentesque habitant morbi tristique senectus et. Amet luctus venenatis lectus magna. Ullamcorper a lacus vestibulum sed arcu. Vitae nunc sed velit dignissim sodales ut eu sem.</p>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lacus viverra vitae congue eu consequat ac felis donec et. Integer eget aliquet nibh praesent tristique magna. Aliquam etiam erat velit scelerisque in. Enim ut sem viverra aliquet. Gravida neque convallis a cras semper auctor neque vitae. Cras ornare arcu dui vivamus arcu felis. Pulvinar pellentesque habitant morbi tristique senectus et. Amet luctus venenatis lectus magna. Ullamcorper a lacus vestibulum sed arcu. Vitae nunc sed velit dignissim sodales ut eu sem.</p>
<div class="align-center">
<a class="btn btn-xs btn-slide btn-light" href="#">
<i class="fab fa-facebook-f"></i>
<span>Facebook</span>
</a>
<a class="btn btn-xs btn-slide btn-light" href="#" data-width="100" style="width: 28px;">
<i class="fab fa-twitter"></i>
<span>Twitter</span>
</a>
<a class="btn btn-xs btn-slide btn-light" href="#" data-width="118" style="width: 28px;">
<i class="fab fa-instagram"></i>
<span>Instagram</span>
</a>
<a class="btn btn-xs btn-slide btn-light" href="mailto:#" data-width="80" style="width: 28px;">
<i class="far fa-envelope"></i>
<span>Mail</span>
</a>
</div>
</div>
</div>
</div>
</div>

<div class="row">
<div class="tabs">
<ul class="nav nav-tabs" id="myTab" role="tablist">
<li class="nav-item">
<a class="nav-link active show" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
</li>
<li class="nav-item">
<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
</li>
<li class="nav-item">
<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
</li>
</ul>
<div class="tab-content" id="myTabContent">
<div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
<p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. </p>
<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.</p>
</div>
<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
<p>Omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. </p>
<p>Odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.</p>
</div>
<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
<p>Soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. </p>
</div>
</div>
</div>
</div>',
                'enable' => '1',
                'created' => '2019-11-07 06:23:34',
                'modified' => '2019-11-07 06:41:01',
            ],
            [
                'id' => '10',
                'title' => 'Rotama Koper',
                'slug' => 'rotama-koper',
                'content' => '<div class="row team-members team-members-left team-members-shadow m-b-40">
<div class="col-lg-12">
<div class="team-member">
<div class="team-image">
<img src="/assets/images/rokok/koper.jpg">
</div>
<div class="team-desc">
<h3>Rotama Aksa</h3>
<span>Varian Filter</span>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lacus viverra vitae congue eu consequat ac felis donec et. Integer eget aliquet nibh praesent tristique magna. Aliquam etiam erat velit scelerisque in. Enim ut sem viverra aliquet. Gravida neque convallis a cras semper auctor neque vitae. Cras ornare arcu dui vivamus arcu felis. Pulvinar pellentesque habitant morbi tristique senectus et. Amet luctus venenatis lectus magna. Ullamcorper a lacus vestibulum sed arcu. Vitae nunc sed velit dignissim sodales ut eu sem.</p>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lacus viverra vitae congue eu consequat ac felis donec et. Integer eget aliquet nibh praesent tristique magna. Aliquam etiam erat velit scelerisque in. Enim ut sem viverra aliquet. Gravida neque convallis a cras semper auctor neque vitae. Cras ornare arcu dui vivamus arcu felis. Pulvinar pellentesque habitant morbi tristique senectus et. Amet luctus venenatis lectus magna. Ullamcorper a lacus vestibulum sed arcu. Vitae nunc sed velit dignissim sodales ut eu sem.</p>
<div class="align-center">
<a class="btn btn-xs btn-slide btn-light" href="#">
<i class="fab fa-facebook-f"></i>
<span>Facebook</span>
</a>
<a class="btn btn-xs btn-slide btn-light" href="#" data-width="100" style="width: 28px;">
<i class="fab fa-twitter"></i>
<span>Twitter</span>
</a>
<a class="btn btn-xs btn-slide btn-light" href="#" data-width="118" style="width: 28px;">
<i class="fab fa-instagram"></i>
<span>Instagram</span>
</a>
<a class="btn btn-xs btn-slide btn-light" href="mailto:#" data-width="80" style="width: 28px;">
<i class="far fa-envelope"></i>
<span>Mail</span>
</a>
</div>
</div>
</div>
</div>
</div>

<div class="row">
<div class="tabs">
<ul class="nav nav-tabs" id="myTab" role="tablist">
<li class="nav-item">
<a class="nav-link active show" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
</li>
<li class="nav-item">
<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
</li>
<li class="nav-item">
<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
</li>
</ul>
<div class="tab-content" id="myTabContent">
<div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
<p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. </p>
<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.</p>
</div>
<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
<p>Omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. </p>
<p>Odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.</p>
</div>
<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
<p>Soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. </p>
</div>
</div>
</div>
</div>',
                'enable' => '1',
                'created' => '2019-11-07 06:30:15',
                'modified' => '2019-11-07 06:41:57',
            ],
            [
                'id' => '12',
                'title' => 'Rotama Pulen',
                'slug' => 'rotama-pulen',
                'content' => '<div class="row team-members team-members-left team-members-shadow m-b-40">
<div class="col-lg-12">
<div class="team-member">
<div class="team-image">
<img src="/assets/images/rokok/pulen.jpg">
</div>
<div class="team-desc">
<h3>Rotama Aksa</h3>
<span>Varian Filter</span>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lacus viverra vitae congue eu consequat ac felis donec et. Integer eget aliquet nibh praesent tristique magna. Aliquam etiam erat velit scelerisque in. Enim ut sem viverra aliquet. Gravida neque convallis a cras semper auctor neque vitae. Cras ornare arcu dui vivamus arcu felis. Pulvinar pellentesque habitant morbi tristique senectus et. Amet luctus venenatis lectus magna. Ullamcorper a lacus vestibulum sed arcu. Vitae nunc sed velit dignissim sodales ut eu sem.</p>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lacus viverra vitae congue eu consequat ac felis donec et. Integer eget aliquet nibh praesent tristique magna. Aliquam etiam erat velit scelerisque in. Enim ut sem viverra aliquet. </p>
<div class="align-center">
<a class="btn btn-xs btn-slide btn-light" href="#">
<i class="fab fa-facebook-f"></i>
<span>Facebook</span>
</a>
<a class="btn btn-xs btn-slide btn-light" href="#" data-width="100" style="width: 28px;">
<i class="fab fa-twitter"></i>
<span>Twitter</span>
</a>
<a class="btn btn-xs btn-slide btn-light" href="#" data-width="118" style="width: 28px;">
<i class="fab fa-instagram"></i>
<span>Instagram</span>
</a>
<a class="btn btn-xs btn-slide btn-light" href="mailto:#" data-width="80" style="width: 28px;">
<i class="far fa-envelope"></i>
<span>Mail</span>
</a>
</div>
</div>
</div>
</div>
</div>

<div class="row">
<div class="tabs">
<ul class="nav nav-tabs" id="myTab" role="tablist">
<li class="nav-item">
<a class="nav-link active show" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
</li>
<li class="nav-item">
<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
</li>
<li class="nav-item">
<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
</li>
</ul>
<div class="tab-content" id="myTabContent">
<div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
<p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. </p>
<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.</p>
</div>
<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
<p>Omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. </p>
<p>Odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.</p>
</div>
<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
<p>Soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. </p>
</div>
</div>
</div>
</div>',
                'enable' => '1',
                'created' => '2019-11-07 06:32:31',
                'modified' => '2019-11-07 06:43:05',
            ],
            [
                'id' => '14',
                'title' => 'Rotama Arsen',
                'slug' => 'rotama-arsen',
                'content' => '<div class="row team-members team-members-left team-members-shadow m-b-40">
<div class="col-lg-12">
<div class="team-member">
<div class="team-image">
<img src="/assets/images/rokok/arsen.jpg">
</div>
<div class="team-desc">
<h3>Rotama Aksa</h3>
<span>Varian Filter</span>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lacus viverra vitae congue eu consequat ac felis donec et. Integer eget aliquet nibh praesent tristique magna. Aliquam etiam erat velit scelerisque in. Enim ut sem viverra aliquet. Gravida neque convallis a cras semper auctor neque vitae. Cras ornare arcu dui vivamus arcu felis. Pulvinar pellentesque habitant morbi tristique senectus et. Amet luctus venenatis lectus magna. Ullamcorper a lacus vestibulum sed arcu. Vitae nunc sed velit dignissim sodales ut eu sem.</p>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lacus viverra vitae congue eu consequat ac felis donec et. Integer eget aliquet nibh praesent tristique magna. Aliquam etiam erat velit scelerisque in. Enim ut sem viverra aliquet. </p>
<div class="align-center">
<a class="btn btn-xs btn-slide btn-light" href="#">
<i class="fab fa-facebook-f"></i>
<span>Facebook</span>
</a>
<a class="btn btn-xs btn-slide btn-light" href="#" data-width="100" style="width: 28px;">
<i class="fab fa-twitter"></i>
<span>Twitter</span>
</a>
<a class="btn btn-xs btn-slide btn-light" href="#" data-width="118" style="width: 28px;">
<i class="fab fa-instagram"></i>
<span>Instagram</span>
</a>
<a class="btn btn-xs btn-slide btn-light" href="mailto:#" data-width="80" style="width: 28px;">
<i class="far fa-envelope"></i>
<span>Mail</span>
</a>
</div>
</div>
</div>
</div>
</div>

<div class="row">
<div class="tabs">
<ul class="nav nav-tabs" id="myTab" role="tablist">
<li class="nav-item">
<a class="nav-link active show" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
</li>
<li class="nav-item">
<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
</li>
<li class="nav-item">
<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
</li>
</ul>
<div class="tab-content" id="myTabContent">
<div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
<p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. </p>
<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.</p>
</div>
<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
<p>Omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. </p>
<p>Odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.</p>
</div>
<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
<p>Soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. </p>
</div>
</div>
</div>
</div>',
                'enable' => '1',
                'created' => '2019-11-07 06:33:28',
                'modified' => '2019-11-07 06:43:24',
            ],
        ];

        $table = $this->table('pages');
        $table->insert($data)->save();
    }
}
