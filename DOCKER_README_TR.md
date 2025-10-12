# 🐳 Docker Entegrasyonu - NEU PMS

## 📋 Proje Hakkında

NEU Project Management System artık Docker ile kolayca çalıştırılabilir! Tüm sistem izole container'lar içinde çalışır ve kurulum dakikalar içinde tamamlanır.

---

## ✨ Docker'ın Avantajları

### ✅ Kolay Kurulum
- Tek komutla tüm sistem hazır
- Bağımlılık yönetimi otomatik
- İzole ortam (sistem kirlenmez)

### ✅ Tutarlı Geliştirme
- Herkesin aynı ortamı vardır
- "Benim bilgisayarımda çalışıyor" sorunu yok
- Development ve Production ortamları aynı

### ✅ Hızlı Deployment
- Herhangi bir sunucuya kolayca deploy
- Scalable (ölçeklenebilir)
- CI/CD entegrasyonu kolay

### ✅ İzolasyon
- Projeler birbirini etkilemez
- Her proje kendi veritabanı
- Port çakışması yok

---

## 🏗️ Docker Mimarisi

```
┌─────────────────────────────────────────────────┐
│              NEU PMS Application                 │
└─────────────────────────────────────────────────┘
                      │
        ┌─────────────┼─────────────┐
        │             │             │
┌───────▼───────┐ ┌──▼──────┐ ┌───▼──────┐
│   App (PHP)   │ │  MySQL  │ │  Redis   │
│  Laravel 12   │ │   8.0   │ │ (Cache)  │
│  + Nginx      │ │         │ │          │
│  + PHP-FPM    │ │         │ │          │
└───────────────┘ └─────────┘ └──────────┘
      Port 8080      Port 3306   Port 6379

┌───────────────┐
│  phpMyAdmin   │
│  (DB Admin)   │
└───────────────┘
      Port 8081
```

---

## 📦 Oluşturulan Dosyalar

### Ana Dosyalar
- `Dockerfile` - Production build image
- `Dockerfile.dev` - Development build image  
- `docker-compose.yml` - Production orchestration
- `docker-compose.dev.yml` - Development orchestration
- `.dockerignore` - Ignore kuralları

### Konfigürasyon
- `docker/nginx/default.conf` - Nginx web server ayarları
- `docker/supervisor/supervisord.conf` - Process manager

### Otomatik Başlatma Scripts
- `docker-start.bat` - Windows için otomatik kurulum
- `docker-start.sh` - Linux/Mac için otomatik kurulum

### Dokümantasyon
- `DOCKER_SETUP.md` - Detaylı Docker kurulum rehberi
- `DOCKER_COMMANDS.md` - Docker komutları referansı
- `QUICK_START.md` - Hızlı başlangıç rehberi
- `DOCKER_README_TR.md` - Bu dosya

---

## 🚀 Hızlı Başlangıç

### Windows

```bash
# 1. Docker Desktop kurun
# https://www.docker.com/products/docker-desktop/

# 2. Otomatik script'i çalıştırın
docker-start.bat

# 3. Tarayıcıda açın
# http://localhost:8080
```

### Linux/Mac

```bash
# 1. Docker kurun (örnekler için DOCKER_SETUP.md)

# 2. Otomatik script'i çalıştırın
chmod +x docker-start.sh
./docker-start.sh

# 3. Tarayıcıda açın
# http://localhost:8080
```

---

## 🔧 Manuel Kurulum

### 1. Environment Hazırlama

```bash
# .env dosyasını manuel oluşturun
# (veya .env.example'dan kopyalayın)

# Önemli ayarlar:
DB_CONNECTION=mysql
DB_HOST=mysql           # Docker container adı
DB_PORT=3306
DB_DATABASE=neu_pms
DB_USERNAME=neu_user
DB_PASSWORD=secret
```

### 2. Container'ları Başlatma

**Development:**
```bash
docker-compose -f docker-compose.dev.yml up -d
```

**Production:**
```bash
docker-compose up -d
```

### 3. Uygulama Kurulumu

