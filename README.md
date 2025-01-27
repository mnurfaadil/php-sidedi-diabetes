# SiDeDi : Sistem Informasi Deteksi Dini Diabetes

## ⚠️ Disclaimer
> Repository ini merupakan project UAS mata kuliah `Sistem Pendukung Keputusan (SPK)` atau `Decision Suport System (DSS)` yang dikembangkan untuk tujuan memenuhi prasyarat mata kuliah SPK. Dataset yang digunakan sebagai acuan perhitungan diabetes disini merupakan `dataset dummy` yang digunakan untuk `tujuan edukasi`.  ⚠️ APLIKASI INI TIDAK DIGUNAKAN SEBAGAI ACUAN MEDIS ATAU TUJUAN KOMERSIAL⚠️ 

## 💬 Informasi
Pengembangan situs ini didasarkan pada materi pada kelas SPK yaitu penerapan Metode Naive Bayes Classifier (NBC) untuk mengkasifikasi penyakit diabetes berdasarkan beberapa kriteria gejala yang ditentukan. Pengembangan aplikasi SiDeDi ini mengacu pada publikasi jurnal yang sama yaitu [JSIKA - SiDedi (Sistem Informasi Deteksi Dini) : Sistem Pendukung Keputusan Deteksi Dini Diabetes](jurnalJSIKA).

## 👉 Petunjuk
- Repository ini berisikan project web
- Pengembangan repository ini menggunakan software XAMPP untuk web server & DBMS (My SQL)
- Clone / download repository ini dan masukan dalam folder `htdocs` XAMPP
- Buat database MySQL baru di `PHPMyAdmin` dan import file `raw/spk.sql` pada halaman [berikut]()
- Nyalakan Apache pada XAMPP dan masuk ke URL `http://localhost/uas_spk/view_training.php` untuk memuat halaman website
- Jika pada situs belum terdapat dataset, kamu bisa mengimport nya melalui file excel pada menu import
- Selamat, situs sudah dapat digunakan untuk mendeteksi (dataset yang ada dalam repository ini adalah data DUMMY)

## 📱 Gambaran Aplikasi
<div>
  <img src="https://www.dropbox.com/s/2zrz6o29dwsnejr/banner_website.png?raw=1" alt="Screen Shot Situs SiDeDi"/>
</div>

## 🚧 Feature / Technology
- [x] PHP Native versi 7.8
- [x] Support Import data excel ke database MySQL [(Library)](https://github.com/shuchkin/simplexls)
- [x] Monitoring / Manage Dataset diabetes
- [x] Uji / deteksi diabetes pada situs

## 🤝🏻 Referensi : [Github UAS SPK SIDEDI](https://github.com/apriantoa917/php-UAS_SPK-SiDeDi)

[ref1]: <https://towardsdatascience.com/naive-bayes-classifier-81d512f50a7c>
[jurnalJSIKA]: <https://www.dropbox.com/s/d12t67ayl5jv14e/Jurnal%20SiDeDi.pdf?dl=0>
[JurnalSTIKESSALSABILA]: <https://jurnal.stikessalsabila.ac.id/index.php/jikd/article/download/79/72/209>
[JurnalUMJ]: <https://jurnal.umj.ac.id/index.php/AN-NUR/article/view/7132>
[appURL]: <>
