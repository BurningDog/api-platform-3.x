# User, registration, login setup

This setup has been provided by `MakerBundle` by running the following:

```sh
console make:user
console make:auth
console make:registration-form
```

This does the following:

* enables cookie-based sessions
* provides a simple registration and login form
* provides a custom authenticator
* provides a logout url
* email verification

## User entity

Note that the User identifier is the email address and it must be unique.

## Customize your new authenticator and the login template

Open [AppCustomAuthenticator](src/Security/AppCustomAuthenticator.php)

* Finish the redirect "TODO" in the App\Security\AppCustomAuthenticator::onAuthenticationSuccess() method.
* Review & adapt the login template: templates/security/login.html.twig.

## RegistrationController

Set `no-reply@example.com` and `NewSite Mail Bot` to the desired values.

In `verifyUserEmail()` see the TODO:

* Customize the last redirectToRoute() after a successful email verification.
* Make sure you're rendering success flash messages or change the $this->addFlash() line.

## Confirmation email

The email which gets sent to the user to ask them to confirm their email is at [confirmation_email.html.twig](templates/registration/confirmation_email.html.twig) - customize it to your needs.

## SecurityController

The [SecurityController](src/Controller/SecurityController.php) handles the login form.

* Finish the TODO for once the user is logged in, redirect them somewhere.

## Set the redirect url after log out

In [security.yaml](config/packages/security.yaml) set this:

```yaml
# where to redirect after logout
# target: app_any_route
```

## Email setup

symfony/mailer  instructions:

* You're ready to send emails.

* If you want to send emails via a supported email provider, install the corresponding bridge. For instance, `composer require mailgun-mailer` for Mailgun.
* Then set the `MAILER_DSN` env var (it's currently set to null).

* If you want to send emails asynchronously:

1. Install the messenger component by running `composer require messenger`;
2. Add `Symfony\Component\Mailer\Messenger\SendEmailMessage`: amqp to the `config/packages/messenger.yaml` file under `framework.messenger.routing` and replace `amqp` with your transport name of choice.

* Read the documentation at [https://symfony.com/doc/master/mailer.html](https://symfony.com/doc/master/mailer.html)
