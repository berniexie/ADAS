<?php

/* paperList.phtml */
class __TwigTemplate_e512700020ec8fc580c50bae36f2af53a284d454161000c331cb8f1f40b62306 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<html>

<head>
    <link rel=\"stylesheet\" type=\"text/css\" href=\"/Stylesheets/pageStyles.css\">
    <script src = \"./main.js\"> </script>
     <style>
        a {
            text-decoration: none;
            color: #000000;
        }
        table, th, td {
            padding: 5px;
            text-align: left;
        }
/*        table#t01 td:nth-child(1) {
            text-align: left;
        }
        table#t01 th:nth-child(1) {
            text-align: left;
        }*/
    </style>
</head>
<body bgcolor=\"#A4A4A4\">
    <div class=\"wrapper\">
        <div id=\"paperHeader\">
            <h1><a href=\"http://localhost:3000/\">";
        // line 26
        echo twig_escape_filter($this->env, (isset($context["title"]) ? $context["title"] : null), "html", null, true);
        echo "</a></h1>
            <h2>\"";
        // line 27
        echo twig_escape_filter($this->env, (isset($context["searchword"]) ? $context["searchword"] : null), "html", null, true);
        echo "\"</h2> 
        </div>

        <div class=\"footer\">
            <div>
                <form method='get' action='previous.html'>
                    <input type=\"submit\" class=\"buttons\" value=\"Back\" onClick=\"history.back();return false;\" style=\"width: 8%\">
                </form>
                <form id = \"export\" method='get' action='/pdf/";
        // line 35
        echo twig_escape_filter($this->env, (isset($context["searchword"]) ? $context["searchword"] : null), "html", null, true);
        echo "'>
                    <input type=\"button\" onclick= \"exportFunc()\" value=\"Export to PDF\">
                </form>
            </div>
        </div>
        <div id = \"paperTitles\">
                <table id=\"t01\" rules=\"rows\" max-width=100%>
                    <col style=\"width:1%\">
                    <col style=\"width:15%\">
                    <col style=\"width:10%\">
                    <col style=\"width:15%\">
                    <col style=\"width:1%\">
                    <col style=\"width:1%\">
                    <tr>
                    <th></th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Journal</th>
                    <th>Link</th>
                    <th>Frequency</th>      
                    </tr>
                    ";
        // line 56
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["papers"]) ? $context["papers"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["paper"]) {
            // line 57
            echo "                        <tr>
                        <td><input type=\"checkbox\" name=\"papers\"></td>
                        <td>
                        ";
            // line 60
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["paper"], "title", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["word"]) {
                // line 61
                echo "                        <a href=\"/cloud/?type=keyword&limit=10&search=";
                echo twig_escape_filter($this->env, $context["word"], "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $context["word"], "html", null, true);
                echo " </a>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['word'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 63
            echo "                        </td>
                        <td>
                        ";
            // line 65
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["paper"], "author", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["author"]) {
                // line 66
                echo "                        <a href=\"/cloud/?type=author&limit=10&search=";
                echo twig_escape_filter($this->env, $context["author"], "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $context["author"], "html", null, true);
                echo " </a>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['author'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 67
            echo " 
                        </td>
                        <td> ";
            // line 69
            echo twig_escape_filter($this->env, $this->getAttribute($context["paper"], "journal", array()), "html", null, true);
            echo " </td>
                        <td>
                        <a href= ";
            // line 71
            echo twig_escape_filter($this->env, $this->getAttribute($context["paper"], "link", array()), "html", null, true);
            echo " target=\"_blank\"> X </a>
                        </td>
                        <td> ";
            // line 73
            echo twig_escape_filter($this->env, $this->getAttribute($context["paper"], "frequency", array()), "html", null, true);
            echo " </td>
                        </tr>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['paper'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 76
        echo "                </table>
        </div>
       <div class=\"push\"></div>
    </div>
</body>
</html>
";
    }

    public function getTemplateName()
    {
        return "paperList.phtml";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  151 => 76,  142 => 73,  137 => 71,  132 => 69,  128 => 67,  117 => 66,  113 => 65,  109 => 63,  98 => 61,  94 => 60,  89 => 57,  85 => 56,  61 => 35,  50 => 27,  46 => 26,  19 => 1,);
    }
}
