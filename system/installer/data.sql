-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2013 at 08:36 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
-- --------------------------------------------------------

--
--Table structure for table `db_prefix_apps`
--

CREATE TABLE IF NOT EXISTS `db_prefix_apps` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `folder` varchar(200) NOT NULL,
  `author` varchar(50) NOT NULL,
  `type` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
--Dumping data for table `db_prefix_apps`
--

INSERT INTO `db_prefix_apps` (`id`, `name`, `folder`, `author`, `type`) VALUES
(1, 'Article', 'app_article', 'Fiyo CMS', 0),
(2, 'Comment', 'app_comment', 'Fiyo CMS', 2),
(3, 'User', 'app_user', 'Fiyo CMS', 0),
(4, 'Search', 'app_search', 'Fiyo CMS', 3),
(5, 'Contact', 'app_contact', 'Fiyo CMS', 1),
(6, 'SEF', 'app_sef', 'Fiyo CMS', 2),
(7, 'Sitemap', 'app_sitemap', 'Fiyo CMS', 2);

-- --------------------------------------------------------

--
--Table structure for table `db_prefix_article`
--

CREATE TABLE IF NOT EXISTS `db_prefix_article` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `category` int(5) NOT NULL,
  `article` text NOT NULL,
  `date` datetime NOT NULL,
  `author` varchar(250) NOT NULL,
  `author_id` int(5) NOT NULL,
  `description` text NOT NULL,
  `tag` text NOT NULL,
  `keyword` text NOT NULL,
  `featured` int(1) NOT NULL,
  `status` int(1) NOT NULL,
  `level` int(1) NOT NULL,
  `hits` int(10) NOT NULL,
  `parameter` text NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `editor` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
--Dumping data for table `db_prefix_article`
--

