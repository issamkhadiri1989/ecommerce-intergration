stop:
	docker container stop $$(docker container ps -aq)

start-containers:
	docker-compose up -d

start:
	docker-compose up -d --no-recreate --remove-orphans

restart: stop start

reload-apache:
	docker-compose exec server service apache2 reload

build:
	docker-compose build --force-rm

install-vendor:
	docker-compose exec server composer self-update
	docker-compose exec server composer install

install: build start-containers install-vendor

ps:
	docker-compose ps

enter:
	docker-compose exec server bash