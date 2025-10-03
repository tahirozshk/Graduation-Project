# 🎓 YDU Project Management System (PMS)

Modern ve profesyonel bir **Öğretmen Proje Yönetim Sistemi** - Yeditepe Üniversitesi için geliştirilmiştir.

![Version](https://img.shields.io/badge/version-1.0.0-blue.svg)
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

**YDU Project Management System**, öğretmenlerin öğrenci projelerini takip etmesini, raporları değerlendirmesini ve proje süreçlerini yönetmesini sağlayan kapsamlı bir web uygulamasıdır.

### Sistem Amacı:
- 👨‍🏫 Öğretmenlerin öğrenci projelerini merkezi bir platformdan yönetmesi
- 📊 Proje ilerlemelerinin gerçek zamanlı takibi
- 📝 Haftalık rapor değerlendirmeleri ve notlandırma
- 🔔 Önemli tarihler ve teslimler için bildirim sistemi
- 📈 İstatistiksel raporlar ve görselleştirmeler

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
- **YDU Kurumsal Renkleri**
  - Primary: `#7A001E` (Bordo)
  - Secondary: `#2E2E2E` (Koyu Gri)
  - Background: `#F5F5F5` (Açık Gri)
- **Responsive Design** - Mobil, tablet ve masaüstü uyumlu
- **Modern UI/UX** - Kullanıcı dostu arayüz

---

## ✨ Özellikler

### 🔐 Kimlik Doğrulama
- ✅ Güvenli öğretmen girişi
- ✅ Şifre sıfırlama
- ✅ Oturum yönetimi
- ✅ Rol tabanlı yetkilendirme

### 👥 Öğrenci Yönetimi
- ✅ Öğrenci ekleme, düzenleme, silme
- ✅ Öğrenci detay sayfaları
- ✅ Aktif/Pasif durum yönetimi
- ✅ Bölüm ve yıl bilgileri
- ✅ Gelişmiş arama ve filtreleme
- ✅ Proje atama

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

### 📝 Rapor Sistemi
- ✅ Haftalık rapor girişi
- ✅ Rapor durumları:
  - Submitted (Teslim Edildi)
  - Review (İnceleniyor)
  - Overdue (Gecikmiş)
- ✅ Notlandırma sistemi (A, A-, B+, vb.)
- ✅ Rapor içeriği ve yorumlar
- ✅ Teslim tarihi takibi

### 🔔 Bildirim Sistemi
- ✅ Gerçek zamanlı bildirimler
- ✅ Bildirim tipleri:
  - Deadline (Son tarih)
  - Overdue (Gecikmiş)
  - System (Sistem)
  - Reminder (Hatırlatma)
- ✅ Okundu/Okunmadı işaretleme
- ✅ Bildirim filtreleme

### 📊 Dashboard & Raporlama
- ✅ İstatistik kartları
- ✅ Son projeler listesi
- ✅ Yaklaşan son tarihler
- ✅ Grafik ve görselleştirmeler
- ✅ Özet bilgiler

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

---

## 🚀 Kurulum

### Gereksinimler
- PHP >= 8.2
- Composer
- Node.js >= 18.x
- npm veya yarn
- MySQL veya SQLite

### Adım 1: Projeyi İndirin
```bash
git clone <repository-url>
cd "Graduation Project"
```

### Adım 2: PHP Bağımlılıklarını Yükleyin
```bash
composer install
```

### Adım 3: JavaScript Bağımlılıklarını Yükleyin
```bash
npm install
```

### Adım 4: Ortam Dosyasını Oluşturun
```bash
copy .env.example .env
```

### Adım 5: Uygulama Anahtarı Oluşturun
```bash
php artisan key:generate
```

### Adım 6: Veritabanını Yapılandırın
`.env` dosyasında veritabanı ayarlarını düzenleyin:

**SQLite için (önerilen):**
```env
DB_CONNECTION=sqlite
```

**MySQL için:**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ydu_pms
DB_USERNAME=root
DB_PASSWORD=
```

### Adım 7: Veritabanı Tablolarını Oluşturun
```bash
php artisan migrate
```

### Adım 8: Örnek Verileri Yükleyin
```bash
php artisan db:seed
```

### Adım 9: Frontend Varlıklarını Derleyin
**Geliştirme için:**
```bash
npm run dev
```

**Üretim için:**
```bash
npm run build
```

### Adım 10: Sunucuyu Başlatın
```bash
php artisan serve
```

Tarayıcınızda `http://localhost:8000` adresini açın.

---

## 👤 Kullanım

### Giriş Bilgileri (Demo)

Sistem 3 demo öğretmen hesabı ile gelir:

**Öğretmen 1:**
- Email: `ahmed.hassan@ydu.edu.tr`
- Şifre: `password`

**Öğretmen 2:**
- Email: `fatima.yilmaz@ydu.edu.tr`
- Şifre: `password`

**Öğretmen 3:**
- Email: `mehmet.demir@ydu.edu.tr`
- Şifre: `password`

### Demo Veriler
Seeder ile oluşturulan örnek veriler:
- ✅ 3 Öğretmen
- ✅ 10 Öğrenci
- ✅ 5 Proje
- ✅ 10 Rapor
- ✅ 6 Bildirim

---

## 📸 Ekran Görüntüleri

### Login Sayfası
Modern ve güvenli giriş ekranı

### Dashboard
İstatistikler, son projeler ve bildirimler

### Öğrenci Listesi
Tablo görünümü ile öğrenci yönetimi

### Proje Kartları
Card görünümü ile proje takibi

### Raporlar
Detaylı rapor tablosu ve notlandırma

### Bildirimler
Gerçek zamanlı bildirim sistemi

---

## 🗄️ Veritabanı Şeması

### Users (Teachers) Tablosu
```
- id (PK)
- name
- email (unique)
- password (hashed)
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
- message
- type (deadline/overdue/system/reminder)
- is_read (boolean)
- created_at
- updated_at
```

### İlişkiler
```
Teacher (User) → hasMany → Students
Student → belongsTo → Teacher
Student → hasMany → Projects
Project → belongsTo → Student
Project → hasMany → Reports
Report → belongsTo → Project
Teacher → hasMany → Notifications
Notification → belongsTo → Teacher
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
│   │   └── NotificationController.php
│   ├── Models/               # Eloquent Model'ler
│   │   ├── User.php
│   │   ├── Student.php
│   │   ├── Project.php
│   │   ├── Report.php
│   │   └── Notification.php
│   └── Policies/             # Authorization Policy'leri
│       ├── StudentPolicy.php
│       └── NotificationPolicy.php
├── database/
│   ├── migrations/           # Veritabanı migration'ları
│   └── seeders/              # Seed dosyaları
├── resources/
│   ├── css/                  # CSS dosyaları
│   ├── js/                   # JavaScript/TypeScript
│   │   ├── app.js
│   │   └── dashboard.ts
│   └── views/                # Blade şablonları
│       ├── auth/             # Giriş sayfaları
│       ├── layouts/          # Layout şablonları
│       ├── students/         # Öğrenci sayfaları
│       ├── projects/         # Proje sayfaları
│       ├── reports/          # Rapor sayfaları
│       └── notifications/    # Bildirim sayfaları
├── routes/
│   ├── web.php               # Web route'ları
│   ├── api.php               # API route'ları
│   └── auth.php              # Auth route'ları
├── public/                   # Public dosyalar
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
Success:  #10B981  /* Yeşil - Completed, Active */
Warning:  #F59E0B  /* Turuncu - Review, Pending */
Danger:   #EF4444  /* Kırmızı - Overdue, Inactive */
Info:     #3B82F6  /* Mavi - In Progress */
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

---

## 📝 API Endpoints

### Authentication
```
POST   /login           - Giriş yap
POST   /logout          - Çıkış yap
POST   /forgot-password - Şifre sıfırlama isteği
```

### Students API
```
GET    /api/students           - Tüm öğrencileri listele
POST   /api/students           - Yeni öğrenci ekle
GET    /api/students/{id}      - Öğrenci detayı
PUT    /api/students/{id}      - Öğrenci güncelle
DELETE /api/students/{id}      - Öğrenci sil
```

### Projects API
```
GET    /api/projects           - Tüm projeleri listele
POST   /api/projects           - Yeni proje ekle
GET    /api/projects/{id}      - Proje detayı
PUT    /api/projects/{id}      - Proje güncelle
DELETE /api/projects/{id}      - Proje sil
```

### Reports API
```
GET    /api/reports            - Tüm raporları listele
POST   /api/reports            - Yeni rapor ekle
GET    /api/reports/{id}       - Rapor detayı
PUT    /api/reports/{id}       - Rapor güncelle
DELETE /api/reports/{id}       - Rapor sil
```

### Notifications API
```
GET    /api/notifications              - Tüm bildirimleri listele
POST   /api/notifications              - Yeni bildirim ekle
PATCH  /api/notifications/{id}/read    - Okundu işaretle
DELETE /api/notifications/{id}         - Bildirim sil
```

---

## 🤝 Katkıda Bulunma

Bu proje Yeditepe Üniversitesi Bilgisayar Mühendisliği bölümü bitirme projesi olarak geliştirilmiştir.

---

## 📄 Lisans

Bu proje MIT lisansı altında lisanslanmıştır.

---

## 👨‍💻 Geliştirici

**Graduation Project 2025**  
Yeditepe University  
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
- Yeditepe Üniversitesi

---

**🎓 Developed with ❤️ for Yeditepe University**
