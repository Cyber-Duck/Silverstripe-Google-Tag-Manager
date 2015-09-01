<?php
/**
 * Google Tag Manager
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
 * @license MIT License https://github.com/Cyber-Duck/Silverstripe-Google-Tag-Manager/blob/master/LICENSE
 * @author  <andrewm@cyber-duck.co.uk>
 **/
class GTM {

	/**
	 * @var array $data Contains any manually set data layer key value pairs
	 */
	private static $data = array();

	/**
	 * @var array $purchase Contains purchase fields and products
	 */
	private static $purchase = array();

	/**
	 * @var array $refunds Contains any refunded products
	 */
	private static $refunds = array();

	/**
	 * Returns the complete data layer and Google Tag Manager snippet. Inject in 
	 * the container ID (GTM-XXXXX). Only the XXXXX part is required for injection.
	 * Creating the data layer and snippet this way stops any issues with data layer
	 * values being populated after the snippet is called.
	 *
	 * @param string $id Your container ID
	 *
	 * @return string
	 */
	public static function snippet($id)
	{
		return self::dataLayer().
		'<!-- Google Tag Manager -->
		<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-TJFKGH"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({\'gtm.start\':
		new Date().getTime(),event:\'gtm.js\'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!=\'dataLayer\'?\'&l=\'+l:\'\';j.async=true;j.src=
		\'//www.googletagmanager.com/gtm.js?id=\'+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,\'script\',\'dataLayer\',\'GTM-'.$id.'\');</script>
		<!-- End Google Tag Manager -->';
	}

	/**
	 * Assign a data layer key value pair. This is be the same as pushing to 
	 * the data layer.
	 *
	 * @param string $key   The data layer key / name
	 * @param string $value The data layer value
	 *
	 * @return void
	 */
	public static function data($key, $value)
	{
		self::$data[$key] = $value;
	}

	/**
	 * Create the data layer code. All things like manually set data layer values
	 * and purchases are processed and built as one data layer. Creating this way 
	 * stops the need of having to set a JavaScript data layer variable initially 
	 * within the page code and stops issues with undefined data layer when pushing.
	 *
	 * @return string
	 */
	public static function dataLayer()
	{
		$javascript = '<script>dataLayer = [{';

		// create an enhanced ecommerce object
		$EnhancedEcommerce = new EnhancedEcommerce();

		// check for any ecommerce data layer values combine their arrays
		$ecommerce = implode(',',
			array_filter(
				array(
					$EnhancedEcommerce->purchase(self::$purchase),
					$EnhancedEcommerce->refund(self::$refunds)
					)
				)
			);

		// wrap any ecommerce data layer values in the ecommerce JSON array
		if($EnhancedEcommerce->show === true) :
			$ecommerce  = "'ecommerce' : {".$ecommerce."}";
		endif;

		// combine all the data layer values into a single data layer
		$javascript .= implode(',',
			array_filter(
				array(
					self::buildData(),
					$ecommerce
					)
				)
			);
		
		$javascript .= '}];</script>';

		return $javascript;
	}

	/**
	 * Set the ecommerce purchase fields
	 *
	 * @param array $params The purchase fields to set
	 *
	 * @return void
	 */
	public static function purchase($params)
	{
		// required fields to check
		$defaults = array(
			'id'          => '',
			'affiliation' => '',
			'revenue'     => '0.00',
			'tax'         => '0.00',
			'shipping'    => '0.00'
			);

		foreach($defaults as $key => $value) :
			if(!isset($params[$key])) :
				$params[$key] = $value;
			endif;
		endforeach;

		self::$purchase['fields'] = $params;
	}

	/**
	 * Set fields for an item within a purchase
	 *
	 * @param array $params The purchased item fields to set
	 *
	 * @return void
	 */
	public static function purchaseItem($params)
	{
		$defaults = array(
			'name'     => '',
			'id'       => ''
			);

		foreach($defaults as $key => $value) :
			if(!isset($params[$key])) :
				$params[$key] = $value;
			endif;
		endforeach;

		self::$purchase['items'][] = $params;
	}

	/**
	 * Add an id to the product refund array
	 *
	 * @param mixed int|array $item An id or array of item ids to refund
	 *
	 * @return void
	 */
	public static function refund($item)
	{
		if(is_array($item)) :
			foreach($item as $id) :
				self::$refunds[] = $id;
			endforeach;
		else :
			self::$refunds[] = $item;
		endif;
	}

	/**
	 * Creates a JSON array formatted string containing our created data layer 
	 * key value pairs.
	 *
	 * @return string
	 */
	private static function buildData()
	{
		$data = array();

		foreach(self::$data as $key => $value) :
			$data[] .= "'".$key."' : '".$value."'";
		endforeach;

		return implode(',',$data);
	}
}