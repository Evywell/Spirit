.PHONY: analyse
analyse: vendor/autoload.php ## Analyse de code phpstan
	vendor/bin/phpstan analyse

.PHONY: lint
lint: vendor/autoload.php ## Analyse le code suivant les normes PSR 2
	vendor/bin/phpcs --standard=PSR2 src/

.PHONY: fix
fix: vendor/autoload.php ## Effectue des corrections automatiques de code
	vendor/bin/phpcbf --standard=PSR2 src/

.PHONY: lf
lf: vendor/autoload.php ## lint & fix
	vendor/bin/phpcs --standard=PSR2 src/ && vendor/bin/phpcbf --standard=PSR2 src/

.PHONY: test
test: vendor/autoload.php ## Exécute les tests unitaires PHPUNIT
	vendor/bin/phpunit