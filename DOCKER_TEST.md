# 🧪 Docker Test Rehberi - NEU PMS

Bu dokümanda Docker kurulumunuzun çalışıp çalışmadığını nasıl test edeceğinizi öğreneceksiniz.

---

## ✅ Test Senaryosu - Baştan Sona

### Ön Hazırlık (Sadece İlk Defa)

```bash
# Docker Desktop kurulu mu kontrol et
docker --version
docker-compose --version

# Çıktı şöyle olmalı:
# Docker version 24.x.x
# Docker Compose version v2.x.x
```

---

## 🚀 Test Adımları

### Adım 1: Temiz Başlangıç

```bash
# Eğer daha önce çalıştırdıysanız, temizleyin
docker-compose down -v

# Tüm container'ları görmek için
docker ps -a

# Eski image'leri temizle (opsiyonel)
docker system prune -a
```

### Adım 2: Production Mode Test

```bash
# 1. .env dosyası var mı kontrol et
# Yoksa oluştur:
# copy .env.example .env  (Windows)
# cp .env.example .env    (Linux/Mac)

# 2. Container'ları başlat (BUILD AŞAMASI - 2-5 dakika sürer)
docker-compose up -d --build

# BEKLENEN ÇIKTI:
# [+] Building X.Xs (X/X FINISHED)
# [+] Running 4/4
#  ✔ Network neu_network         Created
#  ✔ Container neu_pms_mysql      Started
#  ✔ Container neu_pms_app        Started
#  ✔ Container neu_pms_phpmyadmin Started
```

### Adım 3: Container Durumunu Kontrol Et

```bash
# Container'lar çalışıyor mu?
docker-compose ps

# BEKLENEN ÇIKTI:
# NAME                    STATUS          PORTS
# neu_pms_app             Up X seconds    0.0.0.0:8080->80/tcp
# neu_pms_mysql           Up X seconds    0.0.0.0:3306->3306/tcp
# neu_pms_phpmyadmin      Up X seconds    0.0.0.0:8081->80/tcp
```

✅ **BAŞARI KRITERI:** Tüm container'lar "Up" durumunda olmalı!

### Adım 4: Logları Kontrol Et

```bash
# Tüm logları görüntüle
docker-compose logs

# Sadece app logları (canlı)
docker-compose logs -f app

# ❌ Eğer hata varsa şöyle görünür:
# ERROR: connection refused
# FATAL: database connection failed

# ✅ Başarılı ise şöyle görünür:
# nginx entered RUNNING state
# php-fpm entered RUNNING state
```

### Adım 5: Database Setup

```bash
# 1. Key generate
docker-compose exec app php artisan key:generate --force

# BEKLENEN ÇIKTI:
# Application key set successfully.

# 2. Migration çalıştır
docker-compose exec app php artisan migrate --force

# BEKLENEN ÇIKTI:
# Running migrations...
# 2024_01_01_000001_create_students_table ............... DONE
# 2024_01_01_000002_create_projects_table .............. DONE
# ... (daha fazla migration)

# 3. Seed data yükle
docker-compose exec app php artisan db:seed --force

# BEKLENEN ÇIKTI:
# Database seeding completed successfully.
```

### Adım 6: Web Tarayıcı Testi

1. **Ana Uygulama:**
   - URL: http://localhost:8080
   - ✅ **Başarı:** Login sayfası açılmalı (NEU logosu ile)
   - ❌ **Hata:** "Connection refused" veya "This site can't be reached"

2. **phpMyAdmin:**
   - URL: http://localhost:8081
   - ✅ **Başarı:** phpMyAdmin login sayfası
   - Giriş: Server: `mysql`, User: `root`, Password: `rootsecret`

3. **Database Kontrolü:**
   - phpMyAdmin'de `neu_pms` database'i görünmeli
   - Tablolar: users, students, projects, reports, notifications, etc.

### Adım 7: Login Testi

```
URL: http://localhost:8080/login

Test Hesabı:
Email: ahmed.hassan@neu.edu.tr
Password: password

✅ BAŞARI: Dashboard'a yönlendirme
❌ HATA: "These credentials do not match"
```

