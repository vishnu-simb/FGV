<?php
/**
 * Extended clientscript to automatically merge script and css files
 *
 * @author Trac Nguyen <npbtrac@yahoo.com>
 * @version $Id $
 * @package extensions.minify
 * @since 1.0
 */
class NpMinScript extends CClientScript
{
	/**
	 * @var combined script file name
	 */
	public $scriptFileName = 'script.js';
	/**
	 * @var combined css stylesheet file name
	 */
	public $cssFileName = 'style.css';
	/**
	 * @var boolean if to combine the script files or not
	 */
	public $combineScriptFiles = true;
	/**
	 * @var boolean if to combine the css files or not
	 */
	public $combineCssFiles = true;
	/**
	 * @var boolean if to optimize the css files
	 */
	public $optimizeCssFiles = true;
	/**
	 * @var boolean if to optimize the script files via googleCompiler(this may cause to much slower)
	 */
	public $optimizeScriptFiles = true;
	/**
	 * @var integer maximum compressed files
	 */
	public $maxFileSize = 200000;
	/**
	 * @var string name of cache object
	 */
	public $cacheObjectName = '';
	public $cacheTimeout = 7200;

    /* @var string url of the static resources */
    public $staticUrl = '';

    /* @var boolean place js at the end or not */
    public $jsPosEnd = false;

    public $cacheFoldername = 'npMinScript';

    protected $excludedCssFiles = array();
    protected $excludedScriptFiles = array();

    public function init()
    {
        parent::init();

        if (empty($this->staticUrl)) {
            $this->staticUrl = Yii::app()->params['absUrlStatic'];
        }

        $this->createMinifiedFoler();
    }

	/**
	 * Combine css files and script files before renderHead.
	 * @param string the output to be inserted with scripts.
	 */
	public function renderHead(&$output)
	{
		if ($this->combineCssFiles)
			$this->combineCssFiles();

		if ($this->combineScriptFiles && $this->enableJavaScript)
			$this->combineScriptFiles(self::POS_HEAD);

        parent::renderHead($output);
	}

	/**
	 * Inserts the scripts at the beginning of the body section.
	 * @param string the output to be inserted with scripts.
	 */
	public function renderBodyBegin(&$output)
	{
		// $this->enableJavascript has been checked in parent::render()
		if ($this->combineScriptFiles)
			$this->combineScriptFiles(self::POS_BEGIN);

		parent::renderBodyBegin($output);
	}

	/**
	 * Inserts the scripts at the end of the body section.
	 * @param string the output to be inserted with scripts.
	 */
	public function renderBodyEnd(&$output)
	{
		// $this->enableJavascript has been checked in parent::render()
		if ($this->combineScriptFiles)
			$this->combineScriptFiles(self::POS_END);

		parent::renderBodyEnd($output);
	}

    /**
     * create minified folder to store files
     * @return bool
     */
    protected function createMinifiedFoler()
    {
        return file_exists($this->getMinifiedPath()) ? true : mkdir($this->getMinifiedPath(), 0777);
    }

    /**
     * Get the path of minified asset files
     * @param string $filename
     * @return string
     */
    protected function getMinifiedPath($filename='')
    {
        $strFolderName = DIRECTORY_SEPARATOR. $this->cacheFoldername;
        return $filename ? Yii::app()->runtimePath . $strFolderName . DIRECTORY_SEPARATOR . $filename
            : Yii::app()->runtimePath . $strFolderName;
    }

    protected function getMinifiedUrl($filename='')
    {
        $strFolderName = '/' .'npMinScript';
        return $filename ? Yii::app()->assetManager->baseUrl . $strFolderName . '/' . $filename
            : Yii::app()->assetManager->baseUrl . $strFolderName;
    }

