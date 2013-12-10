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
    <meta name="viewport" content="width=device-width">
    <title><?php print $head_title; ?></title>
    <?php
    global $theme;
    $theme_path = "/" . drupal_get_path('theme', $theme);
    print $styles;
    ?>
    <link rel="stylesheet/less" type="text/css" href="<?php echo $theme_path; ?>/css/sitewide.less" />
    <script type="text/javascript">
      less = {
        env: "development", // or "production"
        async: true, // load imports async
        fileAsync: true, // load imports async when in a page under a file protocol
        poll: 1000, // when in watch mode, time in ms between polls
        functions: {}, // user functions, keyed by name
        dumpLineNumbers: "comments", // or "mediaQuery" or "all"
        relativeUrls: true, // whether to adjust url's to be relative if false, url's are already relative to the entry less file
        rootpath: "<?php echo $theme_path; ?>/css/"// a path to add on to the start of every url resource
      };
    </script>
    <script src="<?php echo $theme_path; ?>/js/less-1.5.0.min.js"></script>
    <script src="<?php echo $theme_path; ?>/js/modernizr-2.6.2.min.js"></script>
  </head>
  <body class="<?php print $classes; ?>" <?php print $attributes; ?>>
    <!--[if lt IE 7]>
    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
    <![endif]-->
    <?php
    print $page_top;
    print $page;
    print $page_bottom;
    ?>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?php echo $theme_path; ?>/js/jquery-1.10.2.min.js"><\/script>')</script>
    <script src="<?php echo $theme_path; ?>/js/jquery-migrate-1.2.1.js"></script>
    <?php print $scripts; ?>
    <script src="<?php echo $theme_path; ?>/js/hasChanged.js"></script>
    <script src="<?php echo $theme_path; ?>/js/script.js"></script>
  </body>
</html>

