# Installation

## Composer

Add the following to your composer.json file

```json
{  
    "require": {  
        "cyber-duck/silverstripe-google-tag-manager": "1.0.*"
    }
}
```

Run composer and then flush the Silverstripe cache (add ?flush=all to your URL and reload the page)

## Controller

Add the following method to the Page_Controller in your Page.php file located in your code folder. Replace XXXXX with the ID of your container which you can get from the Tag Manager interface. It takes the format GTM-XXXXX, however you don't need to include the GTM part.

```php
class Page_Controller extends ContentController {

    public function TagManager()
    {
        return GTM::snippet('XXXXX');
    }
}
```

Within your Page.ss template or similar add the $TagManager variable after your opening body tag to call your controller method.

```php
<body>
    $TagManager
```

If you wish to load it depending on environment you can do something like below. Generally you will only want tag manager to load in a production environment unless you are debugging in a local development environment or you are filtering your analytics property by hostname.

```php  
<% if IsLive %>
    $TagManager
<% end_if %>
```

## Validating your Search Console property

The Tag Manager snippet will allow your to validate your search console property providing your place it straight after the opening body tag and you have it on your live server / domain.

Next: [Pushing Data](../data)