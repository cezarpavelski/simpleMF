<?php

/* View.html */
class __TwigTemplate_71a4bcc8451cca2a3ea87cf2e73770800a368fb86ff643fcefa21fc5f4d97ab7 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<div class=\"row\">
    <input type=\"text\" name=\"\" value=\"";
        // line 2
        echo twig_escape_filter($this->env, ($context["a"] ?? null), "html", null, true);
        echo "\">
</div>
";
    }

    public function getTemplateName()
    {
        return "View.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  26 => 2,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "View.html", "/var/www/html/app/Components/Input/View.html");
    }
}