### Adım 8: Fonksiyonel Test

Giriş yaptıktan sonra:
1. ✅ Dashboard açılıyor mu?
2. ✅ Students sayfası çalışıyor mu?
3. ✅ Projects sayfası çalışıyor mu?
4. ✅ Notifications çalışıyor mu?

---

## 🔍 Çalışıp Çalışmadığını Anlamanın 10 Yolu

### 1. Container Status Kontrolü

```bash
docker-compose ps
```

✅ **Başarılı:**
```
NAME                  STATUS
neu_pms_app           Up 2 minutes
neu_pms_mysql         Up 2 minutes
neu_pms_phpmyadmin    Up 2 minutes
```

❌ **Başarısız:**
```
NAME                  STATUS
neu_pms_app           Exited (1) 5 seconds ago
neu_pms_mysql         Up 2 minutes
```

### 2. Port Dinleme Kontrolü

```bash
# Windows
netstat -ano | findstr :8080

# Linux/Mac
lsof -i :8080
```

✅ **Başarılı:** Port 8080'de bir process çalışıyor
❌ **Başarısız:** Sonuç yok

### 3. HTTP Response Kontrolü

```bash
# Linux/Mac/Git Bash
curl -I http://localhost:8080

# PowerShell
Invoke-WebRequest -Uri http://localhost:8080 -Method Head
```

✅ **Başarılı:** `HTTP/1.1 200 OK` veya `HTTP/1.1 302 Found`
❌ **Başarısız:** `Connection refused` veya timeout

### 4. Database Connection Test

```bash
docker-compose exec app php artisan tinker

# Tinker içinde:
DB::connection()->getPdo();
```

✅ **Başarılı:** PDO object döner
❌ **Başarısız:** Exception fırlatır

### 5. Logs Kontrolü

```bash
docker-compose logs app | grep -i error
docker-compose logs mysql | grep -i error
```

✅ **Başarılı:** Hiç veya çok az error
❌ **Başarısız:** Çok sayıda error mesajı

### 6. Container Health Check

```bash
docker inspect neu_pms_app | grep -i health
```

✅ **Başarılı:** "Health": "healthy"
❌ **Başarısız:** "Health": "unhealthy"

### 7. File System Kontrolü

```bash
# Storage yazılabilir mi?
docker-compose exec app touch storage/test.txt
docker-compose exec app ls -la storage/test.txt

# ✅ Başarılı: Dosya oluşur
# ❌ Başarısız: Permission denied
```

### 8. Nginx/PHP-FPM Status

```bash
docker-compose exec app ps aux
```

✅ **Başarılı:**
```
USER       PID COMMAND
root         1 supervisord
www-data     X nginx
www-data     X php-fpm
```

### 9. MySQL Database Kontrolü

```bash
docker-compose exec mysql mysql -u neu_user -p -e "SHOW DATABASES;"

# Password: secret
```

✅ **Başarılı:** `neu_pms` database listede
❌ **Başarısız:** Database yok veya connection error

### 10. Browser Console Kontrolü

Tarayıcıda F12 → Console

✅ **Başarılı:** Hiç veya az error
❌ **Başarısız:** 404 errors, CORS errors, vb.

---

## 🎬 Canlı Demo Senaryosu

### Birilerine Göstermek İçin Adım Adım

```bash
# 1. EKRANI TEMİZLE
clear  # veya cls (Windows)

# 2. MEVCUT DURUMU GÖR
echo "=== 1. Docker versiyonunu kontrol ediyoruz ==="
docker --version
docker-compose --version
echo ""

# 3. CONTAINER'LARI BAŞLAT
echo "=== 2. Container'ları başlatıyoruz (2-3 dakika sürebilir) ==="
docker-compose up -d
echo ""

# 4. DURUM KONTROLÜ
echo "=== 3. Container'ların durumunu kontrol ediyoruz ==="
docker-compose ps
echo ""

# 5. DATABASE SETUP
echo "=== 4. Database'i hazırlıyoruz ==="
docker-compose exec -T app php artisan key:generate --force
docker-compose exec -T app php artisan migrate --force
docker-compose exec -T app php artisan db:seed --force
echo ""

# 6. TEST
echo "=== 5. Bağlantı testi yapıyoruz ==="
curl -I http://localhost:8080
echo ""

# 7. BİTTİ
echo "=== 6. Hazır! Şimdi tarayıcıda açalım ==="
echo "URL: http://localhost:8080"
echo "Login: ahmed.hassan@neu.edu.tr / password"
echo ""
echo "✅ Test başarılı!"

# Tarayıcıda otomatik aç (opsiyonel)
# Windows:
start http://localhost:8080

# Mac:
# open http://localhost:8080

# Linux:
# xdg-open http://localhost:8080
```

