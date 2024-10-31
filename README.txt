=== Retina Image Support ===
Contributors: gregghenry
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=G9NZAQWBA78YW&lc=US&item_name=Gregg%20Henry&item_number=wp_ri&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donate_LG%2egif%3aNonHosted
Tags: retina images, retina display
Requires at least: 3.0
Tested up to: 4.0
Stable tag: 0.1

This plugin helps you easily get setup for retina image support on your WordPress powered website.
 
== Description ==

This plugin will help you get setup to support retina images, making your website look great on retina devices like the iPhone4+, iPad3+ and the MacBook Pro Retina.

This plugin will update your htaccess file and add one line of javascript to the header of your website. After you install and activate the plugin, you can add @2x images for retina support.

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload the folder `retina-image-support` to the `/wp-content/plugins/` directory OR add it through the WordPress admin.
1. Activate the plugin through the 'Plugins' menu in WordPress

For each image you want a retina version to be used, you'll need to upload the retina version with the same file name with @2x at the end of it. so if you upload image.jpg you'll also upload a retina image named image@2x.jpg **Be sure they are uploaded to the same directory**

**Be sure to set your image width/height in HTML**

== Frequently Asked Questions ==

= What devices does this plugin support? =

This plugin is aimed to support retina devices like the iPad, iPhone, iPod Touch and Macbook Pro. Firefox 14.0.1 on a retina MacBook Pro does not load the @2x images because it does not support window.devicePixelRatio and checking min-resolution with window.matchMedia().matches seems wonky. Firefox 14.0.1 will still serve the non-retina image just fine.

= Where's this magic come from? =

Shaun Inman has an [article](http://shauninman.com/tmp/retina/) titled 'Automatic Conditional Retina Images' that is the basis of the plugin.

The main difference from many other Retina plugins or options is that this code doesn't do DOM crawling or PHP scripts. And if cookies are disabled, we still serve the non-retina image just fine. Win-Win-Win situation.

= My Image is too big! =

Be sure to set your image width and height for non-retina first. Then the retina image, while being twice as big, will only take up the width and height you specify in the HTML.

i.e.: <img src="/path/to/img.png" width="300" height="200" alt=""> with an image declaration like this your img@2x.png should be 600px wide by 400px tall and fit perfectly in your set image.

= How do I do retina background images in CSS? =

Be sure to set the width and height of the element you're styling in your CSS file. You'll also want to set the background-size correctly for the retina declaration.

i.e.: background-size: 300px 200px;

= How can I test it? =

For each image you want a retina version to be used, you'll need to upload the retina version with the same file name with @2x at the end of it. so if you upload image.jpg you'll also upload a retina image named image@2x.jpg

Then to test it, you'll just test your site on a retina device (iPad, iPhone or MacBook Pro)


== Changelog ==

= 1.1 =
* Updated FAQ and Installation Notes.

= 1.0 =
* First version. 