INSERT INTO `db_prefix_article` (`id`, `title`, `category`, `article`, `date`, `author`, `author_id`, `description`, `tag`, `keyword`, `featured`, `status`, `level`, `hits`, `parameter`, `updated`, `editor`) VALUES
(1, 'Fiyo CMS Hadir pada Tahun 2012', 1, '<p>\r\n	Akhirnya setelah menunggu beberapa lama FiyoCMS akan dirilis di awal tahun 2012. Karena pengerjaan CMS ini sendiri diselingi oleh beaberapa pekerjaan si-pembuat &nbsp;yang padat dari Portofolio ID, sehingga tidak secepat rencana awal.</p>\r\n<p>\r\n	Meski nanti FiyoCMS tidak di launching secara mewah, semoga saja bisa menarik beberapa pecinta website dan orang yang ingin membuat website.</p>\r\n<hr id=''system-readmore'' />\r\n<p>\r\n	Fiyo CMS memiliki beberapa kelebihan yang kiranya tidak dimiliki oleh CMS lain. Kelebihan itu bisa anda rasakan ketika anda telah mendownload dan menggunakanya pastinya.</p>\r\n', '2012-01-04 14:54:58', 'First Ryan', 1, 'gyi', 'FiyoCMS,be', '', 1, 1, 99, 581, 'show_comment=1;\nshow_author=1;\nshow_date=1;\nshow_category=1;\nshow_tags=1;\nshow_hits=1;\nshow_rate=1;\nrate_value=26;\nrate_counter=6;\n0', '0000-00-00 00:00:00', 0),
(2, 'Online Server Installation', 2, '<p>\r\n	Untuk melakukan instalasi Fiyo di online server atau web hosting, diperlukan akses ke CPanel untuk melakukan upload file dan membuat database atau Software FTP untuk upload file yang lebih mudah.</p>\r\n<hr id=''system-readmore'' />\r\n<h3>\r\n	File Installation</h3>\r\n<p style=''margin-left: 40px;''>\r\n	<strong>Upload via CPanel :</strong><br />\r\n	Anda bisa menggunakan&nbsp;<strong>File Manager</strong>&nbsp;untuk mengupload file. Setelah itu upload file instalasi di folder (misal :&nbsp;<span courier='''' style=''font-family: ''>htdocs</span>,&nbsp;<span courier='''' style=''font-family: ''>www</span>,&nbsp;<span courier='''' style=''font-family: ''>root</span>,&nbsp;<em>dll.</em>).<br />\r\n	Setelah proses upload selesai Anda bisa langsung melakukan ekstraksi file tersebut dengan cara klik kanan file instalasi dan pilih&nbsp;<strong>Extract Here</strong>.</p>\r\n<p style=''margin-left: 40px;''>\r\n	<strong>Upload via Software FTP :</strong><br />\r\n	Anda perlu mengekstrak file instalasi terlebih dahulu. Lalu upload seluruh file yang ada didalam file instalasi di folder (misal :&nbsp;<span courier=''''>htdocs</span>,&nbsp;<span courier=''''>www</span>,&nbsp;<span courier=''''>root</span>,&nbsp;<em>dll</em>.).</p>\r\n<h3>\r\n	Access Fiyo Installer</h3>\r\n<p>\r\n	Setelah itu buka browser dan akses Fiyo Installer susuai nama folder Fiyo (misal :&nbsp;<span courier=''''><span style=''background-color: rgb(230, 230, 250);''>http://namadomain.com/<strong>fiyo</strong>/&nbsp;</span></span>) atau&nbsp;<span courier=''''><span style=''background-color: rgb(230, 230, 250);''>http://namadomain.com/&nbsp;</span></span>).</p>\r\n<h3>\r\n	Database Configuration</h3>\r\n<p>\r\n	Untuk instalasi di online server diperlukan data yang diciptakan secara manual dulu melalui CPanel atau sejenisnya. Anda bisa menggnuakan Database Wizard untuk membuat database beserta user dan passwordnya. Lalu masukan pada kolom yang tersedia.</p>\r\n<ol>\r\n	<li>\r\n		<strong>Host Name</strong>&nbsp;adalah nama untuk server yang digunakan. Biasanya menggunakan&nbsp;<span courier=''''><span style=''background-color: rgb(255, 240, 245);''>localhost</span></span>.</li>\r\n	<li>\r\n		<strong>DB User</strong>&nbsp;adalah nama user yang berhak untuk mengakses database pada&nbsp;<span courier=''''>localhost</span>.<br />\r\n		Jika menggunakan server lokal, nama&nbsp;<em>default</em>&nbsp;adalah&nbsp;<span courier=''''><span style=''background-color: rgb(255, 240, 245);''>root</span></span>.</li>\r\n	<li>\r\n		<strong>DB Pass</strong>&nbsp;adalah password yang digunakan user untuk melengkapi persyaratan akses database.<br />\r\n		Basanya password untuk localhost adalah&nbsp;<em>null</em>&nbsp;atau kosong.</li>\r\n	<li>\r\n		<strong>Database</strong>&nbsp;adalah database yang nanti akan digunakan untuk menyimpan seluruh data website.<br />\r\n		Anda tidak perlu membuat database terlebih dahulu melalui PHPMyAdmin atau sejenisnya.<br />\r\n		Nama database yang Anda isi akan terbentuk secara otomatis pada saat&nbsp;<strong>DB User&nbsp;</strong>dan&nbsp;<strong>DB Pass</strong>&nbsp;benar, serta Database belum pernah dibuat sebelumnya.</li>\r\n	<li>\r\n		<strong>DB Prefix</strong>&nbsp;adalah nama depan yang digunakan untuk setiap tabel yang akan dibuat di database.<br />\r\n		Ini dapat meningkatkan keamanan website, karena nama prefix yang unik akan tidak mudah di deteksi oleh peretas.</li>\r\n</ol>\r\n<h3>\r\n	Website Configuration</h3>\r\n<p>\r\n	Setelah itu muncul kolom untuk menentukan nama situs, nama user dan password yang akan digunakan pada AdminPanel.</p>\r\n<ol>\r\n	<li>\r\n		<strong>Site Name</strong>&nbsp;adalah nama yang digunakan sebagai identitas situs.<br />\r\n		Nama yang diisikan bebas dan tidak bersyarat (misal :&nbsp;<em>Blog Fiyo, Catatan Fiyo, Situs Fiyoku, dll.</em>).</li>\r\n	<li>\r\n		<strong>User Name</strong>&nbsp;adalah nama pengguna yang digunakan untuk mengakses AdminPanel.&nbsp;<br />\r\n		Boleh menggunakan karakter apapun (misal :<em>&nbsp;admin, Administrator, fiyo, dll.</em>).</li>\r\n	<li>\r\n		<strong>Password</strong>&nbsp;adalah katakunci dari User Name yang digunakan untuk melengkapi akses AdminPanel.</li>\r\n	<li>\r\n		<strong>Email</strong>&nbsp;adalah email dari nama User Name yang telah dimasukan.<br />\r\n		<span style=''background-color: rgb(255, 255, 224);''>Usahakan menggunakan email aktif, karena sangat berguna apabila user tidak dapat diakses.</span></li>\r\n</ol>\r\n<h3>\r\n	Finishing</h3>\r\n<p>\r\n	Setelah semua proses selesai akan ada notifikasi bahwa proses instalasi telah berhasil dan Anda bisa langsung menuju halaman&nbsp;<strong>Admin Page</strong>&nbsp;atau&nbsp;<strong>Home Page</strong>.</p>\r\n<div>\r\n	&nbsp;</div>\r\n', '2012-01-03 11:34:04', '', 1, '', '', '', 1, 1, 99, 103, 'show_comment=1;\nshow_author=1;\nshow_date=1;\nshow_category=1;\nshow_tags=1;\nshow_hits=1;\nshow_rate=1;\nrate_value=10;\nrate_counter=2;\n1', '0000-00-00 00:00:00', 0),
(3, 'Local Server Installation', 2, '<p>\r\n	Setelah semua&nbsp;<u>persyaratan</u>&nbsp;telah terpenuhi, Anda bisa langsung melakukan proses instalasi di server lokal. Berikut adalah langkah-langkah instalasi di server lokal :</p>\r\n<hr id=''system-readmore'' />\r\n<h3>\r\n	File Installation</h3>\r\n<p>\r\n	Tampatkan file instalasi di folder server (misal :&nbsp;<span courier='''' style=''font-family: ''>htdocs</span>,&nbsp;<span courier='''' style=''font-family: ''>www</span>,&nbsp;<span courier='''' style=''font-family: ''>root</span>, dll.) lalu ekstrak file tersebut di folder server. Anda juga bisa mengganti nama folder sesuai keinginan.</p>\r\n<h3>\r\n	Access Fiyo Installer</h3>\r\n<p>\r\n	Setelah itu buka browser dan akses Fiyo Installer susuai nama folder Fiyo (misal :&nbsp;<span courier='''' style=''font-family: ''><span style=''background-color: rgb(230, 230, 250);''>http://localhost/<strong>fiyo</strong>/</span></span>).</p>\r\n<h3>\r\n	Database Configuration</h3>\r\n<p>\r\n	Pada saat awal, Anda akan dihadapkan pada form isian untuk mengatur penempatan database. Ada 5 kolom yang harus diisi :</p>\r\n<ol>\r\n	<li>\r\n		<strong>Host Name</strong>&nbsp;adalah nama untuk server yang digunakan. Biasanya menggunakan&nbsp;<span courier='''' style=''font-family: ''><span style=''background-color: rgb(255, 240, 245);''>localhost</span></span>.</li>\r\n	<li>\r\n		<strong>DB User</strong>&nbsp;adalah nama user yang berhak untuk mengakses database pada&nbsp;<span courier=''''>localhost</span>.<br />\r\n		Jika menggunakan server lokal, nama&nbsp;<em>defaul</em>&nbsp;adalah&nbsp;<span courier='''' style=''font-family: ''><span style=''background-color: rgb(255, 240, 245);''>root</span></span>.</li>\r\n	<li>\r\n		<strong>DB Pass</strong>&nbsp;adalah password yang digunakan user untuk melengkapi persyaratan akses database.<br />\r\n		Basanya password untuk localhost adalah&nbsp;<em>null</em>&nbsp;atau kosong.</li>\r\n	<li>\r\n		<strong>Database</strong>&nbsp;adalah database yang nanti akan digunakan untuk menyimpan seluruh data website.<br />\r\n		Anda tidak perlu membuat database terlebih dahulu melalui PHPMyAdmin atau sejenisnya.<br />\r\n		Nama database yang Anda isi akan terbentuk secara otomatis pada saat&nbsp;<strong>DB User&nbsp;</strong>dan&nbsp;<strong>DB Pass</strong>&nbsp;benar, serta Database belum pernah dibuat sebelumnya.</li>\r\n	<li>\r\n		<strong>DB Prefix</strong>&nbsp;adalah nama depan yang digunakan untuk setiap tabel yang akan dibuat di database.<br />\r\n		Ini dapat meningkatkan keamanan website, karena nama prefix yang unik akan tidak mudah di deteksi oleh peretas.</li>\r\n</ol>\r\n<h3>\r\n	Website Configuration</h3>\r\n<p>\r\n	Setelah itu muncul kolom untuk menentukan nama situs, nama user dan password yang akan digunakan pada AdminPanel.</p>\r\n<ol>\r\n	<li>\r\n		<strong>Site Name</strong>&nbsp;adalah nama yang digunakan sebagai identitas situs.<br />\r\n		Nama yang diisikan bebas dan tidak bersyarat (misal :&nbsp;<em>Blog Fiyo, Catatan Fiyo, Situs Fiyoku, dll.</em>).</li>\r\n	<li>\r\n		<strong>User Name</strong>&nbsp;adalah nama pengguna yang digunakan untuk mengakses AdminPanel.&nbsp;<br />\r\n		Boleh menggunakan karakter apapun (misal :<em>&nbsp;admin, Administrator, fiyo, dll.</em>).</li>\r\n	<li>\r\n		<strong>Password</strong>&nbsp;adalah katakunci dari User Name yang digunakan untuk melengkapi akses AdminPanel.</li>\r\n	<li>\r\n		<strong>Email</strong>&nbsp;adalah email dari nama User Name yang telah dimasukan.<br />\r\n		<span style=''background-color: rgb(255, 255, 224);''>Usahakan menggunakan email aktif, karena sangat berguna apabila user tidak dapat diakses.</span></li>\r\n</ol>\r\n<h3>\r\n	Finishing</h3>\r\n<p>\r\n	Setelah semua proses selesai akan ada notifikasi bahwa proses instalasi telah berhasil dan Anda bisa langsung menuju halaman&nbsp;<strong>Admin Page</strong>&nbsp;atau&nbsp;<strong>Home Page</strong>.</p>\r\n<div>\r\n	&nbsp;</div>\r\n', '2012-01-03 11:34:04', '', 1, '', '', '', 1, 1, 99, 1, 'show_comment=1;\nshow_author=1;\nshow_date=1;\nshow_category=1;\nshow_tags=1;\nshow_hits=1;\nshow_rate=1;\nrate_value=10;\nrate_counter=2;\n1', '0000-00-00 00:00:00', 0),
(4, 'Fitur Baru di V.1.2.0', 1, '<p>\r\n	Meski sebenarnya belum rilis versi stabel, tetapi v.1.2.0 sudah bisa digunakan. Hanya saja butuh sedikit penyempurnaan. Apalagi versi ini hampir setengah codingnya berbeda dengan versi sebelumnya yang masih bersifat <em>jadul</em>.</p>\r\n<p>\r\n	Berkat komentar dan masukan dari para ahlinya dan para sahabat ditambah para pengguna Fiyo yang antusias selalu memberikan kritik dan saran. Fiyo mengalami kemajuan dalam pengolahan data dan koding yang di kompres banyak dari versi sebelumnya.</p>\r\n<p>\r\n	Installer yang hanya berjalan normal hanya di sebagian software localhost seperti di XAMPP dan WAMPP, tetapi tidak dapat mulus di Zend sudah sedikit diatasi di versi terbaru ini.</p>\r\n<hr id=''system-readmore'' />\r\n<p>\r\n	Berikut Fitur tambahan dan log di versi terbaru <strong>Fiyo v.1.2.0</strong></p>\r\n<h4>\r\n	AddOns Intaller</h4>\r\n<p>\r\n	Anda dapat memasang AddOns yang tersedia di situs resmi <strong>Fiyo.Org&nbsp;</strong>dan menginstalnya langsung di situs anda. AddOns adalah sebuah ekstensi tambahan yang ada di FiyoCMS seperti,<em> theme, module, plugin, apps.&nbsp;</em>Tetapi Anda harus sabar jika ingin mengambil AddOns di situs resminya, karena belum tersedia secara langsung dan masih dalam tahap penyempurnaan untuk situs Fiyo.Org itu sendiri.</p>\r\n<p>\r\n	&nbsp;</p>\r\n<h4>\r\n	Spot Position</h4>\r\n<p>\r\n	Fitur ini memudahkan anda untuk mencari letak posisi modul pada theme anda, dengan hanya memilih gambar yang ada, dan tidak hanya tulisam saja. Fitur ini bisa anda temukan pada <strong>Module Manager</strong> dan <strong>Theme Manager.</strong></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<strong>Work Logs Fiyo CMS</strong></p>\r\n<ol>\r\n	<li>\r\n		pembenahan posisi modul pada modul manager belum akurat<em><span class=''Apple-tab-span'' style=''white-space:pre''> </span>1.1.0<span class=''Apple-tab-span'' style=''white-space:pre''> </span>6-Jan-2012<span class=''Apple-tab-span'' style=''white-space: pre; ''> </span></em></li>\r\n	<li>\r\n		merapikan tapilan tabel pada saat memilih &quot;single article&quot; di Menu Manager<span class=''Apple-tab-span'' style=''white-space: pre; ''> </span><em>1.1.0<span class=''Apple-tab-span'' style=''white-space: pre; ''> </span>6-Jan-2012</em></li>\r\n	<li>\r\n		Penambahan menu AddOns Manager pada admin panel<span class=''Apple-tab-span'' style=''white-space:pre''> </span><em>1.2.0<span class=''Apple-tab-span'' style=''white-space:pre''> </span>7-Jan-2012</em></li>\r\n	<li>\r\n		penambahan fitur AddOns Instaler<span class=''Apple-tab-span'' style=''white-space:pre''> </span><em>1.2.0<span class=''Apple-tab-span'' style=''white-space:pre''> </span>7-Jan-2012</em></li>\r\n	<li>\r\n		penambahan fitur Apps AddOns<em><span class=''Apple-tab-span'' style=''white-space:pre''> </span>1.2.0<span class=''Apple-tab-span'' style=''white-space:pre''> </span>8-Jan-2012</em></li>\r\n	<li>\r\n		penambahan fitur Modules AddOns<span class=''Apple-tab-span'' style=''white-space:pre''> </span><em>1.2.0<span class=''Apple-tab-span'' style=''white-space:pre''> </span>8-Jan-2012</em></li>\r\n	<li>\r\n		penambahan fitur Themes AddOns<em><span class=''Apple-tab-span'' style=''white-space:pre''> </span>1.2.0<span class=''Apple-tab-span'' style=''white-space:pre''> </span>8-Jan-2012</em></li>\r\n</ol>\r\n<h4>\r\n	Developer Logs Updated</h4>\r\n<ol>\r\n	<li>\r\n		mark-up app_module untuk back-end<span class=''Apple-tab-span'' style=''white-space:pre''> </span><em>6-Jan-2012</em></li>\r\n	<li>\r\n		mark-up app_menu untuk back-end<span class=''Apple-tab-span'' style=''white-space:pre''> </span><em>6-Jan-2012</em></li>\r\n	<li>\r\n		penambahan fungsi extrak file zip -&gt; extractZip($file,$directory);<span class=''Apple-tab-span'' style=''white-space:pre''> </span><em>8-Jan-2012</em></li>\r\n	<li>\r\n		penambahan fungsi hapus direktori dan isinya -&gt; delete_directory($dirname);<span class=''Apple-tab-span'' style=''white-space:pre''> </span><em>8-Jan-2012</em></li>\r\n</ol>\r\n<div>\r\n	<h4>\r\n		Issue</h4>\r\n	<div>\r\n		<ul>\r\n			<li>\r\n				link kress (#) tidak berjalan&nbsp;<em><strong>solved</strong></em></li>\r\n			<li>\r\n				posisi modul pada modul manager belum akurat&nbsp;<em><strong>solved</strong></em></li>\r\n			<li>\r\n				Fiyo Installer tidak berjalan normal&nbsp;<em><strong>solved</strong></em></li>\r\n		</ul>\r\n	</div>\r\n</div>\r\n<p>\r\n	&nbsp;</p>\r\n', '2012-02-04 11:13:29', '', 1, '', 'test', '', 1, 1, 99, 380, 'show_comment=1;\nshow_panel=1;\nshow_author=1;\nshow_date=1;\nshow_category=0;\nshow_hits=1;\nshow_tags=1;\nshow_rate=1;\nrate_value=19;\now_panel=1;\r\nshow_author=1;\r\nshow_date=1;\r\nshow_category=0;\r\nshow_hits=1;\r\nrate_value=19;\r\nrate_counterrate_counter=3;\n', '0000-00-00 00:00:00', 0),
(5, 'Fiyo 1.2.1 Compatible with PHP 5.3.x+', 1, '<p>\r\n	Akhirnya permasalahan besar di versi sebelumnya sudah terpecahkan. masalah terbesar itu adalah Fiyo masih menggunakan PHP versi 5.1.x dan sekarang sudah kompatibel dengan PHP 5.3.x</p>\r\n<p>\r\n	Semoga versi ini dapat digunakan oleh semua yang ingin mencoba dan tidak ada lagi komentar tentang permasalahan ini.</p>\r\n<p>\r\n	Terimakasih dan selamat mencoba :)</p>\r\n<hr id=''system-readmore'' />\r\n<p>\r\n	<em><strong>Work Logs Fiyo CMS</strong></em></p>\r\n<ul>\r\n	<li>\r\n		kompatible dengan php 5.3.x</li>\r\n	<li>\r\n		penambahan fitur updater</li>\r\n	<li>\r\n		Mengganti Field &#39;name&#39; dengan &#39;title&#39; pada tabel Article</li>\r\n</ul>\r\n', '2012-02-08 00:00:00', '', 1, 'Akhirnya permasalahan besar di versi sebelumnya sudah terpecahkan. masalah terbesar itu adalah Fiyo masih menggunakan PHP versi 5.1.x dan sekarang sudah kompatibel dengan PHP 5.3.x\r\nSemoga versi ini dapat digunakan oleh semua yang ingin mencoba dan tidak ada lagi komentar tentang permasalahan ini.\r\nTerimakasih dan selamat mencoba :)', 'test', '', 1, 1, 2, 542, 'show_comment=1;\nshow_author=1;\nshow_date=1;\nshow_category=1;\nshow_tags=1;\nshow_hits=1;\nshow_rate=1;\nrate_value=17;\nrate_counter=1;\n1', '0000-00-00 00:00:00', 0),
(6, 'Fiyo 1.2.2 dengan Fitur Lebih Canggih', 1, '<p>\r\n	Rilis kali ini mempunyai perubahan yang signifikan dari rilis-update sebelumnya. Kali ini fitur yang ingin ditambahkan dari awal pembuatan FiyoCMS baru bisa dirasakan di versi 1.2.2 ini.</p>\r\n<p>\r\n	Yaitu fitur OneClickCange, dengan fitur ini mengatur artikel, menu dan modul terasa sangat mudah. Satu klik tanpa loading anda sudah bisa mengaktifkan atau menon-aktifkan artikel, modul atau menu yang anda inginkan.</p>\r\n<hr id=''system-readmore'' />\r\n<p>\r\n	Ditambah lagi di versi ini kita sudah bisa menyediakan module SlideShow, modul MultiFacebook, ImageScroll dan modul menarik lainya.</p>\r\n<p>\r\n	Pada versi ini juga ditambahkan Apps baru, yaitu App Contact. Anda bisa mengelola kontak para teman anda atau pegawai perusahaan.</p>\r\n<p>\r\n	Berikut Perubahan dan Fitur tambahan yang ada di Fiyo v 1.2.2</p>\r\n<p>\r\n	<em><strong>Work Logs Fiyo CMS</strong></em></p>\r\n<ul>\r\n	<li>\r\n		penambahan plugins From Validator (JQuery)</li>\r\n	<li>\r\n		penambahan plugins input limiter (JQuery)</li>\r\n	<li>\r\n		fitur one click change pada Apps di AdminPanel&nbsp;&nbsp;(JQuery)</li>\r\n	<li>\r\n		penyempurnaan plugin_sef</li>\r\n	<li>\r\n		perbaikan : app_comment</li>\r\n	<li>\r\n		perbaikan : app_article</li>\r\n	<li>\r\n		penambahan : app_contact</li>\r\n	<li>\r\n		perbaikan : app_user &nbsp;(Front Site)</li>\r\n	<li>\r\n		perbaikan : app_module (Front Site)</li>\r\n</ul>\r\n<p>\r\n	<em><strong>Developer Logs Updates</strong></em></p>\r\n<ul>\r\n	<li>\r\n		Mengganti Field &#39;<strong>name</strong>&#39; dengan&nbsp;<strong>&#39;title</strong>&#39; pada tabel Article</li>\r\n	<li>\r\n		penambahan fungsi&nbsp;<strong>get_htmlTag()</strong>&nbsp;sebagai fungsi tag parse</li>\r\n</ul>\r\n<p>\r\n	&nbsp;</p>\r\n', '2012-02-19 13:00:29', '', 1, '', 'asd', '', 1, 1, 2, 308, 'comment=1;\nshow_panel=1;\nshow_author=1;\nshow_date=1;\nshow_category=1;\nshow_hits=1;\nshow_tags=1;\nshow_rate=1;\n=;\nrate_value=16;\nrate_counter=4;\n', '0000-00-00 00:00:00', 0),
(7, 'Update checkpoint di versi 1.2.3', 1, '<p>\r\n	Akhirnya setelah menunggu dan melakukan penambahan serta revisi dibagian system. Fiyo 1.2.3 dapat segera kami rilis. versi ini kami sebut dengan nama &nbsp;Fiyo one-two-three. Versi ini adalah yang terakhir untuk versi 1.2, yang berarti tidak akan ada lagi update untuk versi 1.2.x berikutnya.</p>\r\n<p>\r\n	Walaupun masih ada beberapa fitur yang masih ingin ditambahkan seperti newsteller, dan fitur rating artikel. Tetapi ini diharap bisa menutup untuk versi 1.2 dan menjadikan Fiyo lebih dapat berkambang lebih canggih lagi.</p>\r\n<hr id=''system-readmore'' />\r\n<p>\r\n	Ok, berikut adalah fitur baru yang dimiliki Fiyo one-two-three.</p>\r\n<h2>\r\n	Add-Ons Manager Update</h2>\r\n<p>\r\n	Fitur Add-Ons Manager memang sudah lama ada, tetapi ada beberapa yang belum kami aktifkan. Tapi untuk saat ini anda bisa menggunakan semua fitur yang ada di Add-Ons Manager. Fitur baru seperti Plugins Manager atau penyempurnaan pada Add-Ons Installer bisa anda coba disini.</p>\r\n<p>\r\n	Update fitur ini adalah yang paling menonjol dan paling berpengaruh dalam update kali ini. Dengan sudah lengkapnya fitur pada Add-Ons Manager, diharapkan dapat mempermudah para developer khususnya untuk lebih mengembangkan Fiyo Add-Ons.</p>\r\n<h2>\r\n	Folder Admin Scure</h2>\r\n<p>\r\n	Anda pasti tahu jika FiyoCMS mendukung optimalisasi pengamanan folder admin. Dimana anda dapat mengganti nama folder admin sesuka anda. Tapi hal tersebut belum lengkap, karena masih harus dilakukan secara manual. Hal tersebut memang mudah dilakukan jika kita menjalankan FiyoCMS di server local (localhost), bagai mana jika di live server ? Pasti butuh proses yang panjang.</p>\r\n<p>\r\n	Kali ini anda dapat mengganti nama folder admin anda melalui menu Web Configuration pada menu Admin Panel. Lalu pilih bagian pojok kiri Konfigurasi Admin-Panel untuk mengganti nama folder admin dengan nama baru.</p>\r\n<p>\r\n	&nbsp;</p>\r\n', '2012-07-13 14:57:31', '', 1, '', '', '', 1, 1, 99, 420, 'show_comment=1;\nshow_panel=1;\nshow_author=1;\nshow_date=1;\nshow_category=1;\nshow_hits=1;\nshow_tags=1;\nshow_rate=1;\nrate_value=22;\nrate_counter=2;\n', '0000-00-00 00:00:00', 0),
(8, 'Membuat Template FiyoCMS', 1, '<p>\r\n	&nbsp;</p>\r\n<div>\r\n	<p>\r\n		Akan di Update akhir Februari.</p>\r\n	<p>\r\n		Tutorial Video dan Artikel :)</p>\r\n</div>\r\n<p>\r\n	&nbsp;</p>\r\n', '2012-01-03 11:37:11', '', 1, '', '', '', 1, 1, 99, 114, 'comment=1;\r\nshow_panel=1;\r\nshow_author=1;\r\nshow_date=1;\r\nshow_category=1;\r\nshow_hits=1;\r\nshow_tags=1;\r\nshow_rate=1;\r\nrate_value=10;\nrate_counter=2;\n', '0000-00-00 00:00:00', 0),
(9, 'Fiyo CMS 1.4.0', 1, '<p>\r\n	Setelah melalui masa percobaan untuk berbagai situs yang telah kembangkan, maka Fiyo 1.4.0 resmi dirilis pada tanggal 4 April 2013. Dengan mengusung judul <strong>Fiyo Go Store!&nbsp;</strong>dan pastinya Fi Store pun menjadi senjata andalan.</p>\r\n<p>\r\n	Fersi baru ini memiliki perbedaan dan perkembangan yang cukup signifikan. Karena update kali ini tidak hanya memperbaiki tetapi juga menambah beberapa modul dan apps baru, serta memodifikasi dasboard AdminPanel agar lebih informatif.</p>\r\n<hr id=''system-readmore'' />\r\n<p>\r\n	Kita akan bahas satu-persatu mulai dari (belakang (AdminPanel)&nbsp;hingga sisi depan (Front Site).</p>\r\n<h3>\r\n	Dasboard AdminPanel</h3>\r\n<p>\r\n	Pada saat pertama kali login pada AdminPanel pasti akan diarahkan ke halaman Dasboard. Kali ini dasboard akan sedikit dirubah layoutnya dan penambahan fitur statistik agar AdminPanel lebih informatif.</p>\r\n<p>\r\n	Berikut preview tampilan dasboard AdminPanel.</p>\r\n<p>\r\n	<img alt=''Dasboard Fiyo CMS'' longdesc=''Dasboard Fiyo CMS'' src=''/media/images/dasboard.jpg'' style=''width: 630px; height: 368px;'' /></p>\r\n<p>\r\n	Gambar diatas pada sisi kiri menujukan statistik artikel terbaru dari semenjak Anda login terakhir kali di AdminPanel, komentar yang belum disetujui, jumlah user baru, dan versi Fiyo yang digunakan.</p>\r\n<p>\r\n	Serta pada sisi kiri ada <em>line-chart</em>&nbsp;yang menunjukan jumlah pengunjung perhari dalam 7 hari terakhir. data pada warna biru menunjukan pengunjung unik untuk setiap <em>session</em>-nya dan untuk warna merah adalah pengujung unik setiap IP yang berbeda.</p>\r\n<p>\r\n	Juga perombakan <em>shortcut icon</em> agar lebih fokus dikiri dan lebih rapih.</p>\r\n<h3>\r\n	Fiyo Installer</h3>\r\n<p>\r\n	Pada Fiyo 1.4.0 untuk installernya dibaerikan popup informasi tambahan sebagai panduan instalasi.</p>\r\n<p>\r\n	Apakah itu server lokal yang tidak harus membuat database atau user terlebih daulu. Ataukan di server hosting yang mengharuskan untuk membuat user atau database terlebih dahulu.</p>\r\n<h3>\r\n	Article System</h3>\r\n<p>\r\n	Ada fitur baru yang mungkin wajib diketahui di bagian artikel. Pada bagian editor terdapat tombol baru di samping tombol &#39;Read More&#39;, yaitu tombol &#39;Attach File&#39; yang berguna untuk memanggil file yang disimpan di Media Manager. Tombol ini biasa digunakan untuk menautkan file yang siap diunduh oleh pengujung situs.</p>\r\n<p>\r\n	Juga adanya pengaturan penanggalan yang berfungsi untuk mengatur penjadwalan artikel. Jadi, apabila artikel belum memasuki tanggal yang telah ditetapkan, maka artikel belom muncul atau bisa dikatakan belum aktif. Hal ini juga akan merubah input tanggal menjadi (Y-M-d H:i:s).</p>\r\n<p>\r\n	Dan pengembangan baru untuk artikel adalah, penataan layout. Anda bisa memilih model layout melalui Menu, lalu seting parameter sesuai keinginan. Berikut gambaran layout urut mulai dari default, blog dan list.</p>\r\n<p>\r\n	&nbsp;</p>\r\n<h3>\r\n	User Management</h3>\r\n<p>\r\n	Pada bagiang User Managemement juga ditambahkan fungsi baru untuk mengatur apakah situs menerima pendaftaran baru dari pengunjung atau tidak.&nbsp;</p>\r\n<p>\r\n	Anda bisa menemukan tombol setting pada bagian atas di samping tombol simpan, hapus dan bantuan.</p>\r\n<h3>\r\n	Comment System</h3>\r\n<p>\r\n	Sistem komentar yang menggunakan Fi Comment juga turut diperbaharui. Anda bisa menggunakan dua pilihan <em>security code</em>&nbsp;atau yang lebih dikenal dengan <strong>captcha</strong>.&nbsp;</p>\r\n<p>\r\n	Pada bagian konfigurasi komentar terdapat dua kolom untuk menampilkan reCaptcha. Apabila kolom tersebut salah atau tidak diisi maka Fi Comment akan menggunakan captcha matematika.</p>\r\n<p>\r\n	Capthca matematika sendiri juga sudah diperbaharui, tidak lagi bersifat teks dan sekarang berbantuk gambar. Alasan memilih captcha matematika adalah untuk mengasah otak agar lebih aktif lagi dengan hitungan-hitungan sederhana.</p>\r\n<h3>\r\n	Statistic System</h3>\r\n<p>\r\n	Ada plugin baru yang ditanamkan didalam Fiyo 1.4.0 ini, yaitu sistem statistik untuk melihat detil pengujung. Sistem ini bekerja apabila ada yang mengakses website dan langsung akan tercatat IP, waktu, user id, platform, browser, negara dan kota yang tersimpan ditabel<em> _statistic</em></p>\r\n<p>\r\n	Tabel tersebut bisa dimanfaatkan untuk membuat sebuah AddOn baru. Contoh AddOn dari pengembangan tabel tersebut adalah, statistik pengunjung di AdminPanel dan modul Ststistik yang menggantikan <em>Fi Tracker</em>.</p>\r\n<h3>\r\n	Fiyo Store</h3>\r\n<p>\r\n	Kali ini AddOn yang banyak ditunggu-tunggu adalah Fiyo Store atau dikenal dengan <strong>Fi Store</strong>. Tetapi Fi Store tidak disertakan secara langsung dalam paket instalasi versi terbaru ini. Anda harus megunduhnya dihalaman AddOns.</p>\r\n<p>\r\n	Rilis untuk Fi Store waktunya sendiri tidak bersamaan dengan rislis Fiyo 1.4.0, karena senagja dijedakan beberapa hari untuk mengantisipasi update kecil pada Fiyo 1.4.0.</p>\r\n<h3>\r\n	Sitemap XML Generator</h3>\r\n<p>\r\n	Anda bisa melakukan pelacakan setiap url yang diciptakan dan merangkumnya dalam satu file XML yang bisa digunakan sebagai Sitemap. Fitur ini bisa digunakan dengan menggunakan <strong>Fi Sitemap</strong>.&nbsp;</p>\r\n<h3>\r\n	Change Logs</h3>\r\n<ol>\r\n	<li>\r\n		Penambahan fitur Sitemap XML.</li>\r\n	<li>\r\n		Penambahan fitur perijinan regristrasi user baru.</li>\r\n	<li>\r\n		Penambahan fitur reCaptcha dan captcha math.</li>\r\n	<li>\r\n		Penambahan sistem rating untuk Article.</li>\r\n	<li>\r\n		Penambahan biodata <em>Author</em> artikel (user).</li>\r\n	<li>\r\n		Penambahan konfigurasi rating pada Article Parameter.</li>\r\n	<li>\r\n		Penambahan konfigurasi layout artikel.</li>\r\n	<li>\r\n		Penambahan fitur statistik.</li>\r\n	<li>\r\n		Mengganti sistem penganggalan pada <em>Article</em>.</li>\r\n	<li>\r\n		Mengganti nama fungsi&nbsp;<strong>dataConfig</strong>&nbsp;menjadi&nbsp;<strong>siteConfig</strong>.</li>\r\n	<li>\r\n		Perbaikan fitur <strong>XML</strong> generat untuk <strong>RSS Feed.</strong></li>\r\n	<li>\r\n		Perbaikan sistem Auto Installer.</li>\r\n</ol>\r\n', '2013-04-03 11:42:48', '', 1, '', 'sejarah', '', 1, 1, 99, 142, 'show_comment=1;\nshow_author=1;\nshow_date=1;\nshow_category=1;\nshow_tags=1;\nshow_hits=1;\nshow_rate=1;\nrate_value=5;\nrate_counter=1;\nshow_panel=1;\n', '0000-00-00 00:00:00', 0),
(10, 'Fiyo CMS 1.3.0', 1, '<p>\r\n	Tanggal 16 October 2012, Fiyo CMS versi 1.3.0 resmi di rilis dan pertama kalo di unggah pada situs www.sourceforge.net. Seperti apa yang telah di sampaikan sebelumnya pada artikel <a href=''http://www.fiyo.org/blog/whats-new-on-fiyo-cms-1-3-0.html''>Pre-release Fiyo 1.3.0</a>&nbsp;ada beberapa update yang tidak sedikit di tambahkan dalam versi ini. Disamping vitur yang telah di sampaikan pada Pre-release, ada beberapa fitur tambahan yang memang di tambahkan karena kebutuhan. Mau tau apa saja fitur lengkap yang ada di Fiyo CMS 1.3.0? Berikut data lengjap tetang apa saja yang ada pada Fiyo CMS 1.3.0.</p>\r\n<p>\r\n	Pada versi anyar ini, developer mencoba untuk melengkapi fitur multi bahasa yang ada untuk AdminPanel, dan melengkapi beberapa <em>helper&nbsp;</em>agar memudahkan user dalam membuat website. Jadi apabila anda kesulitan, anda bias membuka<em> helper&nbsp;</em>yang tersedia pada setiap halaman AdminPanel.</p>\r\n<hr id=''system-readmore'' />\r\n<p>\r\n	Ada fitur <em><strong>Auto Tagging</strong></em>, jadi kita bisa memberikan tag pada artikel dan akan otomatis erbentuk ketika kita menekan koma atau enter, sehingga diharapkan mampu mengurangi kesalahan pada penulisan tag artikel.</p>\r\n<p>\r\n	Fitur yang <em><strong>Global Default Page</strong></em> juga merupakan fitur baru, disini kita dapat menentukan halaman default untuk semua halaman yang tidak mempunyai halaman tetap. Jadi, halaman yang tidak mempunyai Page_ID akan mempunyai halaman dengan&nbsp;<em><strong>Global Default Page.</strong></em></p>\r\n<p>\r\n	Serta ada fitur&nbsp;RSS Feed yang bisa anda dapatkan pada kategori artikel atau tag artikel pada bagian bawah halaman dengan icon khusus. Untuk daftar update dengan tanda <strong>Ready!&nbsp;</strong>belum sepenuhnya di aktifkan, karena itu bermain dengan <em>.htaccess.&nbsp;</em>Disarankan untuk merubah&nbsp;<em>.htaccess</em> untuk live server saja dan bukan server lokal. Anda bisa mengaktifkanya dengan merubah isi dari&nbsp;<em>.htaccess.</em></p>\r\n<p>\r\n	Berikut daftar update untuk Fiyo CMS 1.3.0 :</p>\r\n<ul>\r\n	<li>\r\n		Auto Generate Meta Description</li>\r\n	<li>\r\n		Auto Generate Meta Keyword</li>\r\n	<li>\r\n		Auto Generate Meta Robots</li>\r\n	<li>\r\n		Auto Generate Meta Author</li>\r\n	<li>\r\n		Optimize Page Title</li>\r\n	<li>\r\n		GZiP <strong>Ready!</strong></li>\r\n	<li>\r\n		SpeedUp Caching Server &amp; Browser <strong>Ready!</strong></li>\r\n	<li>\r\n		Copressed Static File <strong>Ready!</strong></li>\r\n	<li>\r\n		Scurity libwww (Library World Wide Web) via .httaccess<strong> Ready!</strong></li>\r\n	<li>\r\n		RSS Feed</li>\r\n	<li>\r\n		Auto Tagging</li>\r\n	<li>\r\n		Default Global Page</li>\r\n</ul>\r\n<p>\r\n	Fix Bug :</p>\r\n<ul>\r\n	<li>\r\n		Scurity Media Manager</li>\r\n	<li>\r\n		Auto Change AdminPanel</li>\r\n	<li>\r\n		Auto Installer in LocalServer</li>\r\n	<li>\r\n		MultiDeletation on Admin Panel</li>\r\n</ul>\r\n<p>\r\n	Change Log :</p>\r\n<ul>\r\n	<li>\r\n		Add new<em> data</em> for table <strong><em>_setting :</em></strong>\r\n		<ul>\r\n			<li>\r\n				lang =&gt; language</li>\r\n			<li>\r\n				backend_folder =&gt; Auto change AdminPanel</li>\r\n			<li>\r\n				follow_link = Meta Robots</li>\r\n			<li>\r\n				site_mail = Official Site Mail</li>\r\n		</ul>\r\n	</li>\r\n	<li>\r\n		Add new <em>column</em>&nbsp;for table&nbsp;<strong><em>_article_category :</em></strong>\r\n		<ul>\r\n			<li>\r\n				keyword =&gt; Meta Keyword category</li>\r\n		</ul>\r\n	</li>\r\n	<li>\r\n		Add new&nbsp;<em>column</em>&nbsp;for table&nbsp;<strong><em>_menu :</em></strong>\r\n		<ul>\r\n			<li>\r\n				global =&gt; Global default Page</li>\r\n		</ul>\r\n	</li>\r\n	<li>\r\n		Change global user session :\r\n		<ul>\r\n			<li>\r\n				<div>\r\n					$_SESSION[rootSession().&#39;_id&#39;] &nbsp; = &#39;&#39; ;</div>\r\n			</li>\r\n			<li>\r\n				<div>\r\n					$_SESSION[rootSession().&#39;_user&#39;] &nbsp;= &#39;&#39; ;</div>\r\n			</li>\r\n			<li>\r\n				<div>\r\n					$_SESSION[rootSession().&#39;_email&#39;] = &#39;&#39; ;</div>\r\n			</li>\r\n			<li>\r\n				<div>\r\n					$_SESSION[rootSession().&#39;_level&#39;] = &#39;&#39; ;</div>\r\n			</li>\r\n		</ul>\r\n	</li>\r\n</ul>\r\n', '2012-10-16 08:11:31', '', 1, '', 'Fiyo,CMS,1.3.0', '', 1, 1, 99, 202, 'show_comment=1;\nshow_author=1;\nshow_date=1;\nshow_category=1;\nshow_tags=1;\nshow_hits=1;\nshow_rate=1;\nrate_value=9;\nrate_counter=3;\n1', '0000-00-00 00:00:00', 0),
(11, 'About Fiyo CMS', 4, '<p>\r\n	Fiyo CMS adalah salah satu dari ratusan Content Management System yang ada di internet.&nbsp;Content Management System atau dalam bahasa Indonesia disebut Sistem Manajemen Konten (disingkat CMS), adalah software yang memungkinkan seseorang untuk menambahkan dan/atau memanipulasi (mengubah) isi dari suatu situs Web.<em style=''font-size: 10px; ''>&nbsp;(<a href=''http://id.wikipedia.org/wiki/Sistem_manajemen_konten''>http://id.wikipedia.org/wiki/Sistem_manajemen_konten</a>)</em></p>\r\n<p>\r\n	Contoh lain CMS seperti Joomla, Wrodpress, Blogspot dan masih banyak lagi.</p>\r\n<hr id=''system-readmore'' />\r\n<h2>\r\n	Kenapa Harus Fiyo ?</h2>\r\n<p>\r\n	Jika anda berpendapat Fiyo sama dengan CMS lain, benar juga, jenisanya kan juga sama-sama CMS. Tetapi Fiyo juga pasti ada bedanya, apalagi dengan CMS yang sudah memiliki banyak developer (pengembang) seperti Joomla, Wrodpress, Drupal, dll.</p>\r\n<p>\r\n	Tapi tenang saja, Fiyo CMS mempunyai fitur yang gak kalah cangihnya. dari mulai kemudahan membuat sebuah theme atau convert template gratisan ke Fiyo Theme dengan cara yang mudah.</p>\r\n<p>\r\n	Ditambah lagi, developernya orang Indonesia yang ramah-ramah. Jadi bisa mudah tanya jawab dengan mereka.</p>\r\n<blockquote>\r\n	<p>\r\n		FiyoCMS gratis kan ?</p>\r\n</blockquote>\r\n<p>\r\n	Oh, tentunya gratis! Kan disesuaikan dengan selera orang Indonesia :D</p>\r\n<h2>\r\n	Fiyo CMS untuk siap saja ?</h2>\r\n<p>\r\n	Fiyo dibuat untuk siapa saja yang ingin menambah referensi para pecinta CMS untuk lebih berkreasi. Dan mereka yang baru mengenal CMS atau hanya sekedar ingin membuat website bisa menggunakan Fiyo.</p>\r\n<p>\r\n	Terutama untuk orang Indonesia dan masyarakat Indonesia supaya perkembangan teknologi di Indonesia semkasin maju kejalan yang positif.</p>\r\n<h2>\r\n	Fiyo CMS bisa apa saja ?</h2>\r\n<p>\r\n	Anda bisa menggunakan Fiyo untuk memenuhi kebutuhan anda dalam dunia internet, khususnya website seperti :</p>\r\n<ul>\r\n	<li>\r\n		Pembuatan situs pribadi</li>\r\n	<li>\r\n		Perusahaan komersil / non komersil</li>\r\n	<li>\r\n		Organisasi kelompok / komunitas</li>\r\n	<li>\r\n		Situs Pemerintahan</li>\r\n	<li>\r\n		Toko Online / e-Commerce</li>\r\n	<li>\r\n		Situs Sekolah</li>\r\n	<li>\r\n		dll</li>\r\n</ul>\r\n<h2>\r\n	Pengembanganya bagaimana ?</h2>\r\n<p>\r\n	Fiyo CMS juga boleh di&nbsp;<em>otak-atik&nbsp;</em>sesuai kebutuhan, tetapi jangan merubah nama Fiyo CMS dengan nama baru lho! Sangat dilarang dan tidak bijak. Alangkah baiknya jika kita saling menghargai karya orang lain.</p>\r\n<blockquote>\r\n	<p>\r\n		Wah jadi gak sabar pingin coba nih :)</p>\r\n</blockquote>\r\n<p>\r\n	Widiiiih, udah pingin nyobai nih ? Langsung aja download Fiyo CMS versi terbaru di link&nbsp;<a href=''http://www.fiyo.org/downloads.html''>ini</a></p>\r\n<p>\r\n	Sekian dulu ya artikel kali ini, semoga dapat menambah wawasan para pembaca.</p>\r\n<p>\r\n	<em>Dukung terus buatab Asli 100% Indonesia !</em></p>\r\n', '2012-12-04 15:14:16', 'Fiyo CMS', 1, '', 'komputer', '', 0, 1, 99, 404, 'show_comment=1;\nshow_author=0;\nshow_date=0;\nshow_category=0;\nshow_tags=0;\nshow_hits=1;\nshow_rate=1;\nrate_value=0;\nrate_counter=ow_panel=0;\nshow_panel=0;\n', '2013-08-30 12:31:04', 0),
(12, 'Mengenal Lebih Dekat tentang Fiyo CMS', 1, '<p>\r\n	Bagi yang masih penasaran dan bertanya-tanya apa itu Fiyo CMS? Buat apa sih Fiyo CMS? Atau, apalagi nih Fiyo CMS? Jangan jangan itu virus? Wah kagak minat ah!</p>\r\n<p>\r\n	Tenang, tenang sabar dulu, langsung saja nih silahkan dibaca untuk lebih jelasnya.</p>\r\n<hr id=''system-readmore'' />\r\n<p>\r\n	Fiyo CMS adalah sebuah Content Management System.&nbsp;</p>\r\n<blockquote>\r\n	<p>\r\n		Apalagi nih Content Management System ?</p>\r\n</blockquote>\r\n<p>\r\n	Content Management System atau dalam bahasa Indonesia disebut Sistem Manajemen Konten (disingkat CMS), adalah software yang memungkinkan seseorang untuk menambahkan dan/atau memanipulasi (mengubah) isi dari suatu situs Web.<em style=''font-size: 10px; ''>&nbsp;(<a href=''http://id.wikipedia.org/wiki/Sistem_manajemen_konten''>http://id.wikipedia.org/wiki/Sistem_manajemen_konten</a>)</em></p>\r\n<p>\r\n	Contoh lain CMS seperti Joomla, Wrodpress, bahkan Blogspot juga CMS looh. Gimana sudah bisa mengertikan apa itu CMS?</p>\r\n<blockquote>\r\n	<p>\r\n		Jadi sama aja antara Fiyo dengan CMS yang lain ?</p>\r\n</blockquote>\r\n<p>\r\n	Ehmm, kalo dibilang sama sih iya, kan jenisanya juga sama-sama CMS. Tetapi Fiyo CMS juga pasti ada bedanya, apalagi dengan CMS yang sudah memiliki banyak developer (pengembang) seperti Joomla, Wrodpress, Drupal, dll.</p>\r\n<p>\r\n	Tapi tenang saja, Fiyo CMS mempunyai fitur yang gak kalah canggihnya. dari mulai kemudahan membuat sebuah theme atau convert template gratisan ke Fiyo Theme dengan cara yang mudah.</p>\r\n<p>\r\n	Ditambah lagi, developernya orang Indonesia yang ramah-ramah, jadi bisa mudah tanya jawab dengan mereka.</p>\r\n<blockquote>\r\n	<p>\r\n		Fiyo CMS free kan ?</p>\r\n</blockquote>\r\n<p>\r\n	Oh, tentunya <em>free</em>! Karena disesuaikan dengan selera orang Indonesia, hahaha.</p>\r\n<p>\r\n	Fiyo CMS juga boleh di <em>otak-atik&nbsp;</em>sesuai kebutuhan, tetapi jangan merubah nama Fiyo CMS dengan nama baru lho! Sangat dilarang dan tidak bijak. Alangkah baiknya jika kita saling menghargai karya orang lain.</p>\r\n<p>\r\n	Yang terpenting adalah, kata free yang bararti bebas dan gratjs itu berbeda. Fiyo CMS adalah software free dalam arti <u>bebas</u>.</p>\r\n<blockquote>\r\n	<p>\r\n		Lisensinya gimana untuk Fiyo CMS ?</p>\r\n</blockquote>\r\n<p>\r\n	Fiyo CMS menggunakan License&nbsp;GNU General Public License, version 3 (GPL-3.0) sebagai basis lisensinya.</p>\r\n<p>\r\n	Jadi menurut keterangan untuk lisensi tersebut, adalah setiap orang dapat mengopy (mengunduh) dan mendisitribusikan kembali. Tetapi tidak diperbolehkan untuk melakukan perubahan terhadap sistem yang ada tanpa izin.</p>\r\n<blockquote>\r\n	<p>\r\n		Emang Fiyo CMS bisa dipake buat apa aja sih ?</p>\r\n</blockquote>\r\n<p>\r\n	Fiyo CMS sengaja disiapkan untuk pengembangan yang lebih lanjut, meski dasarnya adalah CMS yang simple. Dari kategori yang umum digunakan oleh orang-orang, yaitu digunakan untuk <em>ngeblog</em>, buat toko online, website perkantoran, &nbsp;website pemerintahan, dan masih banyak lagi sesuai keinginan anda.</p>\r\n<p>\r\n	Fiyo CMS yang berbasis Fiyo Framework juga telah dikembangkan untuk pembuatan sistem informasi berbasis website, seperti Sistem Administrasi Sekolah, Sistem Perkantoran, Sistem Keuangan, dan Sistem Database lainya.</p>\r\n<p>\r\n	Jadi, meski simple pengembangan Fiyo CMS masihlah panjang karena akan ada banyak penambahan AddOns seiring berjalanya waktu.&nbsp;</p>\r\n<blockquote>\r\n	<p>\r\n		Wah jadi gak sabar pingin coba nih :)</p>\r\n</blockquote>\r\n<p>\r\n	Waaaah, udah pingin nyobai nih? Langsung aja download Fiyo CMS versi terbaru di <a href=''http://www.fiyo.org/downloads''>link </a><a href=''http://www.fiyo.org/downloads.html''>ini</a></p>\r\n<p>\r\n	Sekian dulu ya artikel kali ini, semoga dapat menambah wawasan para pembaca.</p>\r\n<p>\r\n	<em>Dukung terus buatab Asli 100% Indonesia !</em></p>\r\n', '2013-03-22 23:18:52', '', 1, '', 'Fiyo,CMS,free,Indonesia', '', 1, 1, 99, 847, 'show_comment=1;\nshow_author=1;\nshow_date=1;\nshow_category=1;\nshow_tags=1;\nshow_hits=1;\nshow_rate=1;\nrate_value=29;\nrate_counter=6;\n0', '0000-00-00 00:00:00', 0),
(13, 'Parade Modules Fiyo CMS', 4, '<p>\r\n	Ini adalah halaman parade module dimana module ditampilkan disini semuanya untuk melihat module apa yang terinstall.&nbsp;</p>\r\n<p style=''text-align: center;''>\r\n	<img alt='''' src=''/media/images/brush.png'' style=''width: 412px; height: 330px;'' /></p>\r\n', '2013-08-22 14:39:31', '', 1, '', '', '', 0, 1, 99, 357, 'show_comment=0;\nshow_author=0;\nshow_date=0;\nshow_category=0;\nshow_tags=0;\nshow_hits=0;\nshow_rate=0;\nrate_value=0;\nrate_counter=0;\nshow_panel=1;\n', '0000-00-00 00:00:00', 0),
(14, 'Fiyo CMS 1.5.0', 1, '<p>\r\n	Semakin optimal peforma dari Fiyo CMS di versi 1.5.0 ini. Banyak perubahan dari sisi <em>system core</em> yang ada untuk mengoptimalkan Fiyo CMS. Kami ingin selalu menyajikan sebuah perangkat yang mudah digunakan, sangat mudah dan ringan diakses. Oleh karena itu kami akan terus melekukan perbaikan dan invoasi serta menerima saran dari para pengguna Fiyo CMS.</p>\r\n<p>\r\n	Merupakan penyempurnaan dari versi sebelumnya, yaitu Fiyo 1.4.0 dengan penambahan fitur yang banyak, Fiyo 1.5.0 lebih spesifik kepada penyempurnaan dari awal Fiyo CMS terbentuh hingga versi yang sekarang. Fungsi dari AdminPanel dan situs depan telah aktif secara keseluruhan.</p>\r\n<hr id=''system-readmore'' />\r\n<h2>\r\n	Edit Theme</h2>\r\n<p>\r\n	Fiyo 1.5.0 memiliki fitur baru dibagian <strong>Theme Manager</strong>, yaitu penambahan tombol <u>Edit Theme</u>. Dimana kita bisa mengedit file yang ada dalam <em>theme</em> yang dipilih.</p>\r\n<p style=''text-align: center;''>\r\n	<img alt=''Edit Theme'' src=''/media/images/edit_theme.jpg'' style=''width: 464px; height: 298px;'' /></p>\r\n<p>\r\n	Anda hanya perlu memilih file yang ingin di edit dan simpan dengan dengan mudah disisi kanan layar.</p>\r\n<p style=''text-align: center;''>\r\n	<img alt=''Edit File Theme on Fiyo CMS'' src=''/media/images/file_theme.gif'' style=''width: 600px; height: 323px;'' /></p>\r\n<p>\r\n	Dengan ini kita dengan mudah menambahkan tag custom apapun, seperti Google Analytics, file css, file javascript atau tag lainya.&nbsp;</p>\r\n<h2>\r\n	HTML Valid Ready!</h2>\r\n<p>\r\n	Memang semua bisa mengatakan bahwa mereka juga siap untuk menjadikan situs lulus uji validasi HTML. <u>Tetapi kami jauh lebih siap</u>&nbsp;Fiyo 1.5.0 akan membantu Anda untuk memuat semua file css didalam tag &lt;head&gt;. tinggal tambahkan kode berikut di setiap file tema yang digunakan,</p>\r\n<div>\r\n	<span style=''font-family:courier new,courier,monospace;''>&lt;?php loadAppsCss(); ?&gt;</span></div>\r\n<div>\r\n	<span style=''font-family:courier new,courier,monospace;''>&lt;?php loadModuleCss(); ?&gt;</span></div>\r\n<div>\r\n	&nbsp;</div>\r\n<h2 style=''text-align: center;''>\r\n	<em>Fiyo 1.5.0, More Stable, More Fast and More Elegant</em></h2>\r\n', '2013-08-30 19:29:20', '', 1, '', '', '', 1, 1, 99, 40, 'show_comment=0;\nshow_author=0;\nshow_date=0;\nshow_category=0;\nshow_tags=0;\nshow_hits=0;\nshow_rate=0;\nrate_value=0;\nrate_counter=0;\nshow_panel=0;\n', '2013-08-30 12:14:20', 2),
(17, 'Fiyo CMS 1.5.7', 1, '<p>Update yang sangat terasa untuk versi 1.5.x yaitu terlihat pada halaman installer dan login Admin Panel. Kami memberikan sentuhan lebih elegan agar lebih enak dipandang. Dan beberapa penyempurnaan untuk tampilan pada antar muka Admin Panel itu sendiri.</p>\r\n\r\n<p>Menu Admin Panel tampak lebih gelap dari versi sebelumnya dan tombol pun lebih enak dilihat. Selain dihalaman Admin Panel, theme untuk website juga ada sedikit sentuhan, menambahkan beberapa css untuk merubah notifikasi dan menu agar lebih pas di versi mobile.</p>\r\n\r\n<div style=''page-break-after: always;''><span style=''display: none;''>&nbsp;</span></div>\r\n\r\n<p>Pada bagian App User sudah bisa untuk aktifasi member melalui konfirmasi email ataupun pendaftaran otomatis aktif. Dan fitur lupa password menggunakan token yang dikirim melalui email.</p>\r\n\r\n<p>Fiyo 1.5.7 telah didukung fitur update otomatis. Jadi anda tidak perlu lagi mengupdate Fiyo installer secara penuh, hanya klik tombol otomatis maka Fiyo sudah update ke versi terbaru. Update ini juga bisa dilakukan secara manual melalui AddOns Installer. Fiyo&nbsp;1.5.7 juga menerapkan redirect www di Admin Panel, jadi www/non-www juga di filter pada Admin Panel.</p>\r\n\r\n<h3>New :&nbsp;</h3>\r\n\r\n<ul>\r\n	<li>User email activation</li>\r\n	<li>Update Otomatis</li>\r\n	<li>siteConfig(&#39;member_activation&#39;);</li>\r\n	<li>siteConfig(&#39;member_register&#39;);</li>\r\n	<li>siteConfig(&#39;member_group&#39;);</li>\r\n</ul>\r\n\r\n<h3>Update :</h3>\r\n\r\n<ul>\r\n	<li>User reminder</li>\r\n	<li>User register</li>\r\n	<li>Article</li>\r\n	<li>AdminPanel Login</li>\r\n	<li>Offline Theme</li>\r\n	<li>Curve Theme</li>\r\n	<li>Konfigurasi Situs</li>\r\n	<li>Bahasa App Contact</li>\r\n	<li>Bahasa App Comment</li>\r\n	<li>Bahasa App User</li>\r\n	<li>Merubah target pembaharuan :&nbsp;http://www.fiyo.org/update.xml</li>\r\n</ul>\r\n\r\n<h3>Fix :</h3>\r\n\r\n<ul>\r\n	<li>App Contact (personal-view)</li>\r\n	<li>App Article (featured,blog)</li>\r\n	<li>Plugin SEF (www redirection)</li>\r\n	<li>System Core :&nbsp;function.php -&gt; FUrl();</li>\r\n	<li>System Core :&nbsp;site.php -&gt; global</li>\r\n	<li>Dasboard Visitor Statistic</li>\r\n</ul>\r\n', '2013-12-17 14:08:31', '', 1, '', '', '', 1, 1, 99, 46, 'show_comment=1;\nshow_author=1;\nshow_date=1;\nshow_category=1;\nshow_tags=1;\nshow_hits=1;\nshow_rate=1;\nrate_value=1;\nrate_counter=0;\nshow_panel=1;\n', '2013-12-17 13:37:29', 1);


-- --------------------------------------------------------

--
--Table structure for table `db_prefix_article_category`
--

CREATE TABLE IF NOT EXISTS `db_prefix_article_category` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `parent_id` int(5) NOT NULL,
  `description` varchar(250) NOT NULL,
  `keywords` varchar(150) NOT NULL,
  `level` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
--Dumping data for table `db_prefix_article_category`
--

INSERT INTO `db_prefix_article_category` (`id`, `name`, `parent_id`, `description`, `keywords`, `level`) VALUES
(1, 'Blog', 0, 'kk', 'asd', 99),
(2, 'Docs', 0, 'Fiyo Documentation', 'Fiyo Documentation', 99),
(3, 'Page', 0, '', '', 99);

-- --------------------------------------------------------

--
--Table structure for table `db_prefix_comment`
--

CREATE TABLE IF NOT EXISTS `db_prefix_comment` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `link` varchar(250) NOT NULL,
  `user_id` int(5) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `website` varchar(100) NOT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `comment` text NOT NULL,
  `status` int(1) NOT NULL,
  `clink` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=85 ;

--
--Dumping data for table `db_prefix_comment`
--

INSERT INTO `db_prefix_comment` (`id`, `link`, `user_id`, `name`, `email`, `website`, `date`, `comment`, `status`, `clink`) VALUES
(84, '?app=article&view=item&id=14', 99, 'Perahu Ilmu', 'perahuilmu@gmail.com', '#www.perahuilmu.net', '2013-07-11 20:35:05', 'mantap gan, ane pengen nyobain nih punya anak negeri :-) ( www.perahuilmu.net )', 1, 4),
(24, '?app=article&view=item&id=14', 0, 'terzier', 'terziersampurno@yahoo.co.id', 'www.mybb-id.com', '2012-03-10 02:48:56', 'cms yang bagus. layak dicoba nih. :)\r\n\r\nsalam kenal dari aku,\r\nterzier,\r\nCEO - Founder MyBB-ID.com', 1, 3),
(81, '?app=article&view=item&id=9', 1, 'Administrator', 'admin@fiyo.org', '', '2013-03-29 19:04:06', 'okeeeyy terimakasih :)', 1, 2),
(82, '?app=article&view=item&id=12', 99, 'qwerty', 'qwerty@gmail.com', '', '2013-04-03 01:51:40', 'Kok qwerty qwerty?', 1, 3),
(83, '?app=article&view=item&id=10', 99, 'Radhitya', 'raftsaw@outlook.com', '', '2013-07-11 20:35:10', 'terus lanjutkan :D\r\nteru diperbaharui dan dipercanggih !\r\nsementara itu saya mau unduh dan dipelajari dulu , hhe', 1, 4),
(36, '?app=article&view=item&id=6', 0, 'Rocker', 'roes.wibowo@yahoo.com', 'http://roes-wibowo.com', '2012-05-17 19:58:52', 'You''re ROCK man!! :D', 1, 2),
(37, '?app=article&view=item&id=5', 0, 'Hendri', 'hendritriplesix@gmail.com', 'underconsturction.com', '2012-05-17 19:58:47', 'MANTAP...\r\n\r\nTerimakasih \r\nsemoga Sukses selalu', 1, 1),
(38, '?app=article&view=item&id=5', 0, 'saione', 'saione@yahoo.com', 'http://google.com', '2012-05-17 19:58:41', 'nice cms...', 1, 2);

-- --------------------------------------------------------

--
--Table structure for table `db_prefix_comment_setting`
--

CREATE TABLE IF NOT EXISTS `db_prefix_comment_setting` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `value` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
--Dumping data for table `db_prefix_comment_setting`
--

INSERT INTO `db_prefix_comment_setting` (`id`, `name`, `value`) VALUES
(1, 'auto_submit', '0'),
(2, 'name_filter', 'Admin, Administrator'),
(3, 'email_filter', 'email'),
(4, 'word_filter', 'anj, ngsat, sial, njin'),
(6, 'recaptcha_privatekey', ''),
(5, 'recaptcha_publickey', '');

-- --------------------------------------------------------

--
--Table structure for table `db_prefix_contact`
--

CREATE TABLE IF NOT EXISTS `db_prefix_contact` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(20) NOT NULL,
  `country` varchar(20) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `fax` varchar(20) NOT NULL,
  `job` varchar(100) NOT NULL,
  `photo` text NOT NULL,
  `web` varchar(30) NOT NULL,
  `ym` varchar(50) NOT NULL,
  `fb` varchar(50) NOT NULL,
  `tw` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `group_id` int(5) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
--Dumping data for table `db_prefix_contact`
--

INSERT INTO `db_prefix_contact` (`id`, `name`, `gender`, `email`, `address`, `city`, `state`, `country`, `zip`, `phone`, `fax`, `job`, `photo`, `web`, `ym`, `fb`, `tw`, `description`, `group_id`, `status`) VALUES
(1, 'First Ryan', 1, 'firstryan@gmail.com', 'Jl. Selomulyo Mukti Timur VI\r\n444', 'Semarang', 'Jawa Tengah', 'Indonesia', '50195', '0898 578 578 7', '', 'CEO', '/media/images/brush.png', 'http://firstryan.net', 'firstryan', 'firstryan', 'firstryan', '', 1, 1);

-- --------------------------------------------------------

--
--Table structure for table `db_prefix_contact_group`
--

CREATE TABLE IF NOT EXISTS `db_prefix_contact_group` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
--Dumping data for table `db_prefix_contact_group`
--

INSERT INTO `db_prefix_contact_group` (`id`, `name`, `description`) VALUES
(1, 'Developer', 'Fiyo Developers ');

-- --------------------------------------------------------

--
--Table structure for table `db_prefix_menu`
--

CREATE TABLE IF NOT EXISTS `db_prefix_menu` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `category` varchar(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `link` text NOT NULL,
  `app` varchar(100) NOT NULL,
  `parent_id` int(5) NOT NULL,
  `status` int(5) NOT NULL,
  `short` int(5) NOT NULL,
  `level` int(5) NOT NULL DEFAULT '3',
  `home` int(5) NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL,
  `show_title` int(2) NOT NULL,
  `sub_name` varchar(100) NOT NULL,
  `class` varchar(200) NOT NULL,
  `style` text NOT NULL,
  `parameter` text NOT NULL,
  `global` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
--Dumping data for table `db_prefix_menu`
--

INSERT INTO `db_prefix_menu` (`id`, `category`, `name`, `link`, `app`, `parent_id`, `status`, `short`, `level`, `home`, `title`, `show_title`, `sub_name`, `class`, `style`, `parameter`, `global`) VALUES
(1, 'mainmenu', 'Home', '?app=article&view=featured&type=blog', 'app_article', 0, 1, 0, 99, 1, '', 0, 'Beranda', '', '', 'per_page=5;\nshow_panel=1;\nread_more=;\nimgW=150;\nimgH=200;\nformat=blog;\nintro=5;\npanel_format=<b>%a</b> on %f %m %y in %c;\nshow_rss=0;\n', 1),
(2, 'mainmenu', 'About', '?app=article&view=item&id=11', 'app_article', 0, 1, 3, 99, 0, '', 0, '', '', '', 'per_page=5;\nshow_panel=0;\nread_more=;\nimgW=120;\nimgH=100;\nformat=default;\nintro=5;\npanel_format=how_panel=0;\nshow_rss=1;\n', 0),
(3, 'mainmenu', 'Blog', '?app=article&view=category&id=1&type=blog', 'app_article', 0, 1, 2, 99, 0, '', 0, '', '', '', 'per_page=5;\nshow_panel=1;\nread_more=;\nimgW=120;\nimgH=100;\nformat=blog;\nintro=5;\npanel_format=;\nshow_rss=1;\n', 0),
(9, 'mainmenu', 'Sub Menu', '#', 'sperator', 3, 1, 0, 99, 0, '', 1, '', '', '', '', 0),
(10, 'mainmenu', 'Sub Menu', '#', 'sperator', 3, 1, 0, 99, 0, '', 1, '', '', '', '', 0),
(8, 'mainmenu', 'Contact', '?app=contact&view=group&id=1', 'app_contact', 0, 1, 5, 99, 0, '', 1, '', '', '', 'per_page=10;\nshow_name=1;\nshow_group=1;\nshow_gender=1;\nshow_address=1;\nshow_phone=0;\nshow_email=1;\nshow_links=0;\nshow_job=0;\nshow_photo=0;\n', 0);

-- --------------------------------------------------------

--
--Table structure for table `db_prefix_menu_category`
--

CREATE TABLE IF NOT EXISTS `db_prefix_menu_category` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `category` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `category_2` (`category`),
  UNIQUE KEY `category_3` (`category`),
  KEY `category` (`category`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
--Dumping data for table `db_prefix_menu_category`
--

INSERT INTO `db_prefix_menu_category` (`id`, `category`, `title`, `description`) VALUES
(1, 'mainmenu', 'Main Menu', 'Menu utama');

-- --------------------------------------------------------

--
--Table structure for table `db_prefix_module`
--

CREATE TABLE IF NOT EXISTS `db_prefix_module` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `folder` varchar(150) NOT NULL,
  `position` varchar(100) NOT NULL,
  `short` int(2) NOT NULL,
  `level` int(2) NOT NULL DEFAULT '3',
  `status` int(2) NOT NULL DEFAULT '1',
  `page` varchar(250) NOT NULL,
  `parameter` text NOT NULL,
  `class` varchar(200) NOT NULL,
  `style` text NOT NULL,
  `show_title` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=86 ;

--
--Dumping data for table `db_prefix_module`
--

INSERT INTO `db_prefix_module` (`id`, `name`, `folder`, `position`, `short`, `level`, `status`, `page`, `parameter`, `class`, `style`, `show_title`) VALUES
(1, 'Menu', 'mod_menu', 'mainmenu', 0, 99, 1, '1,3,9,10,2,8', 'category=mainmenu;\ntype=2;\nsub_menu=1;\nsub_title=0;\n', '', '', 0),
(2, 'User Panel', 'mod_user', 'right', 0, 99, 1, '1,3,9,10,2,8', '', '', '', 1),
(3, 'Article Archives', 'mod_article_archive', 'right', 0, 99, 1, '66', 'start=;\nend=;\ncat=1,2,4;\ntype=category;\n', '', '', 1),
(4, 'Article List', 'mod_article_list', 'right', 0, 99, 1, '1,3,9,10,2,8', 'type=2;\nfilter=0;\nvalue=;\nitem=5;\ninfo=1;\nother=0;\n', '', '', 1),
(5, 'You are here : ', 'mod_breadchumb', 'breadchumb', 0, 99, 1, '1,3,9,10,2,8', '', '', '', 1),
(6, 'Comments', 'mod_comment', 'right', 0, 99, 1, '1,3,9,10,2,8', 'name=1;\ngravatar=1;\ntitle=1;\ncomment=0;\ndate=1;\ntext=100;\nitem=5;\n', '', '', 1),
(7, 'Search', 'mod_search', 'search', 0, 99, 1, '1,3,9,10,2,8', '', '', '', 0),
(8, 'Statistic', 'mod_statistic', 'right', 0, 99, 1, '1,3,9,10,2,8', 'today=1;\nyesterday=1;\nthisweek=1;\nlastweek=1;\nthismonth=1;\nlastmonth=1;\nall=1;\ninfo=1;\n', '', '', 1);

-- --------------------------------------------------------

--
--Table structure for table `db_prefix_permalink`
--

CREATE TABLE IF NOT EXISTS `db_prefix_permalink` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` text NOT NULL,
  `permalink` varchar(250) NOT NULL,
  `pid` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `locker` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permalink` (`permalink`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
--Dumping data for table `db_prefix_permalink`
--

INSERT INTO `db_prefix_permalink` (`id`, `link`, `permalink`, `pid`, `status`, `locker`) VALUES
(3, '?app=article&view=item&id=14', 'blog/fiyo-cms-1-5-0.html', 1, 1, 0),
(8, '?app=article&view=category&id=1&type=blog', 'blog', 3, 1, 0),
(7, '?app=article&view=item&id=11', 'about', 2, 1, 0),
(13, '?app=contact&view=person&id=1', 'contact/developer/first-ryan.html', 1, 1, 0),
(12, '?app=contact&view=group&id=1', 'contact/developer', 8, 1, 0);

-- --------------------------------------------------------

--
--Table structure for table `db_prefix_plugin`
--

CREATE TABLE IF NOT EXISTS `db_prefix_plugin` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `folder` varchar(20) NOT NULL,
  `status` smallint(1) NOT NULL,
  `parameter` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
--Dumping data for table `db_prefix_plugin`
--

INSERT INTO `db_prefix_plugin` (`id`, `folder`, `status`, `parameter`) VALUES
(1, 'plg_sef', 1, 0),
(2, 'plg_cache', 1, 0),
(3, 'plg_recaptcha', 1, 0),
(4, 'plg_statistic', 1, 0);

-- --------------------------------------------------------

--
--Table structure for table `db_prefix_session_login`
--

CREATE TABLE IF NOT EXISTS `db_prefix_session_login` (
  `user_id` int(11) NOT NULL,
  `session_id` varchar(100) NOT NULL,
  `level` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
--Table structure for table `db_prefix_setting`
--

CREATE TABLE IF NOT EXISTS `db_prefix_setting` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
--Dumping data for table `db_prefix_setting`
--

INSERT INTO `db_prefix_setting` (`id`, `name`, `value`) VALUES
(1, 'site_theme', 'curve'),
(2, 'admin_theme', 'fiyo'),
(3, 'site_name', '_site_title'),
(4, 'site_keys', 'keyword 1, keyword two, 3rd key,'),
(5, 'site_desc', 'Site Description'),
(6, 'site_title', '_site_title'),
(7, 'site_url', 'localhost'),
(8, 'site_status', '1'),
(9, 'sef_url', '1'),
(10, 'file_allowed', 'swf flv avi mpg mpeg qt mov wmv asf rm rar zip exe msi iso'),
(11, 'file_size', '100000'),
(12, 'media_theme', 'oxygen'),
(13, 'title_type', '1'),
(14, 'title_divider', ' - '),
(15, 'sef_www', '1'),
(16, 'sef_ext', '.html'),
(17, 'site_mail', 'mail@domain.com'),
(18, 'backend_folder', 'dapur'),
(19, 'follow_link', '1'),
(20, 'member_registration', '1'),
(21, 'member_activation', '0'),
(22, 'member_group', '5'),
(23, 'version', '1.5.7 5.0'),
(24, 'lang', 'id'),
(25, 'timezone', 'Asia/Jakarta');

-- --------------------------------------------------------

--
--Table structure for table `db_prefix_statistic`
--

CREATE TABLE IF NOT EXISTS `db_prefix_statistic` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ip` varchar(20) NOT NULL,
  `user_id` int(10) NOT NULL,
  `time` datetime NOT NULL,
  `browser` varchar(30) NOT NULL,
  `platform` varchar(30) NOT NULL,
  `country` varchar(15) NOT NULL,
  `city` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
--Table structure for table `db_prefix_statistic_online`
--

CREATE TABLE IF NOT EXISTS `db_prefix_statistic_online` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(20) NOT NULL,
  `url` tinytext NOT NULL,
  `time` int(11) NOT NULL,
  `browser` varchar(20) NOT NULL,
  `platform` varchar(20) NOT NULL,
  `country` varchar(30) NOT NULL,
  `city` varchar(50) NOT NULL,
  `key` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
--Table structure for table `db_prefix_user`
--

CREATE TABLE IF NOT EXISTS `db_prefix_user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` int(2) NOT NULL,
  `level` int(11) NOT NULL DEFAULT '3',
  `time_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `time_log` timestamp NOT NULL,
  `about` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user` (`user`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
--Table structure for table `db_prefix_user_group`
--

CREATE TABLE IF NOT EXISTS `db_prefix_user_group` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(50) NOT NULL,
  `level` int(2) NOT NULL,
  `description` text NOT NULL,
  `allowed_apps` varchar(200) NOT NULL,
  `default_apps` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `level` (`level`),
  KEY `group` (`group_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
--Dumping data for table `db_prefix_user_group`
--

INSERT INTO `db_prefix_user_group` (`id`, `group_name`, `level`, `description`, `allowed_apps`, `default_apps`) VALUES
(1, 'Super Administrator', 1, 'Super Administrator', '', ''),
(2, 'Administrator', 2, 'Admin', '', ''),
(3, 'Editor', 3, 'Editor', '', ''),
(4, 'Publisher', 4, 'Publisher', 'app_article;app_contact;app_download', ''),
(5, 'Member', 5, 'Registered Member', '', '');
