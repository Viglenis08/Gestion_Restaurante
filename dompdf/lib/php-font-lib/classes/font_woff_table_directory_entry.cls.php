<?php


require_once dirname(__FILE__)."/font_table_directory_entry.cls.php";

/**
 * WOFF font file table directory entry.
 * 
 * @package php-font-lib
 */
class Font_WOFF_Table_Directory_Entry extends Font_Table_Directory_Entry {
  function __construct(Font_WOFF $font) {
    parent::__construct($font);
    $this->offset = $this->readUInt32();
    $this->length = $this->readUInt32();
    $this->origLength = $this->readUInt32();
    $this->checksum = $this->readUInt32();
  }
}
