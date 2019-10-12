# SugarCRM Password Hash Utility [![Build Status](https://travis-ci.com/skymeyer/sugarcrm-pwd-hash.svg?branch=master)](https://travis-ci.com/skymeyer/sugarcrm-pwd-hash)

This CLI tool generates SugarCRM compatible password hashes for SugarCRM 7.7
and up which can be stored in SugarCRM's database directly.

By default `bcrypt` is used for the password hashing. You can also specify
using the `--type` parameter `sha256` or `sha512`. Check with your
administrator which hashing backend is enabled on your SugarCRM instance.

Use `hash --help` to review the available options.

## Execute using docker

When you have docker installed, simply execute one of the following commands:

```
docker run --rm skymeyer/sugarcrm-pwd-hash generate "password"
docker run --rm skymeyer/sugarcrm-pwd-hash generate "password" --type=sha256
docker run --rm skymeyer/sugarcrm-pwd-hash generate "password" --type=sha512
```


## Execute using composer

Make sure you have [composer](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos) installed. Next, use the `composer create-project` command to initialize the CLI tool. When completed successfully,
you will be able to execute the `hash` executable.

```
composer create-project skymeyer/sugarcrm-pwd-hash --prefer-dist --no-dev
cd sugarcrm-pwd-hash
bin/hash generate "password"
bin/hash generate "password" --type=sha256
bin/hash generate "password" --type=sha512
```

## Disclaimer

This is not an official SugarCRM package and is offered as-is.