```bash
# Key generate
docker-compose exec app php artisan key:generate --force

# Database migrate
docker-compose exec app php artisan migrate --force

# Seed data
docker-compose exec app php artisan db:seed --force
```

---

## 🌐 Erişim URL'leri

### Development Modu
| Servis | URL | Açıklama |
|--------|-----|----------|
| Laravel | http://localhost:8000 | Ana uygulama |
| Vite | http://localhost:5173 | Hot reload server |
| phpMyAdmin | http://localhost:8081 | DB yönetimi |
| MySQL | localhost:3307 | Database |

### Production Modu
| Servis | URL | Açıklama |
|--------|-----|----------|
| Application | http://localhost:8080 | Ana uygulama |
| phpMyAdmin | http://localhost:8081 | DB yönetimi |
| MySQL | localhost:3306 | Database |

---

## 🛠️ Temel Docker Komutları

### Başlatma ve Durdurma

```bash
# Başlat
docker-compose up -d

# Durdur
docker-compose down

# Yeniden başlat
docker-compose restart

# Logları görüntüle
docker-compose logs -f
```

### Laravel Komutları

```bash
# Artisan
docker-compose exec app php artisan [command]

# Migration
docker-compose exec app php artisan migrate

# Cache temizle
docker-compose exec app php artisan cache:clear

# Tinker
docker-compose exec app php artisan tinker
```

### Composer & NPM

```bash
# Composer
docker-compose exec app composer install

# NPM
docker-compose exec app npm install
docker-compose exec app npm run build
```

### Shell Erişimi

```bash
# Container'a gir
docker-compose exec app sh

# MySQL'e bağlan
docker-compose exec mysql mysql -u neu_user -p
```

**📘 Tüm komutlar için:** [DOCKER_COMMANDS.md](DOCKER_COMMANDS.md)

---

## 🎯 Kullanım Senaryoları

### Senaryo 1: İlk Kez Kurulum

```bash
# 1. Docker Desktop'ı kur
# 2. Proje dizinine git
cd "Graduation Project"

# 3. Otomatik script çalıştır
docker-start.bat    # Windows
./docker-start.sh   # Linux/Mac

# 4. Hazır!
```

### Senaryo 2: Mevcut Proje ile Çalışma

```bash
# Container'ları başlat
docker-compose up -d

# Çalış...

# İş bitince durdur
docker-compose down
```

### Senaryo 3: Development Mode

```bash
# Development compose ile başlat
docker-compose -f docker-compose.dev.yml up -d

# Hot reload aktif!
# Kod değişiklikleri otomatik yansır
```

### Senaryo 4: Production Deployment

```bash
# Server'a deploy
git clone <repo>
cd "Graduation Project"

# .env ayarla
cp .env.docker.example .env
nano .env

# Başlat
docker-compose up -d --build

# Setup
docker-compose exec app php artisan key:generate --force
docker-compose exec app php artisan migrate --force
docker-compose exec app php artisan db:seed --force
```

---

## 🔍 İki Mod Arasındaki Farklar

| Özellik | Development | Production |
|---------|-------------|------------|
| **Dockerfile** | `Dockerfile.dev` | `Dockerfile` |
| **Compose** | `docker-compose.dev.yml` | `docker-compose.yml` |
| **Hot Reload** | ✅ Var | ❌ Yok |
| **Vite Server** | ✅ Port 5173 | ❌ Pre-built |
| **Debug** | ✅ Açık | ❌ Kapalı |
| **Volume Mount** | ✅ Kod mount | ❌ Image içinde |
| **Optimizasyon** | ❌ Minimal | ✅ Tam optimize |
| **Image Boyutu** | ~800MB | ~400MB |
| **Port** | 8000, 5173 | 8080 |

---

## ⚙️ Environment Variables

### Temel Ayarlar

```env
APP_NAME="NEU PMS"
APP_ENV=production          # local/production
APP_DEBUG=false             # true/false
APP_URL=http://localhost:8080
```

### Database (Docker)

