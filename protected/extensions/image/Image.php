<?php 
class Image
{
    public function __construct(){}
    public function init(){}
	public function create_thumbnail($input, $output, &$error_message, $thumb_width = 100)
	{
		// If blank variables are passed, return false immediately.
		if(($input == "") || ($output == ""))
		{
			$error_message = "Either the input or output file is blank";
			return false;
		}
			
		// Ensure input file exists
		if(!file_exists($input))
		{
			$error_message = "Input file does not exist";
			return false;
		}  
		
		// Ensure input file type is valid, and if it is, create a GD image object
		if(stristr($input, ".jpg"))
		{
			// This is a JPEG image
			$src_img=imagecreatefromjpeg($input);
		}	
		else if(stristr($input, ".png"))
		{
			// This is a PNG file
			$src_img=imagecreatefrompng($input);
		} 
        else if(stristr($input, ".gif"))
        {
            // This is a GIF file
            $src_img=imagecreatefromgif($input);
        }
		else
		{               
			$error_message = "Invalid input file.  It must be either a JPEG or PNG ";
			return false;	
		}
		
		// Get x and y dimensions of the big image.
		$old_x = imageSX($src_img);
		$old_y = imageSY($src_img);
      
      	// Calculate what ratio the proposed thumbnail width is in proportion to the big image.
		$ratio = $thumb_width / $old_x;
		
		// Calculate appropriate thumbnail height
		$thumb_height = round($old_y * $ratio, 0);
		
		// Create a new image to hold the thumbnail
		$dst_img = ImageCreateTrueColor($thumb_width, $thumb_height);
		
		// Resample the original image into the thumbnail
		imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $thumb_width, $thumb_height, $old_x, $old_y); 

		// Always save thumbnails as jpegs
		if(!imagejpeg($dst_img, $output))
		{
			$error_message = "Couldn't create ouput thumbnail file: $output";
			return false;	
		}
		
		// All done.
		return true;   
	}
		
	public function create_square_thumbnail($source, $dest, $thumb_size=84, &$error_message = "") 
	{
		// If blank variables are passed, return false immediately.
		if(($source == "") || ($dest == ""))
		{
			$error_message = "Either the input or output file is blank";
			return false;
		}
			
		// Ensure input file exists
		if(!file_exists($source))
		{
			$error_message = "Input file does not exist";
			return false;
		}		
		
		$size = getimagesize($source);
		$width = $size[0];
		$height = $size[1];

		if($width > $height) 
		{
			$x = ceil(($width - $height) / 2 );
			$width = $height;
			$y = 0;
		}
		else if($height > $width) 
		{
			$y = ceil(($height - $width) / 2);
			$height = $width; 
			$x = 0;
		}

		$new_im = ImageCreatetruecolor($thumb_size,$thumb_size);
        // Ensure input file type is valid, and if it is, create a GD image object
		if(stristr($source, ".jpg"))
		{
			// This is a JPEG image
			$src_img=imagecreatefromjpeg($source);
		}	
		else if(stristr($source, ".png"))
		{
			// This is a PNG file
			$src_img=imagecreatefrompng($source);
		} 
        else if(stristr($source, ".gif"))
        {
            // This is a GIF file
            $src_img=imagecreatefromgif($source);
        }
		else
		{               
			$error_message = "Invalid input file.  It must be either a JPEG, GIF or PNG ";
			return false;	
		}
		imagecopyresampled($new_im,$src_img,0,0,$x,$y,$thumb_size,$thumb_size,$width,$height);
		imagejpeg($new_im,$dest,100);

		return true;
	}
    
    public function resize_magick($source, $dest, $width=0, $height=0, $crop = false, &$error_message = "") 
	{
		// If blank variables are passed, return false immediately.
		if(($source == "") || ($dest == ""))
		{
			$error_message = "Either the input or output file is blank";
			return false;
		}
			
		// Ensure input file exists
		if(!file_exists($source))
		{
			$error_message = "Input file does not exist";
			return false;
		}
        
        // Ensure input file type is valid, and if it is, create a GD image object
		if(stristr($source, ".jpg"))
		{
			// This is a JPEG image
			$src_img=imagecreatefromjpeg($source);
		}	
		else if(stristr($source, ".png"))
		{
			// This is a PNG file
			$src_img=imagecreatefrompng($source);
		} 
        else if(stristr($source, ".gif"))
        {
            // This is a GIF file
            $src_img=imagecreatefromgif($source);
        }
		else
		{               
			$error_message = "Invalid input file.  It must be either a JPEG, GIF or PNG ";
			return false;	
		}
        
        // Get x and y dimensions of the image.
		$img_width = imageSX($src_img);
		$img_height = imageSY($src_img);
        
        if ($width == 0 && $height == 0)
        {
            $width = $img_width;
            $height = $img_height;
        }
		
        // Calculate what ratio the proposed thumbnail width is in proportion to the big image.
        $ratio = 0;
        $ratio_x = 0;
        $ratio_y = 0;
        if ($width)
            $ratio_x = $width / $img_width;
        
        if ($height)
            $ratio_y = $height / $img_height;
        
        if (!$crop)
        {
            if ($ratio_x && $ratio_y)
            {
                if ($ratio_x > $ratio_y)
                    $ratio = $ratio_y;
                else
                    $ratio = $ratio_x;
            }
            else if ($ratio_x || $ratio_y)
            {
                if ($ratio_x)
                    $ratio = $ratio_x;
                else
                    $ratio = $ratio_y;
            }
            
            if ($ratio)
            {
                $w = round($ratio*$img_width);
                $h = round($ratio*$img_height);
            }
            
            
            // Create a new image
    		$dst_img = ImageCreateTrueColor($w, $h);
    		
    		// Resample the original image into the new image
    		imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $w, $h, $img_width, $img_height);                         
        }
        else
        {
            if ($ratio_x && $ratio_y)
            {
                if ($ratio_x > $ratio_y)
                    $ratio = $ratio_x;
                else
                    $ratio = $ratio_y;
                
                if ($ratio)
                {
                    $w = round($ratio*$img_width);
                    $h = round($ratio*$img_height);
                }
                
                // Create a temp image
        		$temp_img = ImageCreateTrueColor($w, $h);
        		
        		// Resample the original image into the temp image
        		imagecopyresampled($temp_img, $src_img, 0, 0, 0, 0, $w, $h, $img_width, $img_height);
                
                // Create a new image
        		$dst_img = ImageCreateTrueColor($width, $height);
        		
        		// Crop the temp image into the new image
        		imagecopyresampled($dst_img, $temp_img, 0, 0, 0, 0, $width, $height, $width, $height);                                                                    
            }
        }

		// Always save images as jpegs
		if(!imagejpeg($dst_img, $dest))
		{
			$error_message = "Couldn't create ouput file: $dest";
			return false;	
		}
		
		return true;
	}
}
