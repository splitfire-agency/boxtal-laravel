<?php
/** 
 * EnvoiMoinsCher API order status class.
 * 
 * It can be used to load informations about passed order (label availability, carrier reference). 
 * @package Env
 * @author EnvoiMoinsCher <informationAPI@envoimoinscher.com>
 * @version 1.0
 */

class Env_OrderStatus extends Env_WebService
{

	/** 
	 * Contains order informations.
	 * <samp>
	 * Structure :<br>
	 * $order_info		 			=> array(<br>
	 * &nbsp;&nbsp;['emcRef'] 					=> data<br>
	 * &nbsp;&nbsp;['state'] 					=> data<br>
	 * &nbsp;&nbsp;['opeRef'] 					=> data<br>
	 * &nbsp;&nbsp;['labelAvailable']	=> data<br>
	 * &nbsp;&nbsp;['labelUrl'] 				=> data<br>
	 * &nbsp;&nbsp;['labels'][x]				=> data<br>
	 * )
	 * </samp>
	 * @access public
	 * @var array
	 */
	public $order_info = array('emcRef' => '', 'state' => '', 'opeRef' => '', 'labelAvailable' => false);

	/**
	 * Function loads all categories.
	 * @param $reference : folder reference
	 * @access public
	 * @return Void
	 */
	public function getOrderInformations($reference)
	{
		$this->setOptions(array('action' => '/api/v1/order_status/'.$reference.'/informations'));
		$this->doStatusRequest();
	}

	/** 
	 * Function executes order request and prepares the $order_info array.
	 * @access private
	 * @return Void
	 */
	private function doStatusRequest()
	{
		$source = parent::doRequest();

		/* We make sure there is an XML answer and try to parse it */
		if ($source !== false)
		{
			parent::parseResponse($source);
			if (count($this->resp_errors_list) == 0)
			{
				/* The XML file is loaded, we now gather the datas */
				$labels = array();
				$order_labels = $this->xpath->evaluate('/order/labels');
				foreach ($order_labels as $label_index => $label)
					$labels[$label_index] = $label->nodeValue;
				$documents = array();
				$order_documents = $this->xpath->evaluate('/order/documents');
				foreach ($order_documents as $docs)
					$documents[$docs->nodeName] = $docs->nodeValue;
				$this->order_info = array(
					'emcRef' => $this->xpath->evaluate('/order/emc_reference')->item(0)->nodeValue,
					'state' => $this->xpath->evaluate('/order/state')->item(0)->nodeValue,
					'opeRef' => $this->xpath->evaluate('/order/carrier_reference')->item(0)->nodeValue,
					'labelAvailable' => (bool)$this->xpath->evaluate('/order/label_available')->item(0)->nodeValue,
					'labelUrl' => $this->xpath->evaluate('/order/label_url')->item(0)->nodeValue,
					'labels' => $labels,
					'documents' => $documents);
			}
		}
	}
}

?>
