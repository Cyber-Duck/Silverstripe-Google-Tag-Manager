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

	private static function purchase($ecommerce)
	{
		if(!empty(self::$ecommerce)) :
			if(!empty(self::$data)) :
				self::$val.= ',';
			endif;
			$purchase  = "'ecommerce' : {";
			$purchase .= "'purchase' : {";

			$i = 1;
			$purchase .= "'actionField' : {";
			foreach($ecommerce['fields'] as $key => $value) :
				$total = count(self::$ecommerce['fields']);

				$purchase .= "'".$key."' : '".$value."'";
				$purchase .= $i < $total ? ',' : '';

				$i++;
			endforeach;
			$purchase .= '},';

			$purchase .= "'products' : [";
			$i = 1;
			foreach($ecommerce['items'] as $item) :
				$purchase .= "{";

				$e = 1;
				foreach($item as $key => $value) :
					$purchase .= "'".$key."' : '".$value."'";
					$purchase .= $e < count($item) ? ',' : '';
					$e++;
				endforeach;
				$purchase .= "}";
				$purchase .= $i < count($ecommerce['items']) ? ',' : '';

				$i++;
			endforeach;
			$purchase .= ']';

			$purchase .= "}";
			$purchase .= "}";
		endif;
	}
}