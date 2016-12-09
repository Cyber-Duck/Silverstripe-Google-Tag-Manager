<?php
/**
 * GTM
 *
 * A module to allow the easy implementation of Google Tag Manager within the 
 * Silverstripe framework. The GTM module is meant to cater for any features of 
 * Google Tag Manager that must be "hard coded" with a page. Data layer variables 
 * and ecommerce features such as purchases can be easily be inserted within a page 
 * through your controller functionality without having to edit your ss templates.
 * Instead of building the datalayer JavScript straight away, all data layer values 
 * are stored in static arrays which are converted into JavScript once we call our
 * Tag Manager snippet. 
 *
 * @package silverstripe-google-tag-manager
 * @license MIT License https://github.com/cyber-duck/silverstripe-google-tag-manager/blob/master/LICENSE
 * @author  <andrewm@cyber-duck.co.uk>
 **/
class GTM
{
    /**
     * Returns the complete data layer and Google Tag Manager snippet. Inject in 
     * the container ID (GTM-XXXXX). Only the XXXXX part is required for injection.
     * Creating the data layer and snippet this way stops any issues with data layer
     * values being populated after the snippet is called.
     *
     * @since 1.0.0
     *
     * @param string $id Your container ID
     *
     * @return string
     */
    public static function snippet($id)
    {
        return Controller::curr()->customise([
            'ID'   => $id, 
            'Data' => GTMdata::getDataLayer()
        ])->renderWith('TagManager');
    }

    /**
     * Set a dataLayer key value pair
     *
     * @since 1.0.0
     *
     * @param string $name  DataLayer var name
     * @param mixed  $value DataLayer var value
     *
     * @return void
     */
    public static function data($name, $value)
    {
        GTMdata::pushData($name, $value);
    }

    /**
     * Push an event to the dataLayer
     *
     * @since 1.0.0
     *
     * @param string $name  The event name
     *
     * @return void
     */
    public static function event($name)
    {
        GTMdata::pushEvent($name);
    }

    /**
     * Add the ecommerce transaction currency code
     *
     * @since 1.0.0
     *
     * @param string $code ISO 4217 format currency code e.g. EUR
     *
     * @return void
     */
    public static function transactionCurrency($code)
    {
        GTMdata::pushTransactionCurrency($code);
    }

    /**
     * Record a product impression
     *
     * @since 1.0.0
     *
     * @param mixed $product An array of item fields
     *
     * @return void
     */
    public static function productImpression($product)
    {
        GTMdata::pushProductImpression($product);
    }

    /**
     * Record a product impression in a promotional space
     *
     * @since 1.0.0
     *
     * @param mixed $product An array of item fields
     *
     * @return void
     */
    public static function productPromoImpression($product)
    {
        GTMdata::pushProductPromoImpression($product);
    }

    /**
     * Record a product detail page
     *
     * @since 1.0.0
     *
     * @param mixed $product An array of item fields
     *
     * @return void
     */
    public static function productDetail($product)
    {
        GTMdata::pushProductDetail($product);
    }

    /**
     * Record a product being added to the cart
     *
     * @since 1.0.0
     *
     * @param mixed $product An array of item fields
     *
     * @return void
     */
    public static function addToCart($product)
    {
        GTMdata::pushAddToCart($product);
    }

    /**
     * Record a product being removed from the cart
     *
     * @since 1.0.0
     *
     * @param mixed $product An array of item fields
     *
     * @return void
     */
    public static function removeFromCart($product)
    {
        GTMdata::pushRemoveFromCart($product);
    }

    /**
     * Add an ecommerce transaction
     *
     * @since 1.0.0
     *
     * @param array $fields An array of purchase fields
     *
     * @return void
     */
    public static function purchase($fields)
    {
        GTMdata::pushPurchase($fields);
    }

    /**
     * Add an ecommerce transaction item
     * Used in conjunction with ->purchase()
     *
     * @since 1.0.0
     *
     * @param mixed $product An array of item fields
     *
     * @return void
     */
    public static function purchaseItem($product)
    {
        GTMdata::pushPurchaseItem($product);
    }

    /**
     * Refund an ecommerce transaction
     *
     * @since 1.0.0
     *
     * @param string $id The id of the transaction to refund
     *
     * @return void
     */
    public static function refundTransaction($id)
    {
        GTMdata::pushRefundTransaction($id);
    }

    /**
     * Refund an ecommerce transaction item
     *
     * @since 1.0.0
     *
     * @param string $id        The id of the transaction
     * @param string $productId The id of the item
     * @param int    $quantity  The quantity to refund
     *
     * @return void
     */
    public static function refundItem($id, $productId, $quantity)
    {
        GTMdata::pushRefundTransactionItem($id, $productId, $quantity);
    }
}