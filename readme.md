# Hybrid Sample Theme

A search engine optimized, mobile-first sample theme based on the Hybrid Framework with a modern development workflow.


## Features

* Fully responsive, lightweight menus with pure CSS menu-toggle buttons that combine into one mobile menu.
* [Superfish](https://superfish.joelbirch.co/) menu for keyboard navigation and other accessibility enhancements.
* Accessible skip links and *read more* links with descriptive screen-reader text.
* Mobile-first, flexbox-based CSS with combined rules, selectors and media queries for the smallest minification possible.
* Exhaustive, valid schema.org microdata.
* Robust Gulpfile included for automatically compiling assets, optimizing images, i18n, theme zip packaging and more.
* Sass/SCSS partials, variables, mixins and functions included.
* Custom logo, header and background support with postMessage transport.
* Custom colors with postMessage transport.
* Front page Hero section widget area with custom background image or video upload.
* Flexbox based footer widget areas that automatically adjust widths.
* Full support for [Roots Soil](https://github.com/roots/soil) plugin.
* Gravity forms CSS/SCSS reset.


## Requirements

* PHP > 5.6 (PHP 7 recommended)
* WordPress > 4.7
* Node.js > 6.9
* Gulp.js > 3.9


## Quick Installation

1. Upload, install and activate the Hybrid Sample theme.
2. Install and activate recommended plugins.
3. *IMPORTANT:* Delete unwanted existing posts, pages, comments & widgets.
4. Import demo content *(sample.xml)* with the **WordPress Importer**.
5. Import widgets demo content *(widgets.wie)* with the **Widget Importer & Exporter** plugin.
6. Create navigation menus from ***Appearance > Menus***.
7. Go to ***Appearance > Customize > Site Identity*** to upload a logo.
8. Go to ***Appearamce > Customize > Header Media*** to upload hero image or video.
9. Go to ***Appearance > Customize > Static Front Page*** and configure to your liking.
10. Go to ***Appearance > Customize > Layout*** and configure to your liking.


## Structure

```shell
theme/  
├── assets/
│   ├── fonts/
│   ├── images/
│   ├── scripts/
│   └── styles/
├── comment/
├── content/
├── includes/
├── languages/
├── library/
├── menu/
├── sidebar/
├── .editorconfig
├── .gitmodules
├── comments.php
├── footer.php
├── functions.php
├── gulpfile.js
├── header.php
├── index.php
├── license.md
├── package.json
├── README.md
├── rtl.css
├── screenshot.png
├── style.css
├── style.min.css
└── style.min.css.map
```


## Development

Hybrid Sample includes [Gulp](http://gulpjs.com/) as a build tool and [npm](https://www.npmjs.com/) to manage front-end packages.


### Install dependencies

From the command line on your host machine, navigate to the theme directory then run `npm install`:

```shell
# @ themes/your-theme-name/
$ npm install
```

You now have all the necessary dependencies to run the build process.


### Build commands

* `gulp sass` — Compile, autoprefix and minify Sass files.
* `gulp scripts` — Minify javascript files.
* `gulp images` — Compress and optimize images.
* `gulp watch` — Compile assets when file changes are made, start Browsersync
* `gulp` — Default task - runs all of the above tasks.


#### Additional commands

* `gulp i18n` — Scan the theme and create a POT file in the languages/ directory.
* `gulp zip` — Package theme into zip file for distribution.


### Using Browsersync

To use Browsersync you need to update `dev_url` on line 43 of `gulpfile.js` to reflect your local development hostname.

If your local development URL is `my-site.dev`, update the file to read:

```javascript
...
  var dev_url = 'my-site.dev',
...
```


## Support

Please visit https://seothemes.net/support/ for theme support.


## Recomended Plugins

After you have activated the Hybrid Sample theme, a Recommended Plugins notice will appear in the WordPress dashboard. Click 'Begin installing plugins' and follow the steps to install and activate all of the plugins recommended by the theme. This theme recommends the following:

* ### Simple Social Icons
	* Simple Social Icons is a lightweight easy to use social icon plugin that creates a new widget for displaying links to social media profiles.

* ### Widget Importer & Exporter <a name="wie"></a>
	* Widget Importer & Exporter makes it easy to import the theme demo widget content. Upon acitvation it will create a new settings page under ***Tools > Widget Importer***. Simply upload the ***widgets.wie*** file included with the theme.

* ### WP Featherlight
	* This plugin adds simple lightbox functionality to any WordPress `[gallery]` shortcode. No settings or configuration required, just simply create a gallery on any post or page and link the images to 'Media File' and the lightbox will be automatically applied.

* ### WordPress Importer
	* Imports the theme demo content such as posts, pages, comments and more.


## Import Demo Content

***IMPORTANT: Delete any unwanted widgets, posts, pages and comments BEFORE importing demo content***

Once the recommended plugins have been installed it is safe to import the theme demo content and widget demo content. To import the content used in the Hybrid Sample theme demo site, navigate to ***Tools > Import*** and then select ***WordPress > Run***. This will take you to the **Import** settings page where you can upload the *sample.xml* file included with the theme.


## Menus

Hybrid Sample includes two responsive menus by default with support for sub-menu items. These are called the **Primary Menu** and **Secondary Menu** and are displayed in the site-header section of the theme. The menu used in the demo should be imported with the theme demo content *(sample.xml)*, however WordPress sometimes has problems with importing menu items. If this occurs, please create your menus by navigating to ***Appearance > Menus*** and configuring to your liking.

Hybrid Sample also supports a third menu in the site footer. The theme demo uses this menu to display links to social media profiles.


## Widget Areas

This theme supports 3 default widget areas, Hero, Footer and Sidebar. To import the theme demo widget content, [follow the instructions](#wie) for using the ***Widget Importer & Exporter*** plugin above.

* ### Hero
	* The hero widget area is displayed on the front page of the site. The background image or video can be set in the theme customizer under ***Appearance > Customize > Header Media***.

* ### Footer
	* The footer widget area is a site-wide widget area displayed in the site footer. Widgets placed here will always be even widths and automatically adjust depending on the number of widgets.

* ### Sidebar
	* The sidebar widget area is displayed on *Sidebar Left* and *Sidebar Right* page layouts.


## Customization

Hybrid Sample makes it easy to customize the theme to your liking. All customizations are done via the WordPress customizer as recommended by WordPress.

* ### Custom Logo
	* To upload your own custom logo, navigate to ***Appearance > Customize > Site Identity***. From the **Site Identity** section of the customizer panel you can upload your own logo and favicon.

* ### Custom Header
	* To upload a custom header for the Hero section, navigate to ***Appearance > Customize > Header Media***. The **Header Media** section contains video upload, YouTube URL or image upload options.

* ### Custom Background
	* To set a custom background image, navigate to ***Appearance > Customize > Background Image***. From here you can upload your own image and configure to your liking. You can also use a color instead by navigating to the **Colors** section. You can find some really great free textures to use [here](http://subtlepatterns.com).

* ### Custom Colors
	* To customize the colors of your theme, navigate to ***Appearance > Customize > Colors*** and customize to your liking.


## Optimization

We decided to leave out the theme optimization file that most of our themes include by default, instead we recommend the use of the amazing [Soil](https://github.com/roots/soil) plugin by the team at Roots. Hybrid Sample fully supports all of Soil's features by default, all you need to do is install and activate the plugin and your set. The only configuration required is if you are using Google Analytics, you will then need to add your own GA tracking code to the /includes/theme-functions.php file on line 30. Simply uncomment the `add_theme_support( 'soil-google-analytics', 'YOUR-GA-CODE' );` line and replace *YOUR-GA-CODE* with your own unique code.


## CHANGELOG

= 0.1.0 = 2017-06-02
* Initial beta release