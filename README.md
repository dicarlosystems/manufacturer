# Manufacturer Module for InvoiceNinja

This module adds manufacturer data such as part number, UPC, etc to products data entry and a CRUD for maintaining the manufacturers list.

#### As of 2018-09-28, this module depends on the current develop branch of Invoice Ninja (due to some newly introduced features)

**This module is in an early alpha stage.  Use at your own risk!**

## Install via Composer

```
composer require dicarlosystems/manufacturer
```

After installing, run the migrations:

```
php artisan module:migrate Manufacturer
```
