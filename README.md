# Silverstripe - Google Tag Manager
Google Tag Manager Version 2 integration for Silverstripe

Author: Andrew Mc Cormack

- Populate the Tag Manger data layer easily
- Generate ecommerce transaction data layer values
- Makes setting up user ID tracking much easier

## Installation
Add the following to your composer.json file

    {  
        "require": {  
            "Cyber-Duck/Silverstripe-Google-Tag-Manager": "master"  
        },  
        "repositories": [  
            {  
                "type": "vcs",  
                "url": "https://github.com/Cyber-Duck/Silverstripe-Google-Tag-Manager"  
            }  
        ]  
    }

Run composer install and composer update to download the module  

Add the following function to the Page_Controller in your Page.php file located in your code folder. Replace XXXXX with the ID of your container which you can get from the Tag Manager interface. It takes the format GTM-XXXXX, however you don't need to include the GTM part.

```php  
public function TagManager()
{
	return GTM::snippet('XXXXX');
}
```

In your Page.ss template add $TagManager just after the opening body tag

```php  
<body>
$TagManager
```

If you wish to load it depending on environment you can do something like below. Generally you will only want tag manager to load in a production environment unless you are debugging in a local development environment.

```php  
<% if IsLive %>
$TagManager
<% end_if %>
```

Append the following to your app URL  
**/dev/build?flush=all**  
This rebuilds your database and clears your cache.

## Usage

### Pushing to the data layer

To push a key value pair to the dataLayer you can simply call the data method within your controller files. You can call the method as many times as you want to push values to the data layer.

```php  
GTM::data('key','value')
```
The key value pairs will generate the necessary data layer JavaScript code

```javascript  
<script>dataLayer = [{'key' : 'value'}];</script>
```

### Pushing an ecomerce transaction to the data layer

Create 2 arrays; one containing the transaction fields and another containing your products. Call the purchase method first and inject your order fields then loop through your products and add each using the purchaseItem method.

```php  
$order = array(
    'id'          => '1',
    'affiliation' => 'My Store Name',
    'revenue'     => '1000.00'
);

$products = array(
    array(
        'id'       => 1,
        'name'     => 'product 1',
        'category' => 'category 1',
        'price'    => '100.00',
        'brand'    => 'brand 1'
    ),
    array(
        'id'       => 2,
        'name'     => 'product 2',
        'category' => 'category 2',
        'price'    => '100.00',
        'brand'    => 'brand 2'
    )
);

GTM::purchase($order);

foreach($products as $product) {

    $item = array(
        'id'       => $product['id'],
        'name'     => $product['name'],
        'category' => $product['category'],
        'price'    => $product['price'],
        'brand'    => $product['brand']
    );

    GTM::purchaseItem($item);
}
```

## About

Author: Andrew Mc Cormack

## License

The MIT License (MIT)

Copyright (c) 2015 Andrew Mc Cormack

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.