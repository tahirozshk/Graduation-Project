# 🎓 NEU Project Management System (PMS)

Modern ve profesyonel bir **Öğretmen & Admin Proje Yönetim Sistemi** - Yakın Doğu Üniversitesi için geliştirilmiştir.

![Version](https://img.shields.io/badge/version-2.0.0-blue.svg)
![Laravel](https://img.shields.io/badge/Laravel-11-red.svg)
![PHP](https://img.shields.io/badge/PHP-8.2-purple.svg)
![TypeScript](https://img.shields.io/badge/TypeScript-5.0-blue.svg)
![License](https://img.shields.io/badge/license-MIT-green.svg)

---

## 📋 İçindekiler

- [Proje Hakkında](#-proje-hakkında)
- [Teknolojiler](#-teknolojiler)
- [Özellikler](#-özellikler)
- [Kurulum](#-kurulum)
- [Kullanım](#-kullanım)
- [Ekran Görüntüleri](#-ekran-görüntüleri)
- [Veritabanı Şeması](#-veritabanı-şeması)

---

## 🎯 Proje Hakkında

**NEU Project Management System**, öğretmenlerin öğrenci projelerini takip etmesini, raporları değerlendirmesini ve proje süreçlerini yönetmesini sağlayan kapsamlı bir web uygulamasıdır. Admin paneli ile tüm sistemi merkezi olarak yönetebilirsiniz.

### Sistem Amacı:
- 👨‍🏫 Öğretmenlerin öğrenci projelerini merkezi bir platformdan yönetmesi
- 👨‍💼 Admin'lerin tüm sistem aktivitelerini izlemesi ve yönetmesi
- 📊 Proje ilerlemelerinin gerçek zamanlı takibi
- 📝 Haftalık rapor değerlendirmeleri ve notlandırma
- 🔔 Önemli tarihler ve teslimler için bildirim sistemi
- 📈 İstatistiksel raporlar ve görselleştirmeler
- 📋 Detaylı aktivite logları ve izleme

---

## 🛠️ Teknolojiler

### Backend
- **PHP 8.2+** - Sunucu tarafı programlama dili
- **Laravel 11** - Modern PHP framework
  - Eloquent ORM - Veritabanı ilişkileri
  - Blade Templates - Şablon motoru
  - Laravel Breeze - Kimlik doğrulama
  - Sanctum - API token yönetimi
- **MySQL/SQLite** - İlişkisel veritabanı

### Frontend
- **HTML5** - Sayfa yapısı
- **TailwindCSS 3** - Utility-first CSS framework
- **JavaScript (ES6+)** - Dinamik interaktivite
- **TypeScript 5** - Tip güvenli JavaScript
- **Alpine.js** - Hafif JavaScript framework
- **Vite** - Modern build tool

### Geliştirme Araçları
- **Composer** - PHP bağımlılık yöneticisi
- **NPM** - JavaScript paket yöneticisi
- **Git** - Versiyon kontrol sistemi

### Tasarım
- **NEU Kurumsal Renkleri**
  - Primary: `#7A001E` (Bordo)
  - Secondary: `#2E2E2E` (Koyu Gri)
  - Background: `#F5F5F5` (Açık Gri)
- **Responsive Design** - Mobil, tablet ve masaüstü uyumlu
- **Modern UI/UX** - Kullanıcı dostu arayüz
- **Custom NEU Logo** - Kurumsal görsel kimlik

---

## ✨ Özellikler

### 🔐 Kimlik Doğrulama & Yetkilendirme
- ✅ Modern ve güvenli giriş sayfası
- ✅ Kayıt sistemi (Teacher/Admin seçimi)
- ✅ Şifre sıfırlama
- ✅ Oturum yönetimi
- ✅ Rol tabanlı erişim kontrolü (RBAC)
- ✅ Admin onay sistemi

### 👥 Kullanıcı Rolleri

#### 🎓 Teacher (Öğretmen)
- Kendi öğrencilerini yönetebilir
- Kendi öğrencilerinin projelerini görebilir
- Kendi öğrencilerinin raporlarını değerlendirebilir
- Bildirimler alabilir
- Hemen aktif olur (onay gerektirmez)

#### 👨‍💼 Admin (Yönetici)
- **Tüm öğretmenlerin** verilerine erişebilir
- **Tüm öğrencileri** görebilir ve yönetebilir
- **Tüm projeleri** izleyebilir
- **Tüm raporları** inceleyebilir
- **Pending Admin Approvals** - Yeni admin kayıtlarını onaylayabilir
- **Activity Logs** - Tüm sistem aktivitelerini izleyebilir
- Kayıt olurken admin onayı bekler (pending durumu)

### 📊 Admin Panel Özellikleri
- ✅ **Pending Approvals** - Bekleyen admin onayları
  - Yeni admin kayıtlarını görüntüleme
  - Approve (Onayla) butonu
  - Reject (Reddet) butonu
  - Kayıt tarihi ve detaylar
- ✅ **Activity Logs** - Aktivite kayıtları
  - Tüm öğretmen aktivitelerini izleme
  - Created/Updated/Deleted işlemlerini görme
  - Hangi öğretmenin ne yaptığını takip
  - Timestamp ve detaylı açıklamalar
  - Pagination ile sayfalama

### 👥 Öğrenci Yönetimi
- ✅ Öğrenci ekleme, düzenleme, silme
- ✅ Öğrenci detay sayfaları
- ✅ Aktif/Pasif durum yönetimi
- ✅ Bölüm ve yıl bilgileri
- ✅ Gelişmiş arama ve filtreleme
- ✅ Proje atama
- ✅ Admin için öğretmen bilgisi görünümü

### 📁 Proje Yönetimi
- ✅ Proje oluşturma ve düzenleme
- ✅ İki proje tipi: Araştırma / Geliştirme
- ✅ İlerleme takibi (% progress bar)
- ✅ Durum yönetimi:
  - Planning (Planlama)
  - In Progress (Devam Ediyor)
  - Review (İnceleme)
  - Completed (Tamamlandı)
- ✅ Başlangıç ve bitiş tarihleri
- ✅ Proje detay sayfaları
- ✅ Öğrenci seçimi ile proje oluşturma

### 📝 Rapor Sistemi
- ✅ Haftalık rapor girişi
- ✅ **Proje seçimi ile rapor oluşturma**
- ✅ Rapor durumları:
  - Submitted (Teslim Edildi)
  - Review (İnceleniyor)
  - Overdue (Gecikmiş)
- ✅ Notlandırma sistemi (A, A-, B+, vb.)
- ✅ Rapor içeriği ve yorumlar
- ✅ Teslim tarihi takibi
- ✅ **Add Report** butonu ile kolay ekleme

### 🔔 Bildirim Sistemi
- ✅ Gerçek zamanlı bildirimler
- ✅ 4 Farklı bildirim tipi:
  - **SYSTEM** (Varsayılan) - Genel sistem bildirimleri (Yeşil)
  - **DEADLINE** - Teslim tarihi bildirimleri (Turuncu)
  - **OVERDUE** - Gecikmiş görevler (Kırmızı)
  - **REMINDER** - Hatırlatma bildirimleri (Mavi)
- ✅ Görsel tip ayrımı:
  - Her tip için farklı renk kodları
  - Tip'e özel ikonlar (Takvim, Uyarı, Onay işareti)
  - Tip'e özel butonlar (View Project, Contact Student)
  - Badge etiketleri (normal, high, urgent)
- ✅ Okundu/Okunmadı işaretleme
- ✅ Tekil ve toplu okundu işaretleme
- ✅ JavaScript ile dinamik filtreleme
- ✅ Badge ile okunmamış sayısı
- ✅ İstatistik kartları (Unread, Urgent, Deadlines, Submissions)
- ✅ AJAX ile gerçek zamanlı güncelleme

### 📊 Dashboard & Raporlama
- ✅ İstatistik kartları
- ✅ Son projeler listesi
- ✅ Yaklaşan son tarihler
- ✅ Grafik ve görselleştirmeler
- ✅ Özet bilgiler
- ✅ Rol bazlı dashboard (Teacher/Admin)

### 🔍 Arama & Filtreleme
- ✅ Anlık arama (live search)
- ✅ Çoklu filtreleme seçenekleri
- ✅ JavaScript tabanlı client-side filtering
- ✅ Performans optimizasyonu

### 🎨 Kullanıcı Arayüzü
- ✅ Modern ve profesyonel tasarım
- ✅ Responsive layout (mobil uyumlu)
- ✅ Sidebar navigasyon
- ✅ Card ve table görünümleri
- ✅ Progress bar'lar
- ✅ Status badge'leri
- ✅ Icon'lar ve görsel elementler
- ✅ Smooth transitions ve animasyonlar
- ✅ **YDU Logo** entegrasyonu
- ✅ Admin panel bölümü (sadece adminler için)

### 📋 Activity Logging
- ✅ Tüm CRUD işlemleri loglanır:
  - Student ekleme/güncelleme/silme
  - Project ekleme/güncelleme/silme
  - Report ekleme/güncelleme/silme
  - Admin onaylama/reddetme
- ✅ Kullanıcı bazlı takip
- ✅ Timestamp ile zaman kayıtları
- ✅ Detaylı açıklamalar

---

## 🚀 Kurulum

### Kurulum Seçenekleri

1. **🐳 Docker ile Kurulum (Önerilen)** - Hızlı ve kolay
2. **💻 Manuel Kurulum** - Geleneksel yöntem

---

## 🐳 Docker ile Kurulum (Önerilen)

Docker ile projeyi dakikalar içinde çalıştırabilirsiniz! Tüm bağımlılıklar otomatik olarak yüklenecek.

### Gereksinimler
- Docker Desktop (Windows/Mac) veya Docker Engine (Linux)
- Docker Compose v2.0+

### ⚡ Hızlı Başlangıç

1. **Projeyi klonlayın**
   ```bash
   git clone <repository-url>
   cd "Graduation Project"
   ```

2. **Docker'ı başlatın**
   ```bash
   # Windows için
   docker-start.bat
   
   # Linux/Mac için
   chmod +x docker-start.sh
   ./docker-start.sh
   ```

3. **Tarayıcınızda açın**
   - 🌐 Uygulama: http://localhost:8080
   - 🗄️ phpMyAdmin: http://localhost:8081

### 🔧 Manuel Docker Kurulumu

```bash
# 1. .env dosyasını hazırlayın
cp .env.example .env

# 2. .env dosyasını düzenleyin (ÖNEMLİ!)
# APP_KEY oluşturun:
php artisan key:generate

# Veritabanı ayarlarını Docker için yapılandırın:
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=neu_pms
DB_USERNAME=neu_user
DB_PASSWORD=secret

# 3. Docker container'ları başlatın
docker-compose up -d

# 4. Container'ın hazır olmasını bekleyin (5-10 saniye)
# MySQL'in başlamasını bekleyin

# 5. Veritabanını hazırlayın
docker-compose exec app php artisan migrate:fresh --force
docker-compose exec app php artisan db:seed --force

# 6. Cache'leri temizleyin
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan cache:clear
```

### 📝 Önemli Notlar (Docker)

**⚠️ İlk Kurulum İçin Dikkat:**
1. `.env` dosyasında mutlaka `APP_KEY` oluşturulmalı
2. Veritabanı ayarları Docker için yapılandırılmalı (yukardaki gibi)
3. Container'ları yeniden başlatırken `docker-compose down` ve `docker-compose up -d` kullanın

**🔍 Sorun Giderme:**
```bash
# Log'ları kontrol edin
docker-compose logs app

# Container'ları yeniden başlatın
docker-compose restart app

# Tam sıfırlama (veritabanı silinir!)
docker-compose down -v
docker-compose up -d
```

**📖 Detaylı Docker dokümantasyonu için:** [DOCKER_SETUP.md](DOCKER_SETUP.md)

---

## 💻 Manuel Kurulum (XAMPP)

XAMPP kullanarak projeyi localhost üzerinde çalıştırabilirsiniz.

### Gereksinimler
- **XAMPP** (PHP 8.2+, MySQL içerir)
- **Composer** (PHP bağımlılık yöneticisi)
- **Node.js >= 18.x** (npm ile birlikte gelir)
- **Git** (opsiyonel)

### 📥 Kurulum Adımları

#### 1. XAMPP'i Başlatın
```bash
# Apache ve MySQL servislerini başlatın
# XAMPP Control Panel'den Start butonlarına tıklayın
```

#### 2. Projeyi XAMPP'e Yerleştirin
```bash
# Projeyi XAMPP htdocs klasörüne kopyalayın veya klonlayın
# Örnek: C:\xampp\htdocs\Graduation Project
```

#### 3. Composer Bağımlılıklarını Yükleyin
```bash
cd "C:\xampp\htdocs\Graduation Project"
composer install
```

#### 4. NPM Bağımlılıklarını Yükleyin
```bash
npm install
```

#### 5. .env Dosyasını Oluşturun
```bash
# Windows için
copy .env.example .env
```

#### 6. .env Dosyasını Yapılandırın

**.env dosyasını açın ve şu ayarları yapın:**

```env
APP_NAME=Laravel
APP_ENV=local
APP_KEY=                    # ← php artisan key:generate ile oluşturulacak
APP_DEBUG=true
APP_URL=http://localhost

# XAMPP MySQL Ayarları
DB_CONNECTION=mysql
DB_HOST=127.0.0.1           # ← localhost
DB_PORT=3306                # ← XAMPP MySQL portu
DB_DATABASE=neu_pms         # ← Veritabanı adı (phpMyAdmin'den oluşturun)
DB_USERNAME=root            # ← XAMPP varsayılan kullanıcı
DB_PASSWORD=                # ← XAMPP'de şifre boş
```

#### 7. APP_KEY Oluşturun
```bash
php artisan key:generate
```

#### 8. Veritabanını Oluşturun

**Yöntem 1: phpMyAdmin ile (Önerilen)**
1. Tarayıcıda `http://localhost/phpmyadmin` açın
2. Sol tarafta "New" (Yeni) butonuna tıklayın
3. Database name: `neu_pms` yazın
4. "Create" butonuna tıklayın

**Yöntem 2: Komut satırı ile**
```bash
mysql -u root
CREATE DATABASE neu_pms;
exit;
```

#### 9. Migration'ları Çalıştırın
```bash
php artisan migrate:fresh --seed
```

Bu komut:
- ✓ Tüm tabloları oluşturur
- ✓ Örnek verileri yükler (öğretmenler, öğrenciler, projeler)

#### 10. Frontend Varlıklarını Derleyin

**Geliştirme için (Hot Reload ile):**
```bash
npm run dev
```

**Production için (Tek sefer):**
```bash
npm run build
```

#### 11. Projeyi Çalıştırın

**Yöntem 1: Laravel Development Server (Önerilen)**
```bash
php artisan serve
```
Tarayıcıda: `http://localhost:8000`

**Yöntem 2: XAMPP Apache**
```
# Apache zaten çalışıyorsa, direkt şu adresi açın:
http://localhost/Graduation%20Project/public
```

### ⚙️ XAMPP ile Çalışırken İpuçları

**🔧 Port Çakışması Sorunu:**
Eğer port 80 veya 3306 başka bir program tarafından kullanılıyorsa:
```bash
# Apache için (httpd.conf)
Listen 8080      # 80 yerine 8080 kullanın

# MySQL için (my.ini)
port=3307        # 3306 yerine 3307 kullanın
```

**🔄 Cache Temizleme:**
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

**🗄️ Veritabanını Sıfırlama:**
```bash
php artisan migrate:fresh --seed
```

**📝 Log Dosyalarını Kontrol:**
```bash
# Laravel log dosyası
tail -f storage/logs/laravel.log
```

### 🔍 Sorun Giderme (XAMPP)

**Problem: "Class not found" hatası**
```bash
composer dump-autoload
php artisan clear-compiled
```

**Problem: "Permission denied" hatası**
```bash
# storage ve bootstrap/cache klasörlerine yazma izni verin
chmod -R 775 storage bootstrap/cache
```

**Problem: "SQLSTATE[HY000] [1045] Access denied"**
- `.env` dosyasındaki `DB_USERNAME` ve `DB_PASSWORD` doğru mu kontrol edin
- XAMPP'de MySQL şifresi varsa `.env`'ye ekleyin

**Problem: "No application encryption key"**
```bash
php artisan key:generate
php artisan config:clear
```

### 📱 Development ile Production Farkı

**Development Mode (npm run dev):**
- ✅ Hot reload (otomatik yenileme)
- ✅ Detaylı hata mesajları
- ✅ Hızlı derleme
- ❌ Büyük dosya boyutu

**Production Mode (npm run build):**
- ✅ Optimize edilmiş kod
- ✅ Küçük dosya boyutu
- ✅ Cache'lenmiş varlıklar
- ❌ Her değişiklikte tekrar build gerekir

### 🌐 XAMPP Virtual Host Kurulumu (Opsiyonel)

Daha profesyonel bir URL için (örn: `neu-pms.local`):

1. **httpd-vhosts.conf** düzenleyin:
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

2. **hosts** dosyasını düzenleyin (`C:\Windows\System32\drivers\etc\hosts`):
```
127.0.0.1    neu-pms.local
```

3. Apache'yi yeniden başlatın ve `http://neu-pms.local` adresini açın

---

## 👤 Kullanım

### Giriş Bilgileri (Demo)

**Teacher Hesapları:**
- Email: `ahmed.hassan@neu.edu.tr` | Şifre: `password`
- Email: `fatima.yilmaz@neu.edu.tr` | Şifre: `password`
- Email: `mehmet.demir@neu.edu.tr` | Şifre: `password`

**Admin Hesabı:**
İlk admin hesabını kayıt sayfasından oluşturun:
1. `/register` sayfasına gidin
2. **Admin** rolünü seçin
3. Kayıt olun
4. İlk admin kaydı otomatik onaylanır
5. Sonraki admin kayıtları onay bekler

### Yeni Kullanıcı Kaydı

#### Teacher Olarak Kayıt:
1. `/register` sayfasına git
2. Bilgilerinizi girin
3. Role: **Teacher** seçin
4. "Create Account" tıklayın
5. ✅ Hemen giriş yapabilirsiniz (instant active)

#### Admin Olarak Kayıt:
1. `/register` sayfasına git
2. Bilgilerinizi girin
3. Role: **Admin** seçin
4. "Create Account" tıklayın
5. ⏳ Onay bekleyin (pending status)
6. Mevcut admin onaylayana kadar giriş yapamazsınız
7. Admin onayladıktan sonra giriş yapabilirsiniz

### Demo Veriler
Seeder ile oluşturulan örnek veriler:
- ✅ 3 Öğretmen
- ✅ 10 Öğrenci
- ✅ 5 Proje
- ✅ 10 Rapor
- ✅ 6 Bildirim
- ✅ Activity Logs

---

## 📸 Ekran Görüntüleri

### Login Sayfası
Modern ve güvenli giriş ekranı
- NEU gradient arka plan
- Modern input alanları
- "Create an account" linki
- Demo credentials görünümü

### Register Sayfası
Kullanıcı kayıt ekranı
- Teacher/Admin rol seçimi
- Modern form tasarımı
- Rol açıklamaları

### Dashboard
İstatistikler, son projeler ve bildirimler
- Teacher: Kendi verileri
- Admin: Tüm sistem verileri

### Admin Panel
Sadece adminler için özel bölüm
- Pending Approvals: Bekleyen onaylar
- Activity Logs: Sistem kayıtları

### Öğrenci Listesi
Tablo görünümü ile öğrenci yönetimi
- Admin için öğretmen bilgisi sütunu
- Arama ve filtreleme

### Proje Yönetimi
Card görünümü ile proje takibi
- Progress bar'lar
- Status badge'leri

### Raporlar
Detaylı rapor tablosu ve notlandırma
- Add Report butonu
- Proje seçimi dropdown

### Bildirimler
Gerçek zamanlı bildirim sistemi
- Okunmamış sayısı badge
- 4 farklı bildirim tipi ile görsel ayrım
- Filtreleme ve arama özellikleri
- AJAX ile dinamik güncelleme

---

## 🔔 Bildirim Sistemi Detayları

### Bildirim Tipleri ve Görsel Tasarım

#### 1. **SYSTEM** (Varsayılan) - Genel Sistem Bildirimleri
- **Renk**: Yeşil (`#10B981` - kenarlık, `bg-green-100` - ikon arka planı)
- **İkon**: Onay işareti (✓)
- **Badge**: "normal" (mavi rozet)
- **Kullanım**: Yeni rapor gönderildi, proje güncellendi, genel bilgilendirmeler

#### 2. **DEADLINE** - Teslim Tarihi Bildirimleri
- **Renk**: Turuncu (`#F97316` - kenarlık, `bg-blue-100` - ikon arka planı)
- **İkon**: Takvim (📅)
- **Badge**: "high" (sarı rozet)
- **Buton**: "View Project" (Projeyi Görüntüle)
- **Kullanım**: Teslim tarihi yaklaştığında, milestone hatırlatmaları

#### 3. **OVERDUE** - Gecikmiş Görevler
- **Renk**: Kırmızı (`#EF4444` - kenarlık, `bg-red-100` - ikon arka planı)
- **İkon**: Uyarı (⚠️)
- **Badge**: "urgent" (kırmızı rozet)
- **Buton**: "Contact Student" (Öğrenciyle İletişime Geç)
- **Kullanım**: Teslim tarihi geçtiğinde, acil müdahale gereken durumlar

#### 4. **REMINDER** - Hatırlatma Bildirimleri
- **Renk**: Mavi (`#3B82F6` - kenarlık, `bg-purple-100` - ikon arka planı)
- **İkon**: Onay işareti (✓) - system ile aynı
- **Badge**: "normal" (mavi rozet)
- **Kullanım**: Haftalık rapor hatırlatmaları, genel hatırlatmalar

### Bildirim Oluşturma Örnekleri

```php
// 1. Sistem bildirimi (varsayılan)
Notification::create([
    'teacher_id' => $teacherId,
    'message' => 'Yeni rapor gönderildi: Proje A - Hafta 5',
    'type' => 'system' // yazmasanız da otomatik 'system' olur
]);

// 2. Deadline bildirimi
Notification::create([
    'teacher_id' => $teacherId,
    'message' => 'Proje teslim tarihi yaklaşıyor: 3 gün kaldı',
    'type' => 'deadline'
]);

// 3. Overdue bildirimi
Notification::create([
    'teacher_id' => $teacherId,
    'message' => 'Proje teslim tarihi geçti: 2 gün gecikme',
    'type' => 'overdue'
]);

// 4. Reminder bildirimi
Notification::create([
    'teacher_id' => $teacherId,
    'message' => 'Haftalık rapor gönderimi hatırlatması',
    'type' => 'reminder'
]);
```

### JavaScript Fonksiyonları

```javascript
// Bildirim filtreleme
function filterNotifications(type) {
    const cards = document.querySelectorAll('.notification-card');
    cards.forEach(card => {
        const cardType = card.dataset.type;
        if (type === 'all') {
            card.style.display = 'block';
        } else {
            card.style.display = cardType === type ? 'block' : 'none';
        }
    });
}

// Tüm bildirimleri okundu işaretle
function markAllAsRead() {
    fetch('/notifications/mark-all-read', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    });
}

// Tekil bildirimi okundu işaretle
function toggleNotificationRead(notificationId, isRead) {
    const endpoint = `/notifications/${notificationId}/${isRead ? 'read' : 'unread'}`;
    fetch(endpoint, { method: 'PATCH' });
}
```

### İstatistik Kartları

- **Okunmamış**: Toplam okunmamış bildirim sayısı
- **Acil**: `overdue` tipindeki bildirimlerin sayısı
- **Teslim Tarihleri**: `deadline` tipindeki bildirimlerin sayısı
- **Gönderimler**: `system` tipindeki bildirimlerin sayısı

### Yetkilendirme

- **Admin**: Tüm bildirimleri görüntüleyebilir ve yönetebilir
- **Teacher**: Sadece kendi bildirimlerini görüntüleyebilir ve yönetebilir

---

## 🗄️ Veritabanı Şeması

### Users (Teachers/Admins) Tablosu
```
- id (PK)
- name
- email (unique)
- password (hashed)
- role (teacher/admin) ✨ NEW
- status (active/pending) ✨ NEW
- email_verified_at
- remember_token
- created_at
- updated_at
```

### Students Tablosu
```
- id (PK)
- student_id (unique)
- teacher_id (FK → users.id)
- name
- email (unique)
- year
- department
- status (active/inactive)
- created_at
- updated_at
```

### Projects Tablosu
```
- id (PK)
- student_id (FK → students.id)
- title
- description
- project_type (Research/Development)
- start_date
- end_date
- progress (0-100)
- status (Planning/In Progress/Review/Completed)
- created_at
- updated_at
```

### Reports Tablosu
```
- id (PK)
- project_id (FK → projects.id)
- week_number
- content
- submission_date
- status (Submitted/Review/Overdue)
- grade (nullable)
- created_at
- updated_at
```

### Notifications Tablosu
```
- id (PK)
- teacher_id (FK → users.id)
- message (text) - Bildirim mesajı
- type (string) - Bildirim tipi:
  * system (varsayılan) - Genel sistem bildirimleri
  * deadline - Teslim tarihi bildirimleri
  * overdue - Gecikmiş görevler
  * reminder - Hatırlatma bildirimleri
- is_read (boolean) - Okundu durumu
- created_at
- updated_at
```

### Activity Logs Tablosu ✨ NEW
```
- id (PK)
- user_id (FK → users.id)
- action (created/updated/deleted/approved/rejected)
- model (Student/Project/Report/User)
- model_name
- model_id
- description
- created_at
- updated_at
```

### İlişkiler
```
User (Teacher/Admin) → hasMany → Students
User → hasMany → ActivityLogs ✨ NEW
Student → belongsTo → Teacher (User)
Student → hasMany → Projects
Project → belongsTo → Student
Project → hasMany → Reports
Report → belongsTo → Project
Teacher → hasMany → Notifications
Notification → belongsTo → Teacher
ActivityLog → belongsTo → User ✨ NEW
```

---

## 🔧 Geliştirme

### Cache Temizleme
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Veritabanını Sıfırlama
```bash
php artisan migrate:fresh --seed
```

### Kod Formatı
```bash
./vendor/bin/pint
```

### Test Çalıştırma
```bash
php artisan test
```

---

## 📂 Proje Yapısı

```
├── app/
│   ├── Http/Controllers/     # Controller'lar
│   │   ├── DashboardController.php
│   │   ├── StudentController.php
│   │   ├── ProjectController.php
│   │   ├── ReportController.php
│   │   ├── NotificationController.php
│   │   └── AdminController.php ✨ NEW
│   ├── Models/               # Eloquent Model'ler
│   │   ├── User.php
│   │   ├── Student.php
│   │   ├── Project.php
│   │   ├── Report.php
│   │   ├── Notification.php
│   │   └── ActivityLog.php ✨ NEW
│   └── Policies/             # Authorization Policy'leri
│       ├── StudentPolicy.php
│       └── NotificationPolicy.php
├── database/
│   ├── migrations/           # Veritabanı migration'ları
│   │   ├── add_status_to_users_table.php ✨ NEW
│   │   └── create_activity_logs_table.php ✨ NEW
│   └── seeders/              # Seed dosyaları
├── public/
│   └── build/assets/
│       └── ydu-logo.svg ✨ NEW
├── resources/
│   ├── css/                  # CSS dosyaları
│   ├── js/                   # JavaScript/TypeScript
│   │   ├── app.js
│   │   └── dashboard.ts
│   └── views/                # Blade şablonları
│       ├── auth/             # Giriş sayfaları
│       │   ├── login.blade.php (updated)
│       │   └── register.blade.php (updated)
│       ├── admin/ ✨ NEW
│       │   ├── pending-approvals.blade.php
│       │   └── activity-logs.blade.php
│       ├── layouts/          # Layout şablonları
│       ├── students/         # Öğrenci sayfaları
│       ├── projects/         # Proje sayfaları
│       ├── reports/          # Rapor sayfaları
│       └── notifications/    # Bildirim sayfaları
├── routes/
│   ├── web.php               # Web route'ları (updated)
│   ├── api.php               # API route'ları
│   └── auth.php              # Auth route'ları (updated)
├── composer.json             # PHP bağımlılıkları
├── package.json              # JS bağımlılıkları
├── tsconfig.json             # TypeScript ayarları
├── tailwind.config.js        # TailwindCSS ayarları
└── vite.config.js            # Vite ayarları
```

---

## 🎨 Tasarım Sistemi

### Renk Paleti
```css
Primary:    #7A001E  /* YDU Bordo */
Secondary:  #2E2E2E  /* Koyu Gri */
Background: #F5F5F5  /* Açık Gri */
White:      #FFFFFF  /* Beyaz */
```

### Status Renkleri
```css
Success:  #10B981  /* Yeşil - Completed, Active, Approved */
Warning:  #F59E0B  /* Turuncu - Review, Pending */
Danger:   #EF4444  /* Kırmızı - Overdue, Inactive, Rejected */
Info:     #3B82F6  /* Mavi - In Progress */
Purple:   #8B5CF6  /* Mor - Admin Role */
```

---

## 🔒 Güvenlik

- ✅ CSRF koruması
- ✅ XSS koruması
- ✅ SQL Injection koruması (Eloquent ORM)
- ✅ Şifre hashleme (bcrypt)
- ✅ Authentication middleware
- ✅ Authorization policies
- ✅ Rate limiting
- ✅ Secure session management
- ✅ Role-based access control (RBAC) ✨ NEW
- ✅ Admin approval system ✨ NEW
- ✅ Activity logging ✨ NEW

---

## 📝 API Endpoints

### Authentication
```
POST   /register        - Yeni kullanıcı kaydı (Teacher/Admin)
POST   /login           - Giriş yap
POST   /logout          - Çıkış yap
POST   /forgot-password - Şifre sıfırlama isteği
```

### Admin Routes ✨ NEW
```
GET    /admin/pending-approvals     - Bekleyen admin onayları
POST   /admin/approve/{id}          - Kullanıcı onayla
POST   /admin/reject/{id}           - Kullanıcı reddet
GET    /admin/activity-logs         - Aktivite logları
```

### Students
```
GET    /students           - Tüm öğrencileri listele
POST   /students           - Yeni öğrenci ekle
GET    /students/{id}      - Öğrenci detayı
PUT    /students/{id}      - Öğrenci güncelle
DELETE /students/{id}      - Öğrenci sil
```

### Projects
```
GET    /projects           - Tüm projeleri listele
POST   /projects           - Yeni proje ekle
GET    /projects/{id}      - Proje detayı
PUT    /projects/{id}      - Proje güncelle
DELETE /projects/{id}      - Proje sil
```

### Reports
```
GET    /reports            - Tüm raporları listele
POST   /reports            - Yeni rapor ekle
GET    /reports/{id}       - Rapor detayı
PUT    /reports/{id}       - Rapor güncelle
DELETE /reports/{id}       - Rapor sil
```

### Notifications
```
GET    /notifications                    - Tüm bildirimleri listele
POST   /notifications                    - Yeni bildirim ekle
PATCH  /notifications/{id}/read          - Okundu işaretle
PATCH  /notifications/{id}/unread        - Okunmadı işaretle
POST   /notifications/mark-all-read      - Tüm bildirimleri okundu işaretle
DELETE /notifications/{id}               - Bildirim sil

API Endpoints:
GET    /api/notifications                - API ile bildirimleri listele
POST   /api/notifications                - API ile bildirim oluştur
PATCH  /api/notifications/{id}/read      - API ile okundu işaretle
PATCH  /api/notifications/{id}/unread    - API ile okunmadı işaretle
POST   /api/notifications/mark-all-read  - API ile tümünü okundu işaretle
DELETE /api/notifications/{id}           - API ile bildirim sil
```

---

## 🆕 Yeni Özellikler (v2.0.0)

### ✨ Rol Tabanlı Sistem
- Teacher ve Admin rolleri
- Her rolün farklı yetkileri
- Dinamik dashboard içeriği

### ✨ Admin Onay Sistemi
- Admin kayıtları pending durumunda başlar
- Mevcut admin onaylayana kadar giriş yapılamaz
- Approve/Reject mekanizması

### ✨ Activity Logs
- Tüm CRUD işlemleri kaydedilir
- Hangi öğretmenin ne yaptığı görülebilir
- Admin panelinden izlenebilir

### ✨ Modern UI/UX
- Login sayfası yenilendi
- Register sayfası yenilendi
- YDU logosu eklendi
- Sidebar menü güncellendi
- Admin panel bölümü eklendi

### ✨ Gelişmiş Bildirim Sistemi
- 4 farklı bildirim tipi (system, deadline, overdue, reminder)
- Her tip için özel renk kodları ve ikonlar
- Görsel tip ayrımı ve badge sistemi
- JavaScript ile dinamik filtreleme
- AJAX ile gerçek zamanlı güncelleme
- İstatistik kartları ve sayaçlar
- Tip'e özel aksiyon butonları

---

## 🤝 Katkıda Bulunma

Bu proje Yakın Doğu Üniversitesi Bilgisayar Mühendisliği bölümü bitirme projesi olarak geliştirilmiştir.

---

## 📄 Lisans

Bu proje MIT lisansı altında lisanslanmıştır.

---

## 👨‍💻 Geliştirici

**Graduation Project 2025**  
Near East University (Yakın Doğu Üniversitesi)  
Computer Engineering Department

---

## 📞 İletişim

Sorularınız için lütfen proje yöneticisi ile iletişime geçin.

---

## 🙏 Teşekkürler

- Laravel Framework
- TailwindCSS
- Alpine.js
- Heroicons
- Yakın Doğu Üniversitesi (Near East University)

---

## 📌 Önemli Notlar

### İlk Kurulum
1. İlk admin hesabını `/register` sayfasından oluşturun
2. Teacher hesapları otomatik aktif olur
3. Sonraki admin kayıtları onay bekler

### Güvenlik
- Üretim ortamında `.env` dosyasını güvenli tutun
- Güçlü şifreler kullanın
- HTTPS kullanın
- Regular backups alın

### Performans
- Production ortamında `npm run build` çalıştırın
- Cache'leri kullanın: `php artisan config:cache`
- Database indexleri optimize edin

---

**🎓 Developed with ❤️ for Near East University**

**Version 2.0.0** - Rol Tabanlı Sistem & Admin Paneli