<?php

namespace Framework\View;

use Symfony\Bridge\Twig\Extension\TranslationExtension;
use Symfony\Component\Translation\Translator as SymfonyTranslator;
use Symfony\Component\Translation\Loader\YamlFileLoader;
use Framework\Translation\Translator;

class Template
{
    private $template;

    public function __construct(string $dir)
    {
        $loader = new \Twig_Loader_Filesystem($dir);
		$extensions = [];
        if(getenv('CACHE_TEMPLATE') == 'true') {
			$extensions['cache'] = __DIR__.'/../../storage/cache';
        }
        $extensions['debug'] = true;

        $this->template = new \Twig_Environment($loader, $extensions);
        $this->template->addExtension(new TranslationExtension($this->getTranslation()));
        $this->template->addExtension(new \Twig_Extensions_Extension_Intl());
		$this->template->addExtension(new \Twig_Extension_Debug());
    }

    public function render(string $pathTemplate, array $params = []): string
    {
        return $this->template->render($pathTemplate, $params);
    }

    private function getTranslation(): SymfonyTranslator
    {
        $locale = Translator::getLocale();

        $translator = new SymfonyTranslator($locale);
        $yamlLoader = new YamlFileLoader();
        $translator->addLoader('yaml', $yamlLoader);
        $translator->addResource('yaml', __DIR__.'/../../translations/'.$locale.'.yml', $locale);

        return $translator;
    }

}
