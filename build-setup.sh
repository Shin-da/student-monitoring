#!/bin/bash

# =============================================================================
# BUILD SETUP SCRIPT
# Sets up the development environment and builds optimized assets
# =============================================================================

echo "🚀 Setting up Student Monitoring System Frontend Build..."

# Check if Node.js is installed
if ! command -v node &> /dev/null; then
    echo "❌ Node.js is not installed. Please install Node.js first."
    exit 1
fi

# Check if npm is installed
if ! command -v npm &> /dev/null; then
    echo "❌ npm is not installed. Please install npm first."
    exit 1
fi

echo "✅ Node.js and npm are installed"

# Install dependencies
echo "📦 Installing dependencies..."
npm install

if [ $? -ne 0 ]; then
    echo "❌ Failed to install dependencies"
    exit 1
fi

echo "✅ Dependencies installed successfully"

# Create necessary directories
echo "📁 Creating directory structure..."
mkdir -p src/js/core
mkdir -p src/js/features
mkdir -p src/js/components
mkdir -p src/scss/components
mkdir -p src/scss/layout
mkdir -p src/scss/themes
mkdir -p public/assets/images

echo "✅ Directory structure created"

# Copy existing JS files to src directory (if they exist)
echo "📋 Organizing existing JavaScript files..."

if [ -f "public/assets/app.js" ]; then
    cp public/assets/app.js src/js/core/app-core.js
    echo "✅ Copied app.js to src structure"
fi

if [ -f "public/assets/component-library.js" ]; then
    cp public/assets/component-library.js src/js/components/component-library.js
    echo "✅ Copied component-library.js to src structure"
fi

if [ -f "public/assets/sidebar-complete.js" ]; then
    cp public/assets/sidebar-complete.js src/js/features/sidebar-system.js
    echo "✅ Copied sidebar-complete.js to src structure"
fi

if [ -f "public/assets/enhanced-forms.js" ]; then
    cp public/assets/enhanced-forms.js src/js/features/enhanced-forms.js
    echo "✅ Copied enhanced-forms.js to src structure"
fi

if [ -f "public/assets/notification-system.js" ]; then
    cp public/assets/notification-system.js src/js/features/notification-system.js
    echo "✅ Copied notification-system.js to src structure"
fi

# Copy existing CSS files to src directory (if they exist)
echo "📋 Organizing existing CSS files..."

if [ -f "public/assets/app.css" ]; then
    cp public/assets/app.css src/scss/base/app-base.scss
    echo "✅ Copied app.css to src structure"
fi

if [ -f "public/assets/component-library.css" ]; then
    cp public/assets/component-library.css src/scss/components/component-library.scss
    echo "✅ Copied component-library.css to src structure"
fi

if [ -f "public/assets/sidebar-complete.css" ]; then
    cp public/assets/sidebar-complete.css src/scss/layout/sidebar.scss
    echo "✅ Copied sidebar-complete.css to src structure"
fi

if [ -f "public/assets/enhanced-forms.css" ]; then
    cp public/assets/enhanced-forms.css src/scss/components/forms.scss
    echo "✅ Copied enhanced-forms.css to src structure"
fi

# Build assets for development
echo "🔨 Building assets for development..."
npm run build:dev

if [ $? -ne 0 ]; then
    echo "❌ Failed to build assets"
    exit 1
fi

echo "✅ Assets built successfully"

# Create .gitignore for build artifacts
echo "📝 Creating .gitignore for build artifacts..."
cat > .gitignore << EOF
# Dependencies
node_modules/
npm-debug.log*
yarn-debug.log*
yarn-error.log*

# Build outputs
public/assets/*.min.js
public/assets/*.min.css
public/assets/*.map
public/assets/manifest.json

# Environment files
.env
.env.local
.env.development.local
.env.test.local
.env.production.local

# IDE files
.vscode/
.idea/
*.swp
*.swo

# OS files
.DS_Store
Thumbs.db

# Logs
logs/
*.log
EOF

echo "✅ .gitignore created"

# Create development server script
echo "📝 Creating development server script..."
cat > dev-server.sh << 'EOF'
#!/bin/bash

echo "🚀 Starting development server..."

# Watch for changes and rebuild
npm run watch &

# Start PHP development server (if available)
if command -v php &> /dev/null; then
    echo "🌐 Starting PHP development server on http://localhost:8000"
    php -S localhost:8000 -t public/
else
    echo "⚠️  PHP not found. Please start your web server manually."
fi

echo "✅ Development server started. Press Ctrl+C to stop."
wait
EOF

chmod +x dev-server.sh

echo "✅ Development server script created"

# Final instructions
echo ""
echo "🎉 Setup completed successfully!"
echo ""
echo "Next steps:"
echo "1. Run 'npm run build' to build production assets"
echo "2. Run './dev-server.sh' to start development server"
echo "3. Run 'npm run watch' to watch for changes during development"
echo ""
echo "Available commands:"
echo "  npm run dev          - Build for development and watch"
echo "  npm run build        - Build for production"
echo "  npm run watch        - Watch for changes"
echo "  npm run clean        - Clean build artifacts"
echo "  npm run lighthouse   - Run Lighthouse performance audit"
echo ""
echo "Your optimized assets will be generated in public/assets/"
