@echo off
REM NEU PMS - Docker Test Script (Windows)
REM Bu script Docker kurulumunuzu test eder

echo ================================
echo NEU PMS Docker Test Scripti
echo ================================
echo.

REM Test 1: Docker kurulu mu?
echo [TEST 1] Docker kurulumu kontrol ediliyor...
docker --version >nul 2>&1
if errorlevel 1 (
    echo [HATA] Docker kurulu degil!
    echo Lutfen Docker Desktop kurun: https://www.docker.com/products/docker-desktop/
    pause
    exit /b 1
)
docker --version
echo [BASARILI] Docker kurulu
echo.

REM Test 2: Docker Compose kurulu mu?
echo [TEST 2] Docker Compose kontrol ediliyor...
docker-compose --version >nul 2>&1
if errorlevel 1 (
    echo [HATA] Docker Compose kurulu degil!
    pause
    exit /b 1
)
docker-compose --version
echo [BASARILI] Docker Compose kurulu
echo.

REM Test 3: Container'lari baslat
echo [TEST 3] Container'lar baslatiliyor... (2-3 dakika surebilir)
docker-compose up -d
echo Servisler icin bekleniyor...
timeout /t 15 /nobreak >nul
echo [BASARILI] Container'lar baslatildi
echo.

REM Test 4: Container durumu
echo [TEST 4] Container durumu kontrol ediliyor...
docker-compose ps
echo.

REM Test 5: Database setup
echo [TEST 5] Database hazırlaniyor...
echo - Key generate...
docker-compose exec -T app php artisan key:generate --force
echo - Migration...
docker-compose exec -T app php artisan migrate --force
echo - Seed data...
docker-compose exec -T app php artisan db:seed --force
echo [BASARILI] Database hazir
echo.

REM Test 6: HTTP test
echo [TEST 6] HTTP erisim testi...
curl -s -o nul -w "HTTP Status: %%{http_code}" http://localhost:8080
echo.
echo [BASARILI] HTTP erisim calisiyor
echo.

REM Test 7: Port kontrolu
echo [TEST 7] Port kontrolu...
netstat -ano | findstr :8080 >nul
if errorlevel 1 (
    echo [UYARI] Port 8080 dinlenmiyor!
) else (
    echo [BASARILI] Port 8080 aktif
)

netstat -ano | findstr :8081 >nul
if errorlevel 1 (
    echo [UYARI] Port 8081 dinlenmiyor!
) else (
    echo [BASARILI] Port 8081 aktif (phpMyAdmin)
)
echo.

REM Sonuc
echo ================================
echo TESTLER TAMAMLANDI!
echo ================================
echo.
echo Uygulamaya erisim:
echo   - Ana sayfa: http://localhost:8080
echo   - phpMyAdmin: http://localhost:8081
echo.
echo Test hesabi:
echo   Email: ahmed.hassan@neu.edu.tr
echo   Password: password
echo.
echo Tarayicida acmak icin herhangi bir tusa basin...
pause >nul

REM Tarayiciyi ac
start http://localhost:8080

echo.
echo Basarili giris yaptiniz mi? (E/H)
set /p success="Cevap: "

if /i "%success%"=="E" (
    echo.
    echo ================================
    echo TEBRIKLER! SISTEM CALISIYOR!
    echo ================================
    echo.
    echo Kullanisli komutlar:
    echo   - Durdur: docker-compose down
    echo   - Loglar: docker-compose logs -f
    echo   - Restart: docker-compose restart
    echo.
) else (
    echo.
    echo Sorun yasiyorsaniz:
    echo 1. Loglari kontrol edin: docker-compose logs -f app
    echo 2. DOCKER_SETUP.md dosyasindaki sorun giderme bolumune bakin
    echo 3. Container'lari yeniden baslatmayi deneyin:
    echo    docker-compose down
    echo    docker-compose up -d --build
    echo.
)

pause

