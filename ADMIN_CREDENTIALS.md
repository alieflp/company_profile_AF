# Admin Login Credentials

## Default Admin Account

Untuk login ke admin panel, gunakan kredensial berikut:

**URL Admin Panel:** `http://your-domain.com/admin/login`

**Email:** `admin@afweb.com`  
**Password:** `password`

---

## Setelah Login Pertama Kali

⚠️ **PENTING: Segera ubah password default untuk keamanan!**

1. Login menggunakan kredensial di atas
2. Buka menu **Profile** atau **Settings**
3. Ubah password menjadi password yang kuat
4. Simpan perubahan

---

## Reset Password

Jika lupa password, gunakan fitur "Lupa Password" di halaman login atau hubungi developer untuk reset manual.

---

## Catatan Keamanan

- Jangan gunakan password `password` di production environment
- Gunakan password yang kuat (minimal 8 karakter, kombinasi huruf besar/kecil, angka, dan simbol)
- Jangan share kredensial admin ke sembarang orang
- Ubah email admin sesuai dengan email perusahaan yang aktif

---

## Seeder Info

Admin user dibuat melalui `AdminUserSeeder.php` yang bisa dijalankan dengan:

```bash
php artisan db:seed --class=AdminUserSeeder
```

Atau saat fresh migration:

```bash
php artisan migrate:fresh --seed
```
