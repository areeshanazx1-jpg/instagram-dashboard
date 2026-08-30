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
**Status:** 🔄 In Progress

#### Completed (30-Aug-2026):
- ✅ Created Laravel 11 project
- ✅ Configured MySQL database
- ✅ Created `instagram_accounts` migration with encrypted token field
- ✅ Created `action_logs` migration with foreign key constraints
- ✅ Created Eloquent models with relationships
- ✅ Implemented automatic token encryption/decryption using Laravel Crypt
- ✅ Created seeders for dummy data
- ✅ Migrations and seeders executed successfully
- ✅ Admin dashboard with statistics cards
- ✅ Accounts listing with pagination
- ✅ Status toggle functionality

#### Pending (Days 3-4):
- ⬜ Action logs in dashboard
- ⬜ Account delete feature
- ⬜ FormRequest validation
- ⬜ Service-Repository pattern with interfaces

### Milestone 2: Meta Graph API & OAuth Integration
**Status:** ⏳ Scheduled (Days 5-9)

### Milestone 3: Asynchronous Queue Engine
**Status:** ⏳ Scheduled (Days 10-13)

### Milestone 4: Testing & Code Review
**Status:** ⏳ Scheduled (Days 14-15)

---

## 🚀 Local Environment Setup

### Prerequisites
- PHP 8.2+
- Composer
- MySQL 8.0+

### Installation Steps

1. **Clone the repository**
```bash
git clone https://github.com/YOUR_USERNAME/instagram-dashboard.git
cd instagram-dashboard