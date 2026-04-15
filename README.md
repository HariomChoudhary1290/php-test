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

Part 2
# 🚀 CI/CD Pipeline using Jenkins, GitHub Webhook & Docker

## 📌 Project Overview

This project demonstrates a complete CI/CD pipeline where:

* Code is pushed to GitHub
* GitHub webhook triggers Jenkins automatically
* Jenkins pulls latest code
* Docker image is built

---

## 🛠️ Jenkins Installation (EC2 - Ubuntu)

### 🔹 Clean old Jenkins config

```bash
sudo rm -f /etc/apt/sources.list.d/jenkins.list
sudo rm -f /usr/share/keyrings/jenkins-keyring.asc
sudo rm -f /usr/share/keyrings/jenkins-keyring.gpg
```

---

### 🔹 Install Java

```bash
sudo apt update
sudo apt install -y fontconfig openjdk-17-jre
java -version
```

---

### 🔹 Add Jenkins GPG Key (2026 Fix)

```bash
sudo mkdir -p /etc/apt/keyrings
sudo wget -O /etc/apt/keyrings/jenkins-keyring.asc \
https://pkg.jenkins.io/debian-stable/jenkins.io-2026.key
```

---

### 🔹 Add Jenkins Repository

```bash
echo "deb [signed-by=/etc/apt/keyrings/jenkins-keyring.asc] \
https://pkg.jenkins.io/debian-stable binary/" | \
sudo tee /etc/apt/sources.list.d/jenkins.list > /dev/null
```

---

### 🔹 Install Jenkins

```bash
sudo apt update
sudo apt install jenkins -y
```

---

### 🔹 Start Jenkins

```bash
sudo systemctl start jenkins
sudo systemctl enable jenkins
sudo systemctl status Jenkins
```

---

### 🔹 Get Admin Password

```bash
sudo cat /var/lib/jenkins/secrets/initialAdminPassword
```

👉 Open in browser:

```
http://<EC2-PUBLIC-IP>:8080
```

---

## ⚙️ Jenkins Setup

* Unlock Jenkins using admin password
* Install suggested plugins
* Create admin user

---

## 🔧 Create Jenkins Pipeline Job

1. Jenkins Dashboard → **New Item**
2. Select **Pipeline**
3. Enter job name

---

### 🧾 Pipeline Script

```groovy
pipeline {
    agent any

    stages {

        stage('Clone Code') {
            steps {
                git branch: 'main', url: 'https://github.com/YOUR_USERNAME/php-test.git'
            }
        }

        stage('Build Docker Image') {
            steps {
                sh 'docker build -t php-app .'
            }
        }

    }
}
```

---

## 🔔 Enable Auto Trigger (Webhook)

### Jenkins:

* Go to **Configure**
* Enable:

```
GitHub hook trigger for GITScm polling
```

---

### GitHub:

Go to:
**Repository → Settings → Webhooks → Add webhook**

Fill details:

* Payload URL:

```
http://<EC2-IP>:8080/github-webhook/
```

* Content Type:

```
application/json
```

* Event:

```
Just the push event
```

---

## 🔁 Git Commands (Trigger Pipeline)

```bash
git add .
git commit -m "trigger test"
git push origin main
```

---

## 🔄 CI/CD Flow

1. Developer pushes code to GitHub
2. GitHub sends webhook request
3. Jenkins receives trigger
4. Jenkins pulls latest code
5. Docker image build starts

---

## ✅ Output Verification

* Jenkins job automatically triggers
* Build stages execute successfully
* Application updates reflect

---

## 💡 Key Interview Points

* Webhook-based automation (no manual build)
* Importance of branch consistency (main/master)
* Jenkins pipeline stages
* Docker integration with CI/CD
* Real-time auto trigger workflow

---

## 🚨 Common Issues & Fixes

| Issue                  | Solution                   |
| ---------------------- | -------------------------- |
| nothing to commit      | File not saved             |
| Jenkins not triggering | Check webhook & trigger    |
| Branch mismatch        | Use same branch everywhere |
| Webhook failed         | Ensure EC2 is public       |

---

## 🎯 Conclusion

Successfully implemented automated CI/CD pipeline using:

* Jenkins
* GitHub Webhooks
* Docker

---

## 🚀 Final Statement (Interview)

**"Whenever I push code to GitHub, Jenkins automatically triggers via webhook, pulls the latest code, and builds the Docker image without any manual intervention."**

