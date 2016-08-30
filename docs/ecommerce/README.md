# Pushing Ecommerce Data

## Setting the ecommerce currency

```php
GTM::transactionCurrency('EUR');
```

```javascript
window.dataLayer = window.dataLayer || [];
dataLayer.push({
    "ecommerce": {
        "currencyCode": "EUR"
    }
});
```

## Pushing a product impression

```php

$impression = array(
    'name'     => 'Triblend Android T-Shirt',
    'id'       => '12345',
    'price'    => '15.25',
    'brand'    => 'Google',
    'category' => 'Apparel',
    'variant'  => 'Gray',
    'list'     => 'Search Results',
    'position' => 1
);

GTM::productImpression($product)
```

```javascript
window.dataLayer = window.dataLayer || [];
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

## Pushing a product promotion

```php
GTM::productPromoImpression($product)
```

## Pushing a product detail view

```php
GTM::productDetail($product)
```

## Pushing an add to cart action

```php
GTM::addToCart($product)
```

## Pushing an remove from cart action

```php
GTM::removeFromCart($product)
```

## Pushing a purchase transaction and items

```php
GTM::purchase($product)

GTM::purchaseItem($product)
```

```

## Refundign a transaction or items

```php
GTM::refundTransaction($product)

GTM::refundItem($product)
```