build:
	docker-compose up -d --build
	docker exec php-container composer install

bash:
	docker exec -it php-container  bash

test:
	docker exec php-container php bin/phpunit

down:
	docker-compose down

log:
	docker logs -f --details php-container
