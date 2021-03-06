<?php



class imageupload_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        // $this->table_name = 'tips';
    }

  
	
    function uploadBigImage($uploadFile,$bigImgPath,$smallImgPath,$thumb,$existImage)
    {
		//echo $smallImgPath;exit;
		if (!file_exists($bigImgPath)) {
			mkdir($bigImgPath, 0777);
		} 
		
		if(!empty($existImage)){
			$path = $bigImgPath.$existImage;
			$path_thumb = $smallImgPath.$existImage;
			@unlink($path);
			@unlink($path_thumb);
		}
	
        $upload_name = $uploadFile;
		$config['upload_path'] = $bigImgPath; /* NB! create this dir! */  
		$config['allowed_types'] = 'gif|jpg|png|bmp|jpeg|csv|doc|docx|txt|pdf|xls|mov|mp4';
		
		$random = substr(md5(rand()),0,7);
		$config['file_name'] = $random."-".(strtolower($_FILES[$uploadFile]['name']));
		$config['overwrite'] = false;  
		
		/*$config['max_width'] = '1024';
		$config['max_height'] = '768';*/

		$this->load->library('upload', $config);  
		$this->upload->initialize($config);
		
		if($this->upload->do_upload($upload_name))
			$data = $this->upload->data();
		else
		{
			echo $this->upload->display_errors();
			exit;
		}
//		print_r($data);
		$sourcePath = $data['full_path'];
		$thumbPath = $smallImgPath;
		$thumbPath1 = $this->config->item('temp_medium_img_path');
		$fileName = $data['file_name'];
		
		list($width, $height, $type, $attr) = getimagesize($bigImgPath.$fileName);
		if($width > 4000 || $height > 4000)
		{
			if(file_exists($bigImgPath.$fileName))
			{
				@unlink($bigImgPath.$fileName);
			}
			return "Error";	
		}
		else
		{
			if(!empty($thumb) && $thumb=='thumb'){
				if (!file_exists($smallImgPath)) {
					mkdir($bigImgPath, 0777);
				}
				
				$basename = explode('.', $_FILES[$uploadFile]['name']);
				$filename =$basename[0];
				//for create small image
				if($data['file_type'] == 'image/bmp' || $basename[1] == 'bmp')
				{
				$sourceImgBig = base_url().$bigImgPath.$fileName;
				copy($sourceImgBig,$smallImgPath.$filename.".jpeg"); 
				$imgurl = base_url().$smallImgPath.$filename.".jpeg";
				$width = 150;
				$this->make_thumb($imgurl,$smallImgPath.$fileName, $width);
				@unlink($smallImgPath.$filename.".jpeg");
				}
				else
				{
					$filename = $this->uploadSmallImage($sourcePath,$thumbPath,$fileName);	
					$filename1 = $this->uploadSmallImage1($sourcePath,$thumbPath1,$fileName);	
				}
				
				
			}
			   
			return $fileName;     
		}
    }
	function make_thumb($src, $dest, $desired_width) {
	 $param = getimagesize($src);
		if($param['mime']=="image/png"){
			$source_image = imagecreatefrompng($src);
		}else if($param['mime']=="image/x-ms-bmp"){
			$source_image = $this->imagecreatefrombmp($src);
		}else if($param['mime']=="image/gif"){
			$source_image = imagecreatefromgif($src);
		}
		else{
			$source_image = imagecreatefromjpeg($src);
		} 
	  //$source_image = imagecreatefromjpeg($src);
	  $width = imagesx($source_image);
	  $height = imagesy($source_image);
	  
	  $desired_height = floor($height * ($desired_width / $width));
	  $virtual_image = imagecreatetruecolor($desired_width, $desired_height);
	  imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
	  imagejpeg($virtual_image, $dest);
	}
	function imagecreatefrombmp($p_sFile)
	{
        $file    =    fopen($p_sFile,"rb");
        $read    =    fread($file,10);
        while(!feof($file)&&($read<>""))
            $read    .=    fread($file,1024);
       
        $temp    =    unpack("H*",$read);
        $hex    =    $temp[1];
        $header    =    substr($hex,0,108);

        if (substr($header,0,4)=="424d")
        {
            $header_parts    =    str_split($header,2);
           
            $width            =    hexdec($header_parts[19].$header_parts[18]);
           
            $height            =    hexdec($header_parts[23].$header_parts[22]);

            unset($header_parts);
        }
       
        $x                =    0;
        $y                =    1;

        $image            =    imagecreatetruecolor($width,$height);
       
        $body            =    substr($hex,108);

        $body_size        =    (strlen($body)/2);
        $header_size    =    ($width*$height);

        $usePadding        =    ($body_size>($header_size*3)+4);
       
	    for ($i=0;$i<$body_size;$i+=3)
        {
            if ($x>=$width)
            {
			   if ($usePadding)
                    $i    +=    $width%4;
               
                $x    =    0;
               
                $y++;
               
                if ($y>$height)
                    break;
            }
                       $i_pos    =    $i*2;
            $r        =    hexdec($body[$i_pos+4].$body[$i_pos+5]);
            $g        =    hexdec($body[$i_pos+2].$body[$i_pos+3]);
            $b        =    hexdec($body[$i_pos].$body[$i_pos+1]);
           
            $color    =    imagecolorallocate($image,$r,$g,$b);
            imagesetpixel($image,$x,$height-$y,$color);
           
            $x++;
        }
       
        unset($body);
       
        return $image; 
	}
   
	
    public function uploadSmallImage($sourceImgPath,$thumbPath)
    {
		$configThumb = array();  
		$configThumb['image_library'] = 'gd2';
		$configThumb['thumb_marker'] = FALSE; 
		$configThumb['source_image'] = '';  
		$configThumb['create_thumb'] = TRUE;  
		$configThumb['maintain_ratio'] = FALSE;  
		$configThumb['width'] = 150;  
		$configThumb['height'] = 150;  
		$this->load->library('image_lib');
	
		$configThumb['source_image'] = $sourceImgPath; 
		$configThumb['new_image'] = $thumbPath;
		$this->image_lib->initialize($configThumb);  
		$this->image_lib->resize();
	}
	
	public function uploadSmallImage1($sourceImgPath,$thumbPath)
    {
		$configThumb = array();  
		$configThumb['image_library'] = 'gd2';
		$configThumb['thumb_marker'] = FALSE; 
		$configThumb['source_image'] = '';  
		$configThumb['create_thumb'] = TRUE;  
		$configThumb['maintain_ratio'] = TRUE;  
		$configThumb['width'] = 450;  
		$configThumb['height'] = 450;  
		$this->load->library('image_lib');
	
		$configThumb['source_image'] = $sourceImgPath; 
		$configThumb['new_image'] = $thumbPath;
		$this->image_lib->initialize($configThumb);  
		$this->image_lib->resize();
	}
	
    public function deleteImageFromFolder($imgPath)
    {
        @unlink($imgPath);
    }
	
	function copyImage($bgImgPath,$smallImgPath,$image)
	{
		$this->load->helper("file"); 
		$bgTempPath = $this->config->item('temp_big_img_path');
		$smallTempPath = $this->config->item('temp_small_img_path');
		$sourceImgBig = base_url().$bgTempPath.$image;
		$sourceImgSmall = base_url().$smallTempPath.$image;
		$sourceRootImgBig = $bgTempPath.$image;
		$sourceRootImgSmall = $smallTempPath.$image;
		$destinationImgBig = $bgImgPath.$image;
		$destinationImgSmall = $smallImgPath.$image;
		
		copy($sourceImgBig,$destinationImgBig);
		//@unlink($bgTempPath);	
		copy($sourceImgSmall,$destinationImgSmall);
		//@unlink($smallTempPath);
			
	}
	
	function copyImage1($bgImgPath,$mediumImgPath,$smallImgPath,$image)
	{
		$this->load->helper("file"); 
		$bgTempPath = $this->config->item('temp_big_img_path');
		$mdTempPath = $this->config->item('temp_medium_img_path');
		$smallTempPath = $this->config->item('temp_small_img_path');
		$sourceImgBig = base_url().$bgTempPath.$image;
		$sourceImgMed = base_url().$mdTempPath.$image;
		$sourceImgSmall = base_url().$smallTempPath.$image;
		$sourceRootImgBig = $bgTempPath.$image;
		$sourceRootImgMed = $mdTempPath.$image;
		$sourceRootImgSmall = $smallTempPath.$image;
		$destinationImgBig = $bgImgPath.$image;
		$destinationImgMed = $mediumImgPath.$image;
		$destinationImgSmall = $smallImgPath.$image;
		
		copy($sourceImgBig,$destinationImgBig);
		//@unlink($bgTempPath);	
		copy($sourceImgMed,$destinationImgMed);
		//@unlink($bgTempPath);	
		copy($sourceImgSmall,$destinationImgSmall);
		//@unlink($smallTempPath);
			
	}
	
	function delete_files($path, $del_dir = FALSE, $level = 0)
    {    
        // Trim the trailing slash
        $path = preg_replace("|^(.+?)/*$|", "\\1", $path);
        
        if ( ! $current_dir = @opendir($path))
            return;
    
        while(FALSE !== ($filename = @readdir($current_dir)))
        {
            if ($filename != "." and $filename != "..")
            {
                if (is_dir($path.'/'.$filename))
                {
                    // Ignore empty folders
                    if (substr($filename, 0, 1) != '.')
                    {
                        delete_files($path.'/'.$filename, $del_dir, $level + 1);
                    }
                }
                else
                {
                    unlink($path.'/'.$filename);
                }
            }
        }
        @closedir($current_dir);
    
        if ($del_dir == TRUE AND $level > 0)
        {
            @rmdir($path);
        }
    }
	
	function resizeThumbnailImage($thumb_image_name, $image, $width, $height, $start_width, $start_height, $scale){
		
		//echo $thumb_image_name.$image.$width.$height.$start_width.$start_height.$scale;exit;
		
		list($imagewidth, $imageheight, $imageType) = getimagesize($image);
		$imageType = image_type_to_mime_type($imageType);
		
		$newImageWidth = ceil($width * $scale);
		$newImageHeight = ceil($height * $scale);
		$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
		switch($imageType) {
			case "image/gif":
				$source=imagecreatefromgif($image); 
				break;
			case "image/pjpeg":
			case "image/jpeg":
			case "image/jpg":
				$source=imagecreatefromjpeg($image); 
				break;
			case "image/png":
			case "image/x-png":
				$source=imagecreatefrompng($image); 
				break;
		}
		imagecopyresampled($newImage,$source,0,0,$start_width,$start_height,$newImageWidth,$newImageHeight,$width,$height);
		switch($imageType) {
			case "image/gif":
				imagegif($newImage,$thumb_image_name); 
				break;
			case "image/pjpeg":
			case "image/jpeg":
			case "image/jpg":
				imagejpeg($newImage,$thumb_image_name,90); 
				break;
			case "image/png":
			case "image/x-png":
				imagepng($newImage,$thumb_image_name);  
				break;
		}
		chmod($thumb_image_name, 0777);
		return $thumb_image_name;
	}
	
}