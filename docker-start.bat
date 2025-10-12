@echo off
REM NEU PMS - Docker Quick Start Script (Windows)
REM This script helps you quickly start the application with Docker

echo ================================
echo NEU Project Management System
echo Docker Setup (Windows)
echo ================================
echo.

REM Check if Docker is installed
docker --version >nul 2>&1
if errorlevel 1 (
    echo [ERROR] Docker is not installed.
    echo Please install Docker Desktop for Windows from:
    echo https://www.docker.com/products/docker-desktop/
    pause
    exit /b 1
)

echo [OK] Docker is installed
echo.

REM Check if .env exists
if not exist .env (
    echo Creating .env file from template...
    if exist .env.docker.example (
        copy .env.docker.example .env
        echo [OK] .env file created
    ) else (
        echo [ERROR] .env.docker.example not found
        pause
        exit /b 1
    )
) else (
    echo [OK] .env file already exists
)

echo.
echo Choose your environment:
echo 1. Development (with hot reload)
echo 2. Production (optimized)
echo.
set /p choice="Enter choice (1 or 2): "

if "%choice%"=="1" goto development
if "%choice%"=="2" goto production
echo Invalid choice. Exiting.
pause
exit /b 1

:development
echo.
echo Starting Development Environment...
echo - Laravel: http://localhost:8000
echo - Vite: http://localhost:5173
echo - phpMyAdmin: http://localhost:8081
echo.

REM Build and start
docker-compose -f docker-compose.dev.yml up -d --build

echo.
echo Waiting for services to start...
timeout /t 10 /nobreak

echo.
echo Installing dependencies...
docker-compose -f docker-compose.dev.yml exec -T app composer install
docker-compose -f docker-compose.dev.yml exec -T app npm install

echo.
echo Generating application key...
docker-compose -f docker-compose.dev.yml exec -T app php artisan key:generate --force

echo.
echo Setting up database...
docker-compose -f docker-compose.dev.yml exec -T app php artisan migrate --force
docker-compose -f docker-compose.dev.yml exec -T app php artisan db:seed --force

echo.
echo ================================
echo Development environment is ready!
echo ================================
echo.
echo Access your application:
echo - Application: http://localhost:8000
echo - Database: http://localhost:8081
echo.
echo Useful commands:
echo - View logs: docker-compose -f docker-compose.dev.yml logs -f
echo - Stop: docker-compose -f docker-compose.dev.yml down
echo - Restart: docker-compose -f docker-compose.dev.yml restart
echo.
pause
exit /b 0

:production
echo.
echo Starting Production Environment...
echo - Application: http://localhost:8080
echo - phpMyAdmin: http://localhost:8081
echo.

REM Build and start
docker-compose up -d --build

echo.
echo Waiting for services to start...
timeout /t 10 /nobreak

echo.
echo Generating application key...
docker-compose exec -T app php artisan key:generate --force

echo.
echo Setting up database...
docker-compose exec -T app php artisan migrate --force
docker-compose exec -T app php artisan db:seed --force

echo.
echo Optimizing application...
docker-compose exec -T app php artisan config:cache
docker-compose exec -T app php artisan route:cache
docker-compose exec -T app php artisan view:cache

echo.
echo ================================
echo Production environment is ready!
echo ================================
echo.
echo Access your application:
echo - Application: http://localhost:8080
echo - Database: http://localhost:8081
echo.
echo Useful commands:
echo - View logs: docker-compose logs -f
echo - Stop: docker-compose down
echo - Restart: docker-compose restart
echo.
pause
exit /b 0

