# Mini-CRM — Laravel 12

Мини-CRM система для сбора заявок с сайта через универсальный виджет и последующей обработки менеджером.

---

## Возможности

- Сбор заявок через iframe-виджет
- Загрузка файлов (Spatie MediaLibrary)
- Автоматическое создание клиента и привязка к заявке
- Админ-панель для менеджеров
- Фильтрация заявок по дате, статусу, телефону, email
- Просмотр деталей заявки + скачивание файлов
- Статистика по заявкам (сутки, неделя, месяц)
- Роли и права (Spatie Permission)
- Ограничение: не более одной заявки в сутки с одного email/телефона
- Полностью REST API + AJAX отправка формы

---

## Стек технологий

- **Laravel 12**, PHP 8.4
- **spatie/laravel-permission** — роли и права
- **spatie/laravel-medialibrary** — хранение файлов
- Blade + AJAX виджет
- Eloquent, Form Requests, Services, Repositories
- PSR-12, SOLID, KISS, DRY

---

## Установка и запуск

### Клонировать репозиторий

```bash
git clone https://github.com/your/repo.git
cd repo
```

### Установить зависимости

composer install

### Установить пакеты Spatie (роли и файлы)

composer require spatie/laravel-permission
composer require spatie/laravel-medialibrary

### Опубликовать файлы пакетов

php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider" --tag="migrations"
php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider" --tag="config"

### Permission (роли и права)

php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"

### Создать .env

cp .env.example .env
Указать параметры подключения к БД.

### Сгенерировать ключ приложения

php artisan key:generate

### Запустить миграции и сидеры

php artisan migrate
php artisan db:seed

### Запустить локальный сервер

php artisan serve

## API

### Создание заявки

POST /api/tickets

### Статистика заявок

GET /api/tickets/statistics

Все ответы оформлены через API Resources.

## Роли и права

После установки сидеров доступны:
admin — полный доступ
manager — управление заявками
Ролевые проверки реализованы через middleware

## Файлы заявок

Используется Spatie MediaLibrary. Все файлы хранятся в коллекции attachments.

## Примечания разработчика

Архитектура соответствует SOLID, KISS, DRY, PSR-12

Контроллеры максимально тонкие (вся логика — в сервисах/репозиториях)

Eloquent scopes используются для статистики

Ограничение на отправку 1 заявки в сутки реализовано на уровне сервиса
