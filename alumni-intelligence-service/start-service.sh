#!/bin/bash

# Alumni Intelligence Service Startup Script

echo "🎓 Starting Alumni Intelligence Service..."
echo ""

# Check if Java is installed
if ! command -v java &> /dev/null; then
    echo "❌ Error: Java is not installed"
    echo "Please install Java JDK 17 or higher"
    echo "Download from: https://adoptium.net/"
    exit 1
fi

# Check Java version
JAVA_VERSION=$(java -version 2>&1 | awk -F '"' '/version/ {print $2}' | awk -F '.' '{print $1}')
if [ "$JAVA_VERSION" -lt 17 ]; then
    echo "❌ Error: Java version must be 17 or higher"
    echo "Current version: $(java -version 2>&1 | head -n 1)"
    exit 1
fi

echo "✅ Java version check passed"

# Check if Maven is installed
if ! command -v mvn &> /dev/null; then
    echo "❌ Error: Maven is not installed"
    echo "Please install Apache Maven 3.6+"
    echo "Download from: https://maven.apache.org/download.cgi"
    exit 1
fi

echo "✅ Maven check passed"

# Check if port 8081 is available
if lsof -Pi :8081 -sTCP:LISTEN -t >/dev/null ; then
    echo "⚠️  Warning: Port 8081 is already in use"
    echo "Please stop the existing service or change the port in application.properties"
    exit 1
fi

echo "✅ Port 8081 is available"
echo ""

# Build the project if target directory doesn't exist
if [ ! -d "target" ]; then
    echo "📦 Building project for the first time..."
    mvn clean install
    if [ $? -ne 0 ]; then
        echo "❌ Build failed. Please check the error messages above."
        exit 1
    fi
    echo "✅ Build successful"
    echo ""
fi

# Start the service
echo "🚀 Starting service on port 8081..."
echo "Press Ctrl+C to stop"
echo ""
echo "────────────────────────────────────────────────────────────────"
echo ""

mvn spring-boot:run
