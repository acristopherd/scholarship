<?php defined('BASEPATH') OR exit('No direct script access allowed.');

/**
 * CodeIgniter compatible email-library powered by PHPMailer.
 * Version: 1.1.5
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2012-2015.
 * @license The MIT License (MIT), http://opensource.org/licenses/MIT
 * @link https://github.com/ivantcholakov/codeigniter-phpmailer
 *
 * This library is intended to be compatible with CI 2.x and CI 3.x.
 *
 * Tested on production sites with CodeIgniter 3.0rc2 (February 15, 2015) and
 * PHPMailer Version 5.2.9+ (November 13, 2014).
 */

class Phpemail extends CI_Email {

    public function __construct($config = array()) {

        parent::__construct();
    }

}
