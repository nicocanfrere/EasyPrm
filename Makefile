.PHONY: up down cs csf punit deptrac

up:
	docker-compose -f .local/docker-compose.yml up --remove-orphans
down:
	docker-compose -f .local/docker-compose.yml down --remove-orphans
cs:
	./vendor/bin/phpcs
csf:
	./vendor/bin/phpcbf
punit:
	php ./bin/phpunit
deptrac:
	./vendor/bin/deptrac
