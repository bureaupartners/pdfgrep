# pdfgrep
![Run tests](https://github.com/bureaupartners/pdfgrep/workflows/Run%20tests/badge.svg?branch=master)

A simple package for reading information via full text search with pdfgrep and using the information in a PHP script.

## Installing / Getting started
First add bureaupartners/pdfgrep to your composer.json
```shell
composer require bureaupartners/pdfgrep
```
Then add the following code to your project
```php
use BureauPartners\pdfgrep\pdfgrep;

$pdfgrep = new pdfgrep('Document.pdf', 'Dog');
$pdfgrep->getFirstMatch(); // Returns first match in the document
$pdfgrep->getMatches(); // Returns all the matches
$pdfgrep->getPageNumbers(); // Returns all page numbers with a match
```

## Dependencies

Requires an installation of pdfgrep on the server.

You can install it for example like this:
```shell
apt-get install -y poppler-utils
apt-get install -y pdfgrep
```

## Contributing

If you'd like to contribute, please fork the repository and use a feature
branch. Pull requests are warmly welcome.

## Links
- Repository: https://github.com/bureaupartners/pdfgrep
- Issue tracker: https://github.com/bureaupartners/pdfgrep/issues


## Licensing
The code in this project is licensed under MIT license.
