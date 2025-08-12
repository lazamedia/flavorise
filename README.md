<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# FLAVORISE - Sistem Kasir POS
Sistem Point of Sale (POS) berbasis Laravel untuk mengelola transaksi penjualan, inventori, dan laporan keuangan usaha retail atau restoran.

## Fitur Utama

-  **Sistem POS Real-time** - Interface kasir dengan cart management
-  **Manajemen User** - Role-based access (Admin/Kasir)
-  **Manajemen Shift** - Kontrol shift kerja dengan cash tracking
-  **Laporan Penjualan** - Analytics komprehensif dengan export CSV
-  **Keamanan Canggih** - Rate limiting dan anti brute-force
-  **Multi Payment** - Cash dan QRIS payment method
-  **Inventory Control** - Stock management dengan low stock alerts
-  **Expense Tracking** - Pencatatan pengeluaran operasional

## Tech Stack

- **Backend:** Laravel 10+, PHP 8.1+
- **Database:** MySQL/PostgreSQL
- **Frontend:** Blade Templates, TailwindCSS
- **Authentication:** Laravel built-in Auth with custom security
- **File Storage:** Laravel Storage with public disk

##  Quick Start

### Prerequisites
- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL/PostgreSQL

### Installation

1. **Clone Repository**
   ```bash
   git clone https://github.com/lazamedia/flavorise.git
   cd flavorise
   ```

2. **Install Dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database Configuration**
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=flavorise
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Database Migration & Seeding**
   ```bash
   php artisan migrate --seed
   php artisan storage:link
   ```

6. **Build Assets & Start Server**
   ```bash
   npm init
   npm install
   npm run dev
   php artisan serve
   ```

7. **Access Application**
   - URL: `http://localhost:8000/login`
   - Username: `admin`
   - Password: `password123`

##  Core Modules

###  Authentication System
- **Rate Limiting:** Max 3 attempts per 40 menit
- **Progressive Blocking:** 1 min → 30 min escalation
- **IP-based Throttling:** Per IP + User Agent combination
- **Session Security:** Auto-regeneration on login/logout

###  POS Interface
- **Cart Management:** Frontend-based real-time cart
- **Payment Processing:** Cash dengan change calculation, QRIS digital
- **Price Validation:** Server-side price integrity check
- **Receipt Generation:** Automatic transaction code generation

###  Shift Management
- **Access Control:** User hanya bisa akses shift sendiri (kecuali admin)
- **Cash Tracking:** Opening/closing cash dengan variance calculation
- **Business Rules:** Wajib buka shift untuk akses POS
- **Reports:** X-Report (mid-shift) dan Z-Report (end-shift)

###  Reporting & Analytics
- **Sales Analytics:** Total sales, average ticket, payment breakdown
- **Category Performance:** Sales by product category
- **Top Products:** Best-selling items ranking
- **Time-series Data:** Daily sales trends
- **Export:** CSV export untuk external analysis


##  Security Features

-  **Rate Limiting** - Prevent brute force attacks
-  **Role-based Access** - Admin/Kasir permission system  
-  **Input Validation** - Server-side validation untuk semua endpoints
-  **SQL Injection Prevention** - Eloquent ORM protection
-  **XSS Protection** - Blade template auto-escaping
-  **Session Security** - Regeneration dan proper invalidation

##  Business Logic

### Transaction Flow
```
Login → Buka Shift → POS Interface → Checkout → Print Receipt → Tutup Shift
```

### Payment Methods
- **Cash:** Manual input dengan change calculation
- **QRIS:** Digital payment integration

### Stock Management
- Auto deduction saat transaction
- Stock restoration saat void transaction
- Low stock alerts dan warnings

##  Deployment

### Production Checklist
- [ ] Set `APP_ENV=production`
- [ ] Set `APP_DEBUG=false`
- [ ] Configure SSL certificate
- [ ] Set proper file permissions
- [ ] Configure backup strategy
- [ ] Set up monitoring


## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Author

**Lazuardi Mandegar**

## Acknowledgments

- Laravel Framework
- TailwindCSS
- Font Awesome Icons
- AlpineJS
- Open source community

---

**Jika project ini membantu, berikan star di repository!**