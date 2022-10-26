# Quote this Woman API

The API will be here.

Refer to the [Getting Started Guide](https://api-platform.com/docs/distribution) for more information. If you'd like to not use Docker (hint: it's a _lot_ more work to do manual setup) then view [SETUP.md](SETUP.md).

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

The first command will show linting issues with files; the second will fix them. The former command also runs on PRs via a [Github workflow](vendor/api-platform/schema-generator/.github/workflows/ci.yml)

If you're using VS Code then install the [junstyle.php-cs-fixer](https://marketplace.visualstudio.com/items?itemName=junstyle.php-cs-fixer) plugin. PHPStorm should integrate `php-cs-fixer` out of the box.
