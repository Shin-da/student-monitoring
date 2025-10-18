@echo off
REM =============================================================================
REM BUILD SETUP SCRIPT FOR WINDOWS
REM Sets up the development environment and builds optimized assets
REM =============================================================================

echo 🚀 Setting up Student Monitoring System Frontend Build...

REM Check if Node.js is installed
where node >nul 2>nul
if %ERRORLEVEL% NEQ 0 (
    echo ❌ Node.js is not installed. Please install Node.js first.
    pause
    exit /b 1
)

REM Check if npm is installed
where npm >nul 2>nul
if %ERRORLEVEL% NEQ 0 (
    echo ❌ npm is not installed. Please install npm first.
    pause
    exit /b 1
)

echo ✅ Node.js and npm are installed

REM Install dependencies
echo 📦 Installing dependencies...
call npm install

if %ERRORLEVEL% NEQ 0 (
    echo ❌ Failed to install dependencies
    pause
    exit /b 1
)

echo ✅ Dependencies installed successfully

REM Create necessary directories
echo 📁 Creating directory structure...
if not exist "src\js\core" mkdir src\js\core
if not exist "src\js\features" mkdir src\js\features
if not exist "src\js\components" mkdir src\js\components
if not exist "src\scss\components" mkdir src\scss\components
if not exist "src\scss\layout" mkdir src\scss\layout
if not exist "src\scss\themes" mkdir src\scss\themes
if not exist "public\assets\images" mkdir public\assets\images

echo ✅ Directory structure created

REM Copy existing JS files to src directory (if they exist)
echo 📋 Organizing existing JavaScript files...

if exist "public\assets\app.js" (
    copy "public\assets\app.js" "src\js\core\app-core.js" >nul
    echo ✅ Copied app.js to src structure
)

if exist "public\assets\component-library.js" (
    copy "public\assets\component-library.js" "src\js\components\component-library.js" >nul
    echo ✅ Copied component-library.js to src structure
)

if exist "public\assets\sidebar-complete.js" (
    copy "public\assets\sidebar-complete.js" "src\js\features\sidebar-system.js" >nul
    echo ✅ Copied sidebar-complete.js to src structure
)

if exist "public\assets\enhanced-forms.js" (
    copy "public\assets\enhanced-forms.js" "src\js\features\enhanced-forms.js" >nul
    echo ✅ Copied enhanced-forms.js to src structure
)

if exist "public\assets\notification-system.js" (
    copy "public\assets\notification-system.js" "src\js\features\notification-system.js" >nul
    echo ✅ Copied notification-system.js to src structure
)

REM Copy existing CSS files to src directory (if they exist)
echo 📋 Organizing existing CSS files...

if exist "public\assets\app.css" (
    copy "public\assets\app.css" "src\scss\base\app-base.scss" >nul
    echo ✅ Copied app.css to src structure
)

if exist "public\assets\component-library.css" (
    copy "public\assets\component-library.css" "src\scss\components\component-library.scss" >nul
    echo ✅ Copied component-library.css to src structure
)

if exist "public\assets\sidebar-complete.css" (
    copy "public\assets\sidebar-complete.css" "src\scss\layout\sidebar.scss" >nul
    echo ✅ Copied sidebar-complete.css to src structure
)

if exist "public\assets\enhanced-forms.css" (
    copy "public\assets\enhanced-forms.css" "src\scss\components\forms.scss" >nul
    echo ✅ Copied enhanced-forms.css to src structure
)

REM Build assets for development
echo 🔨 Building assets for development...
call npm run build:dev

if %ERRORLEVEL% NEQ 0 (
    echo ❌ Failed to build assets
    pause
    exit /b 1
)

echo ✅ Assets built successfully

REM Create .gitignore for build artifacts
echo 📝 Creating .gitignore for build artifacts...
(
echo # Dependencies
echo node_modules/
echo npm-debug.log*
echo yarn-debug.log*
echo yarn-error.log*
echo.
echo # Build outputs
echo public/assets/*.min.js
echo public/assets/*.min.css
echo public/assets/*.map
echo public/assets/manifest.json
echo.
echo # Environment files
echo .env
echo .env.local
echo .env.development.local
echo .env.test.local
echo .env.production.local
echo.
echo # IDE files
echo .vscode/
echo .idea/
echo *.swp
echo *.swo
echo.
echo # OS files
echo .DS_Store
echo Thumbs.db
echo.
echo # Logs
echo logs/
echo *.log
) > .gitignore

echo ✅ .gitignore created

REM Final instructions
echo.
echo 🎉 Setup completed successfully!
echo.
echo Next steps:
echo 1. Run 'npm run build' to build production assets
echo 2. Run 'npm run watch' to watch for changes during development
echo.
echo Available commands:
echo   npm run dev          - Build for development and watch
echo   npm run build        - Build for production
echo   npm run watch        - Watch for changes
echo   npm run clean        - Clean build artifacts
echo   npm run lighthouse   - Run Lighthouse performance audit
echo.
echo Your optimized assets will be generated in public/assets/
echo.
pause
