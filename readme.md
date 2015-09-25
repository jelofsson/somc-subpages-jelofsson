# Wordpress - Subpages Widget

## About

Displays a sortable list of subpages for the current page or post.

It is compitable with Wordpress 3.5+ and try to follow the Wordpress.org [coding standard](https://make.wordpress.org/core/handbook/best-practices/).

## Installation and usage

1. Download and install [Wordpress](http://www.wordpress.org/)

2. Clone project and install plugin `dist/somc-subpages-jelofsson.zip` in Wordpress

3. Activate plugin

4. Add it to your sidebar from the widget section or to a post/page by using the shortcode `[somc-subpages-jelofsson]`

## Developer

`src/` contains all source files for this project.

You'll find the core class in `src/includes/classes/class-plugin-widget.php`
(most of the magic happens here)

Also `src/includes/static/js/subpages.js` contain the scripts for sorting the subpage lists.
    
## Author

Jimmi Elofsson, contact@jimmi.eu