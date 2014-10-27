<?php 
$blogpost['title'] = 'بوابة القاهرة الإخبارية';
$blogpost['postlink'] = 'http://www.cairoportal.com/';

$URL = 'http://rpc.pingomatic.com';
$parse = parse_url($URL);
if (!isset($parse['host']))
	return false;
$host = $parse['host'];
$scheme = $parse['scheme'] . "://";
$port = isset($parse['port']) ? $parse['port'] : 80;
$uri = isset($parse['path']) ? $parse['path'] : '/';



$fp = fsockopen($host, $port, $errno, $errstr);
//$fp=fsockopen($URL,$port,$errno,$errstr);
if (!$fp) {
	return array(-1, "Cannot open connection: $errstr ($errno)<br />\r\n");
}

//Set methodname according to ping type
$methodName = "weblogUpdates.ping";

$data = "<?xml version=\"1.0\"?>\r\n
<methodCall>\r\n
	<methodName>" . $methodName . "</methodName>\r\n
	<params>\r\n
		<param>\r\n
			<value><string>" . $blogpost['title'] . "</string></value>\r\n
		</param>\r\n
		<param>\r\n
			<value><string>" . $blogpost['postlink'] . "</string></value>\r\n
		</param>\r\n
	</params>\r\n
</methodCall>";


$len = strlen($data);
$out = "POST $uri HTTP/1.0\r\n";
$out .= "User-Agent: BlogPing 1.0\r\n";
$out .= "Host: $host\r\n";
$out .= "Content-Type: text/xml\r\n";
$out .= "Content-length: $len\r\n\r\n";
$out .= $data;

fwrite($fp, $out);
$response = '';
while (!feof($fp))
	$response.=fgets($fp, 128);
fclose($fp);

echo '<pre>';
print_r($response);
echo '</pre>';