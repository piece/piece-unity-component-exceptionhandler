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

// {{{ Piece_Unity_Service_ExceptionHandler

/**
 * A class for exception handling.
 *
 * Piece_Unity_Component_ExceptionHandler provides a simple exception handling system
 * which can be used in your bootstrap code as follows:
 *
 * webapp/config/bootstrap.php:
 *
 * <code>
 * <?php
 * ...
 * Piece_Unity_Service_ExceptionHandler::register(new Piece_Unity_Service_ExceptionHandler_DebugInfo());
 * Piece_Unity_Service_ExceptionHandler::register(new Piece_Unity_Service_ExceptionHandler_ErrorLog());
 * Piece_Unity_Service_ExceptionHandler::enable();
 * ...
 * </code>
 *
 * The last one registered will be the first one called.
 *
 * @package    Piece_Unity
 * @subpackage Piece_Unity_Component_ExceptionHandler
 * @copyright  2009 KUBO Atsuhiro <kubo@iteman.jp>
 * @license    http://www.opensource.org/licenses/bsd-license.php  New BSD License
 * @version    Release: @package_version@
 * @since      Class available since Release 0.1.0
 */
class Piece_Unity_Service_ExceptionHandler
{

    // {{{ properties

    /**#@+
     * @access public
     */

    /**#@-*/

    /**#@+
     * @access protected
     */

    /**#@-*/

    /**#@+
     * @access private
     */

    private static $_exceptionHandlers = array();

    /**#@-*/

    /**#@+
     * @access public
     */

    // }}}
    // {{{ register()

    /**
     * @param Piece_Unity_Service_ExceptionHandler_Interface $exceptionHandler
     */
    public static function register(Piece_Unity_Service_ExceptionHandler_Interface $exceptionHandler)
    {
        self::$_exceptionHandlers[] = $exceptionHandler;
    }

    // }}}
    // {{{ enable()

    /**
     */
    public static function enable()
    {
        Stagehand_LegacyError_PHPError::enableConversion();
        Stagehand_LegacyError_PEARError::enableConversion();
        Stagehand_LegacyError_PEARErrorStack::enableConversion();

        set_exception_handler(array(__CLASS__, 'handle'));
    }

    // }}}
    // {{{ disable()

    /**
     */
    public static function disable()
    {
        restore_exception_handler();

        Stagehand_LegacyError_PEARErrorStack::disableConversion();
        Stagehand_LegacyError_PEARError::disableConversion();
        Stagehand_LegacyError_PHPError::disableConversion();
    }

    // }}}
    // {{{ handle()

    /**
     * @param Exception $exception
     */
    public static function handle(Exception $exception)
    {
        while (ob_get_level()) {
            ob_end_clean();
        }

        foreach (self::$_exceptionHandlers as $exceptionHandler) {
            $exceptionHandler->handle($exception);
        }
    }

    /**#@-*/

    /**#@+
     * @access protected
     */

    /**#@-*/

    /**#@+
     * @access private
     */

    /**#@-*/

    // }}}
}

// }}}

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
