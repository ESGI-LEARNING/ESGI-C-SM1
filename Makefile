.PHONY: help
.DEFAULT_GOAL = help

dc = docker compose
de = $(dc) exec

## —— Docker 🐳  ———————————————————————————————————————————————————————————————
.PHONY: dev
dev:	## start container
	$(dc) up -d

.PHONY: in-dc
in-dc:	## connexion container php
	$(de) php bash

.PHONY: delete
delete:	## delete container
	$(dc) down
	$(dc) kill
	$(dc) rm

## —— Tools 🛠️️ ———————————————————————————————————————————————————————————————
.PHONY: phpstan
phpstan:  ## phpstan
	./vendor/bin/phpstan analyse --memory-limit=2G -v

.PHONY: phpcs
phpcs: ## Php cs fixer
	vendor/bin/php-cs-fixer fix --dry-run --diff

.PHONY: phpcs-fix
phpcs-fix: ## Automatically correct coding standard violations
	vendor/bin/php-cs-fixer fix


## —— Others 🛠️️ ———————————————————————————————————————————————————————————————
help: ## listing command
	@grep -E '(^[a-zA-Z0-9_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}{printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'