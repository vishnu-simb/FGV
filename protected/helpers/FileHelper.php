<?php

/**
 * Author: trac.nguyen (npbtrac@yahoo.com)
 * Date: 7/1/14
 * Time: 3:27 PM
 *
 * collection of functions for handling files
 */
class FileHelper
{
    /**
     * Get the full file name with correct extension
     * @param $filePath, path of the file
     * @param bool $getExtensionOnly
     * @return mixed|string
     */
    public static function fillExtension($filePath, $getExtensionOnly = false)
    {
        if (!filter_var($filePath, FILTER_VALIDATE_URL)) {
            $finfo = new finfo;
            $fileinfo = $finfo->file($filePath, FILEINFO_MIME_TYPE);
        } else {
            $fileinfo = self::getRemoteContentType($filePath);
        }

        $ext = self::getExtensionFromMimeType($fileinfo);
        $newFilepath = (pathinfo($filePath, PATHINFO_EXTENSION) == $ext && $ext ? $filePath : $filePath . '.' . $ext);
        return $getExtensionOnly ? $ext : $newFilepath;
    }

    /**
     * @return array mime-type extension relationship
     */
    public static function getMimeTypeExtensionData()
    {
        return array(
            // image
            'image/jpeg' => array('jpg', 'jpeg', 'jpe'),
            'image/gif' => 'gif',
            'image/png' => 'png',
            'image/bmp' => 'bmp',
            'image/tiff' => array('tif', 'tiff'),
            'image/x-icon' => 'ico',
            // Video formats
            'video/x-ms-asf' => array('asf', 'asx'),
            'video/x-ms-wmv' => 'wmv',
            'video/x-ms-wmx' => 'wmx',
            'video/x-ms-wm' => 'wm',
            'video/avi' => 'avi',
            'video/divx' => 'divx',
            'video/x-flv' => 'flv',
            'video/quicktime' => array('mov', 'qt'),
            'video/mpeg' => array('mpg', 'mpeg', 'mpe'),
            'video/mp4' => array('mp4', 'm4v'),
            'video/ogg' => 'ogv',
            'video/webm' => 'webm',
            'video/x-matroska' => 'mkv',
            // Text formats
            'text/plain' => array('txt', 'asc', 'c', 'cc', 'h'),
            'text/csv' => 'csv',
            'text/tab-separated-values' => 'tsv',
            'text/calendar' => 'ics',
            'text/richtext' => 'rtx',
            'text/css' => 'css',
            'text/html' => array('html', 'htm'),
            'text/vtt' => 'vtt',
            // Audio formats
            'audio/mpeg' => array('mp3', 'm4a', 'm4b'),
            'audio/x-realaudio' => array('ra', 'ram'),
            'audio/wav' => 'wav',
            'audio/ogg' => array('ogg', 'oga'),
            'audio/midi' => array('mid', 'midi'),
            'audio/x-ms-wma' => 'wma',
            'audio/x-ms-wax' => 'wax',
            'audio/x-matroska' => 'mka',
            // MS Office formats
            'application/msword' => 'doc',
            'application/vnd.ms-powerpoint' => array('ppt', 'pot', 'pps'),
            'application/vnd.ms-write' => 'wri',
            'application/vnd.ms-excel' => array('xls', 'xla', 'xlt', 'xlw'),
            'application/vnd.ms-access' => 'mdb',
            'application/vnd.ms-project' => 'mpp',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx',
            'application/vnd.ms-word.document.macroEnabled.12' => 'docm',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.template' => 'dotx',
            'application/vnd.ms-word.template.macroEnabled.12' => 'dotm',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'xlsx',
            'application/vnd.ms-excel.sheet.macroEnabled.12' => 'xlsm',
            'application/vnd.ms-excel.sheet.binary.macroEnabled.12' => 'xlsb',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.template' => 'xltx',
            'application/vnd.ms-excel.template.macroEnabled.12' => 'xltm',
            'application/vnd.ms-excel.addin.macroEnabled.12' => 'xlam',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation' => 'pptx',
            'application/vnd.ms-powerpoint.presentation.macroEnabled.12' => 'pptm',
            'application/vnd.openxmlformats-officedocument.presentationml.slideshow' => 'ppsx',
            'application/vnd.ms-powerpoint.slideshow.macroEnabled.12' => 'ppsm',
            'application/vnd.openxmlformats-officedocument.presentationml.template' => 'potx',
            'application/vnd.ms-powerpoint.template.macroEnabled.12' => 'potm',
            'application/vnd.ms-powerpoint.addin.macroEnabled.12' => 'ppam',
            'application/vnd.openxmlformats-officedocument.presentationml.slide' => 'sldx',
            'application/vnd.ms-powerpoint.slide.macroEnabled.12' => 'sldm',
            'application/onenote' => array('onetoc', 'onetoc2', 'onetmp', 'onepkg'),

            // OpenOffice formats
            'application/vnd.oasis.opendocument.text' => 'odt',
            'application/vnd.oasis.opendocument.presentation' => 'odp',
            'application/vnd.oasis.opendocument.spreadsheet' => 'ods',
            'application/vnd.oasis.opendocument.graphics' => 'odg',
            'application/vnd.oasis.opendocument.chart' => 'odc',
            'application/vnd.oasis.opendocument.database' => 'odb',
            'application/vnd.oasis.opendocument.formula' => 'odf',

            // WordPerfect formats
            'application/wordperfect' => array('wp', 'wpd'),

            // iWork formats
            'application/vnd.apple.keynote' => 'key',
            'application/vnd.apple.numbers' => 'numbers',
            'application/vnd.apple.pages' => 'pages',

            // Misc application formats
            'application/rtf' => 'rtf',
            'application/javascript' => 'js',
            'application/pdf' => 'pdf',
            'application/x-shockwave-flash' => 'swf',
            'application/java' => 'class',
            'application/x-tar' => 'tar',
            'application/zip' => 'zip',
            'application/x-gzip' => array('gz', 'gzip'),
            'application/rar' => 'rar',
            'application/x-7z-compressed' => '7z',
            'application/x-msdownload' => 'exe',
        );
    }

    /**
     * Get the file extension from mime type
     * @param $mimeType
     * @return mixed
     */
    public static function getExtensionFromMimeType($mimeType)
    {
        $arrMimeType = self::getMimeTypeExtensionData();

        foreach ($arrMimeType as $key => $value) {
            if (strpos($mimeType, $key) !== false) {
                return is_array($value) ? current($value) : $value;
            }
        }

        return false;
    }

    /**
     * Get content type of the remote file
     * @param $url, url of the remote file
     * @return string
     */
    public static function getRemoteContentType($url)
    {
        $arrHeaders = get_headers($url);
        if (is_array($arrHeaders)) {
            foreach ($arrHeaders as $value) {
                $value = strtolower($value);
                if (strpos($value, 'content-type:') !== false) {
                    return trim(str_replace('content-type: ', '', $value));
                }
            }
        }
    }
}