up:
	@docker-compose up -d --build --remove-orphans

install: dotenv-config up composer-install app-init

down:
	@docker-compose down

down-v:
	@docker-compose down -v

stop:
	@docker-compose stop

restart:
	@docker-compose restart

env:
	@docker-compose exec --user=www-data php bash

env-root:
	@docker-compose exec php bash

dotenv-config:
	@test -f .env || cp .env-dist .env

composer-install:
	@docker-compose exec php bash composer install

composer-update:
	@docker-compose exec php bash composer update

composer-update-lock:
	@docker-compose exec php bash composer update --lock

migrate-main:
	@docker-compose exec --user=www-data php ./yii migrate --interactive=0

migrate-test:
	@docker-compose exec --user=www-data php ./yii_test migrate --interactive=0

migrate: migrate-main migrate-test

migrate-fresh-main:
	@docker-compose exec --user=www-data php ./yii migrate/fresh --interactive=0

migrate-fresh-test:
	@docker-compose exec --user=www-data php ./yii_test migrate/fresh --interactive=0

migrate-fresh: migrate-fresh-main migrate-fresh-test

app-init:
	@docker-compose exec --user=www-data php init

run-tests:
	@docker-compose exec --user=www-data php codecept run

docker-compose-override:
	@test -f docker-compose.override.yml || cp docker-compose.override.yml-dist docker-compose.override.yml
