PWD := $(shell pwd)
COMMIT := $(shell git rev-parse --short HEAD)

# Composer install.
.PHONY: composer-install
composer-install:
	docker run --rm -v ${PWD}:/app composer:1.9 install --prefer-dist

# Composer dependency update.
.PHONY: composer-update
composer-update:
	docker run --rm -v ${PWD}:/app composer:1.9 update --prefer-dist

# Run all unit tests and see if we can build/execute our container.
.PHONY: test
test:
	docker run --rm -v ${PWD}:/app php:7.3-alpine /bin/sh -c "cd /app && vendor/bin/phpunit && bin/hash"
	docker build -t skymeyer/sugarcrm-pwd-hash:${COMMIT} .
	docker run --rm skymeyer/sugarcrm-pwd-hash:${COMMIT} generate --type=bcrypt mypassword
	docker run --rm skymeyer/sugarcrm-pwd-hash:${COMMIT} generate --type=sha256 mypassword
	docker run --rm skymeyer/sugarcrm-pwd-hash:${COMMIT} generate --type=sha512 mypassword

# Manual docker release, `make docker-release RELEASE=1.0.0`.
.PHONY: docker-release
docker-release:
	docker build -t skymeyer/sugarcrm-pwd-hash:$(RELEASE) .
	docker push skymeyer/sugarcrm-pwd-hash:$(RELEASE)