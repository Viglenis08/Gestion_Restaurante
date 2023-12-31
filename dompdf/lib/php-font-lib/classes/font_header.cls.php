<?php

/**
 * Font header container.
 * 
 * @package php-font-lib
 */
abstract class Font_Header extends Font_Binary_Stream {
  /**
   * @var Font_TrueType
   */
  protected $font;
  protected $def = array();
  
  public $data;
  
  public function __construct(Font_TrueType $font) {
    $this->font = $font;
  }
  
  public function encode(){
    return $this->font->pack($this->def, $this->data);
  }
  
  public function parse(){
    $this->data = $this->font->unpack($this->def);
  }
}