---

## 📊 Test Checklist

Aşağıdaki listeyi kullanarak test edin:

### Container Test
- [ ] `docker-compose ps` → Tüm container'lar "Up"
- [ ] `docker-compose logs app` → Kritik hata yok
- [ ] `docker-compose logs mysql` → Kritik hata yok

### Network Test
- [ ] Port 8080 dinleniyor
- [ ] Port 8081 dinleniyor (phpMyAdmin)
- [ ] Port 3306 dinleniyor (MySQL)

### Application Test
- [ ] http://localhost:8080 → Login sayfası açılıyor
- [ ] Login çalışıyor (test hesabı ile)
- [ ] Dashboard yükleniyor
- [ ] Students sayfası çalışıyor
- [ ] Projects sayfası çalışıyor

### Database Test
- [ ] phpMyAdmin açılıyor (http://localhost:8081)
- [ ] `neu_pms` database var
- [ ] Tablolar var (users, students, projects, etc.)
- [ ] Seed data var (ör: 3 teacher)

### Performance Test
- [ ] Sayfa yüklenme hızı < 2 saniye
- [ ] Image/asset'ler yükleniyor
- [ ] CSS doğru uygulanıyor

---

## ❌ Sık Karşılaşılan Sorunlar ve Çözümleri

### Sorun 1: Port Çakışması

**Belirti:**
```
Error: bind: address already in use
```

**Çözüm:**
```bash
# 1. Hangi process kullanıyor bul
netstat -ano | findstr :8080

# 2. Process'i durdur veya
# 3. docker-compose.yml'de portu değiştir:
ports:
  - "9000:80"  # 8080 yerine 9000
```

### Sorun 2: Database Bağlantı Hatası

**Belirti:**
```
SQLSTATE[HY000] [2002] Connection refused
```

**Çözüm:**
```bash
# 1. MySQL container çalışıyor mu?
docker-compose ps mysql

# 2. Logları kontrol et
docker-compose logs mysql

# 3. Biraz bekle (MySQL başlaması 10-15 saniye sürebilir)
sleep 15
docker-compose exec app php artisan migrate --force
```

### Sorun 3: Permission Denied

**Belirti:**
```
The stream or file "storage/logs/laravel.log" could not be opened
```

**Çözüm:**
```bash
docker-compose exec app chmod -R 755 storage bootstrap/cache
docker-compose exec app chown -R www-data:www-data storage bootstrap/cache
docker-compose restart app
```

### Sorun 4: 404 Not Found

**Belirti:**
Tüm sayfalarda 404 hatası

**Çözüm:**
```bash
# Nginx restart
docker-compose restart app

# Route cache temizle
docker-compose exec app php artisan route:clear
docker-compose exec app php artisan route:cache
```

### Sorun 5: Assets Yüklenmiyor

**Belirti:**
CSS/JS dosyaları 404

**Çözüm:**
```bash
# Assets rebuild
docker-compose exec app npm install
docker-compose exec app npm run build
docker-compose restart app
```

---

## 🎯 Hızlı Test Scripti

Bu scripti çalıştırarak tüm testleri otomatik yapabilirsiniz:

### test-docker.sh (Linux/Mac)

```bash
#!/bin/bash

echo "🐳 NEU PMS Docker Test Scripti"
echo "================================"
echo ""

# Test 1: Docker yüklü mü?
echo "Test 1: Docker kurulumu..."
if command -v docker &> /dev/null; then
    echo "✅ Docker kurulu: $(docker --version)"
else
    echo "❌ Docker kurulu değil!"
    exit 1
fi

# Test 2: Docker Compose yüklü mü?
echo ""
echo "Test 2: Docker Compose kurulumu..."
if command -v docker-compose &> /dev/null; then
    echo "✅ Docker Compose kurulu: $(docker-compose --version)"
else
    echo "❌ Docker Compose kurulu değil!"
    exit 1
fi

# Test 3: Container'ları başlat
echo ""
echo "Test 3: Container'ları başlatıyoruz..."
docker-compose up -d
sleep 10

# Test 4: Container durumu
echo ""
echo "Test 4: Container durumu..."
if docker-compose ps | grep -q "Up"; then
    echo "✅ Container'lar çalışıyor"
else
    echo "❌ Container'lar başlamadı!"
    docker-compose logs
    exit 1
fi

# Test 5: Database setup
echo ""
echo "Test 5: Database setup..."
docker-compose exec -T app php artisan key:generate --force
docker-compose exec -T app php artisan migrate --force
docker-compose exec -T app php artisan db:seed --force

# Test 6: HTTP test
echo ""
echo "Test 6: HTTP erişim testi..."
if curl -s -o /dev/null -w "%{http_code}" http://localhost:8080 | grep -q "200\|302"; then
    echo "✅ HTTP erişim başarılı"
else
    echo "❌ HTTP erişim başarısız!"
    exit 1
fi

# Test 7: Database test
echo ""
echo "Test 7: Database bağlantı testi..."
if docker-compose exec -T mysql mysql -u neu_user -psecret -e "USE neu_pms;" &> /dev/null; then
    echo "✅ Database bağlantısı başarılı"
else
    echo "❌ Database bağlantısı başarısız!"
    exit 1
fi

echo ""
echo "================================"
echo "✅ TÜM TESTLER BAŞARILI!"
echo ""
echo "Uygulamaya erişim:"
echo "  - Ana sayfa: http://localhost:8080"
echo "  - phpMyAdmin: http://localhost:8081"
echo ""
echo "Test hesabı:"
echo "  Email: ahmed.hassan@neu.edu.tr"
echo "  Password: password"
```

---

## 📹 Video Demo İçin Senayo

Eğer video çekecekseniz:

### 1. Giriş (30 saniye)
```
"Merhaba! Bugün NEU Project Management System'in 
Docker entegrasyonunu göstereceğim."
```

### 2. Kurulum (2 dakika)
```bash
# Terminal'i göster
docker-compose --version

# Başlat
docker-compose up -d

# Durumu göster
docker-compose ps
```

### 3. Setup (1 dakika)
```bash
docker-compose exec app php artisan migrate --force
docker-compose exec app php artisan db:seed --force
```

### 4. Browser Test (2 dakika)
```
- http://localhost:8080 aç
- Login yap
- Dashboard'u göster
- Students sayfasını göster
- phpMyAdmin'i göster (http://localhost:8081)
```

### 5. Sonuç (30 saniye)
```
"Gördüğünüz gibi Docker ile sistem 
tek komutla hazır ve çalışıyor!"
```

---

## ✅ Başarı Kriterleri

Sistem çalışıyorsa:

1. ✅ `docker-compose ps` → Tüm container "Up"
2. ✅ http://localhost:8080 → Login sayfası
3. ✅ Login → Dashboard yükleniyor
4. ✅ phpMyAdmin → Database görünüyor
5. ✅ Loglar → Kritik hata yok
6. ✅ Students/Projects → Sayfa yükleniyor
7. ✅ Network → Portlar dinleniyor
8. ✅ Database → Tablolar ve data var
9. ✅ Assets → CSS/JS yükleniyor
10. ✅ Performance → Hızlı yükleme

---

## 🎉 Sonuç

Bu testleri yaparak Docker sisteminizin çalıştığını kanıtlayabilirsiniz!

**En hızlı test:**
```bash
docker-compose up -d && \
docker-compose exec app php artisan migrate --force && \
docker-compose exec app php artisan db:seed --force && \
open http://localhost:8080  # veya start (Windows)
```

**Başarı = Login sayfası açılır ve giriş yapabilirsiniz!**

