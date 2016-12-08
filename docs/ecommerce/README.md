# Pushing Ecommerce Data

## Setting the ecommerce currency

Set the currency to an standard currency code such as EUR, GBP, or USD.

```php
GTM::transactionCurrency('EUR');
```

outputs:

```javascript
dataLayer.push({
    "ecommerce": {
        "currencyCode": "EUR"
    }
});
```

## Pushing a product impression

To push a product impression pass an array of product fields.

```php
$impression = [
    'name'     => 'Triblend Android T-Shirt',
    'id'       => '12345',
    'price'    => '15.25',
    'brand'    => 'Google',
    'category' => 'Apparel',
    'variant'  => 'Gray',
    'list'     => 'Search Results',
    'position' => 1
];
GTM::productImpression($product)
```

outputs:

```javascript
dataLayer.push({
    "ecommerce": {
        "currencyCode": "EUR",
        "impressions": [
            {
                "name": "Triblend Android T-Shirt",
                "id": "12345",
                "price": "15.25",
                "brand": "Google",
                "category": "Apparel",
                "variant": "Gray",
                "list": "Search Results",
                "position": 1
            }
        ]
    }
});
```

## Pushing a product promotion impression

```php
$product = [
    'id'       => 'JUNE_PROMO13',
    'name'     => 'June Sale',
    'creative' => 'banner1',
    'position' => 'slot1'
];
GTM::productPromoImpression($product)
```

outputs:

```javascript
dataLayer.push({
    "ecommerce": {
        "promoView": {
            "promotions": [
                {
                    "id": "JUNE_PROMO13",
                    "name": "June Sale",
                    "creative": "banner1",
                    "position": "slot1"
                }
            ]
        }
    }
});
```

## Pushing a product detail view

```php
$product = [
    'name'     => 'Triblend Android T-Shirt',
    'id'       => '12345',
    'price'    => '15.25',
    'brand'    => 'Google',
    'category' => 'Apparel',
    'variant'  => 'Gray'
];
GTM::productDetail($product);
```

outputs:

```javascript
dataLayer.push({
    "ecommerce": {
        "detail": {
            "products": [
                {
                    "name": "Triblend Android T-Shirt",
                    "id": "12345",
                    "price": "15.25",
                    "brand": "Google",
                    "category": "Apparel",
                    "variant": "Gray"
                }
            ]
        }
    }
});
```

## Pushing an add to cart action

```php
$product = [
    'name'     => 'Triblend Android T-Shirt',
    'id'       => '12345',
    'price'    => '15.25',
    'brand'    => 'Google',
    'category' => 'Apparel',
    'variant'  => 'Gray',
    'quantity' => 1
];
GTM::addToCart($product);
```

outputs:

```javascript
dataLayer.push({
    "ecommerce": {
        "add": {
            "products": [
                {
                    "name": "Triblend Android T-Shirt",
                    "id": "12345",
                    "price": "15.25",
                    "brand": "Google",
                    "category": "Apparel",
                    "variant": "Gray",
                    "quantity": 1
                }
            ]
        }
    },
    "event": "addToCart"
});
```

## Pushing a remove from cart action

```php
$product = [
    'name'     => 'Triblend Android T-Shirt',
    'id'       => '12345',
    'price'    => '15.25',
    'brand'    => 'Google',
    'category' => 'Apparel',
    'variant'  => 'Gray',
    'quantity' => 1
];
GTM::removeFromCart($product);
```

outputs:

```javascript
dataLayer.push({
    "ecommerce": {
        "remove": {
            "products": [
                {
                    "name": "Triblend Android T-Shirt",
                    "id": "12345",
                    "price": "15.25",
                    "brand": "Google",
                    "category": "Apparel",
                    "variant": "Gray",
                    "quantity": 1
                }
            ]
        }
    },
    "event": "removeFromCart"
});
```

## Pushing a purchase transaction and items

```php
$transaction = [
    'id'          => 'T12345',
    'affiliation' => 'Online Store',
    'revenue'     => '35.43',
    'tax'         => '4.90',
    'shipping'    => '5.99',
    'coupon'      => 'SUMMER_SALE'
];
GTM::purchase($transaction);

$product = [
    'name'     => 'Donut Friday Scented T-Shirt',
    'id'       => '67890',
    'price'    => '33.75',
    'brand'    => 'Google',
    'category' => 'Apparel',
    'variant'  => 'Black',
    'quantity' => 1
];
GTM::purchaseItem($product);
```

outputs:

```javascript
dataLayer.push({
    "ecommerce": {
        "purchase": {
            "actionField": {
                "id": "T12345",
                "affiliation": "Online Store",
                "revenue": "35.43",
                "tax": "4.90",
                "shipping": "5.99",
                "coupon": "SUMMER_SALE",
                "currencyCode": null
            },
            "products": [
                {
                    "name": "Donut Friday Scented T-Shirt",
                    "id": "67890",
                    "price": "33.75",
                    "brand": "Google",
                    "category": "Apparel",
                    "variant": "Black",
                    "quantity": 1
                }
            ]
        }
    }
});
```

## Refunding a transaction or items

### Refunding a transaction

```php
GTM::refundTransaction(10001)
```

outputs:

```javascript
window.dataLayer = window.dataLayer || [];
dataLayer.push({
    "ecommerce": {
        "refund": {
            "actionField": {
                "id": 1001
            }
        }
    }
});
```

### Refunding a transaction item

```php
GTM::refundItem(1001, 999, 1)
```

outputs:

```javascript
window.dataLayer = window.dataLayer || [];
dataLayer.push({
    "ecommerce": {
        "refund": {
            "actionField": {
                "id": 1001
            },
            "products": [
                {
                    "id": 999,
                    "quantity": 1
                }
            ]
        }
    }
});
```