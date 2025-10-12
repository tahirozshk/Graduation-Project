# 🖥️ XAMPP ile NEU PMS Kurulum Rehberi

Bu rehber, projeyi XAMPP üzerinde çalıştırmak isteyenler için hazırlanmıştır.

---

## ✅ Gereksinimler

- **XAMPP** (PHP 8.2+, MySQL, Apache)
- **Composer** - [Composer İndir](https://getcomposer.org/)
- **Node.js 18+** - [Node.js İndir](https://nodejs.org/)

---

## 🚀 Hızlı Kurulum (5 Dakika)

### 1. XAMPP'i Başlat
```bash
# XAMPP Control Panel'i aç
# Apache ve MySQL'i Start et
```

### 2. Projeyi Yerleştir
```bash
# Projeyi C:\xampp\htdocs\ altına kopyala
cd "C:\xampp\htdocs\Graduation Project"
```

### 3. Bağımlılıkları Yükle
```bash
composer install
npm install
```

### 4. .env Dosyasını Hazırla
```bash
copy .env.example .env
```

**.env dosyasını düzenle:**
```env
APP_KEY=                    # Boş bırak, sonra oluşturulacak
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=neu_pms
DB_USERNAME=root
DB_PASSWORD=                # XAMPP'de boş
```

### 5. Kurulumu Tamamla
```bash
# APP_KEY oluştur
php artisan key:generate

# Veritabanını phpMyAdmin'den oluştur (neu_pms)
# Veya MySQL'de:
# mysql -u root
# CREATE DATABASE neu_pms;
# exit;

# Migration ve seed
php artisan migrate:fresh --seed

# Frontend derle
npm run build

# Serveri başlat
php artisan serve
```

**Tarayıcıda aç:** http://localhost:8000

---

## 🔧 .env Ayarları

### Docker ile Çalıştırıyorsanız:
```env
DB_CONNECTION=mysql
DB_HOST=mysql              # ← Docker container adı
DB_PORT=3306
DB_DATABASE=neu_pms
DB_USERNAME=neu_user
DB_PASSWORD=secret
```

### XAMPP ile Çalıştırıyorsanız:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1          # ← localhost
DB_PORT=3306
DB_DATABASE=neu_pms
DB_USERNAME=root
DB_PASSWORD=               # ← Boş (XAMPP varsayılan)
```

---

## 🔍 Sık Karşılaşılan Sorunlar

### ❌ "No application encryption key"
```bash
php artisan key:generate
php artisan config:clear
```

### ❌ "Access denied for user 'root'"
- `.env` dosyasında `DB_PASSWORD` boş mu kontrol et
- XAMPP'de MySQL şifresi varsa ekle

### ❌ "Database not found"
```bash
# phpMyAdmin'den neu_pms veritabanını oluştur
# http://localhost/phpmyadmin
```

### ❌ "Class not found"
```bash
composer dump-autoload
php artisan clear-compiled
```

### ❌ Port 80 veya 3306 kullanımda
```bash
# Apache için
# httpd.conf'da: Listen 8080

# MySQL için  
# my.ini'de: port=3307
```

---

## 🔄 Docker ile XAMPP Arasında Geçiş

### Docker → XAMPP'e Geçerken:
```bash
# 1. Docker'ı durdur
docker-compose down

# 2. .env'yi güncelle
DB_HOST=127.0.0.1
DB_USERNAME=root
DB_PASSWORD=

# 3. XAMPP MySQL'i başlat ve veritabanını oluştur
# 4. Migration'ları çalıştır
php artisan migrate:fresh --seed
```

### XAMPP → Docker'a Geçerken:
```bash
# 1. XAMPP'i durdur

# 2. .env'yi güncelle
DB_HOST=mysql
DB_USERNAME=neu_user
DB_PASSWORD=secret

# 3. Docker'ı başlat
docker-compose up -d

# 4. Migration'ları çalıştır
docker-compose exec app php artisan migrate:fresh --seed
```

---

## 📝 Geliştirme Komutları

```bash
# Frontend hot reload (development)
npm run dev

# Frontend build (production)
npm run build

# Cache temizle
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Veritabanını sıfırla
php artisan migrate:fresh --seed

# Log dosyasını izle
tail -f storage/logs/laravel.log
```

---

## 🌐 XAMPP ile Production Modu

### 1. Frontend'i Build Et
```bash
npm run build
```

### 2. Cache'leri Oluştur
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 3. .env'de Debug'u Kapat
```env
APP_ENV=production
APP_DEBUG=false
```

### 4. Apache Virtual Host Kur (Opsiyonel)

**httpd-vhosts.conf:**
```apache
<VirtualHost *:80>
    DocumentRoot "C:/xampp/htdocs/Graduation Project/public"
    ServerName neu-pms.local
    <Directory "C:/xampp/htdocs/Graduation Project/public">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

**C:\Windows\System32\drivers\etc\hosts:**
```
127.0.0.1    neu-pms.local
```

Apache'yi yeniden başlat ve `http://neu-pms.local` aç.

---

## 🎯 Demo Kullanıcılar

**Teacher:**
- Email: `ahmed.hassan@neu.edu.tr`
- Şifre: `password`

**Admin:**
- Register sayfasından admin olarak kayıt ol
- İlk admin otomatik onaylanır

---

## 📞 Destek

Sorun yaşarsan:
1. `storage/logs/laravel.log` dosyasını kontrol et
2. `.env` dosyasındaki ayarları doğrula
3. XAMPP MySQL ve Apache'nin çalıştığını kontrol et
4. Cache'leri temizle: `php artisan config:clear`

---

**✨ Başarılar! XAMPP ile geliştirme keyfi!**

