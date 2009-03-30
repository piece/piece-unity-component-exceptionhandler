<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */

/**
 * PHP version 5
 *
 * Copyright (c) 2009 KUBO Atsuhiro <kubo@iteman.jp>,
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 *     * Redistributions of source code must retain the above copyright
 *       notice, this list of conditions and the following disclaimer.
 *     * Redistributions in binary form must reproduce the above copyright
 *       notice, this list of conditions and the following disclaimer in the
 *       documentation and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @package    Piece_Unity
 * @subpackage Piece_Unity_Component_ExceptionHandler
 * @copyright  2009 KUBO Atsuhiro <kubo@iteman.jp>
 * @license    http://www.opensource.org/licenses/bsd-license.php  New BSD License
 * @version    Release: @package_version@
 * @since      File available since Release 0.1.0
 */

require_once 'PEAR/PackageFileManager2.php';
require_once 'PEAR.php';

PEAR::staticPushErrorHandling(PEAR_ERROR_CALLBACK, create_function('$error', 'var_dump($error); exit();'));

$releaseVersion = '0.2.0';
$releaseStability = 'beta';
$apiVersion = '0.2.0';
$apiStability = 'beta';
$notes = 'A new release of Piece_Unity_Component_ExceptionHandler is now available.

What\'s New in Piece_Unity_Component_ExceptionHandler 0.2.0

 * Improved the DebugInfo exception handler: The limit of the ripped source line has been changed to 21. (10 + 1 + 10)
 * Improved HTML rendering: The behavior of HTML rendering has been changed so as to send the HTTP status line and Content-Type header only if the headers haven\'t been sent.';

$package = new PEAR_PackageFileManager2();
$package->setOptions(array('filelistgenerator' => 'file',
                           'changelogoldtonew' => false,
                           'simpleoutput'      => true,
                           'baseinstalldir'    => '/',
                           'packagefile'       => 'package.xml',
                           'packagedirectory'  => '.',
                           'dir_roles'         => array('doc' => 'doc',
                                                        'src' => 'php'),
                           'ignore'            => array('package.php'))
                     );

$package->setPackage('Piece_Unity_Component_ExceptionHandler');
$package->setPackageType('php');
$package->setSummary('A component for exception handling');
$package->setDescription('Piece_Unity_Component_ExceptionHandler provides a simple exception handling system which can be used in your bootstrap code as follows:

webapp/config/bootstrap.php:

<?php
...
Piece_Unity_Service_ExceptionHandler::register(new Piece_Unity_Service_ExceptionHandler_DebugInfo());
Piece_Unity_Service_ExceptionHandler::register(new Piece_Unity_Service_ExceptionHandler_ErrorLog());
Piece_Unity_Service_ExceptionHandler::enable();
...

The last one registered will be the first one called.

Built-in exception handlers are:

Piece_Unity_Service_ExceptionHandler_DebugInfo: Outputs the exception details as a HTML page.
Piece_Unity_Service_ExceptionHandler_ErrorLog: Logs the exception message by error_log().
Piece_Unity_Service_ExceptionHandler_InternalServerError: Outputs a typical *Internal Server Error* HTML page.

Additionally, any exception handlers which implement the interface Piece_Unity_Service_ExceptionHandler_Interface can be used.');
$package->setChannel('pear.piece-framework.com');
$package->setLicense('New BSD License', 'http://www.opensource.org/licenses/bsd-license.php');
$package->setAPIVersion($apiVersion);
$package->setAPIStability($apiStability);
$package->setReleaseVersion($releaseVersion);
$package->setReleaseStability($releaseStability);
$package->setNotes($notes);
$package->setPhpDep('5.0.0');
$package->setPearinstallerDep('1.4.3');
$package->addPackageDepWithChannel('required', 'Piece_Unity', 'pear.piece-framework.com', '1.5.0');
$package->addPackageDepWithChannel('required', 'Stagehand_HTTP_Status', 'pear.piece-framework.com', '1.0.0');
$package->addPackageDepWithChannel('required', 'Stagehand_LegacyError', 'pear.piece-framework.com', '0.1.0');
$package->addExtensionDep('required', 'pcre');
$package->addExtensionDep('required', 'date');
$package->addMaintainer('lead', 'iteman', 'KUBO Atsuhiro', 'kubo@iteman.jp');
$package->addMaintainer('helper', 'noricot', 'KUBO Noriko', 'noricott@gmail.com');
$package->addGlobalReplacement('package-info', '@package_version@', 'version');
$package->generateContents();

if (array_key_exists(1, $_SERVER['argv']) && $_SERVER['argv'][1] == 'make') {
    $package->writePackageFile();
} else {
    $package->debugPackageFile();
}

exit();

/*
 * Local Variables:
 * mode: php
 * coding: iso-8859-1
 * tab-width: 4
 * c-basic-offset: 4
 * c-hanging-comment-ender-p: nil
 * indent-tabs-mode: nil
 * End:
 */
