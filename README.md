# Silverstripe - Google Tag Manager

[![Latest Stable Version](https://poser.pugx.org/cyber-duck/silverstripe-google-tag-manager/v/stable)](https://packagist.org/packages/cyber-duck/silverstripe-google-tag-manager)
[![Total Downloads](https://poser.pugx.org/cyber-duck/silverstripe-google-tag-manager/downloads)](https://packagist.org/packages/cyber-duck/silverstripe-google-tag-manager)
[![License](https://poser.pugx.org/cyber-duck/silverstripe-google-tag-manager/license)](https://packagist.org/packages/cyber-duck/silverstripe-google-tag-manager)

Author: [Andrew Mc Cormack](https://github.com/Andrew-Mc-Cormack)

A Silverstripe module to add Google Tag Manager Version 2 datalayer, event, and ecommerce integration. Using simple functions push any values you want to the datalayer for full Tag Manager integration within Silverstripe. The module genreates a formatted json dataLayer which can be accessed easily through the Google Tag Manager UI. 

## Features

  - Push datalayer key value pairs easily
  - Push events to trigger Tag Manager tags
  - Set ecommerce currency code
  - Set product impressions
  - Set product promotions
  - Set product detail views
  - Set add to cart actions
  - Set remove from cart actions
  - Set purchase data / purchase item data
  - Set refund transactions / transaction item(s)
  - Supports multiple exommerce actions on each page


## Guides
  
  - [Installation](/docs/installation)
    - [Composer](/docs/installation#composer)
    - [Controller and View](/docs/installation#controller-and-view)
    - [Validating your Search Console property](/docs/installation#validating-your-search-console-property)
  - [Pushing Data](/docs/data)
    - [Pushing to the data layer](/docs/data#pushing-to-the-data-layer)
    - [Pushing an event to the data layer](/docs/data#pushing-an-event-to-the-data-layer)
  - [Pushing Ecommerce Data](/docs/ecommerce)
    - [Setting the ecommerce currency](/docs/ecommerce#setting-the-ecommerce-currency)
    - [Pushing a product impression](/docs/ecommerce#pushing-a-product-impression)
    - [Pushing a product promotion impression](/docs/ecommerce#pushing-a-product-promotion-impression)
    - [Pushing a product detail view](/docs/ecommerce#pushing-a-product-detail-view)
    - [Pushing an add to cart action](/docs/ecommerce#pushing-an-add-to-cart-action)
    - [Pushing a remove from cart action](/docs/ecommerce#pushing-a-remove-from-cart-action)
    - [Pushing a purchase transaction and items](/docs/ecommerce#pushing-a-purchase-transaction-and-items)
    - [Refunding a transaction or items](/docs/ecommerce#refunding-a-transaction-or-items)

## License

```
Copyright (c) 2016, Andrew Mc Cormack <andrewm@cyber-duck.co.uk>.
All rights reserved.

Redistribution and use in source and binary forms, with or without
modification, are permitted provided that the following conditions
are met:

    * Redistributions of source code must retain the above copyright
      notice, this list of conditions and the following disclaimer.

    * Redistributions in binary form must reproduce the above copyright
      notice, this list of conditions and the following disclaimer in
      the documentation and/or other materials provided with the
      distribution.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
"AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
POSSIBILITY OF SUCH DAMAGE.
```