```env
DB_CONNECTION=mysql
DB_HOST=mysql               # Container adı
DB_PORT=3306
DB_DATABASE=neu_pms
DB_USERNAME=neu_user
DB_PASSWORD=secret
DB_ROOT_PASSWORD=rootsecret
```

### Cache & Session

```env
CACHE_STORE=database        # file/database/redis
SESSION_DRIVER=database     # file/database/redis
QUEUE_CONNECTION=database   # database/redis
```

### Redis (Opsiyonel)

```env
REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379
```

---

## 🐛 Sorun Giderme

### Problem 1: Port Zaten Kullanımda

**Hata:**
```
Error: bind: address already in use
```

**Çözüm:**
```bash
# docker-compose.yml'de portu değiştir
ports:
  - "9000:80"  # 8080 yerine 9000
```

### Problem 2: Container Başlamıyor

**Çözüm:**
```bash
# Logları kontrol et
docker-compose logs app

# Cache'siz yeniden build
docker-compose build --no-cache
docker-compose up -d
```

### Problem 3: Database Bağlanamıyor

**Çözüm:**
```bash
# MySQL container çalışıyor mu?
docker-compose ps

# .env kontrolü
DB_HOST=mysql    # "localhost" değil!
DB_PORT=3306
```

### Problem 4: Permission Denied

**Çözüm:**
```bash
# Storage permission düzelt
docker-compose exec app chmod -R 755 storage bootstrap/cache
docker-compose exec app chown -R www-data:www-data storage bootstrap/cache
```

### Problem 5: Assets Yüklenmiyor

**Çözüm:**
```bash
# Assets rebuild
docker-compose exec app npm install
docker-compose exec app npm run build
docker-compose restart app
```

**📘 Daha fazla:** [DOCKER_SETUP.md](DOCKER_SETUP.md) - Sorun Giderme bölümü

---

## 📊 Docker Avantajları vs XAMPP

| Özellik | Docker | XAMPP |
|---------|--------|-------|
| **Kurulum** | 1 komut | Manuel yapılandırma |
| **İzolasyon** | ✅ Tam izole | ❌ Global kurulum |
| **Tutarlılık** | ✅ Herkes aynı ortam | ⚠️ Farklı olabilir |
| **Portability** | ✅ Her yerde çalışır | ⚠️ OS'a bağımlı |
| **Temizlik** | ✅ Kolay kaldırma | ⚠️ Manuel temizlik |
| **Multiple Versions** | ✅ Kolay | ❌ Zor |
| **Resource Usage** | ⚠️ Biraz fazla | ✅ Az |
| **Learning Curve** | ⚠️ Öğrenme gerekir | ✅ Basit |

---

## 🚢 Production Deployment

### VPS/Cloud Server'a Deploy

```bash
# 1. Server'a bağlan
ssh user@your-server.com

# 2. Docker kur
curl -fsSL https://get.docker.com | sh
sudo usermod -aG docker $USER

# 3. Projeyi çek
git clone <your-repo>
cd "Graduation Project"

# 4. .env ayarla
cp .env.docker.example .env
nano .env

# 5. Başlat
docker-compose up -d --build

# 6. Setup
docker-compose exec app php artisan key:generate --force
docker-compose exec app php artisan migrate --force
docker-compose exec app php artisan db:seed --force
docker-compose exec app php artisan config:cache
docker-compose exec app php artisan route:cache
```

### SSL/HTTPS Eklemek (Nginx Proxy)

```yaml
# docker-compose.yml'ye ekle
services:
  nginx-proxy:
    image: nginxproxy/nginx-proxy
    ports:
      - "80:80"
      - "443:443"
    volumes:
      - /var/run/docker.sock:/tmp/docker.sock:ro
      - ./certs:/etc/nginx/certs

  app:
    environment:
      - VIRTUAL_HOST=yourdomain.com
      - LETSENCRYPT_HOST=yourdomain.com
      - LETSENCRYPT_EMAIL=your@email.com
```

---

## 📈 Performance Optimization

### Production için Öneriler

