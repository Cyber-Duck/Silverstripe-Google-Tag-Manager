<?php
/**
 * Google Tag Manager
 * A module to allow the easy implementation of Google Tag Manager within a framework
 *
 * @package silverstripe-blacklist
 * @license MIT License https://github.com/Cyber-Duck/Silverstripe-Google-Tag-Manager/blob/master/LICENSE
 * @author  <andrewm@cyber-duck.co.uk>
 **/
class GTM {

	/**
	 * @var array $data Our datalayer key value pairs
	 */
	private static $data = array();

	/**
	 * @var array $ecommerce Our ecommerce transaction items
	 */
	private static $ecommerce = array();

	/**
	 * Returns our data layer and Google Tag Manager snippet. Inject in your container
	 * ID in the format XXXXX.
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
	 * Assign a data layer key value pair
	 *
	 * @param string $key   The array key
	 * @param string $value The array value
	 *
	 * @return void
	 */
	public static function data($key, $value)
	{
		self::$data[$key] = $value;
	}

	/**
	 * Create the data layer code
	 *
	 * @return string
	 */
	public static function dataLayer()
	{
		if(empty(self::$data) && empty(self::$ecommerce)) :
			return false;
		endif;

		$javascript = '<script>dataLayer = [{';

		// add any data layer values populated from the data method
		$javascript .= self::buildData();
		if(!empty(self::$data) && !empty(self::$ecommerce)) :
			$javascript.= ',';
		endif;

		// add enhanced ecommerce data layer values if they are set
		if(!empty(self::$ecommerce)) :
			$ecommerce = new EnhancedEcommerce();

			$javascript .= $ecommerce->purchase(self::$ecommerce);
		endif;
		
		$javascript .= '}];</script>';

		return $javascript;
	}

	/**
	 * Set the ecommerce transaction fields
	 *
	 * @return void
	 */
	public static function order($params)
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

		self::$ecommerce['fields'] = $params;
	}

	/**
	 * Set fields for a product within a purchase
	 *
	 * @return void
	 */
	public static function orderItem($params)
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

		self::$ecommerce['items'][] = $params;
	}

	/**
	 * Creates a json array formatted string containing our data layer key value pairs
	 *
	 * @return void
	 */
	private static function buildData()
	{
		if(!empty(self::$data)) :

			$total = count(self::$data);
			$javascript = '';
			$i = 1;

			foreach(self::$data as $key => $value) :
				$javascript .= "'".$key."' : '".$value."'";
				$javascript .= $i < $total ? ',' : '';
				$i++;
			endforeach;

			return $javascript;
		endif;
	}
}