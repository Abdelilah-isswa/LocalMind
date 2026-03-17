#!/bin/bash

# LocalMind API Test Script
# This script demonstrates all API endpoints

BASE_URL="http://localhost:8000/api"

echo "========================================="
echo "LocalMind API Test"
echo "========================================="
echo ""

# 1. Get all questions (public)
echo "1. GET /api/questions (Public)"
curl -s -X GET "$BASE_URL/questions" -H "Accept: application/json" | jq '.[0] | {id, title, location}'
echo ""

# 2. Register a new user
echo "2. POST /api/register"
REGISTER_RESPONSE=$(curl -s -X POST "$BASE_URL/register" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{"name":"API Test User","email":"apitest@example.com","password":"password123"}')

TOKEN=$(echo $REGISTER_RESPONSE | jq -r '.token')
echo "Registered user and got token: ${TOKEN:0:20}..."
echo ""

# 3. Create a question (authenticated)
echo "3. POST /api/questions (Authenticated)"
curl -s -X POST "$BASE_URL/questions" \
  -H "Authorization: Bearer $TOKEN" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{"title":"API Test Question","content":"This question was created via API","location":"New York","date":"2024-01-15"}' | jq '{id, title, location}'
echo ""

# 4. Get my questions
echo "4. GET /api/questions/my (Authenticated)"
curl -s -X GET "$BASE_URL/questions/my" \
  -H "Authorization: Bearer $TOKEN" \
  -H "Accept: application/json" | jq 'length'
echo " questions found"
echo ""

# 5. Login
echo "5. POST /api/login"
LOGIN_RESPONSE=$(curl -s -X POST "$BASE_URL/login" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{"email":"apitest@example.com","password":"password123"}')
echo $LOGIN_RESPONSE | jq '{user: .user.name, token: .token[:20]}'
echo ""

# 6. Toggle favorite
echo "6. POST /api/questions/1/favorite (Authenticated)"
curl -s -X POST "$BASE_URL/questions/1/favorite" \
  -H "Authorization: Bearer $TOKEN" \
  -H "Accept: application/json" | jq
echo ""

# 7. Get favorites
echo "7. GET /api/favorites (Authenticated)"
curl -s -X GET "$BASE_URL/favorites" \
  -H "Authorization: Bearer $TOKEN" \
  -H "Accept: application/json" | jq 'length'
echo " favorites found"
echo ""

# 8. Logout
echo "8. POST /api/logout (Authenticated)"
curl -s -X POST "$BASE_URL/logout" \
  -H "Authorization: Bearer $TOKEN" \
  -H "Accept: application/json" | jq
echo ""

echo "========================================="
echo "API Test Complete!"
echo "========================================="
