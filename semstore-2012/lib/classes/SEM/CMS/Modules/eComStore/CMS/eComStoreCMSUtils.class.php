<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-03-10
 * @package SEM.CMS.Modules.eComStore.CMS
 */

require_once('SEMObject.class.php');

require_once('Net/Ftp.class.php');

class eComStoreCMSUtils extends SEMObject
{
        /*
         *
	 * Class Constants
         *
	 */
	
        
        
        
        
	/*
         *
	 * Class Variables
         *
	 */
        
        
        
        
        
	/*
         *
	 * Instance Variables
         *
	 */
        
        
        
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function eComStoreCMSUtils ()
        {
                die("Class 'eComStoreCMSUtils' is abstract and cannot be instantiated");
        }
        
        
        /*
         *
	 * Accessor & Mutator Methods
         *
	 */
        
        
        
        
        
        /*
         *
	 * Class Methods
         *
	 */
        
        
        function fileExtension ( $file )
        {
                preg_match('|\.([^/]+)$|', $file, $matches);
                
                return strtolower($matches[1]);
        }
        
        
        function imageType ( $file )
        {
                $ext = eComStoreCMSUtils::fileExtension($file);
                
                if ( $ext == 'gif' )
                {
                        return 'gif';
                }
                elseif ( $ext == 'jpg' || $ext == 'jpeg' )
                {
                        return 'jpeg';
                }
                elseif ( $ext == 'png' )
                {
                        return 'png';
                }
                
                return NULL;
        }
        
        
        function createProductImage ( $infile, $outfile )
        {
                $imagetype = eComStoreCMSUtils::imageType($infile);
                $source = NULL;
                if ( $imagetype == 'gif' )
                {
                        $source = imagecreatefromgif($infile);
                }
                elseif ( $imagetype == 'jpeg' )
                {
                        $source = imagecreatefromjpeg($infile);
                }
                elseif ( $imagetype == 'png' )
                {
                        $source = imagecreatefrompng($infile);
                }
                else
                {
                        die('Unknown file type');
                }
                
                imagepng($source, $outfile);
                imagedestroy($source);
        }
        
        
        function createProductCategoryThumbnail ( $infile, $outfile )
        {
                list($width, $height) = getimagesize($infile);
                $ar = $width / $height;
                $newwidth = $width;
                $newheight = $height;
                
                if ( $width > $height )
                {
                        $newwidth = 100;
                        //$newheight = round($newwidth / $ar);
                        $newheight = floor($newwidth / $ar);
                }
                else
                {
                        $newheight = 100;
                        //$newwidth = round($newheight * $ar);
                        $newwidth = floor($newheight * $ar);
                }
                
                $imagetype = eComStoreCMSUtils::imageType($infile);
                $source = NULL;
                if ( $imagetype == 'gif' )
                {
                        $source = imagecreatefromgif($infile);
                }
                elseif ( $imagetype == 'jpeg' )
                {
                        $source = imagecreatefromjpeg($infile);
                }
                elseif ( $imagetype == 'png' )
                {
                        $source = imagecreatefrompng($infile);
                }
                else
                {
                        die('Unknown file type');
                }
                
                $resimg = imagecreatetruecolor($newwidth, $newheight);
                $white = imagecolorallocate($resimg, 255, 255, 255);
                imagefill($resimg, 0, 0, $white);
                imagecopyresampled($resimg, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                imagedestroy($source);
                
                imagepng($resimg, $outfile);
                imagedestroy($resimg);
        }
        
        
        function createProductGalleryImage ( $infile, $outfile )
        {
                list($width, $height) = getimagesize($infile);
                $ar = $width / $height;
                $newwidth = $width;
                $newheight = $height;
                
                if ( $width > $height )
                {
                        $newwidth = 400;
                        //$newheight = round($newwidth / $ar);
                        $newheight = floor($newwidth / $ar);
                }
                else
                {
                        $newheight = 400;
                        //$newwidth = round($newheight * $ar);
                        $newwidth = floor($newheight * $ar);
                }
                
                $imagetype = eComStoreCMSUtils::imageType($infile);
                $source = NULL;
                if ( $imagetype == 'gif' )
                {
                        $source = imagecreatefromgif($infile);
                }
                elseif ( $imagetype == 'jpeg' )
                {
                        $source = imagecreatefromjpeg($infile);
                }
                elseif ( $imagetype == 'png' )
                {
                        $source = imagecreatefrompng($infile);
                }
                else
                {
                        die('Unknown file type');
                }
                
                $resimg = imagecreatetruecolor($newwidth, $newheight);
                $white = imagecolorallocate($resimg, 255, 255, 255);
                imagefill($resimg, 0, 0, $white);
                imagecopyresampled($resimg, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                imagedestroy($source);
                
                imagepng($resimg, $outfile);
                imagedestroy($resimg);
        }

        
        function createBasketImage ( $infile, $outfile )
        {
                list($width, $height) = getimagesize($infile);
                $ar = $width / $height;
                $newwidth = $width;
                $newheight = $height;
                
                if ( $width > $height )
                {
                        $newwidth = 50;
                        //$newheight = round($newwidth / $ar);
                        $newheight = floor($newwidth / $ar);
                }
                else
                {
                        $newheight = 50;
                        //$newwidth = round($newheight * $ar);
                        $newwidth = floor($newheight * $ar);
                }
                
                $imagetype = eComStoreCMSUtils::imageType($infile);
                $source = NULL;
                if ( $imagetype == 'gif' )
                {
                        $source = imagecreatefromgif($infile);
                }
                elseif ( $imagetype == 'jpeg' )
                {
                        $source = imagecreatefromjpeg($infile);
                }
                elseif ( $imagetype == 'png' )
                {
                        $source = imagecreatefrompng($infile);
                }
                else
                {
                        die('Unknown file type');
                }
                
                $resimg = imagecreatetruecolor($newwidth, $newheight);
                $white = imagecolorallocate($resimg, 255, 255, 255);
                imagefill($resimg, 0, 0, $white);
                imagecopyresampled($resimg, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                imagedestroy($source);
                
                imagepng($resimg, $outfile);
                imagedestroy($resimg);
        }
        
        
        function createProductBrowserThumbnail ( $infile, $outfile )
        {
                list($width, $height) = getimagesize($infile);
                $ar = $width / $height;
                $newwidth = $width;
                $newheight = $height;
                
                if ( $width > $height )
                {
                        $newwidth = 100;
                        //$newheight = round($newwidth / $ar);
                        $newheight = floor($newwidth / $ar);
                }
                else
                {
                        $newheight = 100;
                        //$newwidth = round($newheight * $ar);
                        $newwidth = floor($newheight * $ar);
                }
                
                $imagetype = eComStoreCMSUtils::imageType($infile);
                $source = NULL;
                if ( $imagetype == 'gif' )
                {
                        $source = imagecreatefromgif($infile);
                }
                elseif ( $imagetype == 'jpeg' )
                {
                        $source = imagecreatefromjpeg($infile);
                }
                elseif ( $imagetype == 'png' )
                {
                        $source = imagecreatefrompng($infile);
                }
                else
                {
                        die('Unknown file type');
                }
                
                $resimg = imagecreatetruecolor($newwidth, $newheight);
                $white = imagecolorallocate($resimg, 255, 255, 255);
                imagefill($resimg, 0, 0, $white);
                imagecopyresampled($resimg, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                imagedestroy($source);
                
                imagepng($resimg, $outfile);
                imagedestroy($resimg);
        }
        
        
        function createProductDetailsPageImage ( $infile, $outfile )
        {
                list($width, $height) = getimagesize($infile);
                $ar = $width / $height;
                $newwidth = $width;
                $newheight = $height;
                
                if ( $width > $height )
                {
                        $newwidth = 200;
                        //$newheight = round($newwidth / $ar);
                        $newheight = floor($newwidth / $ar);
                }
                else
                {
                        $newheight = 200;
                        //$newwidth = round($newheight * $ar);
                        $newwidth = floor($newheight * $ar);
                }
                
                $imagetype = eComStoreCMSUtils::imageType($infile);
                $source = NULL;
                if ( $imagetype == 'gif' )
                {
                        $source = imagecreatefromgif($infile);
                }
                elseif ( $imagetype == 'jpeg' )
                {
                        $source = imagecreatefromjpeg($infile);
                }
                elseif ( $imagetype == 'png' )
                {
                        $source = imagecreatefrompng($infile);
                }
                else
                {
                        die('Unknown file type');
                }
                
                $resimg = imagecreatetruecolor($newwidth, $newheight);
                $white = imagecolorallocate($resimg, 255, 255, 255);
                imagefill($resimg, 0, 0, $white);
                imagecopyresampled($resimg, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                imagedestroy($source);
                
                imagepng($resimg, $outfile);
                imagedestroy($resimg);
        }
        
        
        function _ftpCopyFile ( $options, $fsSrcFile, $ftpDestFile )
        {
                //print "copying '$fsSrcFile' to '$ftpDestFile'";
                
                $ftp =& new Ftp(
                        $options['server'],
                        $options['port'],
                        $options['username'],
                        $options['password']
                        );
                $ftp->connect();
                $ftp->put($fsSrcFile, $ftpDestFile, FTP_BINARY);
                $ftp->chmod('666', $ftpDestFile);
                
                return;
        }
        
        
        function _ftpMoveFile ( $ftpOptions, $fsSrcFile, $ftpDestFile )
        {
                eComStoreCMSUtils::_ftpCopyFile($ftpOptions,
                        $fsSrcFile, $ftpDestFile);
                unlink($fsSrcFile);
                
                return;
        }
        
        
        function _moveUploadedImageFileToTmpDir ( $ftpOptions,
                $file, $remoteFile, $ftpPath )
        {
                $filename = md5(uniqid(rand(), TRUE));
                $ext = '';
                if ( preg_match('{\.([^\.]+)$}', $remoteFile, $matches) > 0 )
                {
                        $ext = strtolower($matches[1]);
                }
                
                $dest = $ftpPath . '/' . $filename . '.' . $ext;
                eComStoreCMSUtils::_ftpMoveFile($ftpOptions, $file, $dest);
                
                return $filename . '.' . $ext;
        }
        
        
        /*
         *
	 * Command Methods
         *
	 */
        
        
        
        
        
}

?>
