<?php

class IndexController extends BaseController{
	
	public function request() {
				
	 	$this->test = "test to view" . Router::getParam('id');

	 	$this->render('index', 'home');

	 	DebugLogger::log('done');

	}
	
	public function mysql(){

		// Data_MySQL::getInstance();
		$mysql = Data_MySQL::getInstance();
		//$res_select = $mysql->fetchOne("images", array('id'=>'2'));
		//$res_insert = $mysql->insert("images", array('content'=>'testtest','short_content'=>'short_content'));

		$res_update = $mysql->update("images", array('short_content'=>'t','title'=>'PHP'), array('short_content'=>'vahag', 'id'=>2));

		// $res_delete = $crud->delete("images", array('content'=>'testtest'));
		echo $crud->getSQLString();

		DebugLogger::log($crud->getSQLString());
	}

	public function upload() {
				
		$foo = new File_Upload($_FILES['file']); 
		echo $foo->log;
		var_dump($_FILES['file']);
		if ($foo->uploaded) {
			echo ROOT.'uploads';
		   // save uploaded image with no changes
		   $foo->Process(ROOT.'uploads');
		   if ($foo->processed) {
		     echo 'original image copied';
		   } else {
		     echo 'error : ' . $foo->error;
		   }
		   // save uploaded image with a new name
		   $foo->file_new_name_body = 'foo';
		   $foo->Process(ROOT.'uploads');
		   if ($foo->processed) {
		     echo 'image renamed "foo" copied';
		   } else {
		     echo 'error : ' . $foo->error;
		   }   
		   // save uploaded image with a new name,
		   // resized to 100px wide
		   $foo->file_new_name_body = 'image_resized';
		   $foo->image_resize = true;
		   //$foo->image_convert = jpeg;
		   $foo->image_x = 100;
		   $foo->image_ratio_y = true;
		   $foo->Process(ROOT.'uploads');
		   if ($foo->processed) {
		     echo 'image renamed, resized x=100
		           and converted to GIF';
		     $foo->Clean();
		   } else {
		     echo 'error : ' . $foo->error;
		   } 
		}  

		$this->render('upload', 'uploads');

		Data_MySQL::getInstance();

		DebugLogger::log('asd');

	}

	public function image() {
		$foo = new File_Upload(ROOT.'uploads/foo.jpg');
		$foo->file_new_name_body = 'foo-renameddd';
		$foo->image_resize          = true;
		$foo->image_ratio_pixels    = 10000;
		$foo->file_overwrite = true;
		$foo->Process(ROOT.'uploads');
	}

}



