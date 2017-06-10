<?php

namespace AppBundle\Logic\Benchmark\Export;

class ImageExportLogic {
	
	const A_START = "<a";
	const A_END = "</a>";
	
	const SCRIPT_START = "<script";
	const SCRIPT_END = "</script>";
	
	const LINK_START = "<link";
	const LINK_END = "/>";
	
	const IMG_START = "<img";
	const IMG_END = "/>";
	
	const SRC = "src=\"";
	const HREF = "href=\"";
	
	const INFO_MARKET = "http://infomarket.edu.pl";
	
	public function clean($html) {
		$html = $this->removeJsLinks($html);
		$html = $this->replaceCssLinks($html);
		$html = $this->removeLinks($html);
		$html = $this->replaceRelativeSources($html);
		
		return $html;
	}
	
	protected function removeJsLinks($html) {
		return $this->removeElements($html, self::SCRIPT_START, self::SCRIPT_END);
	}
	
	protected function replaceCssLinks($html) {
		return $this->prependElements($html, self::LINK_START, self::LINK_END, self::HREF, self::INFO_MARKET);
	}
	
	protected function removeLinks($html) {
		return $this->removeElements($html, self::A_START, self::A_END);
	}
	
	protected function replaceRelativeSources($html) {
		return $this->prependElements($html, self::IMG_START, self::IMG_END, self::SRC, self::INFO_MARKET);
	}
	
	protected function removeElements($html, $startTag, $endTag) {
		$pos = 0;
		
		while(($pos = strpos($html, $startTag, $pos)) !== false) {
			$endpos = strpos($html, $endTag, $pos);
				
			if($endpos === false) {
				throw new \InvalidArgumentException("Invalid html content. Cannot find end tag '" . $endTag . "'.");
			} else {
				$link = substr($html, $pos, $endpos + strlen($endTag) - $pos);
				$html = str_replace($link, "", $html);
			}
		}
		
		return $html;
	}
	
	protected function prependElements($html, $startTag, $endTag, $hrefTag, $prependString) {
		$pos = 0;
	
		while(($pos = strpos($html, $startTag, $pos)) !== false) {
			$endpos = strpos($html, $endTag, $pos);
	
			if($endpos === false) {
				throw new \InvalidArgumentException("Invalid html content. Cannot find end tag '" . $endTag . "'.");
			} else {
				$link = substr($html, $pos, $endpos + strlen($endTag) - $pos);
				
				$tagpos = strpos($html, $hrefTag, $pos);
				
				if($tagpos !== false && $tagpos < $endpos) {
					$link2 = str_replace($hrefTag, $hrefTag . $prependString, $link);
					$html = str_replace($link, $link2, $html);
				}
				
				$pos = $endpos;
			}
		}
	
		return $html;
	}
}