<?php

/* View.html */
class __TwigTemplate_8eaf1897f0370ef3b9201503033405584158292aacbc0e338ab3144284ca85cf extends Twig_Template
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
    <textarea name=\"name\" rows=\"8\" cols=\"80\">";
        // line 2
        echo twig_escape_filter($this->env, ($context["b"] ?? null), "html", null, true);
        echo "</textarea>
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
        return new Twig_Source("", "View.html", "/var/www/html/app/Components/Textarea/View.html");
    }
}
