<?php

namespace Matth\TwigBlog\Classes;

use Twig\Environment;
use Twig\Error\Error;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;
use Twig\TemplateWrapper;

/**
 * Extend to render a template
 */
class Controller extends Environment
{

    public function __construct()
    {
        $loader = new FilesystemLoader(__DIR__ . '/../../templates');
        parent::__construct($loader, [
            'debug' => true,
            'strict_variables' => true,
            'cache' => false // __DIR__ . '/../../var/cache',
        ]);

        $this->addExtension(new DebugExtension());
    }

    /**
     * @param string|TemplateWrapper $name
     * @param array $context
     * @return string
     * @throws Error
     */
    public function render($name, array $context = []): string
    {
        try {
            $tpl = parent::render($name, $context);
        }
        catch (LoaderError | RuntimeError | SyntaxError $e) {
            throw new Error("Error loading template '$name'");
        }
        echo $tpl;
        return  $tpl;
    }
}