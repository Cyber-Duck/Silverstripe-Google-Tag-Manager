# Pushing Data

## Pushing to the data layer

To push a key value pair to the dataLayer you can simply call the data method within your controller files. You can call the method as many times as you want to push values to the data layer. The key value pairs will generate the necessary data layer JavaScript code.

```php  
GTM::data('key','value')
```

outputs:

```javascript  
window.dataLayer = window.dataLayer || [];
dataLayer = [{
	'key' : 'value'
}];
```

## Pushing an event to the data layer

Events play a very important part in a lot of custom Google Tag manager tracking. You can push an event easily with the event method.

```php  
GTM::event('MyEvent')
```

outputs:

```javascript  
dataLayer = [{
	'event' : 'MyEvent'
}];
```

Next: [Pushing Ecommerce data](../ecommerce)