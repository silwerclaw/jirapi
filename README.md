# Jirapi
[![Build Status](https://travis-ci.org/silwerclaw/jirapi.svg?branch=master)](https://travis-ci.org/silwerclaw/jirapi)

PHP Jira Rest API client for Laravel 5.1, 5.2 that includes wrapper on both Jira Cloud and Jira Software API`s.

## Installation

```
composer require silwerclaw/jirapi
```

After that register plugin Service Provider adding line to your `app.php` file to `providers` list:
 
```
\Silwerclaw\Jirapi\JirapiServiceProvider::class, 
```

You can also register facade adding line to your `app.php` file to `aliases` list:

```
'Jirapi' => \Silwerclaw\Jirapi\Facades\Jirapi::class,
```

## Configuration

You can configure plugin in two ways:

Add to your `.env` file variables with correct credentials
 
```
JIRA_HOST=
JIRA_LOGIN=
JIRA_PASSWORD=
```

Alternatively you can publish plugin config file with

```
php artisan vendor:publish --provider="Silwerclaw\Jirapi\JirapiServiceProvider"
```

After that go to your config folder and edit fields with `host`, `login` and `password` with your values

**Beware that for most of actions your account in Jira must be granted with appropriate access rights!**

## Package usage

Please check [WIKI](https://github.com/silwerclaw/jirapi/wiki) pages for different use cases and examples