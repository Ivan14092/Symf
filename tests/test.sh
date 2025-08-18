#!/bin/bash

BASE_URL="http://127.0.0.1:8000"

echo "=== 1. Тест створення короткого URL ==="
ENCODE_RESPONSE=$(curl -s -X POST $BASE_URL/encode \
     -H "Content-Type: application/json" \
     -d '{"url": "https://symfony.com"}')
echo "Відповідь: $ENCODE_RESPONSE"


CODE=$(echo $ENCODE_RESPONSE | grep -oE '"code":"[^"]+' | cut -d'"' -f4)

if [ -z "$CODE" ]; then
  echo "Помилка: код не збережено"
  exit 1
fi

echo "Код отримано: $CODE"

echo ""
echo "=== 2. Тест декодування URL ==="
curl -s -X GET $BASE_URL/decode/$CODE
echo ""

echo ""
echo "=== 3. Тест на помилковий decode ==="
curl -s -X GET $BASE_URL/decode/notexist
echo ""

echo ""
echo "=== 4. Тест на відсутній параметр URL ==="
curl -s -X POST $BASE_URL/encode -H "Content-Type: application/json" -d '{}'
echo ""