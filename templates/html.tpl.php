<?php
/**
 * @file
 * Default theme implementation to display the basic html structure of a single
 * Drupal page.
 *
 * Variables:
 * - $css: An array of CSS files for the current page.
 * - $language: (object) The language the site is being displayed in.
 *   $language->language contains its textual representation.
 *   $language->dir contains the language direction. It will either be 'ltr' or 'rtl'.
 * - $rdf_namespaces: All the RDF namespace prefixes used in the HTML document.
 * - $grddl_profile: A GRDDL profile allowing agents to extract the RDF data.
 * - $head_title: A modified version of the page title, for use in the TITLE tag.
 * - $head: Markup for the HEAD section (including meta tags, keyword tags, and
 *   so on).
 * - $styles: Style tags necessary to import all CSS files for the page.
 * - $scripts: Script tags necessary to load the JavaScript files and settings
 *   for the page.
 * - $page_top: Initial markup from any modules that have altered the
 *   page. This variable should always be output first, before all other dynamic
 *   content.
 * - $page: The rendered page content.
 * - $page_bottom: Final closing markup from any modules that have altered the
 *   page. This variable should always be output last, after all other dynamic
 *   content.
 * - $classes String of classes that can be used to style contextually through
 *   CSS.
 *
 * @see template_preprocess()
 * @see template_preprocess_html()
 * @see template_process()
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <title><?php print $head_title; ?></title>
    <?php
    global $theme;
    $theme_path = "/" . drupal_get_path('theme', $theme);
    $libraries_path = "/" . libraries_get_path('mediaelement');
    print $styles;
    ?>
    <script src="<?php echo $theme_path; ?>/js/modernizr-2.6.2.min.js"></script>
    <link href="<?php echo $theme_path; ?>/css/all.css" rel='stylesheet' type='text/css'>
  </head>
  <body class="<?php print $classes; ?>" <?php print $attributes; ?>>
    <!--[if lt IE 7]>
    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
    <![endif]-->
    <?php
    print $page_top;
    $classes_arr = explode(" ", $classes);
    $doc = phpQuery::newDocumentHTML($page);
    print $doc->html();
    phpQuery::unloadDocuments();
    print $page_bottom;
    ?>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?php echo $theme_path; ?>/js/jquery-1.10.2.min.js"><\/script>')</script>
    <script src="<?php echo $theme_path; ?>/js/jquery-migrate-1.2.1.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
    <?php print $scripts; ?>
    <script src="<?php echo $theme_path; ?>/js/cssrefresh.js"></script> 
    <script src="<?php echo $theme_path; ?>/js/hasChanged.js"></script>
    <script src="<?php echo $theme_path; ?>/js/script.js"></script>
  </body>
</html>