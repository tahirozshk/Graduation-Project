#!/bin/bash

# NEU PMS - Docker Quick Start Script
# This script helps you quickly start the application with Docker

echo "🐳 NEU Project Management System - Docker Setup"
echo "================================================"
echo ""

# Check if Docker is installed
if ! command -v docker &> /dev/null; then
    echo "❌ Docker is not installed. Please install Docker first."
    echo "   Download from: https://www.docker.com/products/docker-desktop/"
    exit 1
fi

# Check if Docker Compose is installed
if ! command -v docker-compose &> /dev/null; then
    echo "❌ Docker Compose is not installed."
    exit 1
fi

echo "✅ Docker is installed"
echo ""

# Check if .env exists
if [ ! -f .env ]; then
    echo "📝 Creating .env file from template..."
    if [ -f .env.docker.example ]; then
        cp .env.docker.example .env
        echo "✅ .env file created from .env.docker.example"
    elif [ -f .env.example ]; then
        cp .env.example .env
        echo "✅ .env file created from .env.example"
    else
        echo "❌ No .env template found (.env.docker.example or .env.example)"
        exit 1
    fi
else
    echo "✅ .env file already exists"
fi

echo ""
echo "🔧 Choose your environment:"
echo "1) Development (with hot reload)"
echo "2) Production (optimized)"
echo ""
read -p "Enter choice (1 or 2): " choice

if [ "$choice" = "1" ]; then
    echo ""
    echo "🚀 Starting Development Environment..."
    echo "   - Laravel: http://localhost:8000"
    echo "   - Vite: http://localhost:5173"
    echo "   - phpMyAdmin: http://localhost:8081"
    echo ""
    
    # Build and start
    docker-compose -f docker-compose.dev.yml up -d --build
    
    echo ""
    echo "⏳ Waiting for services to start..."
    sleep 10
    
    echo ""
    echo "📦 Installing dependencies..."
    docker-compose -f docker-compose.dev.yml exec -T app composer install
    docker-compose -f docker-compose.dev.yml exec -T app npm install
    
    echo ""
    echo "🔑 Generating application key..."
    docker-compose -f docker-compose.dev.yml exec -T app php artisan key:generate --force
    
    echo ""
    echo "🗄️ Setting up database..."
    docker-compose -f docker-compose.dev.yml exec -T app php artisan migrate --force
    docker-compose -f docker-compose.dev.yml exec -T app php artisan db:seed --force
    
    echo ""
    echo "✅ Development environment is ready!"
    echo ""
    echo "📱 Access your application:"
    echo "   - Application: http://localhost:8000"
    echo "   - Database: http://localhost:8081"
    echo ""
    echo "📋 Useful commands:"
    echo "   - View logs: docker-compose -f docker-compose.dev.yml logs -f"
    echo "   - Stop: docker-compose -f docker-compose.dev.yml down"
    echo "   - Restart: docker-compose -f docker-compose.dev.yml restart"
    
elif [ "$choice" = "2" ]; then
    echo ""
    echo "🏭 Starting Production Environment..."
    echo "   - Application: http://localhost:8080"
    echo "   - phpMyAdmin: http://localhost:8081"
    echo ""
    
    # Build and start
    docker-compose up -d --build
    
    echo ""
    echo "⏳ Waiting for services to start..."
    sleep 10
    
    echo ""
    echo "🔑 Generating application key..."
    docker-compose exec -T app php artisan key:generate --force
    
    echo ""
    echo "🗄️ Setting up database..."
    docker-compose exec -T app php artisan migrate --force
    docker-compose exec -T app php artisan db:seed --force
    
    echo ""
    echo "🎯 Optimizing application..."
    docker-compose exec -T app php artisan config:cache
    docker-compose exec -T app php artisan route:cache
    docker-compose exec -T app php artisan view:cache
    
    echo ""
    echo "✅ Production environment is ready!"
    echo ""
    echo "📱 Access your application:"
    echo "   - Application: http://localhost:8080"
    echo "   - Database: http://localhost:8081"
    echo ""
    echo "📋 Useful commands:"
    echo "   - View logs: docker-compose logs -f"
    echo "   - Stop: docker-compose down"
    echo "   - Restart: docker-compose restart"
    
else
    echo "❌ Invalid choice. Exiting."
    exit 1
fi

echo ""
echo "🎉 Setup complete! Happy coding!"

