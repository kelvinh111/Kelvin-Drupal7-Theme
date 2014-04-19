<?php
/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/garland.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['content_top']: Items for the header region.
 * - $page['content']: The main content of the current page.
 * - $page['content_bottom']: Items for the header region.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 */
global $language;
$lang = $language->language;
if ($is_front) {
  $title = ''; // This is optional ... it removes the default Welcome to @site-name
  $GLOBALS['conf']['cache'] = FALSE;
  $page['content']['system_main']['default_message'] = array(); // This will remove the 'No front page content has been created yet.'
}
$page_type = "";
$node_type = "";
if (arg(0) == 'node') {
  $node = node_load(arg(1));
  $page_type = "node";
  $node_type = $node->type;
} elseif ($term = menu_get_object('taxonomy_term', 2)) {
  $page_type = "term";
} elseif (arg(0) == 'user') {
  $page_type = "user";
} else {
  $page_type = "other";
}

if ($node_type == "article") {
  $section_tid = $node->field_section[LANGUAGE_NONE][0]['tid'];
  $section_alias = drupal_lookup_path('alias', 'taxonomy/term/' . $section_tid);
}
?>
<div id="page">
  <header id="header" role="banner">
    <div id="header-wrapper" class="wrapper">      
      <?php
      $html = render($page['header']);
      print $html;
      ?>
    </div> 
  </header><!-- /#header -->
  <div id="main">
    <div id="cat">
      <div id="cat-wrapper" class="wrapper">
        <?php
        if ($page_type == "node") {
          if ($node_type == "page") {
            print '<a href="#" class="back" title="back"></a><h3>';
            if (isset($node->field_smaller_title) && count($node->field_smaller_title)) {
              print $node->field_smaller_title[LANGUAGE_NONE][0]['safe_value'];
            } else {
              print $title;
            }
            print "</h3>";
          } elseif ($node_type == "article") {
            print "<h3><a href='/$section_alias'>" . $node->field_section[LANGUAGE_NONE][0]['taxonomy_term']->name . "</a></h3><a class='section-prev'></a><a class='section-next'></a>";
          } else {
            print $title;
          }
        } elseif ($page_type == "user") {
          print '<a href="#" class="back" title="back"></a><h3>Account</h3>';
        }
        ?>
      </div>
    </div>
    <div id="system">
      <div id="system-wrapper" class="wrapper">
        <?php if ($tabs): ?>
          <div class="admin-tabs"><?php print render($tabs); ?></div>
        <?php endif; ?>
        <?php print $messages; ?>
        <?php print render($page['help']); ?>
        <?php if ($action_links): ?>
          <ul class="action-links"><?php print render($action_links); ?></ul>
        <?php endif; ?>
      </div>
    </div>
    <div id = "main-wrapper" class = "wrapper">
      <?php
      if ($node_type == "article") {
        print "<div id='swiper-container'><div class='swiper-wrapper'>
    <div class='swiper-slide'>";
      }
      ?>
      <?php print render($title_prefix);
      ?>
      <?php if ($title): ?>
        <h1 class="title" id="page-title">
          <?php
          if ($page_type == "node") {
            if (isset($node->field_bigger_title) && count($node->field_bigger_title)) {
              print $node->field_bigger_title[LANGUAGE_NONE][0]['safe_value'];
            } else {
              print $title;
            }
          } else {
            print $title;
          }
          ?>
        </h1>
      <?php endif; ?>
      <?php print render($title_suffix); ?>
      <?php print render($page['content_top']); ?>
      <?php print render($page['content']); ?>
      <?php print render($page['content_bottom']); ?>
      <?php
      print "</div> </div> </div>";
      ?>
    </div>
  </div><!-- /#main -->

  <footer id="footer" role="contentinfo">
    <footer id="footer-wrapper" class="wrapper">
      <?php print render($page['footer']); ?>
      <div id="footer-copy"><a href="https://www.redflaggroup.com" target="_blank" title="The Red Flag Group"><img src="/sites/all/themes/ci/images/rfg_logo.png" /></a><?php print t("Compliance Insider® copyright © 2013 by The Red Flag Group. All rights reserved. No part of this publication may be reproduced or transmitted in any form or by any means, electronic or mechanical, including photocopy, recording, or any information storage and retrieval system, without the express written consent of the copyright holders. Your use of this website constitutes acceptance of The Red Flag Group’s Privacy Policy and Terms & Conditions. The information in Compliance Insider® is strictly for educational purposes only and does not constitute legal advice."); ?></div>
    </footer>
  </footer><!-- /#footer -->
</div><!-- /#page -->
