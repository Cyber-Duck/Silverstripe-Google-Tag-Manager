<?php
/**
 * Google Tag Manager Data class
 * This class creates a persistent container for all dataLayer values and is 
 * used by the GTM class to store and retrieve data.
 *
 * @package silverstripe-google-tag-manager
 * @license MIT License https://github.com/cyber-duck/silverstripe-google-tag-manager/blob/master/LICENSE
 * @author  <andrewm@cyber-duck.co.uk>
 **/
class GTMdata {

    /**
     * The Tag Manager dataLayer array of values
     *
     * @var array
     */
    private static $data = array();

    /**
     * The datalayer JSON string
     *
     * @var string
     */
    private static $json = '';

    /**
     * The current dataLayer currency e.g EUR
     *
     * @var string
     */
    private static $currency;

    /**
     * Push a key value pair to the data array
     *
     * @param string $name  DataLayer var name
     * @param mixed  $value DataLayer var value
     * @return void
     */
    public static function pushData($name, $value)
    {
        self::$data[$name] = $value;
    }

    /**
     * Push an event to the data array
     *
     * @param string $name  The event name
     * @return void
     */
    public static function pushEvent($name)
    {
        self::$data['event'] = $name;
    }

    /**
     * Push a transaction currency the data array
     *
     * @param string $code ISO 4217 format currency code e.g. EUR
     * @return void
     */
    public static function pushTransactionCurrency($code)
    {
    	self::$currency = $code;

        self::$data['ecommerce']['currencyCode'] = $code;
    }

    /**
     * Push a product impression to the data array
     *
     * @param array $fields An array of item fields
     * @return void
     */
    public static function pushProductImpression($fields)
    {
        $defaults = array(
            'id'   => '',
            'name' => ''
        );
        self::$data['ecommerce']['impressions'][] = self::getDefaults($fields, $defaults);
    }

    /**
     * Push a product promotional impression to the data array
     *
     * @param array $fields An array of item fields
     * @return void
     */
    public static function pushProductPromoImpression($fields)
    {
        $defaults = array(
            'id'   => '',
            'name' => ''
        );
        self::$data['ecommerce']['promoView']['promotions'][] = self::getDefaults($fields, $defaults);
    }

    /**
     * Push a product detail view fields to the data array
     *
     * @param array $fields An array of a purchase item fields
     * @return void
     */
    public static function pushProductDetail($fields)
    {
        $defaults = array(
            'id'   => '',
            'name' => ''
        );
        self::$data['ecommerce']['detail']['products'][] = self::getDefaults($fields, $defaults);
    }

    /**
     * Push a cart add action to the data array
     *
     * @param array $fields An array of item fields
     * @return void
     */
    public static function pushAddToCart($fields)
    {
        self::pushCartAction('add', 'addToCart', $fields);
    }

    /**
     * Push a cart remove action to the data array
     *
     * @param array $fields An array of item fields
     * @return void
     */
    public static function pushRemoveFromCart($fields)
    {
        self::pushCartAction('remove', 'removeFromCart', $fields);
    }

    /**
     * Push a purchase to the data array
     *
     * @param array $fields An array of purchase fields
     * @return void
     */
    public static function pushPurchase($fields)
    {
        $defaults = array(
            'id'           => '',
            'currencyCode' => self::$currency,
            'affiliation'  => '',
            'revenue'      => '0.00',
            'tax'          => '0.00',
            'shipping'     => '0.00'
        );
        self::$data['ecommerce']['purchase']['actionField'] = self::getDefaults($fields, $defaults);
    }

    /**
     * Push a purchase item fields to the data array
     *
     * @param array $fields An array of a purchase item fields
     * @return void
     */
    public static function pushPurchaseItem($fields)
    {
        $defaults = array(
            'id'   => '',
            'name' => ''
        );
        self::$data['ecommerce']['purchase']['products'][] = self::getDefaults($fields, $defaults);
    }

    /**
     * Push a refund to the data array
     *
     * @param string $id The id of the transaction to refund
     * @return void
     */
    public static function pushRefundTransaction($id)
    {
        self::$data['ecommerce']['refund']['actionField'] = array('id' => $id);
    }

    /**
     * Push a refund item to the data array
     *
     * @param string $id        The id of the transaction
     * @param string $productId The id of the item
     * @param int    $quantity  The quantity to refund
     * @return void
     */
    public static function pushRefundTransactionItem($id, $productId, $quantity)
    {
        self::pushRefundTransaction($id);

        self::$data['ecommerce']['refund']['products'][] = array('id' => $productId, 'quantity' => $quantity);
    }

    /**
     * Push a cart action to the data array
     *
     * @param array $action The cart action
     * @param array $event  The event name of the action
     * @param array $fields An array of item fields
     * @return void
     */
    public static function pushCartAction($action, $event, $fields)
    {
        self::pushCurrent();

        $defaults = array(
            'id'       => '',
            'name'     => '',
            'quantity' => 1
        );
        self::$data['ecommerce'][$action]['products'][] = self::getDefaults($fields, $defaults);

        // add to cart actions require their own event action and push
        self::pushEvent($event);
        self::pushCurrent();
    }

    /**
     * Get the complete formatted dataLayer
     *
     * @return string | null
     */
    public static function getDataLayer()
    {
        self::pushCurrent();

        return self::$json;
    }

    /**
     * Compare an array against an array of required fields for a dataLayer property
     *
     * @param array $fields   Fields to check
     * @param array $defaults Default fields for this array
     * @return array
     */
    private static function getDefaults($fields, $defaults)
    {
        foreach ($defaults as $key => $value) {
            if (!isset($fields[$key])) {
                $fields[$key] = $value;
            }
        }
        return $fields;
    }

    /**
     * Create a dataLayer push from the current data array
     *
     * @return void
     */
    private static function pushCurrent()
    {
        if (!empty(self::$data)) {
            self::$json .= 'dataLayer.push('.json_encode(self::$data, JSON_PRETTY_PRINT).');';
            self::$data = array();
        }
    }

    /**
     * Private constructor
     *
     * @since version 1.0.0
     *
     * @return void
     **/
    private function __construct(){}

    /**
     * Private clone
     *
     * @since version 1.0.0
     *
     * @return void
     **/
    private function __clone(){}

    /**
     * Private wakeup
     *
     * @since version 1.0.0
     *
     * @return void
     **/
    private function __wakeup(){}
}