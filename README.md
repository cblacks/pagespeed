PageSpeed Insights API
======================

A PHP module to interact with the [PageSpeed Insights API](https://developers.google.com/speed/docs/insights/v2/getting-started).

Installation
============

Add the following to the composer.json

``` javascript
"repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/cblacks/pagespeed"
        }
],
```

Then require the following package:
```"sgrodzicki/pagespeed": "master",```


Use the generated `vendor/.composer/autoload.php` file to autoload the library classes.

Basic usage
===================

```php
<?php

$pageSpeed = new \PageSpeed\Insights\Service();
$pageSpeed->getResults('http://www.example.com');
```

Tests
=====

[![Build Status](https://secure.travis-ci.org/sgrodzicki/pagespeed.png?branch=master)](http://travis-ci.org/sgrodzicki/pagespeed)

The client is tested with phpunit; you can run the tests, from the repository's root, by doing:

``` bash
phpunit
```

Some tests may fail, due to requiring an internet connection (to test against a real API response). Make sure that
you are connected to the internet before running the full test suite.
