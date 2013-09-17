<?php
/**
* @version		1.4.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
* @description	
**/

defined('_FINDEX_') or die('Access Denied');

/************************************
*			Article Manager		 	*
************************************/
define("Article_Desc","Anda dapat menampilkan artikel yang telah Anda buat dengan tipe menu ini.<br>Beberapa fitur tipe menu Artikel sebagai berikut :<ul><li>Menampilkan artikel pilihan (featured) pada <i>home page.</i></li><li>Dapat menampilkan artikel berdasarkan kategori.</li><li>Dapat menampilkan artikel tunggal.</li></ul>");
define("Article_Title","Judul Artikel");
define("Article_New_Saved","Artikel baru berhasil disimpan.");
define("Article_Saved","Artikel berhasil disimpan.");
define("Article_Deleted","Artikel berhasil dihapus.");
define("Article_Not_Select","Pilih artikel terlebih dahulu !");
define("Article_category","Kategori Artikel");
define("Add_new_article","Buat artikel baru");
define("Delete_article","Hapus artikel yang dipilih");
define("Featured_tip","Pilih <i>Ya</i> jika artikel akan ditampilkan pada<br>halaman depan/halaman utama");
define("Tags_tip","Tag artikel dibatasi dengan koma (,)");
define("Keywords_tip","Kata kunci yang digunakan oleh <i>search engine</i><br>untuk menemukan artikel");
define("Meta_Desc_tip","Deskripsi singkat artikel yang juga berpengaruh <br>pada hasil pencarian di <i>search engine</i>");
define("Edit_Article_helper","<h3>Bantuan untuk <i>Article Manager </i></h3><ul><li>Manfatkan fitur editor yang ada untuk memasukan gambar atau media yang lain, serta mengatur dan mengolah artikel anda.</li><li>Kolom <b>Featured</b> berguna jika artikel akan ditampilkan pada halaman depan/halaman utama.</li><li>Untuk mendapatkan hasil yang baik dalam masalah pencarian di <i>search engine</i> Anda dapat memanfaatkan <b>Article Meta</b>.</li><li>Tombol <i>Reset</i> pada <b>Article Information</b> berguna untuk melakukan set ulang nilai <b>Hits</b>.</li></ul>");

define("Add_Article_helper","<h3>Bantuan untuk <i>Article Manager </i></h3><ul><li>Manfaatkan fitur editor yang ada untuk memasukan gambar atau media yang lain, serta mengatur dan mengolah artikel anda.</li><li>Kolom <b>Featured</b> berguna jika artikel akan ditampilkan pada halaman depan/halaman utama.</li><li>Untuk mendapatkan hasil yang baik dalam masalah pencarian di <i>search engine</i> Anda dapat memanfaatkan <b>Article Meta</b>.</li></ul>");
define("Article_helper","<h3>Bantuan untuk <i>Article Manager </i></h3><ul><li>Pada halaman ini anda bisa melihat sekaligus mengolah dan mengatur artikel yang telah dibuat.</li><li>Anda bisa mengatur jumlah artikel yang ditampilkan pada <b>Show [angka] entries</b> yang ada pada bagian kiri tabel.</li><li>Dan dapat melakukan pencarian artikel dengan cepat dan mudah pada kolom <b>Search</b> yang ada pada bagian kanan tabel.</li></ul>");
define("Article_category_helper","<h3>Bantuan untuk <i>Article Categories</i></h3><ul><li>Kategori bisa memiliki beberapa sub-kategori tanpa batas yang ditentukan.</li><li>Sub-Kategori juga bisa memiliki anak kategori lain.</li><li>Masukan deskripsi dan kata kunci untuk mengoptimalkan SEO dari Kategori.</li></ul>");

define("Category_Not_Empty","Gagal, Kategori masih berisi artikel!");
define("Category_Name","Nama Kategori");
define("Parent_category","Kategori Induk");
define("Parent_category_tip","Anda dapat mengelompokan kategori<br> berdasarkan kategori yang telah anda buat.<br>Mendukung fitur multi level");
define("Category_level","Siapa yang berhak mengakses kategori ini.");
define("Article","Artikel");
define("Article_Category_Saved","Kategori artikel berhasil disimpan.");
define("Article_Saved_redirect","Artikel berhasil disimpan. Harap tunggu...");
define("Hits_Reset","Tekan tombol <b>Reset</b> untuk mereset Hits artikel");
define("Article_not_found","<h3>Artikel yang anda cari tidak ditemukan.</h3>Hubungi administrator jika terjadi kesalahan!");
define("Article_cant_access","<h3>Maaf, Anda tidak diperkenankan untuk mengakses halaman ini.</h3>Mohon untuk login terlebih dahulu melalui <a href='".@FUrl."?app=user'>link ini</a>.");

/*********** Article Icon *************/
define("Save_add_new","Simpan dan tambah baru");
define("Save_as_duplicate","Simpan sebagai artikel lain");



/*********** Article Information *************/
define("Author_tip","Nama alias penulis");
define("Date_tip","Tanggal dan waktu pembuatan artikel");
define("Article_Status","Status Artikel");
define("Article_Status_tip","Artikel yang aktif dapat ditampilkan/dilihat");
define("Article_level_tip","Siapa saja yang berhak mengakses artikel ini");

/*********** Article Parameter ************/
define("Show_Panel","Tampilkan Panel");
define("Show_Author","Tampilkan Penulis");
define("Show_Date","Tampilkan Tanggal");
define("Show_Category","Tampilkan Kategori");
define("Show_Hits","Tampilkan Kunjungan");
define("Show_Tags","Tampilkan Tag");
define("Show_Rate","Tampilkan Penilaian");
define("Show_Comment","Tampilkan Komentar");