<?php
namespace myphp;
session_start();
error_reporting(E_ERROR|E_PARSE|E_NOTICE|E_WARNING);
date_default_timezone_set("America/Puerto_Rico");
header("Content-type: text/html; Charset: utf-8; Pragma: no-cache;");

/* Minthread CMS v2 Release Under LGPL3 By dyewilliam */

class htmlbuilder{
	
	var $_path;
	private $_str;
	
	public function __construct($_html = "template.html.php"){
		$this->_path = $_html;
		$this->createhtml();
		return($this);
	}
	
	private function createhtml(){
		$this->_str = "ITEM";
		$this->_path = file_get_contents($this->_path,FILE_USE_INCLUDE_PATH);
		$_values = array();
		$_values["title"] = "Boriken Media Subs";
		$_values["Style"] = $this->_get("./stylesheet.css.php");
		$_values["COntent"] = "<h2>Under Construction</h2>";
		foreach($_values as $key => $item){
			$_handle = (file_exists($item))? include($item): $item;
			$this->_path = preg_replace("/{{$key}}/", $_handle, $this->_path);
		}
		return($this);
	}
	
	public function _set($str = "STRING"){}
	
	private function _get($str = "STRING"){
		if(file_exists($str)){
			$fp = fopen($str, "r");
			$_value = fread($fp, filesize($str));
			fclose($fp);
		}else{
			throw new \Exception("Error: The reuested {$str} is not available or not found", 1);
			$_value = false;
		}
		return($_value);
	}
	
	public function sortstr(){}
	
	public function remove($_char, $_piece, $_amount){}
}

$app = new htmlbuilder();

echo($app->_path);

?>