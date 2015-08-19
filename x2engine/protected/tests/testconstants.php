<?php
// set this to true to enable verbose output during tests
defined('X2_VERBOSE_MODE') or define('X2_VERBOSE_MODE', true);
/*
 * Set this to configure the level out output during unit tests
 * 0 = No output other than test completion status
 * 1 = Output names of test classes and statuses of tests
 * 2 = Output names of test classes and methods and detailed information within tests
 */
defined('X2_TEST_DEBUG_LEVEL') or define('X2_TEST_DEBUG_LEVEL', 0);

defined('X2_FTP_FILEOPER') or define('X2_FTP_FILEOPER', false);
defined('X2_DEBUG_EMAIL') or define('X2_DEBUG_EMAIL', false);
defined('X2_FTP_HOST') or define('X2_FTP_HOST', 'localhost');
defined('X2_FTP_USER') or define('X2_FTP_USER', 'root');
defined('X2_FTP_PASS') or define('X2_FTP_PASS', '');
defined('X2_FTP_CHROOT_DIR') or define('X2_FTP_CHROOT_DIR', false);
// if set to false, prevents all fixtures from being loaded, unless X2_LOAD_FIXTURES_FOR_CLASS_ONLY
// is set to true
defined('X2_LOAD_FIXTURES') or define('X2_LOAD_FIXTURES', false);
// if set to true, causes all fixtures but the ones defined in test class and its ancestors from
// being loaded. Takes effect even if X2_LOAD_FIXTURES is false
defined('X2_LOAD_FIXTURES_FOR_CLASS_ONLY') or define('X2_LOAD_FIXTURES_FOR_CLASS_ONLY', false);

?>
