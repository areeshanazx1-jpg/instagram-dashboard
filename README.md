# Instagram Account Management Dashboard

## 📌 Project Overview
A production-grade centralized web dashboard built with Laravel 11 that enables administrators to:
- Connect and manage multiple Instagram accounts
- Monitor authentication and connection states
- Trigger Instagram API operations via Meta Graph API
- Track background task completion logs asynchronously

## 🛠️ Tech Stack
- **Backend:** Laravel 11, PHP 8.2+
- **Database:** MySQL 8.0
- **Queue:** Laravel Queues (Database driver)
- **Frontend:** Blade, Bootstrap 5
- **API:** Meta Graph API (OAuth 2.0)
- **Version Control:** Git/GitHub

## 📅 Project Progress

### Milestone 1: Database Architecture & Core Management UI
**Status:** ✅ Complete

**Completed Features:**
- ✅ Laravel 11 project setup
- ✅ MySQL database configuration
- ✅ `instagram_accounts` migration with encrypted token field
- ✅ `action_logs` migration with foreign key constraints
- ✅ Eloquent models with relationships
- ✅ Automatic token encryption/decryption using Laravel Crypt
- ✅ Seeders with dummy data
- ✅ Admin dashboard with statistics cards
- ✅ Accounts listing with pagination
- ✅ Status toggle (active/inactive)
- ✅ Action logs in dashboard
- ✅ Account delete feature
- ✅ FormRequest validation
- ✅ Add Account form

### Milestone 2: Meta Graph API & OAuth Integration
**Status:** ✅ Complete

**Completed Features:**
- ✅ Meta Developer App setup (`In_Connect`)
- ✅ Instagram Business Login API integration
- ✅ OAuth 2.0 Handshake (redirect + callback)
- ✅ Short-lived to Long-lived token exchange
- ✅ Token encryption using Laravel Crypt
- ✅ "Connect with Instagram" button
- ✅ Instagram account connection with dashboard
- ✅ Token storage in database (encrypted)
- ✅ Token validation subsystem (daily cron check)
- ✅ Ngrok HTTPS tunnel for local development

### Milestone 3: Asynchronous Queue Engine
**Status:** 🔄 In Progress

### Milestone 4: Testing & Code Review
**Status:** ⏳ Scheduled

---

## 🚀 Local Environment Setup

### Prerequisites
- PHP 8.2+
- Composer
- MySQL 8.0+
- Ngrok (for local HTTPS tunnel)

### Installation Steps

1. **Clone the repository**
```bash
git clone https://github.com/areeshanazx1-jpg/instagram-dashboard.git
cd instagram-dashboard
