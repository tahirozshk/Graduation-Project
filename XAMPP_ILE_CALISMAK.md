# 🔄 XAMPP ile Docker Birlikte Kullanmak

## 📋 Durum

XAMPP (localhost) zaten çalışıyorken Docker'ı nasıl kullanırsınız?

---

## ✅ İyi Haber: Docker İzole Çalışır!

### Docker Asla Şunları Bozmaz:

1. ✅ **XAMPP Kurulumunuz** - Hiç etkilenmez
2. ✅ **Mevcut Database'leriniz** - localhost'taki DB'ler güvende
3. ✅ **Mevcut Projeleriniz** - htdocs'taki projeler çalışmaya devam eder
4. ✅ **Apache Ayarlarınız** - Hiçbir şey değişmez
5. ✅ **PHP Ayarlarınız** - Korunur

**Neden?** Docker tamamen kendi dünyasında çalışır!

```
┌─────────────────────────────────────┐
│      Sizin Bilgisayarınız           │
│                                     │
│  ┌──────────────┐  ┌──────────────┐│
│  │    XAMPP     │  │    Docker    ││
│  │              │  │              ││
│  │ localhost    │  │ Container'lar││
│  │ Port 80      │  │ Port 8080    ││
│  │ MySQL 3306   │  │ MySQL 3307   ││
│  │              │  │              ││
│  │ database.db  │  │ neu_pms.db   ││
│  └──────────────┘  └──────────────┘│
│                                     │
│  İKİSİ AYRI DÜNYALAR - ÇAKIŞMAZ!   │
└─────────────────────────────────────┘
```

---

## ⚠️ Dikkat: Port Çakışması!

### Sorun

XAMPP ve Docker aynı portları kullanmaya çalışabilir:

| Servis | XAMPP | Docker (Varsayılan) | Sonuç |
|--------|-------|---------------------|-------|
| Web Server | 80, 443 | 8080 | ✅ Çakışmaz |
| MySQL | 3306 | 3306 | ❌ ÇAKIŞIR! |
| phpMyAdmin | 80/phpmyadmin | 8081 | ✅ Çakışmaz |

---

## 🔧 Çözüm: Docker Portlarını Değiştirin

### Yöntem 1: docker-compose.yml'yi Düzenleyin (ÖNERİLEN)

Docker portlarını değiştirerek XAMPP ile çakışmayı önleyin:

```yaml
# docker-compose.yml dosyasında:

services:
  app:
    ports:
      - "8080:80"  # ✅ 8080 - XAMPP ile çakışmaz

  mysql:
    ports:
      - "3307:3306"  # ✅ 3307 - XAMPP MySQL (3306) ile çakışmaz

  phpmyadmin:
    ports:
      - "8081:80"  # ✅ 8081 - XAMPP ile çakışmaz
```

**Bu değişikliği YAPTIM!** Artık docker-compose.yml MySQL için **3307** portu kullanıyor.

### Yöntem 2: XAMPP'i Geçici Durdurun

```bash
# XAMPP Control Panel'den:
1. Apache Stop
2. MySQL Stop

# Docker'ı çalıştır
docker-compose up -d

# Bitince XAMPP'i tekrar başlat
```

---

## 🎯 Önerilen Kullanım Senaryoları

### Senaryo 1: İKİSİNİ BİRLİKTE KULLANIN (ÖNERİLEN)

```bash
# XAMPP çalışıyor - Mevcut projeleriniz için
# URL: http://localhost
# MySQL: localhost:3306

# Docker çalıştır - NEU PMS için
docker-compose up -d

# Docker URL'leri:
# - Uygulama: http://localhost:8080
# - phpMyAdmin: http://localhost:8081
# - MySQL: localhost:3307
```

**Sonuç:**
- ✅ XAMPP projeleri → http://localhost (Port 80)
- ✅ Docker NEU PMS → http://localhost:8080
- ✅ İKİSİ AYNI ANDA ÇALIŞIR!

---

### Senaryo 2: XAMPP Durdur, Docker Kullan

```bash
# XAMPP'i durdur
# (Geçici olarak, test için)

# Docker çalıştır
docker-compose up -d

# Test et
# http://localhost:8080

# Bitince Docker'ı durdur
docker-compose down

# XAMPP'i tekrar başlat
```

---

### Senaryo 3: Farklı Portlar (Varsayılan Ayarımız)

```bash
# XAMPP çalışıyor (Port 80, 3306)
# Docker da çalışsın (Port 8080, 3307)

docker-compose up -d

# İKİSİ DE ÇALIŞIR!
```

**Mevcut docker-compose.yml zaten bu şekilde ayarlı!**

---

## 📊 Port Karşılaştırması

### Mevcut Durumunuz

| Servis | XAMPP | Docker | Çakışma? |
|--------|-------|--------|----------|
| Web Server | localhost:80 | localhost:8080 | ✅ YOK |
| MySQL | localhost:3306 | localhost:3307 | ✅ YOK |
| phpMyAdmin | localhost/phpmyadmin | localhost:8081 | ✅ YOK |

**Sonuç: HİÇ ÇAKIŞMA YOK! İKİSİ BİRLİKTE ÇALIŞABİLİR! ✅**

---

## 🧪 Test: İkisi Birlikte Çalışıyor mu?

### Test 1: XAMPP Kontrolü

```bash
# Tarayıcıda:
http://localhost

# XAMPP sayfası açılıyor mu?
# ✅ EVET = XAMPP çalışıyor
```

