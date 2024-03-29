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
