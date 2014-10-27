<?php
// enable error debug
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);
//https://snipt.net/public/
// get visitor IP address
function getRealIPAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
        $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
        $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
        $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

// curl post
function curlUsingPost($url, $data)
{

    if(empty($url) OR empty($data))
    {
        return 'Error: invalid Url or Data';
    }

   
    //url-ify the data for the POST
    $fields_string = '';
    foreach($data as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
    $fields_string = rtrim($fields_string,'&');


    //open connection
    $ch = curl_init();

    //set the url, number of POST vars, POST data
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_POST,count($data));
    curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);

    curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,10); # timeout after 10 seconds, you can increase it
   //curl_setopt($ch,CURLOPT_HEADER,false);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);  # Set curl to return the data instead of printing it to the browser.
   curl_setopt($ch,  CURLOPT_USERAGENT , "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)"); # Some server may refuse your request if you dont pass user agent

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    //execute post
    $result = curl_exec($ch);

    //close connection
    curl_close($ch);
    return $result;
}

// curl by Get
function curlUsingGet($url, $data)
{

    if(empty($url) OR empty($data))
    {
    return 'Error: invalid Url or Data';
    }

    //url-ify the data for the get  : Actually create datastring
    $fields_string = '';

    foreach($data as $key=&gt;$value){
    $fields_string[]=$key.'='.urlencode($value).'&amp;'; }
    $urlStringData = $url.'?'.implode('&amp;',$fields_string);

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Set curl to return the data instead of printing it to the browser.
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,10); # timeout after 10 seconds, you can increase it
   curl_setopt($ch, CURLOPT_USERAGENT , "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
    curl_setopt($ch, CURLOPT_URL, $urlStringData ); #set the url and get string together

    $return = curl_exec($ch);
    curl_close($ch);

    return $return;
}

// create arabic url slug remove (~, #,!, ., ?)
function createSlug($string=NULL)
{
	$strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "=", "+", "[", "{", "]",
                   "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
                   "â€”", "â€“", ",", "<", ".", ">", "/", "?", "»", "«", "\"\ ", "?");
	if(!is_null($string)) {
		$string = trim(str_replace($strip, "", strip_tags($string)));
        // $string = preg_replace('/[»"!?,.-]+/', '', trim($string));
        $string = preg_replace('/[-\s]+/', '_', $string);
    }
	
	return $string;
}

//Encode/Decode URL Data As Base64 In PHP
function base64UrlEncode($data)
{
  return strtr(rtrim(base64_encode($data), '='), '+/', '-_');
}

function base64UrlDecode($base64)
{
  return base64_decode(strtr($base64, '-_', '+/'));
}