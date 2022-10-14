<?PHP
header("Access-Control-Allow-Origin: *");
function curlHtml($url) {
	$curl = curl_init();
	curl_setopt_array($curl, array(
	        CURLOPT_URL            => "{$url}",
	        CURLOPT_RETURNTRANSFER => true,
	        CURLOPT_ENCODING       => "",
	        CURLOPT_MAXREDIRS      => 10,
	        CURLOPT_TIMEOUT        => 30,
	        CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
	        CURLOPT_CUSTOMREQUEST  => "GET",
	        CURLOPT_HTTPHEADER     => array(
	            "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8",
	            "Accept-Encoding: gzip, deflate, br",
	            "Accept-Language: zh-CN,zh;q=0.9",
	            "Cache-Control: no-cache",
	            "Connection: keep-alive",
	            "Pragma: no-cache",
	            "Upgrade-Insecure-Requests: 1",
	            "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36",
	            "cache-control: no-cache"
	        ),
	    ));
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);
	if ($err) return false; else return $response;
}
function get_html_data($html,$path,$tag=1,$type=true) {
	$dom = new \DOMDocument();
	@$dom->loadHTML("<?xml encoding='UTF-8'>" . $html);
	// 从一个字符串加载HTML并设置UTF8编码
	$dom->normalize();
	// 使该HTML规范化
	$xpath = new \DOMXPath($dom);
	//用DOMXpath加载DOM，用于查询
	$contents = $xpath->query($path);
	// 获取所有内容
	$data = [];
	foreach ($contents as $value) {
		if ($tag==1) {
			$data[] = $value->nodeValue;
			// 获取不带标签内容
		} elseif ($tag==2) {
			$data[] = $dom->saveHtml($value);
			// 获取带标签内容
		} else {
			$data[] = $value->attributes->getNamedItem($tag)->nodeValue;
			// 获取attr内容
		}
	}
	if (count($data)==1) {
		$data = $data[0];
	}
	return $data;
}

$word=$_GET['word'];
$html=curlHtml("http://dict.youdao.com/example/".$word."/#keyfrom=dict2.top");
echo str_replace("ul","dl",get_html_data($html,"/html/body/div[1]/div[2]/div[1]/div[2]/div[2]",2,true));
?>