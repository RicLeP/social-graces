# Social Graces; a polite way to create dymanic social share images

[![Latest Version on Packagist](https://img.shields.io/packagist/v/riclep/social-graces.svg?style=flat-square)](https://packagist.org/packages/riclep/social-graces)
[![Total Downloads](https://img.shields.io/packagist/dt/riclep/social-graces.svg?style=flat-square)](https://packagist.org/packages/riclep/social-graces)

This package allows you to create dynamic social sharing images in your Laravel apps. It uses [Spatie’s Browsershot](https://github.com/spatie/browsershot) to screenshot special pages that represent the image you wish to use. Create any view, using any content from your site and it’ll become the image used when your page is shared on Twitter, Facebook and elsewhere.

You can either create different images for each network using Manners or use the same Balde view with CSS breakpoints to to vary your images based on the size needed for each network.

## Installation

You can install the package via composer:

```bash
composer require riclep/social-graces
```

## Usage

No docs yet, but check the tests and code. It’s a pretty small package.



### Browsershot Requirements

This package wraps Spatie’s Browsershot that requires Puppeteer, Chromium, Node etc. on your server.

I can’t support installing these on your own server, but here is what I needed to do.

**Use at your own risk!**

```
apt update -y

sudo apt-get install -y nodejs gconf-service libasound2 libatk1.0-0 libc6 libcairo2 libcups2 libdbus-1-3 libexpat1 libfontconfig1 libgbm1 libgcc1 libgconf-2-4 libgdk-pixbuf2.0-0 libglib2.0-0 libgtk-3-0 libnspr4 libpango-1.0-0 libpangocairo-1.0-0 libstdc++6 libx11-6 libx11-xcb1 libxcb1 libxcomposite1 libxcursor1 libxdamage1 libxext6 libxfixes3 libxi6 libxrandr2 libxrender1 libxss1 libxtst6 ca-certificates fonts-liberation libappindicator1 libnss3 lsb-release xdg-utils wget libgbm-dev libxshmfence-dev

export PHANTOM_JS='phantomjs-2.1.1-linux-x86_64'; wget -N https://bitbucket.org/ariya/phantomjs/downloads/$PHANTOM_JS.tar.bz2 ; tar xvjf $PHANTOM_JS.tar.bz2; mv $PHANTOM_JS /usr/local/share; ln -sf /usr/local/share/$PHANTOM_JS/bin/phantomjs /usr/local/bin; phantomjs --version

sudo npm install --global --unsafe-perm puppeteer

chmod -R o+rx /usr/local/lib/node_modules/puppeteer/.local-chromium
```

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email ric@sirric.co.uk instead of using the issue tracker.

## Credits

-   [Richard Le Poidein](https://github.com/riclep)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
