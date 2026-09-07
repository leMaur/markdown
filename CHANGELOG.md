# Changelog

All notable changes to `markdown` will be documented in this file.

## 4.0.1 - 2026-09-07

### What's Changed

* fix: keep the temporary view after the Blade pass by @leMaur in https://github.com/leMaur/markdown/pull/39

The Blade pass no longer deletes the temporary view it renders each document through. Deleting it raced under multi-worker servers (Laravel Octane / FrankenPHP): one worker could unlink the file while another had just resolved the same content-hash filename, raising `View [hash] not found`. The file count is bounded by the number of distinct documents and is cleared together with the other compiled views.

**Full Changelog**: https://github.com/leMaur/markdown/compare/4.0.0...4.0.1

## 4.0.0 - 2026-07-20

### What's Changed

* docs: update CHANGELOG for 3.0.2 by @github-actions[bot] in https://github.com/leMaur/markdown/pull/28
* fix(ci): never auto-merge an untested head in dependabot-auto-merge by @leMaur in https://github.com/leMaur/markdown/pull/29
* chore(deps): bump actions/checkout from 6.0.2 to 6.0.3 by @dependabot[bot] in https://github.com/leMaur/markdown/pull/30
* chore(deps): bump shivammathur/setup-php from 2.37.1 to 2.37.2 by @dependabot[bot] in https://github.com/leMaur/markdown/pull/32
* ci: set persist-credentials: false on checkout steps by @leMaur in https://github.com/leMaur/markdown/pull/33
* chore(deps): bump ramsey/composer-install from 5c2bcf28d7b060ef3c601d7b476d5430a7b46c27 to 26d8a556604053a9612623447203a691f406fbe6 by @dependabot[bot] in https://github.com/leMaur/markdown/pull/31
* chore(deps): bump actions/cache from 5.0.5 to 6.1.0 by @dependabot[bot] in https://github.com/leMaur/markdown/pull/35
* chore(deps): bump actions/checkout from 6.0.3 to 7.0.0 by @dependabot[bot] in https://github.com/leMaur/markdown/pull/34
* feat!: protect code blocks from the Blade rendering pass by @leMaur in https://github.com/leMaur/markdown/pull/36

**Full Changelog**: https://github.com/leMaur/markdown/compare/3.0.2...4.0.0

## 3.0.2 - 2026-06-01

### What's Changed

* docs: update CHANGELOG for 3.0.1 by @github-actions[bot] in https://github.com/leMaur/markdown/pull/26
* chore(ci): add Composer audit gate and composer-normalize by @leMaur in https://github.com/leMaur/markdown/pull/27

### New Contributors

* @github-actions[bot] made their first contribution in https://github.com/leMaur/markdown/pull/26

**Full Changelog**: https://github.com/leMaur/markdown/compare/3.0.1...3.0.2

## 3.0.1 - 2026-05-27

### What's Changed

* chore(ci): pin actions to SHAs + gate dependabot auto-merge on tests by @leMaur in https://github.com/leMaur/markdown/pull/21
* chore: SHA-pin actions + least-privilege permissions + gate Dependabot auto-merge by @leMaur in https://github.com/leMaur/markdown/pull/22
* chore(ci): canary — PR-based signed-merge flow (branch-protection enablement) by @leMaur in https://github.com/leMaur/markdown/pull/23
* fix(ci): pint check-only (no codebase mutation) by @leMaur in https://github.com/leMaur/markdown/pull/24
* chore(ci): converge changelog on shared peter-evans pattern by @leMaur in https://github.com/leMaur/markdown/pull/25

**Full Changelog**: https://github.com/leMaur/markdown/compare/3.0.0...3.0.1

## 3.0.0 - 2026-05-25

### What's Changed

* feat!: drop EOL Laravel 10 + PHP 8.1 (require L11+, PHP 8.2+) by @leMaur in https://github.com/leMaur/markdown/pull/20

**Full Changelog**: https://github.com/leMaur/markdown/compare/2.2.0...3.0.0

## 2.2.0 - 2026-03-19

### What's Changed

* chore(deps): bump stefanzweifel/git-auto-commit-action from 5 to 7 by @dependabot[bot] in https://github.com/leMaur/markdown/pull/14
* chore(deps): bump actions/checkout from 4 to 6 by @dependabot[bot] in https://github.com/leMaur/markdown/pull/15
* chore(deps): bump ramsey/composer-install from 3 to 4 by @dependabot[bot] in https://github.com/leMaur/markdown/pull/16
* Add Laravel 13 and PHP 8.5 support by @leMaur in https://github.com/leMaur/markdown/pull/17

**Full Changelog**: https://github.com/leMaur/markdown/compare/2.1.0...2.2.0

## 2.1.0 - 2026-02-22

### What's Changed

* Upgrade to Laravel 12 by @leMaur in https://github.com/leMaur/markdown/pull/13

**Full Changelog**: https://github.com/leMaur/markdown/compare/2.0.1...2.1.0

## 2.0.1 - 2026-02-22

### What's Changed

* Replace php-cs-fixer with pint by @leMaur in https://github.com/leMaur/markdown/pull/12
* chore(deps): bump dependabot/fetch-metadata from 1.6.0 to 2.0.0 by @dependabot[bot] in https://github.com/leMaur/markdown/pull/9
* chore(deps): bump ramsey/composer-install from 2 to 3 by @dependabot[bot] in https://github.com/leMaur/markdown/pull/8

**Full Changelog**: https://github.com/leMaur/markdown/compare/2.0.0...2.0.1

## 2.0.0 - 2026-02-22

### What's Changed

* chore(deps): bump stefanzweifel/git-auto-commit-action from 4 to 5 by @dependabot[bot] in https://github.com/leMaur/markdown/pull/5
* chore(deps): bump actions/checkout from 3 to 4 by @dependabot[bot] in https://github.com/leMaur/markdown/pull/4
* Upgrade to Laravel 11 by @leMaur in https://github.com/leMaur/markdown/pull/11

**Full Changelog**: https://github.com/leMaur/markdown/compare/1.0.1...2.0.0

## 1.0.1 - 2023-08-09

**Full Changelog**: https://github.com/leMaur/markdown/compare/1.0.0...1.0.1

## 1.0.0 - 202X-XX-XX

- initial release
