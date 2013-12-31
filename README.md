Kelvin Theme
=========

This is a very clean theme for [Drupal 7](https://drupal.org).

Using
-----
  - SCSS & Compass (have to compile them yourself)
  - jQuery 1.10.2
  - cssrefresh.js to monitor changes of .css files
  - hasChanged.js to monitor changes of DOM elements

NOT using
-----
  - .info to load external css & js becoz I think it's unnecessary... just simply add them into html.tpl.php
  - jQuery update module
  - base-theme
  - theme-settings.php for backend panel
  - too many regions

Usage
-----
Just throw into project theme folder then enable it.

Notes
-----
  - Edit config.rb for the SCSS & Compass compilation setting.
  - Unset drupal's old jQuery via hook_js_alter() in template.php, and added 1.10.2 one in html.tpl.php (frontend only, backend keep using the old one).
  - If you wanna use css grid, I'd prefer [Compass's Blueprint Grid](http://compass-style.org/reference/blueprint/grid/), and I've added some init vars in _mixins.scss.
  - Not so many files/code, you may spend some time going through them and then you can figure out wht's going on... or hit me a mail.

Useful resources
-----
  - [Drupal 7](https://drupal.org)
  - [Sass/SCSS](http://sass-lang.com/)
  - [Compass](http://compass-style.org)
  - [jQuery](http://jquery.com/)
  - [cssrefresh](http://cssrefresh.frebsite.nl/)
