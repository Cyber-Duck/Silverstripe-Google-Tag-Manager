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
	 * @var boolean $false Set whether the ecommerce data layer should show
	 */
	public $show = false;

	/**
	 * Create an ecommerce transaction consisting of the transaction fields and order items
	 *
	 * @param array $order A multidimensional array containing our purchase fields and items
	 * 
	 * @return string
	 */
	public function purchase($order)
	{
		if(!empty($order)) :
			$data = "'purchase' : {";

			$i = 1;
			// Set the transaction order fields
			$data .= "'actionField' : {";
			foreach($order['fields'] as $key => $value) :
				$total = count($order['fields']);

				$data .= "'".$key."' : '".$value."'";
				$data .= $i < $total ? ',' : '';

				$i++;
			endforeach;
			$data .= '},';

			$data .= "'products' : [";
			$i = 1;
			// lopp through our products
			foreach($order['items'] as $item) :
				$data .= "{";

				$e = 1;
				// loop through the indivdual product attributes
				foreach($item as $key => $value) :
					$data .= "'".$key."' : '".$value."'";
					$data .= $e < count($item) ? ',' : '';
					$e++;
				endforeach;
				$data .= "}";
				$data .= $i < count($order['items']) ? ',' : '';

				$i++;
			endforeach;
			$data .= ']';

			$data .= "}";

			$this->show = true;

			return $data;
		endif;
	}

	/**
	 * Create an ecommerce refund consisting of the transactions to refund
	 *
	 * @param array $ids An array of transaction ids to refund
	 * 
	 * @return string
	 */
	public function refund($ids)
	{
		if(!empty($ids)) :
			$transactions = array();

			$data = "
			'refund' : {
				'actionField' : [";

			foreach($ids as $id) :
				$transactions[] = "{'id' : '".$id."'}";
			endforeach;

			$data .= implode(',',$transactions);
			$data .= "
				]
			}";

			$this->show = true;

			return $data;
		endif;
	}

	public function productImpression()
	{

	}

	public function productClick()
	{
		
	}

	public function productDetail()
	{
		
	}

	public function cartAdd()
	{
		
	}

	public function cartRemove()
	{
		
	}

	public function promotionImpression()
	{
		
	}

	public function promotionClick()
	{
		
	}

	public function checkoutStep($number = 1)
	{
		
	}

	public function checkoutOption()
	{
		
	}

	public function partialRefund()
	{
		
	}
}