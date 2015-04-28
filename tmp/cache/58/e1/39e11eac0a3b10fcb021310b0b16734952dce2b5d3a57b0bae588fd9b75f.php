<?php

/* wordCloud.phtml */
class __TwigTemplate_58e139e11eac0a3b10fcb021310b0b16734952dce2b5d3a57b0bae588fd9b75f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        try {
            $this->parent = $this->env->loadTemplate("home.phtml");
        } catch (Twig_Error_Loader $e) {
            $e->setTemplateFile($this->getTemplateName());
            $e->setTemplateLine(1);

            throw $e;
        }

        $this->blocks = array(
            'head' => array($this, 'block_head'),
            'search' => array($this, 'block_search'),
            'addartist' => array($this, 'block_addartist'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "home.phtml";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_head($context, array $blocks = array())
    {
        echo " 
<script type=\"text/javascript\" src=\"http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js\"></script>
<script type=\"text/javascript\" src=\"/jqcloud-1.0.4.js\"></script>
<script type=\"text/javascript\">
var word_array = ";
        // line 7
        echo (isset($context["wordArray"]) ? $context["wordArray"] : null);
        echo ";

  \$(function() {
    // When DOM is ready, select the container element and call the jQCloud method, passing the array of words as the first argument.
    \$(\"#wordCloud\").jQCloud(word_array);
  });
</script>
";
    }

    // line 16
    public function block_search($context, array $blocks = array())
    {
        // line 17
        $this->displayParentBlock("search", $context, $blocks);
        echo "
";
    }

    // line 20
    public function block_addartist($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "wordCloud.phtml";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  67 => 20,  61 => 17,  58 => 16,  46 => 7,  38 => 3,  11 => 1,);
    }
}
