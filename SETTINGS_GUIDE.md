# Settings Management Guide

## Overview
Settings system untuk mengelola konfigurasi website company profile secara mudah melalui Admin Panel tanpa perlu edit code.

## Kategori Settings

### 1. Company Information
- `company_name` - Nama perusahaan
- `company_tagline` - Slogan/tagline perusahaan
- `company_description` - Deskripsi singkat perusahaan

### 2. Contact Information
- `contact_email` - Email perusahaan
- `contact_phone` - Nomor telepon
- `contact_whatsapp` - Nomor WhatsApp
- `contact_address` - Alamat kantor
- `office_hours` - Jam operasional

### 3. Social Media
- `social_facebook` - URL Facebook
- `social_twitter` - URL Twitter/X
- `social_instagram` - URL Instagram
- `social_linkedin` - URL LinkedIn
- `social_github` - URL GitHub
- `social_youtube` - URL YouTube

### 4. Footer & SEO
- `footer_about` - Teks deskripsi di footer
- `footer_copyright` - Teks copyright
- `meta_keywords` - Keywords untuk SEO
- `meta_description` - Meta description untuk SEO

## Menggunakan Settings di View

### Cara 1: Menggunakan Helper Method (Recommended)
```blade
{{ \App\Models\Setting::get('company_name', 'Default Value') }}
```

### Cara 2: Mendapatkan Settings per Group
```php
$companyInfo = \App\Models\Setting::getByGroup('company');
// Returns: ['company_name' => '...', 'company_tagline' => '...', ...]
```

### Cara 3: Mendapatkan Semua Settings Grouped
```php
$allSettings = \App\Models\Setting::getAllGrouped();
// Returns: ['company' => [...], 'contact' => [...], 'social' => [...], ...]
```

## Set Settings Programmatically

```php
use App\Models\Setting;

Setting::set('company_name', 'AF Web Design', 'string', 'company');
```

## Caching

Settings secara otomatis di-cache selama 1 jam (3600 detik) untuk performa optimal.

Cache akan otomatis di-clear saat:
- Settings di-update melalui admin panel
- Method `Setting::clearCache()` dipanggil

## Menambahkan Setting Baru

### Via Seeder (Recommended)
Edit `database/seeders/SettingsSeeder.php`:

```php
[
    'key' => 'new_setting_key',
    'value' => 'Default Value',
    'type' => 'string', // string, text, json
    'group' => 'category_name' // company, contact, social, footer, seo
],
```

### Via Admin Panel
Admin dapat langsung menambah/edit settings melalui:
`/admin/settings`

## Struktur Database

Table: `settings`
- `id` - Primary key
- `key` - Unique identifier
- `value` - Nilai setting (text)
- `type` - Tipe data (string, text, json)
- `group` - Kategori/grup setting
- `created_at`, `updated_at` - Timestamps

## Lokasi Penggunaan

Settings saat ini digunakan di:
- **Footer** (`resources/views/partials/footer.blade.php`)
  - Company name, tagline, about text
  - Contact info (email, phone, address)
  - Social media links
  - Copyright text

- **Contact Page** (`resources/views/pages/contact.blade.php`)
  - Email, phone, WhatsApp
  - Office address
  - Office hours
  - Social media links

## Tips

1. **Gunakan default values** untuk backward compatibility
2. **Clear cache** setelah update settings via code
3. **Validasi input** untuk settings yang critical (seperti email, URL)
4. **Group settings** untuk organisasi yang lebih baik

## Troubleshooting

### Settings tidak muncul
1. Pastikan settings sudah ada di database
2. Clear cache: `php artisan cache:clear`
3. Check apakah key setting benar

### Perubahan tidak terlihat
1. Clear cache aplikasi
2. Refresh browser (Ctrl+F5)

### Social media tidak muncul
Social media hanya ditampilkan jika URL-nya tidak kosong (menggunakan `@if(\App\Models\Setting::get('social_facebook'))`)