### Test 2: Docker Kontrolü

```bash
# XAMPP çalışırken:
docker-compose up -d

# Tarayıcıda:
http://localhost:8080

# NEU PMS açılıyor mu?
# ✅ EVET = Docker çalışıyor
```

### Test 3: Her İkisi de Çalışıyor

```bash
# Aynı anda iki tarayıcı sekmesi:

Sekme 1: http://localhost       → XAMPP
Sekme 2: http://localhost:8080  → Docker

# İkisi de açılıyor mu?
# ✅ EVET = MÜKEMMEL! Her ikisi çalışıyor!
```

---

## 💾 Database'ler Ayrı Ayrı

### XAMPP Database

```
Konum: C:\xampp\mysql\data\
Erişim: localhost:3306
Yönetim: http://localhost/phpmyadmin

Projeleriniz:
- wordpress_db
- laravel_db
- test_db
... (ne varsa)

✅ BUNLAR KORUNUR - Docker etkilemez!
```

### Docker Database

```
Konum: Docker volume (izole)
Erişim: localhost:3307
Yönetim: http://localhost:8081

Sadece NEU PMS:
- neu_pms (Docker'a özel)

✅ TAMAMEN AYRI - XAMPP DB'leri etkilemez!
```

---

## 🔄 Geçiş Senaryoları

### XAMPP'ten Docker'a Veri Taşıma (İsterseniz)

```bash
# 1. XAMPP'ten export
# phpMyAdmin'den database'i export et (.sql)

# 2. Docker'a import
docker-compose exec -T mysql mysql -u neu_user -p neu_pms < exported.sql

# Password: secret
```

### Docker'dan XAMPP'e Veri Taşıma

```bash
# 1. Docker'dan export
docker-compose exec mysql mysqldump -u neu_user -p neu_pms > backup.sql

# 2. XAMPP'e import
# XAMPP phpMyAdmin'den import et
```

---

## 🎯 Hangi Durumda Ne Kullanmalı?

### XAMPP Kullan:

- ✅ Eski/Mevcut projeleriniz için
- ✅ WordPress, PHP projeleri için
- ✅ Klasik development için
- ✅ Hızlı test için

### Docker Kullan:

- ✅ NEU PMS projesi için
- ✅ Yeni projeler için
- ✅ Production benzeri ortam için
- ✅ Takım çalışması için
- ✅ Deployment için

### İkisini Birlikte:

- ✅ **EN İYİ SEÇENEK!**
- Eski projeler XAMPP'te
- Yeni projeler Docker'da
- Port çakışması yok
- Her ikisi güvenli

---

## ⚡ Hızlı Komutlar

### XAMPP + Docker Birlikte

```bash
# 1. XAMPP zaten çalışıyor
# (Hiçbir şey yapma)

# 2. Docker başlat
cd "Graduation Project"
docker-compose up -d

# 3. İkisine de eriş
# XAMPP: http://localhost
# Docker: http://localhost:8080

# 4. Bitince Docker'ı durdur
docker-compose down

# XAMPP çalışmaya devam eder!
```

### Sadece Docker

```bash
# XAMPP'i durdur (geçici)

# Docker başlat
docker-compose up -d

# Kullan...

# Bitince
docker-compose down

# XAMPP'i tekrar başlat
```

---

## 🛡️ Güvenlik: Her İkisi de İzole

```
XAMPP Veritabanı:
├── wordpress_db
├── laravel_db
└── test_db
    ↓
    DOCKER BUNLARA ERİŞEMEZ!
    XAMPP ETKILENMEZ!

Docker Veritabanı:
└── neu_pms
    ↓
    XAMPP BUNA ERİŞEMEZ!
    DOCKER İZOLE!
```

---

## ✅ Özet: Endişelenmeyin!

### Docker Çalıştırmak:

1. ✅ **XAMPP'i BOZMAZ**
2. ✅ **Database'leri BOZMAZ**
3. ✅ **Mevcut projeleri ETKİLEMEZ**
4. ✅ **İkisi AYNI ANDA çalışabilir**
5. ✅ **Tamamen GÜVENLİ**

### Tek Önemli Nokta:

⚠️ **Portları doğru ayarlayın!**
- Docker MySQL: **3307** (zaten ayarlandı!)
- XAMPP MySQL: **3306** (değişmez)

---

## 🎉 Sonuç

**EVET, GÜVENLİ BİR ŞEKİLDE ÇALIŞTIRABİLİRSİNİZ!**

```bash
# Hemen test edin:
docker-compose up -d

# XAMPP çalışmaya devam edecek
# Docker da çalışacak
# İKİSİ BİRLİKTE! ✅
```

**Hiçbir şey bozulmaz, verileriniz güvende! 🛡️**

---

## 📞 Hala Endişeniz Varsa

### Yedek Alın (İsterseniz)

```bash
# XAMPP Database yedeği
# phpMyAdmin'den Export → Tüm database'ler

# Klasör yedeği
# C:\xampp\htdocs\ → Kopyala
```

### Test Edin

```bash
# 1. Docker başlat
docker-compose up -d

# 2. XAMPP kontrol et
http://localhost

# Hala çalışıyor mu? ✅ EVET!

# 3. Docker kontrol et
http://localhost:8080

# Çalışıyor mu? ✅ EVET!

# 4. İkisi de çalışıyor! 🎉
```

---

**💡 Portlar farklı olduğu için sorun yok! Çalıştırabilirsiniz!**

