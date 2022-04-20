# Boxtal PHP Library

This PHP library aims to present the PHP Laravel implementation of the EnvoiMoinsCher.com API (created by splitfire agency from https://github.com/boxtal/php-library).

---

### Installation

To install the library, simply:

`composer require splitfire-agency/boxtal-laravel`

To configure:

Open config/boxtal.php and configure it according to your needs. By default you should put the following variables into your .env file and fill them with valid values:

EMC_MODE - Api mode (`test` or `prod`)
EMC_USER - Boxtal user id
EMC_PASS - Boxtal password
EMC_KEY - Boxtal Api key

### Requirements

Boxtal Laravel PHP Library works with PHP >= 8.0 and laravel >= 8.0.

In order to use the API, you need to create a (free) user account on https://www.boxtal.com, then generate an api key from the account management interface."

### Links

Boxtal api documentation: https://www.boxtal.com/fr/fr/api

### Testing

1. Configure `phpunit.xml` with environment variables (EMC_USER, EMC_PASS, EMC_KEY). 

2. Run docker: `docker-compose up`

3. Go to docker bash console: `docker-compose exec api bash`

4. Install dependencies: `composer install`

5. Run phpunit tests: `./vendor/phpunit/phpunit/phpunit`

### Submitting a pull request

If you'd like to submit a pull request, you should run phpunit tests and you should ensure your changes will lint:

`npm run lint`