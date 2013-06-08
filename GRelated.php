<?php 

/*

	Desc : Simple tool for get google images related search query

*/
	
Class GRelated {

	function __construct()
	{
		include('dom.php');
	}

	public function get($query)
	{
		$url = "http://www.google.com/search?q=".urlencode($query)."&sout=1&tbm=isch";

		
		
		$googleRes = $this->curl_download($url);

		$html = str_get_html($googleRes);

		$res = array();
		foreach($html->find('.msrl') as $key => $related){
			$res[$key] = $related->plaintext;
		}

		return json_encode($res);
	}

	protected function curl_download($url)
	{
		$userAgent = 'Mozilla/5.0 (X11; U; Linux x86_64; en-US; rv:1.9.2.3) Gecko/20100423 Ubuntu/10.04 (lucid) Firefox/3.6.3';
		$ch = curl_init($url);
		curl_setopt_array($ch, array(
		    CURLOPT_RETURNTRANSFER => true,
		    CURLOPT_USERAGENT => $userAgent,
		)); 
		$result = curl_exec($ch);
		curl_close($ch);

		return $result;
	}
}

// get input from GET
$query = $_GET['query'];

$foo = new GRelated;
echo $foo->get($query);

 ?>