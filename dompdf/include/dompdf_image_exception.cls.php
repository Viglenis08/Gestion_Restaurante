<?php


/**
 * Image exception thrown by DOMPDF
 *
 * @package dompdf
 */
class DOMPDF_Image_Exception extends DOMPDF_Exception {

  /**
   * Class constructor
   *
   * @param string $message Error message
   * @param int $code Error code
   */
  function __construct($message = null, $code = 0) {
    parent::__construct($message, $code);
  }

}
