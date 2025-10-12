# 🐳 NEU PMS - Docker Kurulum Rehberi

Bu dokümanda NEU Project Management System'in Docker ile nasıl çalıştırılacağını öğreneceksiniz.

---

## 📋 İçindekiler

- [Gereksinimler](#gereksinimler)
- [Docker Yapısı](#docker-yapısı)
- [Hızlı Başlangıç](#hızlı-başlangıç)
- [Development Ortamı](#development-ortamı)
- [Production Ortamı](#production-ortamı)
- [Komutlar](#komutlar)
- [Sorun Giderme](#sorun-giderme)

---

## 🔧 Gereksinimler

- **Docker Desktop** (Windows/Mac) veya **Docker Engine** (Linux)
- **Docker Compose** v2.0+
- En az **4GB RAM**
- En az **10GB disk alanı**

### Windows için Docker Desktop Kurulumu

1. [Docker Desktop for Windows](https://www.docker.com/products/docker-desktop/) indirin
2. Kurulumu tamamlayın
3. WSL 2 backend'i etkinleştirin
4. Docker Desktop'ı başlatın

---

## 🏗️ Docker Yapısı

Projede şu Docker dosyaları bulunur:

```
├── Dockerfile                  # Production build
├── Dockerfile.dev              # Development build
├── docker-compose.yml          # Production compose
├── docker-compose.dev.yml      # Development compose
├── .dockerignore               # Docker ignore dosyası
├── .env.docker                 # Docker environment template
└── docker/
    ├── nginx/
    │   └── default.conf        # Nginx konfigürasyonu
    └── supervisor/
        └── supervisord.conf    # Process manager
```

### Servisler

1. **app** - Laravel PHP uygulaması
2. **mysql** - MySQL 8.0 veritabanı
3. **phpmyadmin** - Veritabanı yönetim arayüzü
4. **redis** - Cache ve queue servisi (opsiyonel)

---

## 🚀 Hızlı Başlangıç

### 1. Environment Dosyasını Hazırlayın

```bash
# .env.docker dosyasını .env olarak kopyalayın
copy .env.docker .env

# Veya Linux/Mac için
cp .env.docker .env
```

### 2. APP_KEY Oluşturun

```bash
# Docker container içinde key generate
docker-compose run --rm app php artisan key:generate
```

### 3. Veritabanı Yapılandırması

`.env` dosyasında şu ayarları yapın:

```env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=neu_pms
DB_USERNAME=neu_user
DB_PASSWORD=secret
DB_ROOT_PASSWORD=rootsecret
```

### 4. Container'ları Başlatın

```bash
# Tüm servisleri başlat
docker-compose up -d

# Logları izle
docker-compose logs -f
```

### 5. Veritabanı Migration ve Seed

```bash
# Migration çalıştır
docker-compose exec app php artisan migrate --force

# Seed data yükle
docker-compose exec app php artisan db:seed --force
```

### 6. Uygulamaya Erişin

- **Ana uygulama**: http://localhost:8080
- **phpMyAdmin**: http://localhost:8081

---

## 💻 Development Ortamı

Development ortamında hot reload ve live development özellikleri aktiftir.

### Development Başlatma

```bash
# Development compose dosyası ile başlat
docker-compose -f docker-compose.dev.yml up -d

# Logları izle
docker-compose -f docker-compose.dev.yml logs -f app
```

### Özellikler

- ✅ **Hot Reload** - Kod değişikliklerinde otomatik yenileme
- ✅ **Vite Dev Server** - Port 5173'te çalışır
- ✅ **Laravel Serve** - Port 8000'de çalışır
- ✅ **Volume Mount** - Kodlar host'tan mount edilir
- ✅ **Debug Mode** - APP_DEBUG=true

### Development Portları

- **Laravel**: http://localhost:8000
- **Vite**: http://localhost:5173
- **phpMyAdmin**: http://localhost:8081
- **MySQL**: localhost:3307

### Development İçin Komutlar

```bash
# Composer install
docker-compose -f docker-compose.dev.yml exec app composer install

# NPM install
docker-compose -f docker-compose.dev.yml exec app npm install

# Artisan komutları
docker-compose -f docker-compose.dev.yml exec app php artisan migrate
docker-compose -f docker-compose.dev.yml exec app php artisan db:seed

# Cache temizle
docker-compose -f docker-compose.dev.yml exec app php artisan cache:clear
docker-compose -f docker-compose.dev.yml exec app php artisan config:clear
docker-compose -f docker-compose.dev.yml exec app php artisan route:clear
docker-compose -f docker-compose.dev.yml exec app php artisan view:clear

# Container'a shell erişimi
docker-compose -f docker-compose.dev.yml exec app sh
```

---

## 🏭 Production Ortamı

Production ortamı optimize edilmiş ve güvenli bir yapıdadır.

### Production Build

```bash
# Build image
docker-compose build

# Start services
docker-compose up -d

# Check logs
docker-compose logs -f
```

### Özellikler

- ✅ **Multi-stage Build** - Optimize edilmiş image boyutu
- ✅ **Nginx + PHP-FPM** - Yüksek performans
- ✅ **Supervisor** - Process yönetimi
- ✅ **Optimized Autoloader** - Hızlı class loading
- ✅ **Asset Compilation** - Pre-compiled frontend assets
- ✅ **Security Headers** - Nginx güvenlik yapılandırması

### Production Portları

- **Application**: http://localhost:8080
- **phpMyAdmin**: http://localhost:8081

### Production Yapılandırması

`.env` dosyasında production ayarları:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

# Cache drivers
CACHE_STORE=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis

# Redis configuration
REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379
```

---

## 🛠️ Komutlar

### Container Yönetimi

```bash
# Tüm servisleri başlat
docker-compose up -d

# Tüm servisleri durdur
docker-compose down

# Servisleri yeniden başlat
docker-compose restart

# Sadece belirli servisi başlat
docker-compose up -d app

# Container'ları sil (volumeler korunur)
docker-compose down

# Container'ları ve volumeleri sil
docker-compose down -v

# Logları görüntüle
docker-compose logs

# Belirli servisin logunu görüntüle
docker-compose logs app

# Canlı log takibi
docker-compose logs -f
```

### Laravel Komutları

```bash
# Artisan komutları
docker-compose exec app php artisan [command]

# Migration
docker-compose exec app php artisan migrate
docker-compose exec app php artisan migrate:fresh --seed

# Cache
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan config:cache
docker-compose exec app php artisan route:cache
docker-compose exec app php artisan view:cache

# Queue worker
docker-compose exec app php artisan queue:work

# Test
docker-compose exec app php artisan test
```

### Composer Komutları

```bash
# Composer install
docker-compose exec app composer install

# Composer update
docker-compose exec app composer update

# Specific package install
docker-compose exec app composer require vendor/package
```

### NPM Komutları

```bash
# NPM install
docker-compose exec app npm install

# Build assets
docker-compose exec app npm run build

# Dev mode (development ortamında)
docker-compose exec app npm run dev
```

### Database Komutları

```bash
# MySQL shell'e gir
docker-compose exec mysql mysql -u neu_user -p neu_pms

# Database backup
docker-compose exec mysql mysqldump -u neu_user -p neu_pms > backup.sql

# Database restore
docker-compose exec -T mysql mysql -u neu_user -p neu_pms < backup.sql

# SQLite kullanıyorsanız
docker-compose exec app php artisan db:seed
```

### Shell Erişimi

```bash
# App container'a gir
docker-compose exec app sh

# MySQL container'a gir
docker-compose exec mysql bash

# Root olarak gir
docker-compose exec -u root app sh
```

---

## 🔍 Sorun Giderme

### Port Çakışması

**Hata**: Port already allocated

**Çözüm**:
```bash
# Kullanımda olan portları değiştir
# docker-compose.yml dosyasında:
ports:
  - "8080:80"  # 8080'i değiştir (örn: 9000:80)
```

### Permission Sorunları

**Hata**: Permission denied on storage/logs

**Çözüm**:
```bash
# Container içinde permission düzelt
docker-compose exec app chmod -R 755 storage
docker-compose exec app chmod -R 755 bootstrap/cache
docker-compose exec app chown -R www-data:www-data storage bootstrap/cache
```

### MySQL Connection Hatası

**Hata**: SQLSTATE[HY000] [2002] Connection refused

**Çözüm**:
```bash
# MySQL container'ın çalıştığından emin ol
docker-compose ps

# MySQL loglarını kontrol et
docker-compose logs mysql

# .env dosyasındaki DB_HOST'u kontrol et
DB_HOST=mysql  # Container adı olmalı
```

### APP_KEY Eksik

**Hata**: No application encryption key has been specified

**Çözüm**:
```bash
# Key generate et
docker-compose exec app php artisan key:generate --force
```

### Vite Build Hatası

**Hata**: Vite manifest not found

**Çözüm**:
```bash
# Assets'leri rebuild et
docker-compose exec app npm install
docker-compose exec app npm run build
```

### Container Başlamıyor

**Çözüm**:
```bash
# Container loglarını incele
docker-compose logs app

# Container'ı yeniden build et
docker-compose build --no-cache app
docker-compose up -d
```

### Memory Hatası

**Hata**: Composer killed

**Çözüm**:
```bash
# Docker'a daha fazla memory ver
# Docker Desktop -> Settings -> Resources -> Memory -> 4GB+

# Veya composer memory limit'i artır
docker-compose exec app php -d memory_limit=-1 /usr/bin/composer install
```

---

## 📊 Monitoring

### Container Durumu

```bash
# Tüm container'ları listele
docker-compose ps

# Resource kullanımı
docker stats

# Container detayları
docker-compose exec app php artisan about
```

### Logs

```bash
# Tüm loglar
docker-compose logs -f

# Sadece errors
docker-compose logs app | grep ERROR

# Son 100 satır
docker-compose logs --tail=100 app
```

---

## 🔒 Güvenlik

### Production için Öneriler

1. **Environment Variables**: `.env` dosyasını güvenli tutun
2. **Strong Passwords**: Güçlü veritabanı şifreleri kullanın
3. **HTTPS**: Reverse proxy ile SSL/TLS ekleyin
4. **Updates**: Docker image'leri düzenli güncelleyin
5. **Firewall**: Gereksiz portları kapatın

### SSL/TLS Ekleme (Nginx Proxy)

```yaml
# docker-compose.yml'ye ekle
nginx-proxy:
  image: nginxproxy/nginx-proxy
  ports:
    - "80:80"
    - "443:443"
  volumes:
    - /var/run/docker.sock:/tmp/docker.sock:ro
    - ./certs:/etc/nginx/certs
```

---

## 🚢 Deployment

### Docker Hub'a Push

```bash
# Image build
docker build -t username/neu-pms:latest .

# Push to Docker Hub
docker push username/neu-pms:latest
```

### Server'da Çalıştırma

```bash
# Clone repository
git clone <repo-url>
cd "Graduation Project"

# Setup environment
cp .env.docker .env
nano .env  # Configure

# Start services
docker-compose up -d

# Initialize database
docker-compose exec app php artisan migrate --force
docker-compose exec app php artisan db:seed --force
```

---

## 📚 Ek Kaynaklar

- [Docker Documentation](https://docs.docker.com/)
- [Laravel Documentation](https://laravel.com/docs)
- [Docker Compose Documentation](https://docs.docker.com/compose/)

---

## 🤝 Destek

Sorularınız için:
- GitHub Issues açın
- Proje yöneticisi ile iletişime geçin

---

**🐳 Developed with Docker for NEU**

