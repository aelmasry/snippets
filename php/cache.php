<?php

//$this->_getObjectCache('filename', expiretime);
protected function _getObjectCache($filename, $expire=60)
{
	$returnData = FALSE ;
	$file = new File(ROOT . DS . APP_DIR . DS .'tmp/cache/'.$filename.'.log');
	$expire_stamp = $file->lastChange()+$expire;
	if ($file->exists() && $expire_stamp >= time()) {
		$returnData = unserialize($file->read());
	}
	
	$file->close();
	
	return $returnData;
}


// $this->_setObjectCache($filename, $data);
protected function _setObjectCache($filename, $data, $expire=60)
{
	$file = new File(ROOT . DS . APP_DIR . DS .'tmp/cache/'.$filename.'.log');
	
	$file->write(serialize($data));
	
	//close
	$file->close();
	
	return ;
}