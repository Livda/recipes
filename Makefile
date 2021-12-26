SHELL := /bin/bash

phpcs:
	./vendor/bin/php-cs-fixer fix
.PHONY: phpcs

phpstan:
	./vendor/bin/phpstan --configuration=.phpstan.neon.dist
.PHONY: phpstan

up:
	docker-compose up -d
	symfony serve
.PHONY: up

tests: export APP_ENV=test
tests:
	symfony console doctrine:database:create --if-not-exists
	symfony console doctrine:schema:drop --force
	symfony console doctrine:schema:create
	symfony console doctrine:migrations:migrate -n
	symfony console doctrine:fixtures:load -n
	symfony php bin/phpunit $@
.PHONY: tests