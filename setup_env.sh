#!/bin/bash

echo "=========================================="
echo "   Shivhare Bangle Store - Local Setup"
echo "=========================================="

# 1. Check for Homebrew
if ! command -v brew &> /dev/null; then
    echo "[INFO] Homebrew not found. Installing now..."
    echo "[NOTE] You may be asked for your system password."
    /bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"
    
    # Configure PATH for Apple Silicon vs Intel
    if [[ $(uname -m) == 'arm64' ]]; then
        echo 'eval "$(/opt/homebrew/bin/brew shellenv)"' >> ~/.zprofile
        eval "$(/opt/homebrew/bin/brew shellenv)"
    else
        echo 'eval "$(/usr/local/bin/brew shellenv)"' >> ~/.zprofile
        eval "$(/usr/local/bin/brew shellenv)"
    fi
else
    echo "[OK] Homebrew is already installed."
fi

# 2. Install PHP
echo "[INFO] Installing PHP..."
brew install php

# 3. Check Installation
if command -v php &> /dev/null; then
    PHP_VERSION=$(php -v | head -n 1 | cut -d " " -f 2)
    echo "[SUCCESS] PHP $PHP_VERSION installed successfully!"
    echo "You can now run the website using: php -S localhost:8000"
else
    echo "[ERROR] PHP installation failed. Please check the logs."
fi
