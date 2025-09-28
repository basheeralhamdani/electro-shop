# Electro-Shop: A Modern E-commerce Platform

![Project Screenshot] (https://imgur.com/a/LM5YaOX)

Welcome to **Electro-Shop**, a complete, full-stack e-commerce application built from the ground up using the Laravel framework. This project demonstrates a wide range of modern web development features, including user authentication, product management, a shopping cart, and a complete checkout system.

## ✨ Key Features

### User Features

-   **Modern & Responsive Design:** A clean UI that works beautifully on desktops, tablets, and mobile phones.
-   **Product Browsing & Search:** Users can browse products and use a functional search bar.
-   **Detailed Product Pages:** View product details, images, stock status, and customer reviews.
-   **AJAX Shopping Cart:** Add items to the cart without any page reloads for a seamless experience.
-   **Full Checkout Process:** A multi-step process for users to enter shipping information and place orders.
-   **User Order History:** Logged-in users can view their past orders and check their status.
-   **Product Reviews & Ratings:** Authenticated users who have purchased a product can leave a star rating and a comment.

### Admin Features

-   **Secure Admin Panel:** Accessible only to users with an 'admin' role.
-   **Dashboard with Analytics:** At-a-glance view of total revenue, orders, and customers.
-   **Full CRUD for Products:** Admins can create, read, update, and delete products.
-   **Full CRUD for Categories:** Admins can manage product categories.
-   **Order Management:** View all user orders, see order details, and update the order status (e.g., Pending, Shipped).
-   **Inventory Management:** Product stock is automatically updated after a successful purchase.

## 🛠️ Technologies Used

-   **Backend:** PHP, Laravel 12
-   **Frontend:** HTML5, CSS3 (with CSS Variables & Flexbox/Grid), Vanilla JavaScript (for AJAX & UI)
-   **Database:** MySQL
-   **Authentication:** Laravel Breeze

## 🚀 Getting Started

To get a local copy up and running, follow these simple steps.

### Prerequisites

-   PHP >= 8.2
-   Composer
-   Node.js & NPM
-   A local database server (e.g., XAMPP, Laragon)

### Installation

```bash
# Clone the repository
git clone https://github.com/basheeralhamdani/electro-shop.git
cd electro-shop

# Install PHP dependencies
composer install

# Install NPM dependencies
npm install

# Create your environment file
cp .env.example .env

# Generate an application key
php artisan key:generate

# Configure your .env file with database credentials (DB_DATABASE, DB_USERNAME, DB_PASSWORD)

# Run database migrations and seeders
php artisan migrate --seed

# Build frontend assets
npm run build

# Start the development server
php artisan serve

👤 Author
Basheer Al-Hamdani
GitHub: @basheeralhamdani
```
