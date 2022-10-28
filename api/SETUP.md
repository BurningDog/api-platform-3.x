# Local setup without Docker

Much easier to use Docker - see [Getting Started Guide](https://api-platform.com/docs/distribution) for how. If you really _want_ to use Valet, PHP, and Postgres (all via HomeBrew), then read on.

## Find/replace the site name

Search for `api.newsite` in the `api` folder and replace with the site name you'd like to use. Note: this should only replace values in `.env` and `SETUP.md` files.

## PHP

Ensure you're running php 8.1 (`brew install php`). Then:

```sh
composer install
```

## Database - postgres

Why postgres? API Platform prefers it over MySQL. MySQL could also be used, but after my (Roger's) experience with both it's much of a muchness. Postgres has a _much_ smaller memory footprint than MySQL (83 MB vs 609MB) so is also nicer for local development.

1. Install postgres (on a Mac, this is with Homebrew - `brew install pgsql`).
2. Connect to it with a client - [DBeaver](https://dbeaver.io/) is recommended.
3. Create a new database, the name could be `newsite_api_platform`.
4. Create a new `test` database, the name could be `newsite_api_platform_test`
5. Locally on Mac, your system username will be your default user without a password.

### Database credentials

```sh
cp .env .env.local
cp .env.test .env.test.local
```

Then, in `.env.local` edit the `DATABASE_URL` connection string. Mine looks like follows:

`DATABASE_URL="postgresql://rs:@127.0.0.1:5432/newsite_api_platform?serverVersion=14&charset=utf8"`

In `.env.test.local` add the following:

`DATABASE_URL="postgresql://rs:@127.0.0.1:5432/newsite_api_platform?serverVersion=14&charset=utf8"`

Yes, it looks the same, but Symfony will always append a `_test` to the database name in the test environment.

### Run database migrations

This will test that postgres is running and accessible, and then run database migrations to create tables:

```sh
php bin/console doctrine:migrations:migrate
php bin/console doctrine:migrations:migrate --env=test
```

Then, using DBeaver, take a look at your database and ensure that some tables exist.

## Web server - Valet

Link the site with [Valet](https://laravel.com/docs/9.x/valet):

```sh
cd public
valet link api.newsite
valet secure
valet open
```

This will open [https://api.newsite.test/](https://api.newsite.test/) in a browser and you should see OpenApi docs.

If you don't have Valet then using nginx/apache/whatever you use, create a new site pointing at the `public` folder and make sure it is available at [https://api.newsite.test/](https://api.newsite.test/)

## Test setup

On first run, do `composer run phpunit`, which will install the necessary packages.

Tests can be run with either of the following:

```sh
php bin/phpunit
composer run phpunit
```

If you get the error `sh: composer: command not found` then set the `COMPOSER_BINARY` env var in `.env.test.local` to the full path of the location of your composer bin (i.e. the output of `which composer` - but an absolute path).
