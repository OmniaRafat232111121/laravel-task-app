# 🚀 PHP Laravel Project Setup Guide

## 📋 **Requirements to Run Laravel Project**

### **1. PHP (Required)**
- **Version**: PHP 8.1 or higher
- **Extensions**: OpenSSL, PDO, Mbstring, Tokenizer, XML, Ctype, JSON, BCMath

### **2. Composer (Required)**
- **Purpose**: PHP dependency manager
- **Version**: Latest stable

### **3. Node.js & npm (Required for Vite)**
- **Purpose**: JavaScript runtime and package manager
- **Version**: Node.js 16+ and npm 8+

---

## 🛠️ **Installation Steps**

### **Step 1: Install PHP**

#### **Option A: XAMPP (Recommended - Easiest)**
1. Download XAMPP from: https://www.apachefriends.org/download.html
2. Install XAMPP (includes PHP, Apache, MySQL)
3. Add PHP to PATH:
   - Open System Properties → Environment Variables
   - Add to PATH: `C:\xampp\php`
   - Restart Command Prompt

#### **Option B: Manual PHP Installation**
1. Download PHP from: https://windows.php.net/download/
2. Extract to `C:\php`
3. Add to PATH: `C:\php`
4. Copy `php.ini-development` to `php.ini`
5. Enable extensions in `php.ini`:
   ```
   extension=fileinfo
   extension=openssl
   extension=pdo_mysql
   extension=mbstring
   ```

### **Step 2: Install Composer**

#### **Option A: Composer-Setup.exe (Recommended)**
1. Download from: https://getcomposer.org/download/
2. Run `Composer-Setup.exe`
3. Follow installation wizard
4. Restart Command Prompt

#### **Option B: Manual Installation**
1. Download `composer.phar` from: https://getcomposer.org/composer.phar
2. Create `composer.bat` in `C:\php`:
   ```batch
   @echo off
   php "%~dp0composer.phar" %*
   ```
3. Add `C:\php` to PATH

### **Step 3: Install Node.js**
1. Download from: https://nodejs.org/
2. Install Node.js (includes npm)
3. Verify installation:
   ```bash
   node --version
   npm --version
   ```

---

## 🚀 **Running Your Laravel Project**

### **Step 1: Install Dependencies**
```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### **Step 2: Environment Setup**
```bash
# Copy environment file
copy .env.example .env

# Generate application key
php artisan key:generate
```

### **Step 3: Build Assets**
```bash
# Build CSS and JavaScript
npm run build
```

### **Step 4: Start Development Server**
```bash
# Start Laravel server
php artisan serve
```

### **Step 5: Access Application**
- Open browser: http://localhost:8000
- Home page: http://localhost:8000/home
- Users page: http://localhost:8000/users

---

## 🔧 **Troubleshooting**

### **PHP Not Found**
```bash
# Check if PHP is in PATH
php --version

# If not found, add to PATH manually
setx PATH "%PATH%;C:\php" /M
```

### **Composer Not Found**
```bash
# Check if Composer is in PATH
composer --version

# If not found, use full path
C:\php\composer.bat --version
```

### **OpenSSL Extension Error**
1. Open `C:\php\php.ini`
2. Uncomment these lines:
   ```
   extension=fileinfo
   extension=openssl
   ```
3. Restart server

### **Permission Issues**
- Run Command Prompt as Administrator
- Or use full paths to executables

---

## 🎯 **Quick Start Commands**

```bash
# 1. Install dependencies
composer install
npm install

# 2. Setup environment
copy .env.example .env
php artisan key:generate

# 3. Build assets
npm run build

# 4. Start server
php artisan serve
```

---

## 📱 **Alternative: Use Demo HTML**

If you want to test the frontend immediately without PHP setup:

```bash
# Open demo.html in browser
start demo.html
```

This gives you a fully functional demo of all features without requiring PHP/Composer installation.

---

## ✅ **Verification Checklist**

- [ ] PHP 8.1+ installed and in PATH
- [ ] Composer installed and in PATH  
- [ ] Node.js and npm installed
- [ ] Laravel dependencies installed (`composer install`)
- [ ] Node dependencies installed (`npm install`)
- [ ] Environment file configured (`.env`)
- [ ] Assets built (`npm run build`)
- [ ] Server running (`php artisan serve`)

**Your Laravel project will be ready to run! 🚀**