	/**
	 * Combine the CSS files, if cached enabled then cache the result so we won't have to do that
	 * Every time
	 */
	protected function combineSingleCssFile($files, $media)
    {
		$cssFiles = array();
		// get unique combined filename
		$fname = $this->getCombinedFileName($this->cssFileName, $files, $media);
		$fpath = $this->getMinifiedPath($fname);

        // check exists file
		$valid = file_exists($fpath);
        $tmpUrl = Yii::app()->assetManager->getPublishedUrl($fpath);

        // re-generate the file
		if (!$valid)
		{
			$urlRegex = '#url\s*\(\s*([\'"])?(?!/|http://)([^\'"\s])#i';
			$fileBuffer = '';

			foreach ($files as $url => $file)
			{
				$contents = file_get_contents($file);
                if ($contents)
				{
					// Reset relative url() in css file
                    $reurl = '';

					if (preg_match($urlRegex, $contents))
					{
						// replace the relative url with absolute url of the file
						$reurl = dirname($url);
						$contents = preg_replace($urlRegex, 'url(${1}' . $reurl . '/${2}', $contents);
                        /*
                        echo '<pre> $url: ';
                        print_r($url);
                        echo '</pre>';

                        echo '<pre> url: ';
                        print_r($reurl);
                        echo '</pre>';

                        echo '<pre> $contents: ';
                        print_r($contents);
                        echo '</pre>';

                        die('sadf');*/
					}
					// Append the contents to the fileBuffer
					$fileBuffer .= "/*** CSS File: {$url} {$reurl}";
					if ($this->optimizeCssFiles 
						&& strpos($file, '.min.') === false && strpos($file, '.pack.') === false)
					{
						$fileBuffer .= ", Original size: " . number_format(strlen($contents)) . ", Compressed size: ";
						$contents = $this->optimizeCssCode($contents);
						$fileBuffer .= number_format(strlen($contents));
					}
					$fileBuffer .= " ***/\n";
					$fileBuffer .= $contents . "\n\n";
				}
			}
			file_put_contents($fpath, $fileBuffer);
		}
		// real url of combined file
		$url = Yii::app()->assetManager->publish($fpath);
		$cssFiles[$url] = $media;
		return $cssFiles;
	}

	/**
	 * Combine the CSS files, if cached enabled then cache the result so we won't have to do that
	 * Every time
	 */
	protected function combineCssFiles() {
		// Check the need for combination
		if (count($this->cssFiles) < 2)
			return;

        $toBeProcessed = array(); // Array of files to be combined
        $tmpValue = array();

        foreach ($this->cssFiles as $url => $media) {
            if ($media == '')
                $media = 'all';
            $this->cssFiles[$url] = strtolower($media);
            if (!isset($toBeProcessed[$media])) {
                $toBeProcessed[$media] = array();
                $tmpValue[$media] = array();
            }
        }

        $cssFiles = $this->cssFiles;

        foreach ($this->cssFiles as $url => $media) {
            $file = $this->getLocalPath($url);

            if ($file === false || in_array($url, $this->excludedCssFiles)) {
                if (!empty($tmpValue[$media])) $toBeProcessed[$media][] = $tmpValue[$media];
                $toBeProcessed[$media][] = $url; // put the url to a new index, not to be combined
                $tmpValue[$media] = array();
            } else {
                $tmpValue[$media][$url] = $file; // put the url to current index, for combining
            }

            unset($cssFiles[$url]);
            // If array reached to the end, add value to the processing array
            if (!empty($tmpValue[$media]) && !in_array($media, $cssFiles)) {
                $toBeProcessed[$media][] = $tmpValue[$media];
            }
        }

        //Check if is cached
		$cacheKey = $this->getHashCache($this->cssFiles);
		if (is_object($this->cacheObjectName) && ($cached_json = Yii::app()->{$this->cacheObjectName}->get($cacheKey))) {
			$cached_data = json_decode($cached_json, true);
			$this->cssFiles = $cached_data;
		}
		else {
            $this->cssFiles = array();

            foreach ($toBeProcessed as $media => $toBeProcessedMedia) {
                foreach ($toBeProcessedMedia as $toBeCombined) {
                    // if value is an array of files to be combined
                    if (is_array($toBeCombined)) {
                        $arrCombining = array();
                        $numFileSize = 0;
                        foreach ($toBeCombined as $url=>$file) {
                            $currentFileSize = filesize($file);
                            if ($numFileSize && (($numFileSize + $currentFileSize) > $this->maxFileSize)) {
                                $this->cssFiles = array_merge($this->cssFiles, $this->combineSingleCssFile($arrCombining, $media));
                                $numFileSize = $currentFileSize;
                                $arrCombining = array($url=>$file);
                            }
                            else {
                                $numFileSize += $currentFileSize;
                                $arrCombining[$url] = $file;
                            }
                        }
                        if (!empty($arrCombining))
                            $this->cssFiles = array_merge($this->cssFiles, $this->combineSingleCssFile($arrCombining, $media));
                    } else {
                        $this->cssFiles[$toBeCombined] = $media;
                    }
                }
            }

        }
    }

