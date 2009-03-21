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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
    <title>Piece_Unity Debug Information</title>
  </head>
  <body>
    <h1>Piece_Unity Debug Information</h1>

    <h2>Context</h2>
    <dl>
      <dt>REQUEST_METHOD</dt>
      <dd><?php echo htmlentities($_SERVER['REQUEST_METHOD'], ENT_QUOTES) ?></dd>
      <dt>REQUEST_URI</dt>
      <dd><?php echo htmlentities($_SERVER['REQUEST_URI'], ENT_QUOTES) ?></dd>
    </dl>

    <h2>Exception</h2>
    <dl>
      <dt>Message</dt>
      <dd><?php echo nl2br($debugInfo->exception->getMessage()) ?></dd>
      <dt>Code</dt>
      <dd><?php echo htmlentities($debugInfo->exception->getCode(), ENT_QUOTES) ?></dd>
      <dt>Class</dt>
      <dd><?php echo htmlentities(get_class($debugInfo->exception), ENT_QUOTES) ?></dd>
      <dt>File</dt>
      <dd><?php echo htmlentities($debugInfo->exception->getFile(), ENT_QUOTES) ?></dd>
      <dt>Line</dt>
      <dd><?php echo htmlentities($debugInfo->exception->getLine(), ENT_QUOTES) ?></dd>
    </dl>

    <h2>Source</h2>
    <h3><?php echo htmlentities($debugInfo->exception->getFile(), ENT_QUOTES) . ':' ?></h3>
    <dl>
<?php foreach ($debugInfo->source as $source): ?>
      <dt><?php echo htmlentities($source->line, ENT_QUOTES) ?></dt>
      <dd><?php echo htmlentities($source->code, ENT_QUOTES) ?></dd>
    </dl>
<?php endforeach; ?>

    <h2>Trace</h2>
    <ol start="0">
<?php foreach ($debugInfo->trace as $invocation): ?>
      <li><?php echo htmlentities($invocation, ENT_QUOTES) ?></li>
<?php endforeach; ?>
    </ol>
  </body>
</html>
