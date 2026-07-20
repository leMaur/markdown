# Markdown parser with superpowers

[![Latest Version on Packagist](https://img.shields.io/packagist/v/lemaur/markdown.svg?style=flat-square)](https://packagist.org/packages/lemaur/markdown)
[![Total Downloads](https://img.shields.io/packagist/dt/lemaur/markdown.svg?style=flat-square)](https://packagist.org/packages/lemaur/markdown)
[![License](https://img.shields.io/packagist/l/lemaur/markdown.svg?style=flat-square&color=yellow)](https://github.com/leMaur/markdown/blob/main/LICENSE.md)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/lemaur/markdown/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/leMaur/markdown/actions/workflows/run-tests.yml)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/lemaur/markdown/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/leMaur/markdown/actions/workflows/fix-php-code-style-issues.yml)
[![GitHub Sponsors](https://img.shields.io/github/sponsors/lemaur?style=flat-square&color=ea4aaa)](https://github.com/sponsors/leMaur)
[![Trees](https://img.shields.io/badge/dynamic/json?color=yellowgreen&style=flat-square&label=Trees&query=%24.total&url=https%3A%2F%2Fpublic.offset.earth%2Fusers%2Flemaur%2Ftrees)](https://ecologi.com/lemaur?r=6012e849de97da001ddfd6c9)

## Support Me

Hey folks,

Do you like this package? Do you find it useful and it fits well in your project?

I am glad to help you, and I would be so grateful if you considered supporting my work.

You can even choose 😃:
* You can [sponsor me 😎](https://github.com/sponsors/leMaur) with a monthly subscription.
* You can [buy me a coffee ☕ or a pizza 🍕](https://github.com/sponsors/leMaur?frequency=one-time&sponsor=leMaur) just for this package.
* You can [plant trees 🌴](https://ecologi.com/lemaur?r=6012e849de97da001ddfd6c9). By using this link we will both receive 30 trees for free and the planet (and me) will thank you. 
* You can "Star ⭐" this repository (it's free 😉).

## Installation

You can install the package via composer:

```bash
composer require lemaur/markdown
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="Lemaur\Markdown\MarkdownServiceProvider" --tag="markdown-config"
```

## Usage

```php
use Lemaur\Markdown;

$markdown = <<<'MD'
# Title

a paragraph with [link](https://website.com).

<x-custom-component></x-custom-component>
MD;

return Markdown::render($markdown);
```

Code blocks are safe: any Blade-looking syntax inside a fenced (```` ``` ````), indented,
or inline (`` ` ``) code block is displayed as literal text, never executed. So you can
document components without them rendering:

````markdown
```blade
<x-custom-component></x-custom-component>
```
````

This code-block protection is based on Aaron Francis' article
[Rendering Blade Components in Markdown](https://aaronfrancis.com/2023/rendering-blade-components-in-markdown-e2e74e55).

> **⚠️ Only render trusted content.** `Markdown::render()` runs the Blade compiler over the
> document body (outside code blocks), so any Blade or PHP in the prose is executed. Never pass
> user-generated Markdown to it. Protection covers CommonMark code constructs only — raw HTML
> `<pre>`/`<code>` you write by hand is treated as HTML and is not shielded from Blade.

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Maurizio](https://github.com/leMaur)
- [Aaron Francis](https://aaronfrancis.com) — the code-block protection approach is based on his article [Rendering Blade Components in Markdown](https://aaronfrancis.com/2023/rendering-blade-components-in-markdown-e2e74e55)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
