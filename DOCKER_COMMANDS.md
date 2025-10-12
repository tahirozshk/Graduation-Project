# 🐳 Docker Komutları - Hızlı Referans

NEU PMS projesi için sık kullanılan Docker komutlarının listesi.

---

## 🚀 Başlatma Komutları

### Development Ortamı

```bash
# İlk başlatma (build ile)
docker-compose -f docker-compose.dev.yml up -d --build

# Normal başlatma
docker-compose -f docker-compose.dev.yml up -d

# Logları izle
docker-compose -f docker-compose.dev.yml logs -f

# Sadece app logları
docker-compose -f docker-compose.dev.yml logs -f app
```

### Production Ortamı

```bash
# İlk başlatma (build ile)
docker-compose up -d --build

# Normal başlatma
docker-compose up -d

# Logları izle
docker-compose logs -f
```

---

## 🛑 Durdurma Komutları

```bash
# Development - Servisleri durdur
docker-compose -f docker-compose.dev.yml stop

# Development - Servisleri durdur ve sil
docker-compose -f docker-compose.dev.yml down

# Development - Servisleri ve volumeleri sil
docker-compose -f docker-compose.dev.yml down -v

# Production
docker-compose stop
docker-compose down
docker-compose down -v
```

---

## 🔄 Yeniden Başlatma

```bash
# Development - Tüm servisleri yeniden başlat
docker-compose -f docker-compose.dev.yml restart

# Development - Sadece app'i yeniden başlat
docker-compose -f docker-compose.dev.yml restart app

# Production
docker-compose restart
docker-compose restart app
```

---

## 📦 Laravel Artisan Komutları

### Migration

```bash
# Development
docker-compose -f docker-compose.dev.yml exec app php artisan migrate
docker-compose -f docker-compose.dev.yml exec app php artisan migrate:fresh
docker-compose -f docker-compose.dev.yml exec app php artisan migrate:fresh --seed

# Production
docker-compose exec app php artisan migrate --force
docker-compose exec app php artisan migrate:fresh --seed --force
```

### Cache Komutları

```bash
# Cache temizle
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan route:clear
docker-compose exec app php artisan view:clear

# Cache oluştur (Production için)
docker-compose exec app php artisan config:cache
docker-compose exec app php artisan route:cache
docker-compose exec app php artisan view:cache
```

### Database Seed

```bash
# Tüm seedler
docker-compose exec app php artisan db:seed

# Belirli seeder
docker-compose exec app php artisan db:seed --class=TeacherSeeder
docker-compose exec app php artisan db:seed --class=StudentSeeder
```

### Key Generate

```bash
docker-compose exec app php artisan key:generate --force
```

### Queue

```bash
# Queue worker başlat
docker-compose exec app php artisan queue:work

# Background'da çalıştır
docker-compose exec -d app php artisan queue:work
```

### Test

```bash
# Tüm testleri çalıştır
docker-compose exec app php artisan test

# Belirli test
docker-compose exec app php artisan test --filter=ProjectTest
```

---

## 📚 Composer Komutları

```bash
# Development
docker-compose -f docker-compose.dev.yml exec app composer install
docker-compose -f docker-compose.dev.yml exec app composer update
docker-compose -f docker-compose.dev.yml exec app composer require vendor/package

# Production
docker-compose exec app composer install --no-dev --optimize-autoloader
docker-compose exec app composer update --no-dev
```

---

## 📦 NPM Komutları

```bash
# Development
docker-compose -f docker-compose.dev.yml exec app npm install
docker-compose -f docker-compose.dev.yml exec app npm run dev
docker-compose -f docker-compose.dev.yml exec app npm run build

# Production
docker-compose exec app npm install --production
docker-compose exec app npm run build
```

---

## 🗄️ Database Komutları

### MySQL Shell

```bash
# Development
docker-compose -f docker-compose.dev.yml exec mysql mysql -u neu_user -p

# Production
docker-compose exec mysql mysql -u neu_user -p
```

### Database Backup

```bash
# Development
docker-compose -f docker-compose.dev.yml exec mysql mysqldump -u neu_user -p neu_pms > backup_$(date +%Y%m%d).sql

# Production
docker-compose exec mysql mysqldump -u neu_user -p neu_pms > backup_$(date +%Y%m%d).sql
```

### Database Restore

```bash
# Development
docker-compose -f docker-compose.dev.yml exec -T mysql mysql -u neu_user -p neu_pms < backup.sql

# Production
docker-compose exec -T mysql mysql -u neu_user -p neu_pms < backup.sql
```

---

## 🖥️ Container Shell Erişimi

```bash
# Development - App container'a gir
docker-compose -f docker-compose.dev.yml exec app sh

# Production - App container'a gir
docker-compose exec app sh

# MySQL container'a gir
docker-compose exec mysql bash

# Root olarak gir
docker-compose exec -u root app sh
```

---

## 📊 Monitoring Komutları

### Container Durumu

```bash
# Çalışan container'ları listele
docker-compose ps

# Tüm Docker container'ları
docker ps -a

# Resource kullanımı
docker stats
```

### Logs

```bash
# Tüm loglar (development)
docker-compose -f docker-compose.dev.yml logs

# Tüm loglar (production)
docker-compose logs

# Son 100 satır
docker-compose logs --tail=100

# Canlı takip
docker-compose logs -f

# Sadece hataları göster
docker-compose logs app | grep ERROR
```

