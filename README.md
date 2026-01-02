# 👕 T-Shirt Store (Laravel E-Commerce)



A Laravel-based T-Shirt Store web application with dynamic product listing, cart functionality, and admin management.

## 🚀 Live Demo

Coming Soon


## tshirt_store/
```
├── app/
│   ├── Http/
│   │   └── Controllers/        # Controllers
│   └── Models/                # Database models
│
├── bootstrap/                 # Framework bootstrap
├── config/                    # Configuration files
│
├── database/
│   ├── migrations/            # Database tables
│   └── seeders/               # Sample data
│
├── public/
│   ├── css/                   # Compiled CSS
│   ├── js/                    # Compiled JS
│   ├── images/                # Images
│   └── index.php              # Entry point
│
├── resources/
│   ├── views/                 # Blade templates
│   ├── css/                   # Source CSS
│   └── js/                    # Source JS
│
├── routes/
│   ├── web.php                # Web routes
│   └── api.php                # API routes
│
├── storage/                   # Logs & uploads
├── tests/                     # Tests
├── vendor/                    # Composer dependencies
│
├── .env.example               # Environment template
├── artisan                    # Laravel CLI
├── composer.json              # PHP dependencies
├── package.json               # Node dependencies
├── vite.config.js             # Vite config
└── README.md                  # Project documentation
```
## ⚙️ Installation

1️⃣ Clone Repository
git clone https://github.com/Satya02804/tshirt_store.git \
cd tshirt-store

2️⃣ Install Dependencies \
composer install \
npm install 

3️⃣ Environment Setup \
cp .env.example .env \
php artisan key:generate 

Update .env with your database credentials.  

4️⃣ Run Database 

php artisan migrate \
php artisan db:seed   # Optional

5️⃣ Run Project \
php artisan serve 

npm run dev

Visit 👉 http://127.0.0.1:8000

## ✨ Features

🛍 Product listing

🧾 Add to cart

👕 Size selection

🛠 Admin dashboard

⚡ AJAX product loading

📱 Responsive UI

## 🧪 Tech Stack
```
| Layer           | Technology            |
| --------------- | --------------------- |
| Backend         | Laravel, PHP          |
| Frontend        | HTML, CSS, JavaScript |
| Database        | MySQL                 |
| Build Tool      | Vite                  |
| Package Manager | Composer, NPM         |

```
## 📌 Future Improvements

Payment gateway integration

User authentication

Order history

Product reviews

## 🤝 Contributing

Contributions are welcome!

Fork the repo

Create a new branch

Commit your changes

Open a Pull Request

## 📄 License

This project is licensed under the MIT License.

## 👨‍💻 Author

Patel Satya

📧 Email: patelsatya2804@gmail.com

🔗 GitHub: https://github.com/Satya02804

## ⭐ If you like this project, don’t forget to give it a star!
