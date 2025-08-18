# Symfony URL Shortener

## Встановлення

1. Клонувати репозиторій:
   ```bash
   git clone https://github.com/your-username/url-shortener.git
   cd url-shortener
   ```

2. Встановити залежності:
   ```bash
   composer install
   ```

3. Налаштувати файл `.env` (підключення до бази даних).

4. Запустити міграції:
   ```bash
   php bin/console doctrine:migrations:migrate
   ```

5. Запустити сервер:
   ```bash
   symfony serve
   ```
   або
   ```bash
   php -S 0.0.0.0:8000 -t public
   ```

---

## Використання API

### Створити скорочене посилання
```bash
curl -X POST http://127.0.0.1:8000/encode      -H "Content-Type: application/json"      -d '{"url":"https://symfony.com"}'
```

### Отримати оригінальне посилання
```bash
curl http://127.0.0.1:8000/decode/ABC123
```

---

## Використання CLI

Скоротити URL:
```bash
php bin/console app:url-shortener encode https://symfony.com
```

Отримати оригінальний URL:
```bash
php bin/console app:url-shortener decode ABC123
```

---

## Вимоги
- PHP >= 8.1
- Composer
- Symfony CLI (опціонально)
- MySQL/PostgreSQL (або інша сумісна БД)

