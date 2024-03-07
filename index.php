<?php
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once __DIR__.'/vendor/autoload.php';

// Render the homepage
$twig = new Environment(new FilesystemLoader(__DIR__.'/src/Twig'));

// Change Twig annotation so it doesn't conflict with Vue
$lexer = new \Twig\Lexer($twig, [
	'tag_variable' => ['${', '}'],
]);
$twig->setLexer($lexer);

$twig->display('html.twig');