---

## 🧹 Temizlik Komutları

### Container Temizleme

```bash
# Durmuş container'ları sil
docker container prune

# Kullanılmayan image'leri sil
docker image prune

# Kullanılmayan volume'leri sil
docker volume prune

# Tüm kullanılmayan resource'ları sil
docker system prune

# Aggressive temizlik (DİKKAT: Tüm data silinir!)
docker system prune -a --volumes
```

### Proje Temizliği

```bash
# Development - Container'ları ve volumeleri sil
docker-compose -f docker-compose.dev.yml down -v

# Production - Container'ları ve volumeleri sil
docker-compose down -v

# Yeniden baştan başla
docker-compose down -v
docker-compose build --no-cache
docker-compose up -d
```

---

## 🔧 Build Komutları

```bash
# Development - Yeniden build
docker-compose -f docker-compose.dev.yml build
docker-compose -f docker-compose.dev.yml build --no-cache

# Production - Yeniden build
docker-compose build
docker-compose build --no-cache

# Sadece app servisini build et
docker-compose build app
```

---

## 🔍 Debug Komutları

### Container Inspect

```bash
# Container detayları
docker inspect neu_pms_app

# Network detayları
docker network inspect graduation-project_neu_network
```

### Environment Variables

```bash
# Container içindeki env'leri göster
docker-compose exec app env
```

### File System

```bash
# Container içindeki dosyaları listele
docker-compose exec app ls -la

# Storage permissions kontrol
docker-compose exec app ls -la storage/
```

---

## 🌐 Network Komutları

```bash
# Network'leri listele
docker network ls

# NEU network detayları
docker network inspect graduation-project_neu_network

# Container'ların IP'lerini göster
docker-compose exec app hostname -i
```

---

## 📱 Hızlı Erişim URL'leri

### Development
- **Laravel**: http://localhost:8000
- **Vite**: http://localhost:5173  
- **phpMyAdmin**: http://localhost:8081
- **MySQL**: localhost:3307

### Production
- **Application**: http://localhost:8080
- **phpMyAdmin**: http://localhost:8081
- **MySQL**: localhost:3306

---

## 🆘 Sorun Giderme Komutları

### Port Kontrolü

```bash
# Windows
netstat -ano | findstr :8080

# Linux/Mac
lsof -i :8080
```

### Container Sağlık Kontrolü

```bash
# Container durumu
docker-compose ps

# Container logları (hata tespiti)
docker-compose logs app | tail -50

# MySQL connection test
docker-compose exec app php artisan tinker
>>> DB::connection()->getPdo();
```

### Permission Fix

```bash
# Storage ve cache permissions
docker-compose exec app chmod -R 775 storage bootstrap/cache
docker-compose exec app chown -R www-data:www-data storage bootstrap/cache
```

### Cache Tamamen Temizle

```bash
docker-compose exec app php artisan optimize:clear
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan route:clear
docker-compose exec app php artisan view:clear
docker-compose exec app composer dump-autoload
```

---

## 📋 Günlük Kullanım Senaryoları

### Senaryo 1: İlk Kurulum

```bash
# 1. Environment hazırla
cp .env.docker.example .env

# 2. Container'ları başlat
docker-compose up -d --build

# 3. Key generate
docker-compose exec app php artisan key:generate --force

# 4. Database setup
docker-compose exec app php artisan migrate --force
docker-compose exec app php artisan db:seed --force

# 5. Uygulamaya eriş
# http://localhost:8080
```

### Senaryo 2: Kod Değişikliği Sonrası

```bash
# 1. Cache temizle
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan config:clear

# 2. Composer güncelle (gerekirse)
docker-compose exec app composer install

# 3. NPM build (gerekirse)
docker-compose exec app npm run build

# 4. Restart
docker-compose restart app
```

### Senaryo 3: Database Değişikliği

```bash
# 1. Migration oluştur
docker-compose exec app php artisan make:migration create_xyz_table

# 2. Migration'ı çalıştır
docker-compose exec app php artisan migrate

# 3. Seeder çalıştır (gerekirse)
docker-compose exec app php artisan db:seed
```

### Senaryo 4: Tamamen Temiz Başlangıç

```bash
# 1. Her şeyi durdur ve sil
docker-compose down -v

# 2. Build tekrarla
docker-compose build --no-cache

# 3. Başlat
docker-compose up -d

# 4. Database setup
docker-compose exec app php artisan migrate:fresh --seed --force
```

---

## 💡 İpuçları

1. **Alias Kullanın** (Bash/Zsh için):
   ```bash
   alias dc='docker-compose'
   alias dcd='docker-compose -f docker-compose.dev.yml'
   alias dce='docker-compose exec app'
   alias dcl='docker-compose logs -f'
   ```

2. **Windows için Alias** (PowerShell Profile):
   ```powershell
   function dc { docker-compose $args }
   function dcd { docker-compose -f docker-compose.dev.yml $args }
   function dce { docker-compose exec app $args }
   ```

3. **Hızlı Test**:
   ```bash
   # Laravel'e hızlı erişim
   dce php artisan tinker
   ```

---

**🐳 Docker ile mutlu kodlamalar!**

