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
- ✅ Bildirim tipleri:
  - Deadline (Son tarih)
  - Overdue (Gecikmiş)
  - System (Sistem)
  - Reminder (Hatırlatma)
- ✅ Okundu/Okunmadı işaretleme
- ✅ Bildirim filtreleme
- ✅ Badge ile okunmamış sayısı

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
- message
- type (deadline/overdue/system/reminder)
- is_read (boolean)
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
GET    /notifications              - Tüm bildirimleri listele
POST   /notifications              - Yeni bildirim ekle
PATCH  /notifications/{id}/read    - Okundu işaretle
DELETE /notifications/{id}         - Bildirim sil
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