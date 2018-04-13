<?php

namespace Framework\Templates;

use Symfony\Bridge\Twig\Extension\TranslationExtension;
use Symfony\Component\Translation\Translator as SymfonyTranslator;
use Symfony\Component\Translation\Loader\YamlFileLoader;

class Template
{
    private $template;

    public function __construct(string $dir)
    {
        $loader = new \Twig_Loader_Filesystem($dir);
        $cachePath = array();
        if(getenv('CACHE_TEMPLATE') == 'true') {
            $cachePath = array(
                'cache' => __DIR__.'/../../storage/cache',
            );
        }
        $this->template = new \Twig_Environment($loader, $cachePath);
        $this->template->addExtension(new TranslationExtension($this->getTranslation()));
    }

    public function render(string $pathTemplate, array $params): string
    {
        return $this->template->render($pathTemplate, $params);
    }

    private function getTranslation(): SymfonyTranslator
    {
        $locale = getenv('LANGUAGE');

        if($_SESSION['lang']){
            $locale = $_SESSION['lang'];
        }

        $translator = new SymfonyTranslator($locale);
        $yamlLoader = new YamlFileLoader();
        $translator->addLoader('yaml', $yamlLoader);
        $translator->addResource('yaml', __DIR__.'/../../translations/'.$locale.'.yml', $locale);
        return $translator;
    }

}
