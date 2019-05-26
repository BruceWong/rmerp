<?php


	header("Content-type: text/html; charset=utf-8"); 
	include_once("00alphaID.php"); 
	$login_name                        = getUsername();
	if(empty($login_name)){exit;}
	if(!empty($_COOKIE['opg'])){
		$op_group                      = $_COOKIE['opg']; 
	} 
	if(!empty($_COOKIE['rm'])){
		$real_name                     = $_COOKIE['rm'];
	}else{
		$real_name                     = $login_name;
	}
	if(!empty($_COOKIE['job_grade'])){
		$job_grade                     = $_COOKIE['job_grade'];
	}

	// http://blog.csdn.net/liuzhaopds/article/details/8941320 
	// application/x-zip-compressed 【rar zip 】

	// http://blog.csdn.net/niushuai666/article/details/6601982 
	$canUpFileType=array('image/png','image/jpeg','image/jpg','image/pjpeg','image/gif','application/octet-stream','application/zip','application/x-zip-compressed','application/msword','application/msword','application/pdf','application/vnd.ms-excel','video/avi','video/mp4','application/vnd.openxmlformats-officedocument.wordprocessingml.document','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

	$up_file_error_message_arr = array(
        0=>"There is no error, the file uploaded with success", 
        1=>"上传的文件超过了php.ini中 upload_max_filesize 选项限制的值！", 
        2=>"上传文件的大小超过了HTML表单中MAX_FILE_SIZE选项指定的值！",
        3=>"文件只有部分被上传", 
        4=>"没有文件被上传！", 
        6=>"缺乏临时文件目录Missing a temporary folder" 
        //-3=>"上传失败" 
        //-4=>"建立存放上传文件目录失败，请重新指定上传目录" 
	);

	if(!empty($_GET['fname'])){
		$file_rename                   = $_GET['fname'];
		$file_rename0                  = $file_rename;

		// utf-8 的文件名会乱码，需要转成 gb2312
		//$log  = date("H:i:s")." 41 行 fname 【".$file_rename." 】\r\n\r\n";
		//file_put_contents("log/".date("Y-m-d").".fileupload.php.log",$log,FILE_APPEND);

		//$file_rename                 = iconv("utf-8","gb2312",$file_rename);
		// XAMPP 系统下的 APACHE处理用的应该是GBK  http://www.jb51.net/article/42660.htm 
		// php判断所处服务器操作系统的类型         http://www.jb51.net/article/38809.htm  
		//if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {// 若为 windows 环境 
		if($_SERVER['HTTP_HOST']=="www.rmerp1.com"){// 本地 pc 环境 必须转义  
			$file_rename               = iconv("utf-8","gb2312",$file_rename);
		}
		// 客户 服务器环境 则不必转义  


		//$log  = date("H:i:s")." 46 行 fname 【".$file_rename." 】\r\n\r\n";
		//$log = mb_convert_encoding($log, 'utf-8', 'gbk');
		//file_put_contents("log/".date("Y-m-d").".fileupload.php.log",$log,FILE_APPEND); 

		//if(isInclucn($file_rename)==1){ exit("<script>alert('文件名不能含任何中文字符！');</script>");}

	}

	if($_FILES["userfile"]){// http://php.net/manual/en/features.file-upload.errors.php 

		//$json_str  = json_encode($_FILES["userfile"]);
		//$json_str2 = json_encode($_POST);
		//$log  = date("H:i:s")." 58 行 json_str 【".$json_str."】\r\n\r\n"; 
		//$log .= date("H:i:s")." 59 行 json_str2 【".$json_str2."】\r\n\r\n"; 
		//$log = mb_convert_encoding($log, 'utf-8', 'gb2312');
		//file_put_contents("log/".date("Y-m-d").".fileupload.php.log",$log,FILE_APPEND); 
		
		$arr_error                     = array();
		$success                       = 0;

		for($x=0,$y=count($_FILES['userfile']['error']);$x<$y;++$x) { 

			//$log  = date("H:i:s")." 68 行 name 【 ".$_FILES["userfile"]["name"][$x]." 】\r\n\r\n";
			//$log .= date("H:i:s")." 69 行 type 【 ".$_FILES["userfile"]["type"][$x]." 】\r\n\r\n";
			//$log .= date("H:i:s")." 70 行 tmp_name 【 ".$_FILES["userfile"]["tmp_name"][$x]." 】\r\n\r\n";
			//$log .= date("H:i:s")." 71 行 error 【 ".$_FILES["userfile"]["error"][$x]." 】\r\n\r\n";
			//$log .= date("H:i:s")." 72 行 size 【 ".$_FILES["userfile"]["size"][$x]." 】\r\n\r\n";
			//file_put_contents("log/".date("Y-m-d").".fileupload.php.log",$log,FILE_APPEND);  

			if($_FILES['userfile']['error'][$x]==0) { 

				$success              += 1;
				$name                  = $_FILES["userfile"]["name"][$x];
				$type                  = $_FILES["userfile"]["type"][$x];
				$tmp_name              = $_FILES["userfile"]["tmp_name"][$x];
				$size                  = $_FILES["userfile"]["size"][$x]; 

				if($size>=100*1024*1024){ 
					exit("<script>alert('文件过大，请上传小于 50.0M 的图片、mp4、办公文档或压缩文件！');</script>");
				}else if(!in_array($type,$canUpFileType)){
					exit("<script>alert('文件类型不对，只允许上传图片、mp4、办公文档或压缩文件！');</script>");
				}else{

					if(empty($file_rename)){
						//$arr_pic     = explode('.',$name);   
						//$num         = substr(time(),(strlen(time())-3),3);
						//$file_rename = $ecardhao."_".$user_id."_".$num.".".$arr_pic[1]; 
						$file_rename   = $name; 
					//}else{// 【ok】 
						//$arr_pic     = explode('.',$name);   
						//$file_rename = $file_rename.".".$arr_pic[count($arr_pic)-1]; 
					}

					// 路径不能用 转义斜线  ，否则 curl 及文件上传都会失败 
					if($_SERVER['HTTP_HOST']=="www.rmerp1.com"){// 本地 pc 环境
						$file_path     = "D:/xampp/htdocs/reuiew/01didi/00rongmin/uploads/".$file_rename;
						//$file_url    = "http://www.rmerp1.com/uploads/".$file_rename;
					}else{// 服务器环境
						$file_path     = "/var/www/html/erp/uploads/".$file_rename;
						//$file_url    = "http://www.rmerp.com/uploads/".$file_rename;
					}

					$result = move_uploaded_file($tmp_name,$file_path);

					if(!$result){

						exit("<script>alert('图片上传失败！请稍后再试！');history.back();</script>");

					}else{

						//$log  = date("H:i:s")." 117 行 file_rename0 【".$file_rename0."】\r\n\r\n"; 
						//$log .= date("H:i:s")." 118 行 _GET docname 【".$_GET['docname']."】\r\n\r\n"; 
						//file_put_contents("log/".date("Y-m-d").".fileupload.php.log",$log,FILE_APPEND); 

						// 公共文档上传部分  

						// 新文档上传 
						if(!empty($_GET['docname'])){
							$doc_name        = $_GET['docname']; 
							// $file_rename0 及 $doc_name 不能转 gb2312 否则入库乱码  
							$sql = "INSERT INTO `docs`(`id`, `name`, `path`, `d_url`, `v_url`, `time`, `is_delete`) VALUES (NULL,'".$doc_name."','".$file_rename0."','uploads/".$file_rename0."','','".time()."','0')"; 
							//$log  = date("H:i:s")." 129行 doc_name 【".$doc_name." 】\r\n\r\n"; 
							//$log .= date("H:i:s")." 130 行 sql 【".$sql." 】\r\n\r\n";   
							insertDb($sql); 
						}
						
						// 旧文档 更新上传  
						if(!empty($_GET['upid'])){// 旧文档更新 【尚未解决】
							$doc_id          = $_GET['upid'];  
							//$log  = date("H:i:s")." 138 行 doc_id 【".$doc_id." 】\r\n\r\n";  
							//file_put_contents("log/".date("Y-m-d").".fileupload.php.log",$log,FILE_APPEND);  
							$sql2 = "UPDATE `docs` SET `path`='".$file_rename0."',`d_url`='uploads/".$file_rename0."' WHERE `id`='".$doc_id."'";
							updateDb($sql2);

						}

					}
				}
			}else{ 

				$error                 = $_FILES["userfile"]["error"][$x];
				array_push($arr_error,$error);  

			}  
		}  
		if($success < 1){// 若全部没成功，只报第一个错 
			echo "<script>alert('".$up_file_error_message_arr[$arr_error[0]]."');</script>";
		}

	} 

?>