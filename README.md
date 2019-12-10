# laravel-jp-postal-code
A Laravel package that allows you to search address with Japanese postal code.  
(This package is maintained under Laravel 5.7.)

# Installation

Run the following command.

    composer require sukohi/laravel-jp-postal-code
    
# Preparation

The migration file is automatically loaded.  
So just run this command.  

    php artisan migrate
    
And download "ken_all.zip" from the below by clicking "全国一括".

[読み仮名データの促音・拗音を小書きで表記するもの](https://www.post.japanpost.jp/zipcode/dl/kogaki-zip.html)

Set a csv file in `/storage/app/csv/KEN_ALL.CSV` after unzip.

Now the time to import postal data.  
Run this command.

    php artisan import:jp-postal-code

***Note:*** Import takes time because the csv file has over 120,000 lines. 

# Configuration

If you'd like to configure, publish `jp_postal_code.php`.  

    php artisan vendor:publish --provider="Sukohi\LaravelJpPostalCode\LaravelJpPostalCodeServiceProvider"
    
Now you have `jp_postal_code.php` in `/config` folder.

***endpoint***

This is URL that provides feature of address search.  
So you can search Japanese address as follows though Ajax.

1. /api/jp_postal_code?code=131-0045
2. /api/jp_postal_code?first_code=131&last_code=0045

Multi-byte character like "１３１００４５" is also available.

[Response example]

    {
        address: "押上"
        city: "墨田区"
        first_code: "131"
        full_address: "〒131-0045 東京都墨田区押上"
        full_code: "131-0045"
        id: 39342
        last_code: "0045"
        prefecture: "東京都"
    }

* You can change format of `full_address` and `full_code`  in `/config/jp_postal_code.php`.

***import_path***

The path of "KEN_ALL.CSV".

***address_format***

The format of `full_address` when retrieving address.

***postal_code_format***

The format of `full_code` when retrieving address.

# License
This package is licensed under the MIT License.
Copyright 2019 Sukohi Kuhoh