	/**
	 * Combine script files, we combine them based on their position, each is combined in a separate file
	 * to load the required data in the required location.
	 * @param $type CClientScript the type of script files currently combined
	 */
	protected function combineSingleScriptFile($toBeCombined, $type = self::POS_HEAD) {
		$scriptFiles = array();
		// get unique combined filename
		$fname = $this->getCombinedFileName($this->scriptFileName, array_values($toBeCombined), $type);
		$fpath = $this->getMinifiedPath($fname);
		// check exists file
		$valid = file_exists($fpath);
		// re-generate the file
		if (!$valid)
		{
			$fileBuffer = '';
			foreach ($toBeCombined as $url => $file)
			{
				$contents = file_get_contents($file);
				if ($contents)
				{
					// Append the contents to the fileBuffer
					$fileBuffer .= "/*** Script File: {$url}";
					if ($this->optimizeScriptFiles
						&& strpos($file, '.min.') === false && strpos($file, '.pack.') === false)
					{
						$fileBuffer .= ", Original size: " . number_format(strlen($contents)) . ", Compressed size: ";
						$contents = $this->optimizeScriptCode($contents);
						$fileBuffer .= number_format(strlen($contents));
					}
					$fileBuffer .= " ***/\n";
					$fileBuffer .= $contents . "\n;\n";
				}
			}
			file_put_contents($fpath, $fileBuffer);
		}
		// add the combined file into one file and publish to asset
		$url = Yii::app()->assetManager->publish($fpath);
        $scriptFiles[$url] = $url;

		return $scriptFiles;
	}

	/**
	 * Combine script files, we combine them based on their position, each is combined in a separate file
	 * to load the required data in the required location.
	 * @param $type CClientScript the type of script files currently combined
	 */
	protected function combineScriptFiles($type = self::POS_HEAD) {
		// Check the need for combination
		if (!isset($this->scriptFiles[$type]) || count($this->scriptFiles[$type]) < 2)
			return;

        $toBeProcessed = array(); // Array of files to be combined
        $tmpValue = array();
        $i = 0;
        foreach ($this->scriptFiles[$type] as $key => $url)
		{
            $i++;
			$file = $this->getLocalPath($url);

            if ($file === false || in_array($url, $this->excludedScriptFiles)) {
                if (!empty($tmpValue)) $toBeProcessed[] = $tmpValue;
                $toBeProcessed[] = $url; // put the url to a new index, not to be combined
                $tmpValue = array();
            } else {
                $tmpValue[$url] = $file; // put the url to current index, for combining
            }


            // If array reached to the end, add value to the processing array
            if (!empty($tmpValue) && $i == count($this->scriptFiles[$type])) {
                $toBeProcessed[] = $tmpValue;
            }
		}

        //Check if is cached
		$cacheKey = $this->getHashCache($toBeProcessed);
		if ((is_object($this->cacheObjectName)) && ($cached_json = Yii::app()->{$this->cacheObjectName}->get($cacheKey))) {
			$cached_data = json_decode($cached_json, true);
			$this->scriptFiles[$type] = $cached_data;
		}
		else {
            $this->scriptFiles[$type] = array();

            foreach ($toBeProcessed as $toBeCombined) {
                // if value is an array of files to be combined
                if (is_array($toBeCombined)) {
                    $arrCombining = array();
                    $numFileSize = 0;
                    foreach ($toBeCombined as $url=>$file) {
                        $currentFileSize = filesize($file);
                        if ($numFileSize && (($numFileSize + $currentFileSize) > $this->maxFileSize)) {
                            $this->scriptFiles[$type] = array_merge($this->scriptFiles[$type], $this->combineSingleScriptFile($arrCombining, $type));
                            $numFileSize = $currentFileSize;
                            $arrCombining = array($url=>$file);
                        }
                        else {
                            $numFileSize += $currentFileSize;
                            $arrCombining[$url] = $file;
                        }
                    }
                    if (!empty($arrCombining))
                        $this->scriptFiles[$type] = array_merge($this->scriptFiles[$type], $this->combineSingleScriptFile($arrCombining, $type));
                } else {
                    $this->scriptFiles[$type][$toBeCombined] = $toBeCombined;
                }
            }

            //Set cache
			if (is_object($this->cacheObjectName)) {
				Yii::app()->{$this->cacheObjectName}->set($cacheKey, json_encode($this->scriptFiles[$type]), $this->cacheTimeout);
			}
		}

        // Set js to
        $jsPos = $this->jsPosEnd ? self::POS_END : self::POS_HEAD;
        if ($jsPos != self::POS_HEAD) {
            $this->scriptFiles[$jsPos] = array_merge(isset($this->scriptFiles[self::POS_HEAD]) ? $this->scriptFiles[self::POS_HEAD] : array(), isset($this->scriptFiles[self::POS_BEGIN]) ? $this->scriptFiles[self::POS_BEGIN] : array(), isset($this->scriptFiles[self::POS_END]) ? $this->scriptFiles[self::POS_END] : array());
            unset($this->scriptFiles[self::POS_HEAD]);
            unset($this->scriptFiles[self::POS_BEGIN]);
        }
    }

