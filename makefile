install:
	composer update

db-migrate:
	php artisan migrate

db-rollback:
	php artisan migrate:rollback

db-seed:
	php artisan db:seed

run:
	php artisan serve

passport:
	php artisan passport:client --personal