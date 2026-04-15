# 🚀 PHP Application Deployment using Docker, EC2 and AWS RDS

## 📌 Project Overview

This project demonstrates how to:

* Dockerize a PHP application
* Deploy it on AWS EC2
* Connect it with a MySQL database hosted on AWS RDS

---

## 🏗️ Architecture

User → EC2 (Docker Container) → PHP App → AWS RDS (MySQL)

---

## 📁 Project Files

* `index.php` → User form (UI)
* `submit.php` → Handles form submission
* `db.php` → Database connection
* `Dockerfile` → Container setup

---

## ⚙️ Step 1 — Launch EC2 Instance

* Go to AWS Console → EC2
* Launch instance (Ubuntu)
* Allow ports:

  * 22 (SSH)
  * 80 (HTTP)
  * 3306 (MySQL)

---

## ⚙️ Step 2 — Install Docker

```bash
sudo apt update
sudo apt install docker.io -y
sudo systemctl start docker
sudo systemctl enable docker
```

---

## ⚙️ Step 3 — Clone GitHub Repository

```bash
git clone https://github.com/your-username/php-test.git
cd php-test
```

---

## ⚙️ Step 4 — Create AWS RDS (MySQL)

* Go to AWS RDS
* Create MySQL database
* Enable public access
* Allow port 3306 in security group

---

## ⚙️ Step 5 — Install MySQL Client (Optional)

```bash
sudo apt install mysql-client -y
```

---

## ⚙️ Step 6 — Connect to RDS

```bash
mysql -h YOUR-ENDPOINT -u admin -p
```

---

## ⚙️ Step 7 — Create Database and Table

```sql
CREATE DATABASE mydb;
USE mydb;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100)
);
```

---

## ⚙️ Step 8 — Configure Database Connection

Edit `db.php`:

```php
<?php
$host = "YOUR-RDS-ENDPOINT";
$user = "admin";
$password = "YOUR_PASSWORD";
$database = "mydb";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
```

---

## ⚙️ Step 9 — Build Docker Image

```bash
docker build -t php-app .
```

---

## ⚙️ Step 10 — Run Docker Container

```bash
docker run -d -p 80:80 php-app
```

If port already used:

```bash
docker stop $(docker ps -q)
docker rm $(docker ps -aq)
```

---

## 🌐 Step 11 — Access Application

Open browser:

```
http://YOUR-EC2-PUBLIC-IP
```

---

## 🧪 Step 12 — Test Application

* Enter Name & Email
* Click Submit
* Output: `Data inserted successfully`

---

## ✅ Step 13 — Verify Data in Database

```bash
mysql -h YOUR-ENDPOINT -u admin -p
```

```sql
USE mydb;
SELECT * FROM users;
```

---

## 🎯 Result

* PHP app successfully deployed on EC2 using Docker
* Connected to AWS RDS MySQL
* Data inserted from UI into database

---

## 🎥 Demo Explanation

This project demonstrates end-to-end deployment:

* Infrastructure setup (EC2 + RDS)
* Containerization using Docker
* Application deployment
* Database integration

---

## 📌 Conclusion

This project shows real-world DevOps workflow:

* Cloud infrastructure
* Container-based deployment
* Database integration

---
