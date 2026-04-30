# Healtisin AI

Healtisin AI is a comprehensive **AI-powered health consultation platform** built with Laravel 11. It provides users with intelligent health-related Q&A through an integrated chatbot, supports bilingual interactions (Indonesian and English), offers subscription-based premium access via Midtrans payment gateway, and includes a full-featured admin dashboard for content and system management.

---

## Table of Contents

- [Overview](#overview)
- [Features](#features)
- [Technology Stack](#technology-stack)
- [System Architecture](#system-architecture)
- [Installation](#installation)
- [Configuration](#configuration)
- [Database Schema](#database-schema)
- [API Integrations](#api-integrations)
- [Authentication](#authentication)
- [Admin Panel](#admin-panel)
- [Payment System](#payment-system)
- [AI Chatbot System](#ai-chatbot-system)
- [Translation System](#translation-system)
- [Logging System](#logging-system)
- [Directory Structure](#directory-structure)
- [Development Commands](#development-commands)
- [Security](#security)
- [License](#license)

---

## Overview

Healtisin AI serves as a digital health assistant where users can:

- **Consult an AI chatbot** trained with Indonesian medical datasets for accurate, localized health information.
- **Subscribe to premium plans** to unlock extended features and consultation limits.
- **Manage their profile**, including personal details, profile photos, and password settings.
- **Read health news and articles** published by administrators.
- **Access the platform in Indonesian or English** with real-time translation capabilities.
- **Administrators** can manage users, transactions, content, system logs, and AI training parameters through a secure admin panel.

---

## Features

### User-Facing Features
- **AI Health Chatbot** – Context-aware conversations powered by Gemini and DeepSeek APIs, enriched with Indonesian medical datasets.
- **User Authentication** – Registration with OTP verification, login, password reset via OTP, and Google OAuth (Socialite).
- **Profile Management** – Update name, phone number, profile photo, and change password.
- **Subscription & Payments** – Select packages, pay via Midtrans (Snap/Virtual Account/e-wallet), and upload payment proof.
- **Chat History** – Save, view, and delete past AI consultations.
- **Health News** – Browse and read health-related articles.
- **FAQ** – Frequently asked questions with click tracking.
- **Contact Form** – Submit inquiries or feedback to administrators.
- **Bilingual Support** – Full Indonesian and English translation for UI and AI responses.
- **Dark Mode** – Toggle between light and dark themes.

### Admin Panel Features
- **Dashboard** – Overview of users, transactions, messages, and system activity.
- **User Management** – CRUD operations for end-users and admin accounts.
- **Transaction Monitoring** – View and manage payment records.
- **Content Management** – Create, edit, and publish news articles.
- **Site Settings** – Manage site information, metadata, logo, and footer content.
- **System Logs** – Dual logging (database and file) with filtering, segment categorization, and audit trails.
- **AI Training Interface** – Prompt engineering, fine-tuning dataset uploads, and management of keywords/patterns for chatbot behavior.
- **Pricing Configuration** – Dynamic subscription package management.
- **Message Inbox** – Read and manage contact form submissions.

---

## Technology Stack

| Layer | Technology |
|-------|------------|
| **Backend Framework** | PHP 8.2+, Laravel 11 |
| **Frontend Build** | Vite 6.x |
| **CSS Framework** | Tailwind CSS 3.4 with Typography plugin |
| **JavaScript** | Vanilla JS (modular), Perfect Scrollbar |
| **Database** | MySQL (primary) / SQLite (fallback) |
| **Cache & Session** | Database driver |
| **Queue** | Database driver |
| **AI APIs** | Google Gemini API, DeepSeek API |
| **Payment Gateway** | Midtrans |
| **Social Authentication** | Laravel Socialite (Google OAuth) |
| **Translation** | `google-translate-api-browser` (client-side), custom Translation Service |
| **Email** | SMTP (Gmail) |

---

## System Architecture

```
┌─────────────────┐
│   Client Browser│
└────────┬────────┘
         │
    ┌────▼────┐
    │   Nginx / Apache  (Laragon / Production)
    └────┬────┘
         │
    ┌────▼────┐
    │  Laravel 11 App   (PHP 8.2+)
    │  ├── Blade Views
    │  ├── Controllers
    │  ├── Models
    │  └── Services
    └────┬────┘
         │
    ┌────┴────┐
    │         │
┌───▼───┐ ┌───▼────┐ ┌──────────┐ ┌──────────┐
│ MySQL │ │ File   │ │ Gemini   │ │ Midtrans │
│ DB    │ │ Logs   │ │ DeepSeek │ │ Payment  │
└───────┘ └────────┘ └──────────┘ └──────────┘
```

---

## Installation

### Prerequisites
- PHP >= 8.2 with extensions: `mbstring`, `openssl`, `pdo`, `pdo_mysql`, `fileinfo`
- Composer 2.x
- Node.js >= 18 + npm
- MySQL 8.0+ (or SQLite for local development)
- A web server (Apache/Nginx) or Laravel's built-in server

### Step-by-Step Setup

1. **Clone the repository**
   ```bash
   git clone <repository-url> healtisin
   cd healtisin
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure your `.env` file**
   Set database credentials, API keys, mail settings, and payment gateway credentials (see [Configuration](#configuration)).

6. **Run migrations and seeders**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

7. **Build frontend assets**
   ```bash
   npm run build
   # OR for development with hot reload:
   npm run dev
   ```

8. **Start the application**
   ```bash
   php artisan serve
   ```
   Visit `http://localhost:8000`.

---

## Configuration

### Required Environment Variables

| Variable | Description |
|----------|-------------|
| `APP_NAME` | Application name (default: "Healtisin AI") |
| `APP_URL` | Base URL of the application |
| `DB_CONNECTION` | `mysql` or `sqlite` |
| `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` | Database connection details |
| `MAIL_MAILER`, `MAIL_HOST`, `MAIL_PORT`, `MAIL_USERNAME`, `MAIL_PASSWORD` | SMTP configuration for OTP and notifications |
| `GOOGLE_CLIENT_ID`, `GOOGLE_CLIENT_SECRET`, `GOOGLE_REDIRECT_URI` | Google OAuth credentials |
| `GEMINI_API_KEY`, `GEMINI_MODEL` | Google Gemini API key and model name |
| `DEEPSEEK_API_KEY`, `DEEPSEEK_MODEL`, `DEEPSEEK_BASE_URL` | DeepSeek API credentials |
| `MIDTRANS_CLIENT_KEY`, `MIDTRANS_SERVER_KEY`, `MIDTRANS_IS_PRODUCTION` | Midtrans payment gateway credentials |

### Localization
Default locale is Indonesian (`id`). English (`en`) is available as a fallback. Configure via:
```env
APP_LOCALE=id
APP_FALLBACK_LOCALE=en
```

---

## Database Schema

### Core Tables

| Table | Purpose |
|-------|---------|
| `users` | Registered end-users with subscription status |
| `admins` | Administrator accounts for the backend panel |
| `admins` | Administrator accounts |
| `chat_histories` | Stored AI consultation conversations |
| `payments` | Payment records and proof uploads |
| `pricing_configs` | Subscription package definitions |
| `news` | Health articles and blog posts |
| `messages` | Contact form submissions |
| `system_logs` | Structured application logs (database) |
| `file_logs` | File-based log entries |
| `social_accounts` | Linked Google OAuth accounts |
| `otps` / `password_otps` | OTP codes for registration and password reset |
| `meta_data`, `site_settings`, `footers`, `information` | Site-wide content and branding configuration |
| `datasets` | AI training datasets for fine-tuning |
| `jobs`, `cache`, `sessions` | Laravel queue, cache, and session storage |

---

## API Integrations

### Google Gemini API
- **Purpose**: Primary AI response generation for health consultations.
- **Configuration**: `GEMINI_API_KEY`, `GEMINI_MODEL` (default: `gemini-2.0-flash`)
- **Usage**: `ChatController` constructs a system prompt with medical datasets and user context before sending requests.

### DeepSeek API
- **Purpose**: Fallback or secondary AI provider for chatbot responses.
- **Configuration**: `DEEPSEEK_API_KEY`, `DEEPSEEK_MODEL`, `DEEPSEEK_BASE_URL`

### Midtrans Payment Gateway
- **Purpose**: Process subscription payments.
- **Features**: Snap payments, virtual accounts, e-wallets, payment notifications via webhook.
- **Configuration**: `MIDTRANS_CLIENT_KEY`, `MIDTRANS_SERVER_KEY`, `MIDTRANS_IS_PRODUCTION`
- **Endpoints**: Payment notification handler at `/payment/notification`

### Google OAuth (Laravel Socialite)
- **Purpose**: One-click login and registration via Google accounts.
- **Routes**: `/auth/google` (redirect) and `/auth/callback` (callback)

---

## Authentication

Healtisin supports three authentication flows:

### 1. Email & Password with OTP
- Users register with email, username, and password.
- An OTP is sent to the email for verification before the account is activated.
- Login requires email/username and password.

### 2. Google OAuth
- Users can sign in or register using their Google account via Socialite.
- Linked accounts are stored in the `social_accounts` table.

### 3. Password Reset via OTP
- Users request a password reset by email.
- An OTP is sent for verification.
- After OTP validation, users can set a new password.

### Session & Security
- Sessions are stored in the database (`SESSION_DRIVER=database`).
- CSRF protection enabled on all forms.
- Admin routes are protected by `auth:admin` middleware.

---

## Admin Panel

The admin panel is accessible at `/admin/dashboard` (requires admin authentication).

### Admin Modules

| Module | Route Prefix | Description |
|--------|-------------|-------------|
| Dashboard | `/admin/dashboard` | Analytics overview |
| Users | `/admin/users` | Manage registered users |
| Admins | `/admin/admins` | Manage admin accounts |
| Transactions | `/admin/transactions` | Payment history |
| Payments | `/admin/payments` | Payment proof verification |
| Pricing | `/admin/pricing` | Configure subscription packages |
| News | `/admin/news` | CRUD for health articles |
| Messages | `/admin/messages` | Contact form inbox |
| Logs (DB) | `/admin/log-database` | Structured system logs |
| Logs (File) | `/admin/log-file` | Raw file logs |
| AI Training | `/admin/prompt-engineering` | Adjust AI prompts |
| Fine-Tuning | `/admin/fine-tuning` | Upload training datasets |
| Keywords | `/admin/keywords-patterns` | Manage chatbot behavior rules |
| Settings | `/admin/settings` | Profile, password, photo |

---

## Payment System

### Subscription Flow
1. User navigates to `/pricing/pro` to view packages.
2. Selects a package at `/pricing/select-package`.
3. Fills payment details at `/pricing/payment-details`.
4. System processes payment via Midtrans at `/pricing/process-payment`.
5. User sees confirmation at `/pricing/payment-confirmation/{id}`.
6. Admin verifies payment proof if manual upload is used.

### Supported Payment Methods
- Midtrans Snap (credit card, virtual account, e-wallet)
- Manual bank transfer with proof upload

---

## AI Chatbot System

### Architecture
The chatbot is managed by `ChatController` and supported by:
- `MedicalDatasetService` – Provides structured Indonesian medical datasets (tropical diseases, symptoms, risk factors) to enrich AI context.
- `ResponseValidationService` – Validates AI responses for accuracy, safety, and relevance.
- `App\Constants\HealthKeywords`, `Greetings`, `QuestionPatterns` – Categorized constants for intent detection and routing.

### Flow
1. User sends a message via `/chat/send`.
2. System detects intent (greeting, health question, follow-up).
3. Context is enriched with medical datasets and user history.
4. Request is sent to Gemini API (with DeepSeek fallback).
5. Response is validated and streamed/sent back to the user.
6. Conversation is saved to `chat_histories` table.

### Features
- Chat history persistence (create, read, delete)
- Regenerate last AI response
- Edit previous messages
- Real-time streaming UI

---

## Translation System

Healtisin provides bilingual support through a custom translation layer:

- **Backend**: `TranslationService` and `TranslationController` handle API translations between Indonesian and English.
- **Frontend**: `translate.js` provides client-side translation with preserved words and custom correction dictionaries.
- **Routes**:
  - `POST /api/translate/id-to-en`
  - `POST /api/translate/en-to-id`
- **Settings**: `/translation/settings` allows configuring preserved words and manual corrections.

---

## Logging System

Healtisin implements a comprehensive dual logging strategy via `LogHelper`:

### Database Logging (`system_logs` table)
- **Types**: `error`, `warning`, `info`, `audit_success`, `audit_failure`
- **Segments**: `transaction`, `user`, `api`, `view`, `system`
- **Fields**: message, type, segment, user_id, ip_address, user_agent, JSON data

### File Logging
- Laravel's native file logging channel for stack traces and raw errors.

### Helper Methods
```php
LogHelper::error($segment, $message, $data);
LogHelper::warning($segment, $message, $data);
LogHelper::info($segment, $message, $data);
LogHelper::auditSuccess($segment, $message, $data);
LogHelper::auditFailure($segment, $message, $data);
```

Admin panel provides log viewers with filtering by date, type, and segment.

---

## Directory Structure

```
healtisin/
├── app/
│   ├── Constants/           # HealthKeywords, Greetings, QuestionPatterns
│   ├── Exceptions/          # AIServiceException, Handler
│   ├── Helpers/             # LogHelper, TextHelper
│   ├── Http/
│   │   ├── Controllers/     # Web controllers (Auth, Admin, Chat, Payment, etc.)
│   │   └── ...
│   ├── Models/              # Eloquent models (User, Admin, ChatHistory, Payment, etc.)
│   ├── Services/            # MedicalDatasetService, TranslationService, OtpService, ResponseValidationService
│   └── ...
├── bootstrap/
├── config/                  # Laravel configuration
├── database/
│   ├── factories/
│   ├── migrations/          # All table schemas
│   └── seeders/             # AdminSeeder, DatabaseSeeder, InformationSeeder
├── docs/                    # Additional documentation
├── public/                  # Entry point, images, fonts
├── resources/
│   ├── css/                 # Tailwind entry (app.css)
│   ├── js/                  # app.js, bootstrap.js, dark-mode.js, translate.js
│   ├── lang/                # Language definitions
│   └── views/               # Blade templates (auth, admin, components, pages)
├── routes/
│   └── web.php              # All web routes
├── storage/                 # Logs, cache, sessions, uploads
├── tests/                   # Feature and Unit tests
├── .env.example             # Environment template
├── composer.json            # PHP dependencies
├── package.json             # Node dependencies
├── tailwind.config.js       # Tailwind + darkMode class strategy
└── vite.config.js           # Vite build configuration
```

---

## Development Commands

```bash
# Start Laravel dev server + Vite + Queue + Logs (concurrently)
composer run dev

# Or individually:
php artisan serve          # Laravel server
npm run dev                # Vite dev server with HMR
php artisan queue:listen   # Process queued jobs
php artisan pail           # Real-time log tailing

# Build for production
npm run build

# Database
php artisan migrate:fresh --seed   # Reset DB with seeders

# Code formatting
php artisan pint           # Laravel Pint (PHP CS Fixer)

# Testing
php artisan test           # Run PHPUnit tests
```

---

## Security

- **CSRF Protection**: Enabled on all state-changing routes.
- **Password Hashing**: Bcrypt with 12 rounds.
- **OTP Expiry**: Time-limited OTP codes for registration and password reset.
- **Admin Middleware**: `auth:admin` guards all `/admin/*` routes.
- **Signed URLs**: Email verification uses signed URLs.
- **Input Validation**: All controllers validate incoming requests.
- **SQL Injection Prevention**: Eloquent ORM and query parameter binding used throughout.
- **XSS Mitigation**: Blade's automatic escaping (`{{ }}`) applied in views.

---

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

## Support

For issues, questions, or contributions, please contact the development team or open an issue in the repository.
