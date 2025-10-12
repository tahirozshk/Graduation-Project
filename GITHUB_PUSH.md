# 📤 GitHub'a Kod Gönderme Rehberi

Bu rehber, projenizi GitHub'a göndermek için gerekli adımları içerir.

---

## ✅ Önkoşullar

- Git yüklü olmalı
- GitHub hesabı olmalı
- Repository oluşturulmuş olmalı

---

## 🚀 İlk Kez GitHub'a Gönderme

### 1. Git Yapılandırması (İlk Sefer)
```bash
# Kullanıcı bilgilerinizi ayarlayın
git config --global user.name "Adınız Soyadınız"
git config --global user.email "email@example.com"
```

### 2. .gitignore Kontrolü
```bash
# .gitignore dosyasının olduğundan emin olun
# .env, node_modules, vendor gibi dosyalar ignore edilmeli
```

**.gitignore'a eklenmesi gereken önemli dosyalar:**
```
/node_modules
/public/hot
/public/storage
/storage/*.key
/vendor
.env
.env.backup
.env.production
.phpunit.result.cache
Homestead.json
Homestead.yaml
auth.json
npm-debug.log
yarn-error.log
/.fleet
/.idea
/.vscode
```

### 3. Repository'yi Başlat
```bash
# Proje klasörüne git
cd "C:\xampp\htdocs\Graduation Project"

# Git repository'sini başlat (eğer başlatılmamışsa)
git init

# Uzak repository'yi ekle
git remote add origin https://github.com/kullanici-adi/repo-adi.git

# Veya SSH kullanıyorsanız:
# git remote add origin git@github.com:kullanici-adi/repo-adi.git
```

### 4. Dosyaları Ekle ve Commit Et
```bash
# Tüm değişiklikleri stage'e ekle
git add .

# Commit mesajı ile kaydet
git commit -m "Initial commit: NEU PMS project setup"
```

### 5. GitHub'a Gönder
```bash
# Ana branch'i belirle ve gönder
git branch -M main
git push -u origin main
```

---

## 🔄 Sonraki Güncellemeler için

### Değişiklikleri Göndermek
```bash
# 1. Değişiklikleri kontrol et
git status

# 2. Dosyaları ekle
git add .

# Veya belirli dosyaları ekle:
# git add dosya_adi.php
# git add resources/views/

# 3. Commit yap
git commit -m "Açıklayıcı commit mesajı"

# 4. GitHub'a gönder
git push
```

### İyi Commit Mesajları
```bash
# ✅ İyi örnekler:
git commit -m "Add: Docker support for MySQL database"
git commit -m "Fix: APP_KEY generation issue in .env"
git commit -m "Update: XAMPP installation guide in README"
git commit -m "Improve: Database seeder with new project types"

# ❌ Kötü örnekler:
git commit -m "update"
git commit -m "fix bug"
git commit -m "asdasd"
```

---

## 📋 Bu Güncelleme için Önerilen Commit

```bash
# Değişiklikleri kontrol et
git status

# Tüm değişiklikleri ekle
git add .

# Commit yap
git commit -m "Fix: Docker and XAMPP configuration with updated documentation

- Fixed APP_KEY generation issue
- Updated .env configuration for Docker (MySQL)
- Added XAMPP installation guide (XAMPP_KURULUM.md)
- Updated README.md with detailed setup instructions
- Fixed database migrations for project_type enum
- Updated ProjectSeeder with new semester field
- Added GITHUB_PUSH.md guide"

# GitHub'a gönder
git push
```

---

## 🔧 Yararlı Git Komutları

### Durum Kontrolü
```bash
# Değişiklikleri göster
git status

# Son commit'leri göster
git log --oneline

# Belirli bir dosyanın geçmişi
git log --follow dosya_adi.php
```

### Değişiklikleri Geri Alma
```bash
# Stage'lenmiş dosyayı geri al
git reset HEAD dosya_adi.php

# Tüm değişiklikleri geri al (DİKKAT: Geri alınamaz!)
git reset --hard HEAD

# Son commit'i geri al (değişiklikler kalır)
git reset --soft HEAD~1
```

### Branch İşlemleri
```bash
# Yeni branch oluştur
git checkout -b feature/yeni-ozellik

# Branch'ler arası geçiş
git checkout main
git checkout feature/yeni-ozellik

# Branch'i merge et
git checkout main
git merge feature/yeni-ozellik

# Branch'i sil
git branch -d feature/yeni-ozellik
```

