<?php
/**
 * Created by PhpStorm.
 * User: Vaidakovich
 * Date: 31.05.2016
 * Time: 18:14
 */

/** function resizeImage - do small copy of image with new name basename($image_name) .'_'. $new_width.'x'.$new_height;
 * @param $uploaded_file - $_FILES['image']
 * @param string $preview_folder - where save result
 * @param int $new_width
 * @param int $new_height
 * @param string $canvas_color
 * @param int $zoom_crop
 * @return bool
 */
function resizeImage($uploaded_file, $preview_folder='preview/', $new_width = 150, $new_height = 0, $canvas_color='', $zoom_crop = 1 )
{
//    нафиг ограничивать размер картинки именно в функции смотри ниже ))
    define ('MAX_WIDTH', 3000);//max image width
    define ('MAX_HEIGHT', 3000);//max image height
    define ('MAX_FILE_SIZE', 3,145728e+7); // changed to 30 MiB

    //image save path
//    $path = 'storeResize/';
    // will use $preview_dst

    // create preview dir if need
    if ( !is_dir($preview_folder) )
        mkdir( $preview_folder);




    $image_type = $uploaded_file['type'];
    $image_size = $uploaded_file['size'];
    $image_error = $uploaded_file['error'];
    $image_file = $uploaded_file['tmp_name'];
    $image_name = $uploaded_file['name'];

    //name of the new image
    $nameOfFile = basename($image_name) .'_'. $new_width.'x'.$new_height;

    $image_info = getimagesize($image_file);

    //check image type
    if ($image_info['mime'] == 'image/jpeg' or $image_info['mime'] == 'image/jpg'){
    }
    else if ($image_info['mime'] == 'image/png'){
    }
    else if ($image_info['mime'] == 'image/gif'){
    }
    else{
        //set error invalid file type
        // если это не картинка то что мы вообще тут делаем
        return false;
    }

    if ($image_error){
        //set error image upload error
    }

    if ( $image_size > MAX_FILE_SIZE ){
        //set error image size invalid
    }

    // если встречаем нужный тип файла создаём новое изображение - копию исходного
    switch ($image_info['mime']) {
        case 'image/jpg': //This isn't a valid mime type so we should probably remove it
        case 'image/jpeg':
            $new_image = imagecreatefromjpeg ($image_file);
            break;
        case 'image/png':
            $new_image = imagecreatefrompng ($image_file);
            break;
        case 'image/gif':
            $new_image = imagecreatefromgif ($image_file);
            break;
        default: // не картинка, сделаем выход из функции
            return false;
    }

    // странный if ну да фиг с ним, типа зацита
    if ($new_width == 0 && $new_height == 0) {
        $new_width = 100;
        $new_height = 100;
    }

    // ensure size limits can not be abused
    $new_width = min ($new_width, MAX_WIDTH);
    $new_height = min ($new_height, MAX_HEIGHT);

    //get original image h/w
    $width = imagesx ($new_image);
    $height = imagesy ($new_image);

    $align = 'b';
    $zoom_crop = 1;
    $origin_x = 0;
    $origin_y = 0;
    //TODO setting Memory

    // generate new w/h if not provided
    if ($new_width && !$new_height) {
        $new_height = floor ($height * ($new_width / $width));
    } else if ($new_height && !$new_width) {
        $new_width = floor ($width * ($new_height / $height));
    }

    // scale down and add borders
    if ($zoom_crop == 3) {

        $final_height = $height * ($new_width / $width);

        if ($final_height > $new_height) {
            $new_width = $width * ($new_height / $height);
        } else {
            $new_height = $final_height;
        }

    }

    // create a new true color image
    $canvas = imagecreatetruecolor ($new_width, $new_height);
    imagealphablending ($canvas, false);



    if (strlen ($canvas_color) < 6) {
        $canvas_color = 'ffffff';
    }

    $canvas_color_R = hexdec (substr ($canvas_color, 0, 2));
    $canvas_color_G = hexdec (substr ($canvas_color, 2, 2));
    $canvas_color_B = hexdec (substr ($canvas_color, 4, 2));

    // Create a new transparent color for image
    $color = imagecolorallocatealpha ($canvas, $canvas_color_R, $canvas_color_G, $canvas_color_B, 127);

    // Completely fill the background of the new image with allocated color.
    imagefill ($canvas, 0, 0, $color);

    // scale down and add borders
    if ($zoom_crop == 2) {

        $final_height = $height * ($new_width / $width);

        if ($final_height > $new_height) {
            $origin_x = $new_width / 2;
            $new_width = $width * ($new_height / $height);
            $origin_x = round ($origin_x - ($new_width / 2));
        } else {

            $origin_y = $new_height / 2;
            $new_height = $final_height;
            $origin_y = round ($origin_y - ($new_height / 2));

        }

    }

    // Restore transparency blending
    imagesavealpha ($canvas, true);

    if ($zoom_crop > 0) {

        $src_x = $src_y = 0;
        $src_w = $width;
        $src_h = $height;

        $cmp_x = $width / $new_width;
        $cmp_y = $height / $new_height;

        // calculate x or y coordinate and width or height of source
        if ($cmp_x > $cmp_y) {
            $src_w = round ($width / $cmp_x * $cmp_y);
            $src_x = round (($width - ($width / $cmp_x * $cmp_y)) / 2);
        } else if ($cmp_y > $cmp_x) {
            $src_h = round ($height / $cmp_y * $cmp_x);
            $src_y = round (($height - ($height / $cmp_y * $cmp_x)) / 2);
        }

        // positional cropping!
        if ($align) {
            if (strpos ($align, 't') !== false) {
                $src_y = 0;
            }
            if (strpos ($align, 'b') !== false) {
                $src_y = $height - $src_h;
            }
            if (strpos ($align, 'l') !== false) {
                $src_x = 0;
            }
            if (strpos ($align, 'r') !== false) {
                $src_x = $width - $src_w;
            }
        }

        // positional cropping!
        imagecopyresampled ($canvas, $new_image, $origin_x, $origin_y, $src_x, $src_y, $new_width, $new_height, $src_w, $src_h);

    } else {
        imagecopyresampled ($canvas, $new_image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
    }
    //Straight from Wordpress core code. Reduces filesize by up to 70% for PNG's
    if ( (IMAGETYPE_PNG == $image_info[2] || IMAGETYPE_GIF == $image_info[2]) && function_exists('imageistruecolor') && !imageistruecolor( $new_image ) && imagecolortransparent( $new_image ) > 0 ){
        imagetruecolortopalette( $canvas, false, imagecolorstotal( $new_image ) );
    }
    $quality = 100;
//    $nameOfFile = 'resize_'.$new_width.'x'.$new_height.'_'.basename($uploaded_file['name']);

    if (preg_match('/^image\/(?:jpg|jpeg)$/i', $image_info['mime'])){
        imagejpeg($canvas, $preview_folder.$nameOfFile, $quality);

    } else if (preg_match('/^image\/png$/i', $image_info['mime'])){
        imagepng($canvas, $preview_folder.$nameOfFile, floor($quality * 0.09));

    } else if (preg_match('/^image\/gif$/i', $image_info['mime'])){
        imagegif($canvas, $preview_folder.$nameOfFile);

    }

    ImageDestroy($new_image);
    return true;
}

/***********************************************
 * if (!$max_width) $max_width = 1000;
 * if (!$max_height) $max_height = 1000;
 * $size = GetImageSize($image);
 * $width = $size[0];
 * $height = $size[1];
 * $x_ratio = $max_width / $width;
 * $y_ratio = $max_height / $height;
 * if ( ($width <= $max_width) && ($height <= $max_height) ) {
 * $tn_width = $width;
 * $tn_height = $height;
 * }
 * else if (($x_ratio * $height) < $max_height) {
 * $tn_height = ceil($x_ratio * $height);
 * $tn_width = $max_width;
 * }
 * else {
 * $tn_width = ceil($y_ratio * $width);
 * $tn_height = $max_height;
 * }
 * $src = ImageCreateFromJpeg($image);
 * $dst = ImageCreate($tn_width,$tn_height);
 * ImageCopyResized($dst, $src, 0, 0, 0, 0,$tn_width,$tn_height,$width,$height);
 * header('Content-type: image/jpeg');
 * ImageJpeg($dst, null, -1);
 * ImageDestroy($src);
 * ImageDestroy($dst);
 ************************************************/


/**
 * @param $file
 * @param int $width
 * @param int $height
 * @param bool $proportional
 * @param string $output
 * @param bool $delete_original
 * @param bool $use_linux_commands
 * @return bool
 */
function smart_resize_image($file,
                            $width              = 0,
                            $height             = 0,
                            $proportional       = false,
                            $output             = 'file',
                            $delete_original    = false,
                            $use_linux_commands = false ) {

    if ( $height <= 0 && $width <= 0 ) return false;
    # Setting defaults and meta
    $info                         = getimagesize($file);
    $image                        = '';
    $final_width                  = 0;
    $final_height                 = 0;
    list($width_old, $height_old) = $info;
    # Calculating proportionality
    if ($proportional) {
        if      ($width  == 0 )  $factor = $height/$height_old;
        elseif  ($height == 0 )  $factor = $width/$width_old;
        else                    $factor = min( $width / $width_old, $height / $height_old );
        $final_width  = round( $width_old * $factor );
        $final_height = round( $height_old * $factor );
    }
    else {
        $final_width = ( $width <= 0 ) ? $width_old : $width;
        $final_height = ( $height <= 0 ) ? $height_old : $height;
    }
    # Loading image to memory according to type
    switch ( $info[2] ) {
        case IMAGETYPE_GIF:   $image = imagecreatefromgif($file);   break;
        case IMAGETYPE_JPEG:  $image = imagecreatefromjpeg($file);  break;
        case IMAGETYPE_PNG:   $image = imagecreatefrompng($file);   break;
        default: return false;
    }


    # This is the resizing/resampling/transparency-preserving magic
    $image_resized = imagecreatetruecolor( $final_width, $final_height );
    if ( ($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_PNG) ) {
        $transparency = imagecolortransparent($image);
        if ($transparency >= 0) {
//            $transparent_color  = imagecolorsforindex($image, $trnprt_indx);
//            $transparency       = imagecolorallocate($image_resized, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
        $transparent_color  = imagecolorsforindex($image, $transparency);
        $transparency       = imagecolorallocate($image_resized, $transparent_color['red'], $transparent_color['green'], $transparent_color['blue']);
            imagefill($image_resized, 0, 0, $transparency);
            imagecolortransparent($image_resized, $transparency);
        }
        elseif ($info[2] == IMAGETYPE_PNG) {
            imagealphablending($image_resized, false);
            $color = imagecolorallocatealpha($image_resized, 0, 0, 0, 127);
            imagefill($image_resized, 0, 0, $color);
            imagesavealpha($image_resized, true);
        }
    }
    imagecopyresampled($image_resized, $image, 0, 0, 0, 0, $final_width, $final_height, $width_old, $height_old);

    # Taking care of original, if needed
    if ( $delete_original ) {
        if ( $use_linux_commands ) exec('rm '.$file);
        else @unlink($file);
    }
    # Preparing a method of providing result
    switch ( strtolower($output) ) {
        case 'browser':
            $mime = image_type_to_mime_type($info[2]);
            header("Content-type: $mime");
            $output = NULL;
            break;
        case 'file':
            $output = $file;
            break;
        case 'return':
            return $image_resized;
            break;
        default:
            break;
    }

    # Writing image according to type to the output destination
    switch ( $info[2] ) {
        case IMAGETYPE_GIF:   imagegif($image_resized, $output);    break;
        case IMAGETYPE_JPEG:  imagejpeg($image_resized, $output);   break;
        case IMAGETYPE_PNG:   imagepng($image_resized, $output);    break;
        default: return false;
    }
    return true;
}
