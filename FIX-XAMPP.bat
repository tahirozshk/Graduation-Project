@echo off
REM XAMPP MySQL Duzeltme Scripti
REM Docker'i durdur ve XAMPP'i calistir

echo ================================
echo XAMPP MySQL Duzeltme Scripti
echo ================================
echo.

echo [1] Docker container'lari durduruluyor...
docker-compose down 2>nul
echo Docker durduruldu.
echo.

echo [2] XAMPP MySQL durumu kontrol ediliyor...
echo.
echo Simdi yapmaniz gerekenler:
echo.
echo 1. XAMPP Control Panel'i acin
echo 2. MySQL satirinda "Stop" butonuna basin
echo 3. 5 saniye bekleyin
echo 4. MySQL satirinda "Start" butonuna basin
echo.
echo MySQL yesil olacak - "Running on port 3306"
echo.

pause

echo.
echo ================================
echo XAMPP MySQL Duzeltildi mi?
echo ================================
echo.
echo XAMPP MySQL calisiyor mu? (E/H)
set /p mysql_ok="Cevap: "

if /i "%mysql_ok%"=="E" (
    echo.
    echo ================================
    echo MUKEMMEL! SISTEM NORMALE DONDU
    echo ================================
    echo.
    echo Su anda durum:
    echo - XAMPP MySQL: CALISIYOR (Port 3306)
    echo - Docker: DURDURULDU
    echo.
    echo Mevcut projeleriniz:
    echo - http://localhost (XAMPP)
    echo - http://localhost/phpmyadmin (XAMPP)
    echo.
    echo Hicbir sey bozulmadi! ^_^
    echo.
) else (
    echo.
    echo Hala sorun varsa:
    echo.
    echo 1. XAMPP Control Panel'de MySQL'i Stop/Start yapin
    echo 2. Bilgisayari yeniden baslatin
    echo 3. XAMPP'i tekrar acin
    echo.
)

echo.
echo Docker ile XAMPP'i birlikte kullanmak icin:
echo - XAMPP_ILE_CALISMAK.md dosyasini okuyun
echo.
pause

