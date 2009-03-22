<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */

/**
 * PHP version 5
 *
 * Copyright (c) 2009 KUBO Atsuhiro <kubo@iteman.jp>,
 *               2009 KUBO Noriko <noricott@gmail.com>,
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
 * @copyright  2009 KUBO Noriko <noricott@gmail.com>
 * @license    http://www.opensource.org/licenses/bsd-license.php  New BSD License
 * @version    Release: @package_version@
 * @since      File available since Release 0.1.0
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
    <title>Piece_Unity Debug Information</title>
    <style type="text/css">
body  {font-size: 0.78em; line-height:1.5; }
h1  {clear: both; color: #AA1122; margin: 10px 0 0; }
h2  {clear: both; color: #000000; font-size: 120%; margin: 10px 0 0; }
h3  {background-color: #EAEAEA; border-bottom: 1px solid #DDDDDD; color: #666666; font-size: 90%; overflow: hidden; padding: 0.5em 1em; margin: 0; }
div.group  {border-bottom: 2px solid #AAAAAA; display: block; }
div.key  {border-top: 1px solid #AAAAAA; color: #666666; float: left; padding: 0 5px; width: 160px; }
div.value  {border-top: 1px solid #AAAAAA; overflow: auto; padding: 0 5px; }
div.source  {border-color: #DDDDDD; border-width: 0 1px 1px; border-style: none solid solid; display: block; }
div.line_numbers  {background-color: #ECECEC; border-right: 1px solid #DDDDDD; color: #AAAAAA; float: left; padding: 0; text-align: right; width:60px; }
div.codearea {overflow: auto; }
div.source span {padding: 0 5px 0; }
div.source span.highlight  {background-color: #AA1122; color: #ffffff; display: block; margin: 0 0 -1.2em; }
dl  {margin: 0; }
dt  {border-top: 1px solid #AAAAAA; color: #666666; float: left; padding: 0 5px; width: 50px; }
dd  {border-top: 1px solid #AAAAAA; display: block; margin: 0 0 0 50px; padding: 0 5px; }
pre {-x-system-font: none; font-family:'andale mono','lucida console',monospace; font-size-adjust: none; font-style: normal; font-variant: normal; font-weight: normal; line-height: normal; margin: 0; }
div.copyright  {color: #AA1122; font-size: 90%; margin: 10px 10px 20px; text-align: right; }
    </style>
  </head>
  <body>
    <h1>Piece_Unity Debug Information</h1>

    <h2>Context</h2>
      <div class="group">
        <div class="key">REQUEST_METHOD</div>
        <div class="value"><?php echo htmlspecialchars($_SERVER['REQUEST_METHOD'], ENT_QUOTES) ?></div>
        <div class="key">REQUEST_URI</div>
        <div class="value"><?php echo htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES) ?></div>
      </div>

    <h2>Exception</h2>
      <div class="group">
        <div class="key">Message</div>
        <div class="value"><pre><?php echo htmlspecialchars($debugInfo->exception->getMessage(), ENT_QUOTES) ?></pre></div>
        <div class="key">Code</div>
        <div class="value"><?php echo htmlspecialchars($debugInfo->exception->getCode(), ENT_QUOTES) ?></div>
        <div class="key">Class</div>
        <div class="value"><?php echo htmlspecialchars(get_class($debugInfo->exception), ENT_QUOTES) ?></div>
        <div class="key">File</div>
        <div class="value"><?php echo htmlspecialchars($debugInfo->exception->getFile(), ENT_QUOTES) ?></div>
        <div class="key">Line</div>
        <div class="value"><?php echo htmlspecialchars($debugInfo->exception->getLine(), ENT_QUOTES) ?></div>
      </div>

    <h2>Source</h2>
    <h3><?php echo htmlspecialchars($debugInfo->exception->getFile(), ENT_QUOTES) ?></h3>
    <div class="source">
      <div class="line_numbers">
        <pre><?php foreach ($debugInfo->source as $source): ?><span<?php if ($debugInfo->exception->getLine() == $source->line): ?> class="highlight"<?php endif; ?>><?php echo htmlspecialchars($source->line, ENT_QUOTES) ?></span>
<?php endforeach; ?></pre>
      </div>
      <div class="codearea">
        <pre><?php foreach ($debugInfo->source as $source): ?><span<?php if ($debugInfo->exception->getLine() == $source->line): ?> class="highlight"<?php endif; ?>><?php echo htmlspecialchars(preg_replace('/^$/', ' ', $source->code), ENT_QUOTES) ?></span>
<?php endforeach; ?></pre>
      </div>
    </div>

    <h2>Trace</h2>
    <div class="group">
      <dl>
<?php for ($i = 0, $count = count($debugInfo->trace); $i < $count; ++$i): ?>
        <dt>#<?php echo $i ?></dt>
        <dd><?php echo htmlspecialchars($debugInfo->trace[$i], ENT_QUOTES) ?></dd>
<?php endfor; ?>
      </dl>
    </div>
    
    <div class="copyright">Copyright &copy; 2009 Piece Project, All rights reserved.</div>
  </body>
</html>
