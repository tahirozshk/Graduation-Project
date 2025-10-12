# 🚀 NEU PMS - Hızlı Başlangıç Rehberi

3 adımda projenizi çalıştırın!

---

## 🐳 Yöntem 1: Docker ile (Önerilen - En Kolay!)

### Windows Kullanıcıları

#### 1️⃣ Docker Desktop Kurun
[Docker Desktop for Windows İndir](https://www.docker.com/products/docker-desktop/)

#### 2️⃣ Projeyi Çalıştırın
```bash
# Proje klasörüne gidin
cd "Graduation Project"

# Otomatik kurulum script'ini çalıştırın
docker-start.bat
```

#### 3️⃣ Tarayıcıda Açın
- **Uygulama**: http://localhost:8080
- **Veritabanı**: http://localhost:8081

✅ **Tamamdır!** Uygulama çalışıyor!

---

### Linux/Mac Kullanıcıları

#### 1️⃣ Docker Kurun
```bash
# Linux için
sudo apt-get update
sudo apt-get install docker.io docker-compose

# Mac için Homebrew ile
brew install docker docker-compose
```

#### 2️⃣ Projeyi Çalıştırın
```bash
# Proje klasörüne gidin
cd "Graduation Project"

# Script'e izin verin
chmod +x docker-start.sh

# Otomatik kurulum script'ini çalıştırın
./docker-start.sh
```

#### 3️⃣ Tarayıcıda Açın
- **Uygulama**: http://localhost:8080
- **Veritabanı**: http://localhost:8081

---

## 💻 Yöntem 2: Manuel Kurulum (XAMPP)

### Gereksinimler
- ✅ XAMPP (PHP 8.2+)
- ✅ Composer
- ✅ Node.js 18+

### Adımlar

#### 1️⃣ Bağımlılıkları Yükle
```bash
# PHP bağımlılıkları
composer install

# JavaScript bağımlılıkları
npm install
```

#### 2️⃣ Environment Ayarları
```bash
# .env dosyası oluştur
copy .env.example .env

# Key generate
php artisan key:generate
```

#### 3️⃣ Veritabanı Ayarları

`.env` dosyasında:
```env
DB_CONNECTION=sqlite
# veya MySQL için
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=neu_pms
DB_USERNAME=root
DB_PASSWORD=
```

#### 4️⃣ Database Migration
```bash
php artisan migrate
php artisan db:seed
```

#### 5️⃣ Assets Build
```bash
npm run build
# veya development için
npm run dev
```

#### 6️⃣ Sunucuyu Başlat
```bash
php artisan serve
```

**Tarayıcıda aç**: http://localhost:8000

---

## 🎯 İlk Giriş

### Demo Hesapları

**Teacher Hesabı:**
- Email: `ahmed.hassan@neu.edu.tr`
- Password: `password`

**Admin Hesabı Oluşturma:**
1. http://localhost:8080/register adresine gidin
2. "Admin" rolünü seçin
3. Kayıt olun
4. İlk admin otomatik onaylanır

---

## 📱 Kullanılabilir Portlar

### Docker Development
- Laravel: http://localhost:8000
- Vite: http://localhost:5173
- phpMyAdmin: http://localhost:8081
- MySQL: localhost:3307

### Docker Production
- Uygulama: http://localhost:8080
- phpMyAdmin: http://localhost:8081
- MySQL: localhost:3306

### Manuel (XAMPP)
- Uygulama: http://localhost:8000
- MySQL: localhost:3306 (phpMyAdmin via XAMPP)

---

## 🛠️ Sık Kullanılan Komutlar

### Docker ile

```bash
# Başlat
docker-compose up -d

# Durdur
docker-compose down

# Logları gör
docker-compose logs -f

# Artisan komutu çalıştır
docker-compose exec app php artisan [command]

# Shell'e gir
docker-compose exec app sh
```

### Manuel ile

```bash
# Cache temizle
php artisan cache:clear
php artisan config:clear

# Migration
php artisan migrate
php artisan db:seed

# Test
php artisan test
```

---

## 🆘 Sorun mu Yaşıyorsunuz?

### Docker ile ilgili sorunlar

**Port çakışması:**
```bash
# docker-compose.yml'de portu değiştirin
ports:
  - "9000:80"  # 8080 yerine 9000
```

**Container başlamıyor:**
```bash
# Logları kontrol edin
docker-compose logs app

# Yeniden build edin
docker-compose build --no-cache
docker-compose up -d
```

**Permission hatası:**
```bash
docker-compose exec app chmod -R 755 storage bootstrap/cache
```

### Manuel kurulum sorunları

**Composer hatası:**
```bash
# Memory limit artır
php -d memory_limit=-1 /usr/bin/composer install
```

**NPM hatası:**
```bash
# node_modules'u sil ve tekrar yükle
rm -rf node_modules
npm install
```

**Database bağlantı hatası:**
- MySQL servisinin çalıştığından emin olun
- .env dosyasındaki DB ayarlarını kontrol edin

---

## 📚 Daha Fazla Bilgi

- 📖 **Detaylı Docker Rehberi**: [DOCKER_SETUP.md](DOCKER_SETUP.md)
- 🐳 **Docker Komutları**: [DOCKER_COMMANDS.md](DOCKER_COMMANDS.md)
- 📋 **Tam Dokümantasyon**: [README.md](README.md)
- 🔧 **Proje Kurulumu**: [PROJECT_SETUP.md](PROJECT_SETUP.md)

---

## ✅ Kurulum Kontrol Listesi

- [ ] Docker Desktop kuruldu (Docker yöntemi için)
- [ ] XAMPP kuruldu (Manuel yöntem için)
- [ ] Proje indirildi
- [ ] Bağımlılıklar yüklendi
- [ ] .env dosyası yapılandırıldı
- [ ] Database migrate edildi
- [ ] Seed data yüklendi
- [ ] Uygulama çalışıyor
- [ ] Demo hesabı ile giriş yapıldı

---

## 🎉 Başarılı Kurulum!

Kurulum tamamlandıysa, şimdi şunları yapabilirsiniz:

1. ✅ Öğrenci ekle
2. ✅ Proje oluştur
3. ✅ Rapor değerlendir
4. ✅ Bildirim gönder
5. ✅ Admin panelini kullan

---

**🎓 Happy Coding with NEU PMS!**

Sorularınız için: [GitHub Issues](your-repo-issues-url)

