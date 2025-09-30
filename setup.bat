@echo off
echo 🚀 Setting up Laravel Task App...

REM Check if composer is installed
composer --version >nul 2>&1
if errorlevel 1 (
    echo ❌ Composer is not installed. Please install Composer first.
    pause
    exit /b 1
)

REM Check if node is installed
node --version >nul 2>&1
if errorlevel 1 (
    echo ❌ Node.js is not installed. Please install Node.js first.
    pause
    exit /b 1
)

REM Check if npm is installed
npm --version >nul 2>&1
if errorlevel 1 (
    echo ❌ npm is not installed. Please install npm first.
    pause
    exit /b 1
)

echo ✅ Prerequisites check passed!

REM Install PHP dependencies
echo 📦 Installing PHP dependencies...
composer install

REM Install Node.js dependencies
echo 📦 Installing Node.js dependencies...
npm install

REM Create .env file if it doesn't exist
if not exist .env (
    echo 📝 Creating .env file...
    copy .env.example .env
    echo ✅ .env file created!
) else (
    echo ✅ .env file already exists!
)

REM Generate application key
echo 🔑 Generating application key...
php artisan key:generate

REM Build assets
echo 🏗️  Building assets...
npm run build

REM Create storage directories
echo 📁 Creating storage directories...
if not exist storage\framework\cache mkdir storage\framework\cache
if not exist storage\framework\sessions mkdir storage\framework\sessions
if not exist storage\framework\views mkdir storage\framework\views
if not exist storage\logs mkdir storage\logs
if not exist storage\app\public mkdir storage\app\public

echo.
echo 🎉 Setup complete!
echo.
echo To start the development server:
echo   php artisan serve
echo.
echo To start Vite for development:
echo   npm run dev
echo.
echo Visit http://localhost:8000 to see your application!
pause
