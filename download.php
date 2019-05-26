<?php


	if($_GET['action']=='dw' && !empty($_GET['file']) && !empty($_GET['filename'])){

		// $d_url = "download.php?action=dw&filename=".$name."&file=".$d_url; 


		//$file                        ='download/test.txt';   //要下载的路径文件
		//$filename                    = 'test.txt'; //这个只是文件的名字
		$file                          = $_GET['file'];   //要下载的路径文件
		$filename                      = $_GET['filename']; //这个只是文件的名字

		//$log  = date("H:i:s")." 14 行 file 【".$file."】\r\n\r\n";          // uploads/03职业和收入证明.doc
		//$log .= date("H:i:s")." 15 行 filename 【".$filename."】\r\n\r\n";  // 03职业和收入证明.doc
		//file_put_contents("log/".date("Y-m-d").".download.php.log",$log,FILE_APPEND); 

		header("Content-Type: application/force-download");
		header("Content-Disposition:attachment;filename=".($filename)); 
		readfile($file);

	}





?>