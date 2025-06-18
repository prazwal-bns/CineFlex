# 🎬 CineFlex - Movie Ticket Booking System

## 📌 Project Overview
**CineFlex** is a modern **Laravel 12** web application that provides an intuitive movie ticket booking experience. It features a sleek admin panel built with **Filament v3**, real-time seat selection, and seamless payment integration.

---

## ⚙️ Tech Stack
- **Laravel 12** – Backend Framework
- **Filament v3** – Admin Panel
- **MySQL** – Database
- **Tailwind CSS** – Frontend Styling
- **Livewire/Alpine.js** – Interactive UI
- **Heroicons** – Icon System

---

## 📂 Database Design
The database consists of the following tables:

### **1️⃣ Users**
| Column       | Type     | Description        |
|-------------|---------|--------------------|
| id          | BIGINT  | Primary Key        |
| name        | STRING  | User's Name        |
| email       | STRING  | Unique Email       |
| password    | STRING  | Hashed Password    |

### **2️⃣ Movies**
| Column        | Type    | Description               |
|--------------|--------|---------------------------|
| id           | BIGINT | Primary Key               |
| title        | STRING | Movie Title               |
| description  | TEXT   | Movie Synopsis            |
| duration     | INT    | Duration (minutes)        |
| genre        | JSON   | Movie Genres              |
| language     | STRING | Movie Language            |
| country      | STRING | Country of Origin         |
| rating       | DECIMAL| Movie Rating (0-10)       |
| poster_url   | STRING | Poster Image URL          |

### **3️⃣ Screens**
| Column       | Type     | Description             |
|-------------|---------|-------------------------|
| id          | BIGINT  | Primary Key             |
| name        | STRING  | Screen Name             |
| capacity    | INT     | Number of Seats         |

### **4️⃣ Seats**
| Column      | Type    | Description         |
|------------|--------|---------------------|
| id         | BIGINT | Primary Key         |
| screen_id  | BIGINT | FK -> screens       |
| row        | STRING | Row Identifier      |
| number     | STRING | Seat Number         |

### **5️⃣ Showtimes**
| Column      | Type    | Description           |
|------------|--------|-----------------------|
| id         | BIGINT | Primary Key           |
| movie_id   | BIGINT | FK -> movies          |
| screen_id  | BIGINT | FK -> screens         |
| start_time | DATETIME | Show Start Time      |
| ticket_price | DECIMAL | Price per Seat      |

### **6️⃣ Bookings**
| Column      | Type    | Description                  |
|------------|--------|------------------------------|
| id         | BIGINT | Primary Key                  |
| user_id    | BIGINT | FK -> users (Booked By)      |
| showtime_id | BIGINT | FK -> showtimes             |
| total_amount | DECIMAL | Total Cost                 |
| status     | ENUM   | (pending/confirmed/cancelled) |

### **7️⃣ Booking Seats**
| Column      | Type    | Description         |
|------------|--------|---------------------|
| id         | BIGINT | Primary Key         |
| booking_id | BIGINT | FK -> bookings      |
| seat_id    | BIGINT | FK -> seats         |

### **8️⃣ Payments**
| Column        | Type    | Description           |
|--------------|--------|-----------------------|
| id           | BIGINT | Primary Key           |
| booking_id   | BIGINT | FK -> bookings        |
| amount       | DECIMAL | Paid Amount          |
| payment_method | STRING | Payment Gateway      |
| status       | ENUM   | (pending/success/failed) |

---

## 🚀 Installation Guide

### **Step 1: Clone the Repository**
```sh
git clone https://github.com/prazwal-bns/CineFlex.git
cd cineflex
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
DB_DATABASE=cineflex
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
npm run dev
```

---

## 🎫 Booking Flow
1️⃣ **Browse Movies**
   - Search by title or genre
   - View movie details and showtimes

2️⃣ **Select Showtime**
   - Choose preferred date and time
   - View available seats

3️⃣ **Seat Selection**
   - Interactive seat layout
   - Real-time seat availability
   - Clear seat status indicators

4️⃣ **Payment Process**
   - Review booking summary
   - Select payment method
   - Complete transaction

5️⃣ **Confirmation**
   - Receive booking confirmation
   - View ticket details

---

## 🎨 Features
- **Responsive Design**: Mobile-friendly interface
- **Real-time Updates**: Live seat availability
- **Intuitive Navigation**: Easy booking process
- **Modern UI**: Clean and user-friendly interface
- **Admin Dashboard**: Comprehensive management tools

---

## 📜 License
This project is **open-source** under the MIT license.

---

## 🙌 Contributing
Pull requests are welcome! Feel free to open an issue if you find a bug.


