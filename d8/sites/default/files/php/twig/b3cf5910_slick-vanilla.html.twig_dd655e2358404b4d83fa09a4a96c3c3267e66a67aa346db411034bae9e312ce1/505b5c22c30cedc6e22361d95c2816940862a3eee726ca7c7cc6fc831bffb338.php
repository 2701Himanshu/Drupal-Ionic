<?php

/* sites/all/modules/slick/templates/slick-vanilla.html.twig */
class __TwigTemplate_2a4ce69c93d97fd9d2e374e7f83252d1e2900ea8ace9cc61eb7b88644254f675 extends Twig_Template
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
        $tags = array("set" => 19, "spaceless" => 26);
        $filters = array();
        $functions = array();

        try {
            $this->env->getExtension('sandbox')->checkSecurity(
                array('set', 'spaceless'),
                array(),
                array()
            );
        } catch (Twig_Sandbox_SecurityError $e) {
            $e->setTemplateFile($this->getTemplateName());

            if ($e instanceof Twig_Sandbox_SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof Twig_Sandbox_SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof Twig_Sandbox_SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

        // line 19
        $context["classes"] = array(0 => "slick__slide", 1 => "slide", 2 => ("slide--" .         // line 22
(isset($context["delta"]) ? $context["delta"] : null)));
        // line 25
        echo "
";
        // line 26
        ob_start();
        // line 27
        echo "<div";
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute((isset($context["attributes"]) ? $context["attributes"] : null), "addClass", array(0 => (isset($context["classes"]) ? $context["classes"] : null)), "method"), "html", null, true));
        echo ">
  ";
        // line 28
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["item"]) ? $context["item"] : null), "html", null, true));
        echo "
</div>
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    public function getTemplateName()
    {
        return "sites/all/modules/slick/templates/slick-vanilla.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  56 => 28,  51 => 27,  49 => 26,  46 => 25,  44 => 22,  43 => 19,);
    }
}
/* {#*/
/* /***/
/*  * @file*/
/*  * Default theme implementation for the slick-vanilla item template.*/
/*  **/
/*  * This is a vanilla alternative for slick-slide.html.twig where everything is*/
/*  * dumped as is into 'item'. Think of it as a raw individual item output.*/
/*  * Choosing vanilla means you are on your own, and want a more controlled item.*/
/*  **/
/*  * Available variables:*/
/*  * - attributes: An array of attributes to apply to the element.*/
/*  * - item: A renderable array of the slide content.*/
/*  * - settings: An array containing the given settings.*/
/*  **/
/*  * @see template_preprocess_slick_vanilla()*/
/*  *//* */
/* #}*/
/* {%*/
/*   set classes = [*/
/*     'slick__slide',*/
/*     'slide',*/
/*     'slide--' ~ delta*/
/*   ]*/
/* %}*/
/* */
/* {% spaceless %}*/
/* <div{{ attributes.addClass(classes) }}>*/
/*   {{ item }}*/
/* </div>*/
/* {% endspaceless %}*/
/* */