```bash
# 1. Cache oluştur
docker-compose exec app php artisan config:cache
docker-compose exec app php artisan route:cache
docker-compose exec app php artisan view:cache

# 2. Autoloader optimize
docker-compose exec app composer install --optimize-autoloader --no-dev

# 3. Redis kullan (opsiyonel)
# .env'de:
CACHE_STORE=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis
```

---

## 🔒 Güvenlik

### Production Checklist

- [ ] `.env` dosyası güvende (.gitignore'da)
- [ ] APP_DEBUG=false
- [ ] Güçlü database şifreleri
- [ ] HTTPS aktif
- [ ] Firewall yapılandırıldı
- [ ] Regular backups
- [ ] Container'lar güncel
- [ ] Log monitoring

---

## 📚 Ek Kaynaklar

### Proje Dokümantasyonu
- 📖 [README.md](README.md) - Ana dokümantasyon
- 🔧 [PROJECT_SETUP.md](PROJECT_SETUP.md) - Proje kurulum detayları
- 🚀 [QUICK_START.md](QUICK_START.md) - Hızlı başlangıç

### Docker Dokümantasyonu
- 🐳 [DOCKER_SETUP.md](DOCKER_SETUP.md) - Detaylı Docker rehberi
- 📋 [DOCKER_COMMANDS.md](DOCKER_COMMANDS.md) - Komut referansı
- 📘 [DOCKER_README_TR.md](DOCKER_README_TR.md) - Bu dosya

### Harici Kaynaklar
- [Docker Documentation](https://docs.docker.com/)
- [Laravel Docker Best Practices](https://laravel.com/docs/deployment)
- [Docker Compose Reference](https://docs.docker.com/compose/)

---

## 🎓 Öğrenme Kaynakları

### Docker'ı Öğrenin
1. **Temel Kavramlar**: Image, Container, Volume, Network
2. **Docker Compose**: Multi-container uygulamalar
3. **Best Practices**: Production deployment

### Önerilen Kurslar
- Docker Mastery (Udemy)
- Docker for Developers (Pluralsight)
- Official Docker Documentation

---

## 💬 Destek

### Sorun mu Yaşıyorsunuz?

1. **Dokümantasyonu kontrol edin**
   - [DOCKER_SETUP.md](DOCKER_SETUP.md) - Sorun Giderme
   - [DOCKER_COMMANDS.md](DOCKER_COMMANDS.md) - Komutlar

2. **Logları inceleyin**
   ```bash
   docker-compose logs -f
   ```

3. **GitHub Issues**
   - Yeni issue açın
   - Hata mesajlarını paylaşın
   - Ortam bilgilerinizi ekleyin

---

## 🤝 Katkıda Bulunma

Docker entegrasyonunu geliştirmek için:

1. Fork edin
2. Feature branch oluşturun
3. Docker yapılandırmasını test edin
4. Pull request gönderin

---

## 📝 Changelog

### v2.0.0 - Docker Entegrasyonu
- ✅ Dockerfile (Production)
- ✅ Dockerfile.dev (Development)
- ✅ docker-compose.yml
- ✅ docker-compose.dev.yml
- ✅ Nginx configuration
- ✅ Supervisor configuration
- ✅ Otomatik başlatma scripts
- ✅ Kapsamlı dokümantasyon
- ✅ Multi-stage build
- ✅ Redis support
- ✅ phpMyAdmin integration

---

## 🎉 Sonuç

Docker entegrasyonu ile NEU PMS artık:

✅ **Kolay kurulabilir** - Tek komutla hazır  
✅ **İzole çalışır** - Sistem kirlenmez  
✅ **Taşınabilir** - Her yerde aynı şekilde çalışır  
✅ **Ölçeklenebilir** - Production'a kolay geçiş  
✅ **Modern** - Industry standard

---

**🐳 Docker ile mutlu kodlamalar!**

**Developed with ❤️ for Near East University**

---

## 📞 İletişim

Sorularınız için:
- GitHub Issues
- Proje yöneticisi
- NEU Bilgisayar Mühendisliği Bölümü

---

**Version 2.0.0** - Docker Integration Complete 🎉

