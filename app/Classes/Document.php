<?php
/**
 * Created by PhpStorm.
 * User: AQSSA
 */

namespace App\Classes;


class Document
{
    private $title;
    private $description;
    private $keywords;
    private $links = [];
    private $styles = [];
    private $scripts = [];

    /**
     *
     *
     * @param	string	$title
     */
    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }

    /**
     *
     *
     * @return	string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     *
     *
     * @param	string	$description
     */
    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    /**
     *
     *
     * @param	string	$description
     *
     * @return	string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     *
     *
     * @param	string	$keywords
     */
    public function setKeywords($keywords) {
        $this->keywords = $keywords;
        return $this;
    }

    /**
     *
     *
     * @return	string
     */
    public function getKeywords() {
        return $this->keywords;
    }

    /**
     *
     *
     * @param	string	$href
     * @param	string	$rel
     */
    public function addLink($href, $rel) {
        $this->links[$href] = array(
            'href' => $href,
            'rel'  => $rel
        );
        return $this;
    }

    /**
     *
     *
     * @return	array
     */
    public function getLinks() {
        return $this->links;
    }

    /**
     *
     *
     * @param	string	$href
     * @param	string	$rel
     * @param	string	$media
     */
    public function addStyle($href, $rel = 'stylesheet', $media = 'screen') {
        $this->styles[$href] = array(
            'href'  => $href,
            'rel'   => $rel,
            'media' => $media
        );
        return $this;
    }

    /**
     *
     *
     * @return	array
     */
    public function getStyles() {
        return $this->styles;
    }

    /**
     *
     *
     * @param	string	$href
     * @param	string	$postion
     */
    public function addScript($href, $postion = 'header') {
        $this->scripts[$postion][$href] = $href;
        return $this;
    }

    /**
     *
     *
     * @param	string	$postion
     *
     * @return	array
     */
    public function getScripts($postion = 'header') {
        if (isset($this->scripts[$postion])) {
            return $this->scripts[$postion];
        } else {
            return array();
        }
    }
}
