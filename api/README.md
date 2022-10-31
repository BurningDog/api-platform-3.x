# API Platform 3.x

The API will be here.

Refer to the [Getting Started Guide](https://api-platform.com/docs/distribution) for more information. If you'd like to not use Docker (hint: it's a _lot_ more work to do manual setup) then view [SETUP.md](SETUP.md).

This starter template is the standard [API Platform](https://api-platform.com/) release [3.0.0](https://github.com/api-platform/api-platform/releases) with some additional helpful things added:

* manual setup documentation
* disabling Mercure
* testing documentation (include code coverage)
* php-cs-fixer integration

## Next setup steps

1. Customise the User login and registration setup - see [SETUP-USER.md](SETUP-USER.md).

## Helpful development things

Add this alias to your shell alias file:

```sh
alias console="php bin/console"
alias phpunits="php bin/phpunit"
```

### Code style

To run the excellent [PHP Coding Standards Fixer](https://cs.symfony.com/) tool - `php-cs-fixer` - do:

```sh
composer run php-lint
composer run php-cs-fixer
```

The first command will show linting issues with files; the second will fix them. The former command also runs on PRs via a [Github workflow](../.github/workflows/ci.yml)

If you're using VS Code then install the [junstyle.php-cs-fixer](https://marketplace.visualstudio.com/items?itemName=junstyle.php-cs-fixer) plugin. PHPStorm should integrate `php-cs-fixer` out of the box.

### PsyshBundle - a PHP REPL

This gives a way, in the dev environment, to open a console and to interact with Symfony by writing PHP code.

```sh
console psysh
```

#### Forget to catch that last exception?

No worries, PsySH has your back. We caught it for you, and made it available via the wtf command.

```php
help wtf
```

## Creating a user

First, get a new hashed password: `console security:hash-password`

Then, run `console psysh` and the following:

```php
$em = $container->get('doctrine')->getManager();
$user = new App\Entity\User;
$user->setEmail('me@example.com');
$user->setPassword('hashed password from earlier');
$em->persist($user);
$em->flush();
```
