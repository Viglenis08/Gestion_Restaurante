<?php

/**
 * Standard exception thrown by DOMPDF classes
 *
 * @package dompdf
 */
class DOMPDF_Exception extends Exception {

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
