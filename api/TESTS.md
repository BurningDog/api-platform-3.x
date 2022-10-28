# Testing

Tests can be run with either of the following:

```sh
php bin/phpunit
composer run phpunit
```

Tests run on the test database.

## Code coverage

To generate tests with code coverage:

```sh
composer run phpunit
composer run phpunit-cov
```

Then open `build/logs/phpunit/html/index.hml` in a browser.
