# PHP Docker App

Simple PHP app with MySQL connection.

## Run Steps

1. Build Image:
docker build -t php-app .

2. Run Container:
docker run -d -p 8080:80 php-app

## Access
http://localhost:8080