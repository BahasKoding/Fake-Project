# Aplikasi Bantuan Sosial Kementerian Sosial RI

Aplikasi ini adalah sistem manajemen bantuan sosial yang dikembangkan untuk Kementerian Sosial Republik Indonesia. Aplikasi ini memungkinkan pengelolaan pengumuman, pendataan penerima bantuan, monitoring, dan pelaporan bantuan sosial.

## Fitur Utama

1. Manajemen Pengumuman
2. Pendataan Penerima Bantuan
3. Monitoring Bantuan
4. Pelaporan dan Analisis
5. Multi-level User (Warga, Unit Kerja, Menteri Sosial)

## Persyaratan Sistem

- PHP >= 7.3
- Composer
- MySQL atau MariaDB
- Node.js dan NPM

## Instalasi

1. Clone repositori ini:
   ```
   git clone https://github.com/username/repo-name.git
   ```

2. Pindah ke direktori proyek:
   ```
   cd repo-name
   ```

3. Install dependensi PHP:
   ```
   composer install
   ```

4. Install dependensi JavaScript:
   ```
   npm install && npm run dev
   ```

5. Salin file `.env.example` menjadi `.env` dan sesuaikan konfigurasi database:
   ```
   cp .env.example .env
   ```

6. Generate application key:
   ```
   php artisan key:generate
   ```

7. Jalankan migrasi database:
   ```
   php artisan migrate
   ```

8. (Opsional) Jalankan seeder untuk data dummy:
   ```
   php artisan db:seed
   ```

9. Mulai server development:
   ```
   php artisan serve
   ```

Aplikasi sekarang dapat diakses di `http://localhost:8000`.

## Alur Program

1. **Login**
   - User mengakses halaman login
   - Memasukkan kredensial (email dan password)
   - Sistem memverifikasi kredensial dan mengarahkan ke dashboard sesuai role

2. **Dashboard**
   - Menampilkan ringkasan data sesuai role user
   - Menyediakan akses ke berbagai fitur aplikasi

3. **Pengumuman (Unit Kerja dan Warga)**
   - Unit Kerja dapat membuat, mengedit, dan menghapus pengumuman
   - Warga dapat melihat daftar pengumuman

4. **Pendataan (Warga)**
   - Warga mengisi formulir pendataan bantuan
   - Data disimpan dan menunggu verifikasi

5. **Verifikasi Penerima (Unit Kerja)**
   - Unit Kerja melihat daftar pendataan
   - Memverifikasi dan menyetujui atau menolak pendataan

6. **Monitoring (Unit Kerja)**
   - Unit Kerja memasukkan data monitoring bantuan
   - Data monitoring terkait dengan data penerima yang disetujui

7. **Laporan (Unit Kerja dan Menteri Sosial)**
   - Mengakses halaman laporan
   - Memfilter data berdasarkan periode waktu
   - Menampilkan data dalam bentuk tabel
   - Mengunduh laporan dalam format PDF

8. **Download PDF**
   - User memilih filter tanggal (opsional)
   - Mengklik tombol "Download PDF"
   - Sistem menggenerate PDF berdasarkan data yang ditampilkan
   - File PDF diunduh ke perangkat user

## Kontribusi

Jika Anda ingin berkontribusi pada proyek ini, silakan buat pull request. Untuk perubahan besar, harap buka issue terlebih dahulu untuk mendiskusikan apa yang ingin Anda ubah.

## Lisensi

[MIT](https://choosealicense.com/licenses/mit/)
