# WordPress Slideshow Plugin

[![Build Status](https://app.travis-ci.com/ivanhala/wp-slideshow-plugin.svg?branch=master)](https://app.travis-ci.com/ivanhala/wp-slideshow-plugin)

Demo project showing WordPress plugins development skills.


### Demo
[Slideshow front-end page](https://staging2.webbatesting.site/sample-page/)


### Usage
* In the WordPress dashboard menu open the __Slideshow Settings__ page
* Click on the __Add images__ button
* Choose images
* Click on the  __Save images__ button
* Add the following shortcode on the page/post: `myslideshow`

---

### Development notes
#### Skills used
* OOP
* REST API
* jQuery
* Shortcodes API
* Options API
* Internationalization
* Asset handling
* Media library
* Plugin integration testing

#### Possible alternative approaches

1. Saving options can be implemented using form submission (standard approach). Saving using REST API was added to demonstrate skills and for a better UI/UX.
2. In the test classes the method `setUp()` can be used instead of  `before_test()`. The method `setUp()` was not used due to compatibility issues with the *PHPUnit Polyfills*.
3. The slideshow settings page can be added as a sub-page of WordPress Settings.

