@echo off
echo ========================================
echo    Laravel Project Setup Script
echo ========================================
echo.

echo Checking PHP installation...
php --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ❌ PHP not found!
    echo.
    echo Please install PHP first:
    echo 1. Download XAMPP from: https://www.apachefriends.org/download.html
    echo 2. Or download PHP from: https://windows.php.net/download/
    echo 3. Add PHP to your PATH environment variable
    echo.
    pause
    exit /b 1
) else (
    echo ✅ PHP found!
)

echo.
echo Checking Composer installation...
composer --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ❌ Composer not found!
    echo.
    echo Please install Composer:
    echo 1. Download from: https://getcomposer.org/download/
    echo 2. Run Composer-Setup.exe
    echo 3. Restart Command Prompt
    echo.
    pause
    exit /b 1
) else (
    echo ✅ Composer found!
)

echo.
echo Checking Node.js installation...
node --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ❌ Node.js not found!
    echo.
    echo Please install Node.js:
    echo 1. Download from: https://nodejs.org/
    echo 2. Install Node.js (includes npm)
    echo.
    pause
    exit /b 1
) else (
    echo ✅ Node.js found!
)

echo.
echo ========================================
echo    Installing Dependencies
echo ========================================

echo Installing PHP dependencies...
composer install
if %errorlevel% neq 0 (
    echo ❌ Failed to install PHP dependencies
    pause
    exit /b 1
)
echo ✅ PHP dependencies installed!

echo.
echo Installing Node.js dependencies...
npm install
if %errorlevel% neq 0 (
    echo ❌ Failed to install Node.js dependencies
    pause
    exit /b 1
)
echo ✅ Node.js dependencies installed!

echo.
echo ========================================
echo    Setting Up Environment
echo ========================================

if not exist .env (
    echo Creating .env file...
    copy .env.example .env
    echo ✅ .env file created!
) else (
    echo ✅ .env file already exists!
)

echo.
echo Generating application key...
php artisan key:generate
if %errorlevel% neq 0 (
    echo ❌ Failed to generate application key
    pause
    exit /b 1
)
echo ✅ Application key generated!

echo.
echo ========================================
echo    Building Assets
echo ========================================

echo Building CSS and JavaScript...
npm run build
if %errorlevel% neq 0 (
    echo ❌ Failed to build assets
    pause
    exit /b 1
)
echo ✅ Assets built successfully!

echo.
echo ========================================
echo    🚀 Setup Complete!
echo ========================================
echo.
echo Your Laravel project is ready to run!
echo.
echo To start the development server:
echo   php artisan serve
echo.
echo Then open: http://localhost:8000
echo.
echo Or use the demo HTML file:
echo   start demo.html
echo.
pause
