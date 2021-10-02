.PHONY: up down app cs csf punit deptrac stan

up:
	docker-compose -f .local/docker-compose.yml up --remove-orphans
down:
	docker-compose -f .local/docker-compose.yml down --remove-orphans
app:
	docker-compose -f .local/docker-compose.yml exec easy_prm_php /bin/bash
cs:
	./vendor/bin/phpcs
csf:
	./vendor/bin/phpcbf
punit:
	php ./bin/phpunit
deptrac:
	./vendor/bin/deptrac
stan:
	./vendor/bin/phpstan analyse
