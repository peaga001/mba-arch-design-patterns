#!/bin/bash

echo "📦 Instalando NVM..."
curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.40.3/install.sh | bash

export NVM_DIR="$HOME/.nvm"
[ -s "$NVM_DIR/nvm.sh" ] && \. "$NVM_DIR/nvm.sh"

echo "📦 Instalando Node.js LTS via NVM..."
nvm install --lts
nvm use --lts

echo "📦 Instalando dependências npm..."
npm install

echo
echo "🚀 Husky instalado e configurado com sucesso!"