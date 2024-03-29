Project deployment:
1. Git clone it to a folder:
 git init
 git remote add origin https://github.com/Scrat1980/Payment-api-2
 git pull origin master
2. Run composer update:
 composer update
3. Release port 3306:
 copy pid from the result of execution of command
 sudo lsof -i :3306
 sudo kill <pid>
4. Build containers and start them:
 docker compose up --build -d
5. Create db, tables and fill them with data:
 php bin/console doctrine:migrations:migrate --em=customer

The project is set to receive calls to
localhost:8080/calculate-price and
localhost:8080/purchase

Curl query examples:

price calculation:

curl --request POST \
--url 'http://127.0.0.1:80/calculate-price' \
--header 'Content-Type: application/json' \
--data '{
"product": 1,
"taxNumber": "DE123456789",
"couponCode": "PERCENT-20"
}'

curl --request POST \
--url 'http://127.0.0.1:80/calculate-price' \
--header 'Content-Type: application/json' \
--data '{
"product": 10,
"taxNumber": "DE123456789",
"couponCode": "PERCENT-20"
}'

curl --request POST \
--url 'http://127.0.0.1:80/calculate-price' \
--header 'Content-Type: application/json' \
--data '{
"product": 1,
"taxNumber": "DE12345678",
"couponCode": "PERCENT-20"
}'

curl --request POST \
--url 'http://127.0.0.1:80/calculate-price' \
--header 'Content-Type: application/json' \
--data '{
"product": 1,
"taxNumber": "DE12345678",
"couponCode": "PERCENT-2"
}'

curl --request POST \
--url 'http://127.0.0.1:80/calculate-price' \
--header 'Content-Type: application/json' \
--data '{
"product": 1,
"taxNumber": "DE123456789",
"couponCode": ""
}'



purchase:

curl --request POST \
--url 'http://127.0.0.1:80/purchase' \
--header 'Content-Type: application/json' \
--data '{
"product": 2,
"taxNumber": "DE123456789",
"couponCode": "PERCENT-20",
"paymentProcessor": "paypal"
}'

curl --request POST \
--url 'http://127.0.0.1:80/purchase' \
--header 'Content-Type: application/json' \
--data '{
"product": 2,
"taxNumber": "DE123456789",
"couponCode": "PERCENT-20",
"paymentProcessor": "paypal",
"someGarbageKey": "DROP TABLE PRODUCT;"
}'

curl --request POST \
--url 'http://127.0.0.1:80/purchase' \
--header 'Content-Type: application/json' \
--data '{
"product": 20,
"taxNumber": "DE123456789",
"couponCode": "PERCENT-20",
"paymentProcessor": "paypal"
}'

curl --request POST \
--url 'http://127.0.0.1:80/purchase' \
--header 'Content-Type: application/json' \
--data '{
"product": 3,
"taxNumber": "DE123456789",
"couponCode": "FIX-20",
"paymentProcessor": "paypal"
}'

curl --request POST \
--url 'http://127.0.0.1:80/purchase' \
--header 'Content-Type: application/json' \
--data '{
"product": 3,
"taxNumber": "DE123456789",
"couponCode": "FI",
"paymentProcessor": "paypal"
}'

curl --request POST \
--url 'http://127.0.0.1:80/purchase' \
--header 'Content-Type: application/json' \
--data '{
"product": 3,
"taxNumber": "DE123456789",
"couponCode": "",
"paymentProcessor": "stripe"
}'
