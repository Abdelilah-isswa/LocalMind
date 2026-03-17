#!/bin/bash
echo "🚀 Starting LocalMind Vue.js Frontend..."
echo "Frontend: http://localhost:3000"
echo "API: http://localhost:8000"
echo ""
cd "$(dirname "$0")"
python3 -m http.server 3000
