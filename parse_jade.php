<?php

require('./jade/autoload.php.dist');

use Everzet\Jade\Dumper\PHPDumper,
  Everzet\Jade\Visitor\AutotagsVisitor,
  Everzet\Jade\Filter\JavaScriptFilter,
  Everzet\Jade\Filter\CDATAFilter,
  Everzet\Jade\Filter\PHPFilter,
  Everzet\Jade\Filter\CSSFilter,
  Everzet\Jade\Parser,
  Everzet\Jade\Lexer\Lexer,
  Everzet\Jade\Jade;


$dumper = new PHPDumper();
$dumper->registerVisitor('tag', new AutotagsVisitor());
$dumper->registerFilter('javascript', new JavaScriptFilter());
$dumper->registerFilter('cdata', new CDATAFilter());
$dumper->registerFilter('php', new PHPFilter());
$dumper->registerFilter('style', new CSSFilter());



// Initialize parser & Jade
$parser = new Parser(new Lexer());
$jade   = new Jade($parser, $dumper);

$template = __DIR__ . '/templates/index.jade';
$template_file =  __DIR__ . '/templates/index.jade.php';
// Parse a template (both string & file containers)

echo "Parsing $template to  $template_file".PHP_EOL;

file_put_contents ($template_file,  $jade->render($template));

$template = __DIR__ . '/templates/teacher.jade';
$template_file =  __DIR__ . '/templates/teacher.jade.php';

echo "Parsing $template to  $template_file".PHP_EOL;

file_put_contents ($template_file,  $jade->render($template));


$template = __DIR__ . '/templates/logout.jade';
$template_file =  __DIR__ . '/templates/logout.jade.php';

echo "Parsing $template to  $template_file".PHP_EOL;

file_put_contents ($template_file,  $jade->render($template));



?>