	protected function getHashCache($files) {
		$s = $this->maxFileSize;
		foreach ($files as $file) {
			$s .= is_array($file) ? http_build_query($file) : $file;
		}
		return self::hash($s);
	}

	/**
	 * Get realpath of published file via its url, refer to {link: CAssetManager}
	 * @return string local file path for this script or css url
	 */
	private function getLocalPath($url)
	{
		$basePath = Yii::app()->themeManager->basePath ? dirname(Yii::app()->themeManager->basePath) . DIRECTORY_SEPARATOR . '..' .DIRECTORY_SEPARATOR : dirname(Yii::app()->basePath) . DIRECTORY_SEPARATOR . '..' .DIRECTORY_SEPARATOR;
		$baseUrl = isset(Yii::app()->params['absUrl']) ? Yii::app()->params['absUrl'].'/' : Yii::app()->homeUrl;

        if (!strncmp($url, $baseUrl, strlen($baseUrl)))
		{
			$filePath = $basePath . substr($url, strlen($baseUrl));
            return $filePath;
		}
		return false;
	}

	/**
	 * Calculate the relative url
	 * @param string $from source url, begin with slash and not end width slash.
	 * @param string $to dest url
	 * @return string result relative url
	 */
	private function getRelativeUrl($from, $to)
	{
		$relative = '';
		while (true)
		{
			if ($from === $to)
				return $relative;
			else if ($from === dirname($from))
				return $relative . substr($to, 1);
			if (!strncmp($from . '/', $to, strlen($from) + 1))
				return $relative . substr($to, strlen($from) + 1);

			$from = dirname($from);
			$relative .= '../';
		}
	}

	/**
	 * Generates base64-like md5sum hash (smaller than hex md5sum)
	 * @param string $s the string to hash
	 * @return string a one way hash of the given string
	 */
	public function hash($s) {
		return str_replace(array('+', '/', '='), array('-', '_', ''), base64_encode(md5($s,1)));
	}

	/**
	 * Get unique filename for combined files
	 * Enpii - Add $offset for multi-files featues
	 * @param string $name default filename
	 * @param array $files files to be combined
	 * @param string $type css media or script position
	 * @param integer offset of combined files
	 * @return string unique filename
	 */
	private function getCombinedFileName($name, $files, $type = '')
	{
		$pos = strrpos($name, '.');
		if (!$pos)
			$pos = strlen($pos);
		$s='';
		foreach($files as $file) $s.="\0$file\0".filemtime($file);
		$hash = self::hash($s);

		$ret = substr($name, 0, $pos);
		if ($type !== '')
			$ret .= '-' . str_replace(array(',', ' '), '_', $type);
		$ret .= '-' . $hash . substr($name, $pos);
		return $ret;
	}

	/**
	 * Optmize css, strip any spaces and newline
	 * @param string $data input css data
	 * @return string optmized css data
	 */
	private function optimizeCssCode($code)
	{
		require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'CssMin.php';
		return CssMin::minify($code, array(), array('CompressUnitValues' => true));
	}

	/**
	 * Optimize script via google compiler
	 * @param string $data script code
	 * @return string optimized script code
	 */
	private function optimizeScriptCode($code)
	{
		require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'JSMinPlus.php';
		$minified = JSMinPlus::minify($code);
		return ($minified === false ? $code : $minified);
	}

    /**
     * Register a CSS file with version trail
     * @param string $url
     * @param string $media
     * @return $this|CClientScript
     */
    public function registerCssFile($url,$media='', $exclude=false)
    {
        if ($exclude) {
            $this->excludedCssFiles[] = $url;
        }
        return parent::registerCssFile($url,$media);
    }

    /**
     * Register a Script file with version trail
     * @param string $url
     * @param null $position
     * @param array $htmpOptions
     * @return $this|CClientScript
     */
    public function registerScriptFile($url,$position=NULL, array $htmlOptions=array(), $exclude=false)
    {
        if ($exclude) {
            $this->excludedScriptFiles[] = $url;
        }
        return parent::registerScriptFile($url,$position,$htmlOptions);
    }
}