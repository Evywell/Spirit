.PHONY: lint
lint: vendor/autoload.php ## Analyse de code phpstan
	vendor/bin/phpstan analyse

.PHONY: test
test: vendor/autoload.php ## Exécute les tests unitaires PHPUNIT
	vendor/bin/phpunit