<?php
class DebugLogger{

	public static function log($data){
		//echo serialize(Router::getParams());
		// echo serialize("\nasdfasd\n");
		//write data to log file //path defined in config
		//
		if(is_array($data) || is_object($data)){
			$data = serialize($data);
		}
		// else{
		// 	settype($data, "string");
		// }

		file_put_contents(LOG_FILE_PATH, "\n$data\n", FILE_APPEND);
	}
	
}
?>