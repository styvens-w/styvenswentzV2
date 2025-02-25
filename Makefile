.PHONY: deploy install
deploy:
	ssh portfolio 'cd public_html && git pull origin main && make install'

install: vendor/autoload.php
	php bin/console d:m:m -n
	composer dump-env prod
	php bin/console sass:build
	php bin/console asset-map:compile
	php bin/console cache:clear
	php bin/console cache:warmup

vendor/autoload.php: composer.json composer.lock
	composer install --no-dev --optimize-autoloader
	touch vendor/autoload.php