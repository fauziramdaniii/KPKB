# CakePHP Application Skeleton

[![Build Status](https://img.shields.io/travis/cakephp/app/master.svg?style=flat-square)](https://travis-ci.org/cakephp/app)
[![Total Downloads](https://img.shields.io/packagist/dt/cakephp/app.svg?style=flat-square)](https://packagist.org/packages/cakephp/app)

A skeleton for creating applications with [CakePHP](https://cakephp.org) 3.x.

The framework source code can be found here: [cakephp/cakephp](https://github.com/cakephp/cakephp).

## Installation

1. Download [Composer](https://getcomposer.org/doc/00-intro.md) or update `composer self-update`.
2. Run `php composer.phar create-project --prefer-dist cakephp/app [app_name]`.

If Composer is installed globally, run

```bash
composer create-project --prefer-dist cakephp/app
```

In case you want to use a custom app dir name (e.g. `/myapp/`):

```bash
composer create-project --prefer-dist cakephp/app myapp
```

You can now either use your machine's webserver to view the default home page, or start
up the built-in webserver with:

```bash
bin/cake server -p 8765
```

Then visit `http://localhost:8765` to see the welcome page.

## Update

Since this skeleton is a starting point for your application and various files
would have been modified as per your needs, there isn't a way to provide
automated upgrades, so you have to do any updates manually.

## Configuration

Read and edit `config/app.php` and setup the `'Datasources'` and any other
configuration relevant for your application.

## Layout

The app skeleton uses a subset of [Foundation](http://foundation.zurb.com/) (v5) CSS
framework by default. You can, however, replace it with any other library or
custom styles.

## Create Seed
contoh untuk membuat seed data
```bash
php bin/cake.php bake seed MenuAdmins
php bin/cake.php bake seed --table my_articles_table
php bin/cake.php bake seed --data  MenuAdmins
```

## Migrations Guide

```bash
php bin/cake.php migrations migrate
php bin/cake.php migrations migrate -p Acl
php bin/cake.php migrations seed
php bin/cake.php acl_extras aco_sync
php bin/cake.php acl create aro root Groups.1
php bin/cake.php acl create aro Groups.1 Users.1
php bin/cake.php acl grant Groups.1 controllers
```

## App Configuration

```bash
    'SiteName' => 'Site Name',
        'CompanyName' => 'Company Name',
        'MetaConfig' => [
            'keywords' => 'Content Keywords',
            'description' => 'Content Description',
            'author' => 'Author Name'
        ],
        'GoogleCaptcha' => [
            'siteKey' => '6Lca-LwUAAAAABFQLMu1T-GWSl3m9-pFXu7VAwxs',
            'secretKey' => '6Lca-LwUAAAAAIcpUBf34-CFUQiJOwW_3srnNMDG'
        ],
        'EmailSender' => 'noreply@yourcompany.com',
        'EmailConfig' => [
            'siteInfo' => 'website.com',
            'address' => 'Company Address',
            'phone' => '
                <ul style="margin-top:-28px; margin-left:-10px;line-height: 1.6;">
                    <li style="margin-bottom:0;">No Kantor Operasional : (XXX) XXXXXX</li>
                    <li style="margin-bottom:0;">WhatsApp ADMIN : XXXX XXXX XXXX</li>
                </ul>',
            'office_phone' => '(XXX) XXXXXX',
            'wa_order' => 'XXXX XXXX XXXX',
            'wa_admin' => 'XXXX XXXX XXXX',
            'emailInfo' => 'info@yourcompany.com'
        ],
        'SloganEmail' => 'Lorem ipsum dolor sit amet',
        'BankCompany' => [
            0 => [
                'name' => 'Bank Mandiri',
                'acc_number' => '123456789',
                'acc_name' => 'YOUR BANK ACCOUNT',
                'img' => 'mandiri.png',
            ],
            1 => [
                'name' => 'Bank BCA',
                'acc_number' => '123456789',
                'acc_name' => 'YOUR BANK ACCOUNT',
                'img' => 'bca.png',
            ],
            2 => [
                'name' => 'Bank BRI',
                'acc_number' => '123456789',
                'acc_name' => 'YOUR BANK ACCOUNT',
                'img' => 'bri.png',
            ],
        ],
        'Rajaongkir' => [
            'url' => 'https://pro.rajaongkir.com/api/',
            'key' => '1ee7bc2c49e1ff46278d7363f3aec3c4',
            'district_default' => 6461, //Kabupaten Tasik malaya sariwangi
            'courrier' => 'jne:tiki:jnt:wahana', //value : 'jne:tiki:pos:'
        ],
        'MinimumClaim' => 100000,
        'ClaimRangeMonth' => 6,
        'Withdrawal' => [
            'fee' => 6500,
            'minimumTransfer' => 50000,
            'request_periode_days' => [24,25,26]
        ],
        'Prefixes' => [
            'username' => [
                'prefix' => 'TST',
                'number' => 1000000
            ]
        ]
```
