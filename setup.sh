#!/bin/bash

echo "🚀 Setting up Laravel Task App..."

# Check if composer is installed
if ! command -v composer &> /dev/null; then
    echo "❌ Composer is not installed. Please install Composer first."
    exit 1
fi

# Check if node is installed
if ! command -v node &> /dev/null; then
    echo "❌ Node.js is not installed. Please install Node.js first."
    exit 1
fi

# Check if npm is installed
if ! command -v npm &> /dev/null; then
    echo "❌ npm is not installed. Please install npm first."
    exit 1
fi

echo "✅ Prerequisites check passed!"

# Install PHP dependencies
echo "📦 Installing PHP dependencies..."
composer install

# Install Node.js dependencies
echo "📦 Installing Node.js dependencies..."
npm install

# Create .env file if it doesn't exist
if [ ! -f .env ]; then
    echo "📝 Creating .env file..."
    cp .env.example .env
    echo "✅ .env file created!"
else
    echo "✅ .env file already exists!"
fi

# Generate application key
echo "🔑 Generating application key..."
php artisan key:generate

# Build assets
echo "🏗️  Building assets..."
npm run build

# Create storage directories
echo "📁 Creating storage directories..."
mkdir -p storage/framework/cache
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/logs
mkdir -p storage/app/public

# Set permissions (Unix-like systems only)
if [[ "$OSTYPE" != "msys" && "$OSTYPE" != "win32" ]]; then
    echo "🔐 Setting storage permissions..."
    chmod -R 775 storage
    chmod -R 775 bootstrap/cache
fi

echo ""
echo "🎉 Setup complete!"
echo ""
echo "To start the development server:"
echo "  php artisan serve"
echo ""
echo "To start Vite for development:"
echo "  npm run dev"
echo ""
echo "Visit http://localhost:8000 to see your application!"
