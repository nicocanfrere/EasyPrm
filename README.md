# EasyPrm

[DDD](https://en.wikipedia.org/wiki/Domain-driven_design) practice and exercise project based on the development of a [PRM](https://en.wikipedia.org/wiki/Partner_relationship_management) with [Symfony](https://symfony.com/)

## Local development environment - .local directory

### Php image

Go to .local/docker

```bash
docker build . -t nico.php-fpm:8.0.10
```
*If you change the tag name (nico.php-fpm:8.0.10), don't forget to change it in the docker-compose.yaml file, in the **easy_prm_php** service.*

### Mailhog

Mailhog is a mailcatcher [github page](https://github.com/mailhog/MailHog). You can see mails sent by your app in your browser at **http://127.0.0.1:8025**.

You can change the port in the **easy_prm_mailhog** service of the docker-compose.yml file.

### Server nginx & traefik

Don't forget to add **easy-prm.local** to your /etc/hosts file (linux users). You can visit the application in your browser at **http://easy-prm.local**
```text
127.0.0.1 easy-prm.local
```

## Tools

### PHP CodeSniffer [github](https://github.com/squizlabs/PHP_CodeSniffer)

show report *(see Makefile for real command)*:
```bash
make cs
```

fix errors *(see Makefile for real command)*:
```bash
make csf
```

### PHPUnit [doc](https://phpunit.readthedocs.io/en/9.5/)

Run your tests locally with *(see Makefile for real command)*:
```bash
make punit
```

### Deptrac [doc](https://github.com/qossmic/deptrac)

show report *(see Makefile for real command)*:
```bash
make deptrac
```
