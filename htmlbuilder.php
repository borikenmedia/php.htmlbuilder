<?php
namespace myphp;
session_start();
error_reporting(E_ERROR|E_PARSE|E_NOTICE|E_WARNING);
date_default_timezone_set("America/Puerto_Rico");
header("Content-type: text/html; Charset: utf-8; Pragma: no-cache;");

/* Minthread CMS v2 Release Under LGPL3 By dyewilliam */

class htmlbuilder{
	
	var $_path = __FILE__;
	var $_str;
	var $_array;
	const DIRECTORY_SEPARATOR = "###############";
	
	public function __construct($_html = "template.html.php"){
		$this->_path = $_html;
		/* Assign the _Path to the _Html file */
		$this->createhtml();
		/* Load Read and Match Elements for replacement in the _Html file */
		$this->_alphanumeric = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
		$this->_rand = substr(str_shuffle($this->_alphanumeric), 0, rand(10, 25));
		$this->collate("changelogs.data.txt", $this->_rand);
		/* Assign a registry changelog and behaviour to the file */
		return($this);
	}
	
	private function createhtml(){
		$this->_str = "ITEM";
		$this->_path = file_get_contents($this->_path,FILE_USE_INCLUDE_PATH);
		/* Find Load And Read The _Html Document to Handle */
		$this->setter("Title", "Boriken Media Subs");
		$this->setter("Style", $this->getter("stylesheet.css.php"));
		$this->setter("Sitemap", "Welcome");
		$this->setter("Sidebar", "SIDEBAR_MENU");
		$this->setter("Data", "Content body");
		$this->setter("Content", "Copyright");
		/* Assign an Associative Array, Elements, Values and Behaviour for Content */
		foreach($this->_array as $key => $item){
			$_handle = (file_exists($item))? include($item): $item;
			$this->_path = preg_replace("/{{$key}}/", $_handle, $this->_path);
		}
		/* Find Match And Replace Elements in the _Read _Html _Source */
		return($this);
	}
	
	private function setter(string $str, string $value):void{
		$this->_array[$str] = $value;
	}
	
	private function getter($str = "STRING"){
		if(file_exists($str)){
			$fp = fopen($str, "r");
			$_value = fread($fp, filesize($str));
			fclose($fp);
		}else{
			throw new \Exception("Error: The requested {$str} is not available or not found", 1);
			$_value = false;
		}
		/* Find Open And Read Items Files And Return The Content __BINARYSAFE__ */
		return($_value);
	}
	
	public function sortstr(){}
	
	public function remove($_char, $_piece, $_amount){}
	
	private function collate($_file, $_data = "SESSION"):bool{
		$fp = fopen($_file, "a");
		$ds = htmlbuilder::DIRECTORY_SEPARATOR;
		if(!file_exists($_file)){
			$fp = fopen($_file, "a");
			fwrite($fp, "Address: ".$_SERVER["REMOTE_ADDR"]."\nRequest: ".$_SERVER["REQUEST_URI"]."\nBrowser: ".$_SERVER["HTTP_USER_AGENT"]."\nDate: ".date("D M d, Y h:ia")."\n{$ds} NEW ITEM (Session ID: {$_data}) {$ds}\n");
			fclose($fp);
		}else{
			fwrite($fp, "Address: ".$_SERVER["REMOTE_ADDR"]."\nRequest: ".$_SERVER["REQUEST_URI"]."\nBrowser: ".$_SERVER["HTTP_USER_AGENT"]."\nDate: ".date("D M d, Y h:ia")."\n{$ds} NEW ITEM (Session ID: {$_data}) {$ds}\n");
			fclose($fp);
		}
		return((bool) true);
	}
}

$app = new htmlbuilder();

echo($app->_path);

?>
