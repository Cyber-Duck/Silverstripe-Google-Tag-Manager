<?php
/**
 * Googel Tag Manager
 *
 * @package silverstripe-blacklist
 * @license MIT License https://github.com/Andrew-Mc-Cormack/Silverstripe-Blacklist/blob/master/LICENSE
 * @author  <andrewm@cyber-duck.co.uk>
 **/
class GTM {

	private static $containerID = '';

	private static $data = array();

	private static $ecommerce = array();

	private static $val;

	public static function id()
	{
		return self::$containerID;
	}

	public static function data($key, $value)
	{
		self::$data[$key] = $value;
	}

	public static function dataLayer()
	{
		self::$val .= '<script>';
		self::$val .= 'dataLayer = [{';

		self::$val .= self::buildData();
		self::$val .= self::buildOrder();
		
		self::$val .= '}];';
		self::$val .= '</script>';

		return self::$val;
	}

	public static function order($params)
	{
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

	private static function buildData()
	{
		if(!empty(self::$data)) :

			$total = count(self::$data);
			$i = 1;

			foreach(self::$data as $key => $value) :
				self::$val .= "'".$key."' : '".$value."'";
				self::$val .= $i < $total ? ',' : '';
				$i++;
			endforeach;
		endif;
	}

	private static function buildOrder()
	{
		if(!empty(self::$ecommerce)) :
			if(!empty(self::$data)) :
				self::$val.= ',';
			endif;
			self::$val .= "'ecommerce' : {";
			self::$val .= "'purchase' : {";

			$i = 1;
			self::$val .= "'actionField' : {";
			foreach(self::$ecommerce['fields'] as $key => $value) :
				$total = count(self::$ecommerce['fields']);

				self::$val .= "'".$key."' : '".$value."'";
				self::$val .= $i < $total ? ',' : '';

				$i++;
			endforeach;
			self::$val .= '},';

			self::$val .= "'products' : [";
			$i = 1;
			foreach(self::$ecommerce['items'] as $item) :
				self::$val .= "{";

				$e = 1;
				foreach($item as $key => $value) :
					self::$val .= "'".$key."' : '".$value."'";
					self::$val .= $e < count($item) ? ',' : '';
					$e++;
				endforeach;
				self::$val .= "}";
				self::$val .= $i < count(self::$ecommerce['items']) ? ',' : '';

				$i++;
			endforeach;
			self::$val .= ']';

				
			self::$val .= "}";
			self::$val .= "}";
		endif;
	}
}