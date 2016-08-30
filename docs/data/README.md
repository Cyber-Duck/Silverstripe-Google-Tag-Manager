# Pushing Data

## Pushing to the data layer

To push a key value pair to the dataLayer you can simply call the data method within your controller files. You can call the method as many times as you want to push values to the data layer.

```php  
GTM::data('key','value')
```

The key value pairs will generate the necessary data layer JavaScript code

```javascript  
<script>dataLayer = [{
	'key' : 'value'
}];</script>
```

## Pushing an event to the data layer

```php  
GTM::event('MyEvent')
```

```javascript  
<script>dataLayer = [{
	'event' : 'MyEvent'
}];</script>
```

Next: [Pushing Ecommerce data](../ecommerce)