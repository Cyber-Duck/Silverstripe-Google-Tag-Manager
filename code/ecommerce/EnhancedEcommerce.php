<?php
/**
 * Google Tag Manager Enhanced Ecommerce
 * Ecommerce functionality, tracking, data layer pushing
 *
 * @package silverstripe-blacklist
 * @license MIT License https://github.com/Cyber-Duck/Silverstripe-Google-Tag-Manager/blob/master/LICENSE
 * @author  <andrewm@cyber-duck.co.uk>
 **/
class EnhancedEcommerce {

	/**
	 * Create an ecommerce transaction consisteing of the trnsaction fields and order items
	 *
	 * @param array $order A multidimensional array containing our purchased items
	 * 
	 * @return string
	 */
	private static function purchase($order)
	{
		if(!empty($purchases)) :
			$purchase  = "'ecommerce' : {";
			$purchase .= "'purchase' : {";

			$i = 1;
			// Set the transaction order fields
			$purchase .= "'actionField' : {";
			foreach($order['fields'] as $key => $value) :
				$total = count($order['fields']);

				$purchase .= "'".$key."' : '".$value."'";
				$purchase .= $i < $total ? ',' : '';

				$i++;
			endforeach;
			$purchase .= '},';

			$purchase .= "'products' : [";
			$i = 1;
			// lopp through our products
			foreach($order['items'] as $item) :
				$purchase .= "{";

				$e = 1;
				// loop through the indivdual product attributes
				foreach($item as $key => $value) :
					$purchase .= "'".$key."' : '".$value."'";
					$purchase .= $e < count($item) ? ',' : '';
					$e++;
				endforeach;
				$purchase .= "}";
				$purchase .= $i < count($order['items']) ? ',' : '';

				$i++;
			endforeach;
			$purchase .= ']';

			$purchase .= "}";
			$purchase .= "}";

			return $purchase;
		endif;
	}
}