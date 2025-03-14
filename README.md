# 🎬 Movie Ticket Booking System

## 📌 Project Overview
The **Movie Ticket Booking System** is a **Laravel 12** web application that allows users to book movie tickets, manage theaters, and handle payments. It includes **Filament v3** for an intuitive admin panel and supports **coupons** for ticket discounts.

---

## ⚙️ Tech Stack
- **Laravel 12** – Backend Framework
- **Filament v3** – Admin Panel
- **MySQL** – Database
- **Spatie Permissions** – Role-based access control
- **Bootstrap/Tailwind** – Frontend Styling
- **Livewire/Alpine.js** – Interactive UI

---

## 📂 Database Design
The database consists of the following tables:

### **1️⃣ Users**
| Column       | Type     | Description        |
|-------------|---------|--------------------|
| id          | BIGINT  | Primary Key        |
| name        | STRING  | User's Name        |
| avatar      | STRING  | User's Image       |
| email       | STRING  | Unique Email       |
| password    | STRING  | Hashed Password    |

### **2️⃣ Theaters**
| Column       | Type     | Description            |
|-------------|---------|------------------------|
| id          | BIGINT  | Primary Key            |
| name        | STRING  | Theater Name           |
| address     | TEXT    | Theater Address        |
| city        | STRING  | Location               |
| manager_id  | BIGINT  | FK -> users (Manager)  |

### **3️⃣ Screens**
| Column       | Type     | Description             |
|-------------|---------|-------------------------|
| id          | BIGINT  | Primary Key             |
| theater_id  | BIGINT  | FK -> theaters          |
| name        | STRING  | Screen Name             |
| capacity    | INT     | Number of Seats         |

### **4️⃣ Movies**
| Column        | Type    | Description               |
|--------------|--------|---------------------------|
| id           | BIGINT | Primary Key               |
| title        | STRING | Movie Title               |
| description  | TEXT   | Movie Synopsis            |
| duration     | INT    | Duration (minutes)        |
| release_date | DATE   | Release Date              |
| poster_url   | STRING | Poster Image URL          |

### **5️⃣ Showtimes**
| Column      | Type    | Description           |
|------------|--------|-----------------------|
| id         | BIGINT | Primary Key           |
| movie_id   | BIGINT | FK -> movies          |
| screen_id  | BIGINT | FK -> screens         |
| start_time | DATETIME | Show Start Time      |
| end_time   | DATETIME | Show End Time        |
| ticket_price | DECIMAL | Ticket Price (NPR) |

### **6️⃣ Seats**
| Column      | Type    | Description         |
|------------|--------|---------------------|
| id         | BIGINT | Primary Key         |
| screen_id  | BIGINT | FK -> screens       |
| row        | STRING | Row Identifier      |
| number     | STRING | Seat Number         |
| seat_type  | ENUM   | (Regular/VIP)       |

### **7️⃣ Bookings**
| Column      | Type    | Description                  |
|------------|--------|------------------------------|
| id         | BIGINT | Primary Key                  |
| user_id    | BIGINT | FK -> users (Booked By)      |
| showtime_id | BIGINT | FK -> showtimes             |
| total_amount | DECIMAL | Total Cost                 |
| discount   | DECIMAL | Discount Applied            |
| coupon_id  | BIGINT | FK -> coupons (Nullable)     |
| status     | ENUM   | (pending/confirmed/cancelled) |

### **8️⃣ Booking Seats**
| Column      | Type    | Description         |
|------------|--------|---------------------|
| id         | BIGINT | Primary Key         |
| booking_id | BIGINT | FK -> bookings      |
| seat_id    | BIGINT | FK -> seats         |

### **9️⃣ Payments**
| Column        | Type    | Description           |
|--------------|--------|-----------------------|
| id           | BIGINT | Primary Key           |
| booking_id   | BIGINT | FK -> bookings        |
| amount       | DECIMAL | Paid Amount          |
| payment_method | STRING | (Esewa/Khalti/COD) |
| transaction_id | STRING | Unique Transaction  |
| status       | ENUM   | (pending/success/failed) |

### **🔟 Coupons**
| Column        | Type    | Description           |
|--------------|--------|-----------------------|
| id           | BIGINT | Primary Key           |
| code         | STRING | Unique Coupon Code   |
| discount_amount | DECIMAL | Fixed Discount    |
| discount_percentage | DECIMAL | Percentage Discount |
| valid_from   | DATETIME | Start Date          |
| valid_until  | DATETIME | Expiry Date         |

---

## 🚀 Installation Guide

### **Step 1: Clone the Repository**
```sh
https://github.com/your-repo/movie-ticket-booking.git
cd movie-ticket-booking
```

### **Step 2: Install Dependencies**
```sh
composer install
npm install
```

### **Step 3: Configure Environment**
```sh
cp .env.example .env
php artisan key:generate
```

### **Step 4: Set Up Database**
Update `.env` with your **MySQL credentials**:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=movie_booking
DB_USERNAME=root
DB_PASSWORD=
```
Then, migrate tables:
```sh
php artisan migrate --seed
```

### **Step 5: Install Filament & Setup Admin Panel**
```sh
composer require filament/filament
php artisan filament:install
```
Create an Admin User:
```sh
php artisan make:filament-user
```

### **Step 6: Start the Server**
```sh
php artisan serve
```

---

## 🔐 User Roles & Permissions
We use **Spatie Permissions** for role management.
```sh
composer require spatie/laravel-permission
```
### Roles:
- **Admin** → Manage Theaters, Movies, Bookings
- **User** → Book Tickets, View Showtimes
- **Theater Manager** → Add Screens, Manage Showtimes

---

## 🎫 Booking Flow
1️⃣ **User logs in** → Selects Movie & Showtime
2️⃣ **Selects Seats** → Applies Coupon (if any)
3️⃣ **Proceeds to Payment** (Esewa/Khalti)
4️⃣ **Receives Ticket Confirmation** 🎟️

---

## 📜 License
This project is **open-source** under the MIT license.

---

## 🙌 Contributing
Pull requests are welcome! Feel free to open an issue if you find a bug.


