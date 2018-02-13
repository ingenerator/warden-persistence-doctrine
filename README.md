This provides a persistence layer for [ingenerator/warden](https://github.com/ingenerator/warden)
using doctrine2.

**Warden is under heavy development and not recommended for production use outwith inGenerator.**

[![Build Status](https://travis-ci.org/ingenerator/warden-persistence-doctrine.svg?branch=0.1.x)](https://travis-ci.org/ingenerator/warden-persistence-doctrine)


# Installing warden-persistence-doctrine

This isn't in packagist yet : you'll need to add our package repository to your composer.json:

```json
{
  "repositories": [
    {"type": "composer", "url": "https://php-packages.ingenerator.com"}
  ]
}
```

`$> composer require ingenerator/warden-persistence-doctrine`

Configure the user repository in your dependency container - it takes an instance
of the Doctrine EntityManager and the current warden configuration.

# Contributing

Contributions are welcome but please contact us before you start work on anything to check your
plans line up with our thinking and future roadmap. 

# Contributors

This package has been sponsored by [inGenerator Ltd](http://www.ingenerator.com)

* Andrew Coulton [acoulton](https://github.com/acoulton) - Lead developer

# Licence

Licensed under the [BSD-3-Clause Licence](LICENSE)
