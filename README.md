# Manufacturer Module for InvoiceNinja

This module adds manufacturer data such as part number, UPC, etc to products data entry and a CRUD for maintaining the manufacturers list.

**_This module depends on the develop branch of Invoice Ninja due to some custom module improvements in the code base._**

## Install via Composer

```
php artisan module:install dicarlosystems/manufacturer --type=github-https
```

After installing, run the migrations:

```
php artisan module:migrate Manufacturer
```
