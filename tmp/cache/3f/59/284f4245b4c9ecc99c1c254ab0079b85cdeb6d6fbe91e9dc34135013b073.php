<?php

/* home.phtml */
class __TwigTemplate_3f59284f4245b4c9ecc99c1c254ab0079b85cdeb6d6fbe91e9dc34135013b073 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'head' => array($this, 'block_head'),
            'search' => array($this, 'block_search'),
            'addartist' => array($this, 'block_addartist'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<html>

<head>
    <meta charset=\"utf-8\">
    <link rel=\"stylesheet\" type=\"text/css\" href=\"/Stylesheets/pageStyles.css\">
    <link rel=\"stylesheet\" type=\"text/css\" href=\"/Stylesheets/jqcloud.css\">
    <link rel=\"stylesheet\" href=\"/vendor/progressbar/dataurl.css\">
    <script src=\"/vendor/progressbar/pace.min.js\"></script>
    <link rel=\"stylesheet\" href=\"//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css\">
    <script src=\"//code.jquery.com/jquery-1.10.2.js\"></script>
    <script src=\"//code.jquery.com/ui/1.11.4/jquery-ui.js\"></script>
    ";
        // line 12
        $this->displayBlock('head', $context, $blocks);
        // line 14
        echo "    <style>
    a {
        text-decoration: none;
        color: #000000;
    }
    .ui-autocomplete {
      max-height: 100px;
      overflow-y: scroll;
      overflow-x: hidden;
    }
   * html .ui-autocomplete {
      height: 100px;
    }
    #city { width: 25em; }
    </style>
    <script>
  //   \$(function() {
  //   function log( message ) {
  //     \$( \"<div>\" ).text( message ).prependTo( \"#log\" );
  //     \$( \"#log\" ).scrollTop( 0 );
  //   }
 
  //   \$( \"#tags\" ).autocomplete({
  //     source: function( request, response ) {
  //       \$.ajax({
  //         url: \"/auto\",
  //         dataType: \"jsonp\",
  //         data: {
  //           q: request.term
  //         },
  //         success: function( data ) {
  //           response( data );
  //         }
  //       });
  //     },
  //     minLength: 3,
  //     select: function( event, ui ) {
  //       log( ui.item ?
  //         \"Selected: \" + ui.item.label :
  //         \"Nothing selected, input was \" + this.value);
  //     },
  //     open: function() {
  //       \$( this ).removeClass( \"ui-corner-all\" ).addClass( \"ui-corner-top\" );
  //     },
  //     close: function() {
  //       \$( this ).removeClass( \"ui-corner-top\" ).addClass( \"ui-corner-all\" );
  //     }
  //   });
  // });
   </script>  
</head>

<body bgcolor= white>

    <div id=\"wordCloudHeader\">
        <h1><a href=\"http://localhost:3000/\">";
        // line 69
        echo twig_escape_filter($this->env, (isset($context["title"]) ? $context["title"] : null), "html", null, true);
        echo "</a><h1>
    </div>

    <div id=\"wordCloud\"></div>

    <div id=\"paperSearch\">
      <div align:\"center\" class=\"ui-widget\">
          <form method='get' action='/cloud'>
              <div id=\"radioButtons\">
                Search by:
                <input type='radio' name='type' value=\"keyword\" checked>Keyword
                <input type='radio' name='type' value=\"author\"> Author
              </div>
              <div id=\"dropDownMenu\">
                Number of Papers:
                <select name=\"limit\">
                  <option value=\"10\">10</option>
                  <option value=\"20\">20</option>
                  <option value=\"30\">30</option>
                  <option value=\"40\">40</option>
                  <option value=\"50\">50</option>
                  <option value=\"60\">60</option>
                  <option value=\"70\">70</option>
                  <option value=\"80\">80</option>
                  <option value=\"90\">90</option>
                  <option value=\"100\">100</option>
                </select>
              </div>
              <input type=text id=\"tags\" name=\"search\" placeholder=\"Search away...\" required>
              <input type=\"submit\" class=\"buttons\" value=\"Submit\">
              ";
        // line 99
        $this->displayBlock('search', $context, $blocks);
        // line 100
        echo "          </form>
          ";
        // line 101
        $this->displayBlock('addartist', $context, $blocks);
        // line 102
        echo "      </div>
    </div>
<script type=\"text/javascript\">
      var searchTerm = document.querySelector('input[type=\"text\"]');
    searchTerm.oninvalid = function(e) {
    e.target.setCustomValidity(\"\");
    if (!e.target.validity.valid) { e.target.setCustomValidity(\"Please enter a valid keyword or author\"); }
    };
</script>
</body>
</html>
";
    }

    // line 12
    public function block_head($context, array $blocks = array())
    {
        // line 13
        echo "    ";
    }

    // line 99
    public function block_search($context, array $blocks = array())
    {
    }

    // line 101
    public function block_addartist($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "home.phtml";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  161 => 101,  156 => 99,  152 => 13,  149 => 12,  134 => 102,  132 => 101,  129 => 100,  127 => 99,  94 => 69,  37 => 14,  35 => 12,  22 => 1,);
    }
}