### Uzak Repository İşlemleri
```bash
# Uzak repository bilgilerini göster
git remote -v

# Uzak repository'den çek
git pull origin main

# Farklı branch'e push et
git push origin branch-adi
```

---

## 🚫 GitHub'a Gönderilmemesi Gerekenler

**✅ Gönderilmesi Gerekenler:**
- Kaynak kod dosyaları (.php, .js, .css)
- Blade template'ler (.blade.php)
- Migration dosyaları
- Seeder dosyaları
- Configuration dosyaları (örnekleri)
- README ve dokümantasyon
- .gitignore dosyası
- composer.json, package.json

**❌ Gönderilmemesi Gerekenler:**
- `.env` dosyası (hassas bilgiler içerir)
- `node_modules/` klasörü (çok büyük)
- `vendor/` klasörü (composer install ile oluşur)
- `storage/logs/` dosyaları
- `public/hot` dosyası
- Veritabanı dosyaları (.sqlite)
- IDE ayar dosyaları (.vscode, .idea)

---

## 🔒 .env Dosyası İçin

**.env dosyası GitHub'a gönderilmez!** Bunun yerine:

1. **.env.example** oluştur:
```bash
cp .env .env.example
```

2. **.env.example**'dan hassas bilgileri çıkar:
```env
APP_NAME=Laravel
APP_ENV=local
APP_KEY=                    # ← Boş bırak
APP_DEBUG=true

DB_CONNECTION=mysql
DB_HOST=127.0.0.1          # ← Varsayılan değer
DB_PORT=3306
DB_DATABASE=neu_pms        # ← Örnek isim
DB_USERNAME=root           # ← Varsayılan
DB_PASSWORD=               # ← Boş bırak
```

3. **README.md**'de kurulum talimatları ekle

---

## 📝 GitHub Repository Settings

### Repository'yi Public/Private Yap
- GitHub → Repository → Settings
- Danger Zone → Change repository visibility

### Branch Protection
- Settings → Branches → Add rule
- Branch name pattern: `main`
- ☑ Require pull request reviews

### Collaborators Ekle
- Settings → Collaborators
- Add people

---

## 🎯 Best Practices

### 1. Sık Sık Commit Yap
```bash
# Her mantıklı değişiklikten sonra commit yap
# Büyük değişiklikleri parçalara böl
```

### 2. Açıklayıcı Commit Mesajları
```bash
# Ne değişti ve neden değişti belirt
git commit -m "Add: User authentication with Laravel Breeze"
```

### 3. Pull İşlemini Unutma
```bash
# Push'tan önce pull yap (takım çalışmasında)
git pull origin main
git push origin main
```

### 4. Branch Kullan
```bash
# Yeni özellikler için branch aç
git checkout -b feature/new-dashboard
# Geliştir, test et
git checkout main
git merge feature/new-dashboard
```

### 5. .gitignore'u Güncel Tut
```bash
# Gereksiz dosyalar eklenmesin
```

---

## ⚠️ Sık Yapılan Hatalar

### Hata 1: .env dosyasını GitHub'a göndermek
**Çözüm:**
```bash
# .env'yi git'ten kaldır
git rm --cached .env
git commit -m "Remove .env from repository"
git push
```

### Hata 2: node_modules'ü göndermek
**Çözüm:**
```bash
# .gitignore'a ekle
echo "node_modules/" >> .gitignore
git rm -r --cached node_modules
git commit -m "Remove node_modules from repository"
git push
```

### Hata 3: Conflict (Çakışma)
**Çözüm:**
```bash
# Pull yap
git pull origin main

# Conflict'i manuel çöz
# Dosyayı aç ve <<<< ==== >>>> işaretlerini düzenle

# Çözüldükten sonra:
git add .
git commit -m "Resolve merge conflict"
git push
```

---

## 🎓 GitHub İçin Öğrenci Avantajları

GitHub Student Developer Pack:
- Ücretsiz private repository'ler
- GitHub Pro ücretsiz
- Birçok geliştirici aracına ücretsiz erişim

**Başvuru:** https://education.github.com/pack

---

## 📞 Yardım

```bash
# Git yardım
git help
git help commit
git help push

# Git durumunu kontrol et
git status

# Son commit'leri göster
git log --oneline -10
```

---

**✨ Başarılar! Kodlarını güvenle GitHub'a gönderebilirsin!**

