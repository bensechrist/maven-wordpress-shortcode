=== Maven Central Shortcodes ===
Contributors: bensechrist
Tags: Maven Central, shortcode
Requires at least: 2.5
Tested up to: 4.0
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A WordPress plugin that uses shortcodes to display Maven Central dependencies and versions.

== Description ==

A WordPress plugin that uses shortcodes to display Maven Central dependencies and versions.

== Installation ==

1. Upload `maven-shortcode.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Use the shortcodes `[mvn-dependency]` and `[mvn-version]` in your posts

== Frequently Asked Questions ==

= How do I use the `[mvn-dependency]` shortcode? =

In your post insert `[mvn-dependency groupid="{GROUP-ID}" artifactid="{ARTIFACT-ID}"]`.
Maven Shortcode will then fetch the latest version of this dependency and replace the shortcode with the `<dependency>` tag filled.

ex. `[mvn-dependency groupid="junit" artifactid="junit"]`

= How do I use the `[mvn-version]` shortcode? =

In your post insert `[mvn-version groupid="{GROUP-ID}" artifactid="{ARTIFACT-ID}"]`.
Maven Shortcode will then fetch the latest version of this dependency and replace the shortcode with the latest version number.

ex. `[mvn-version groupid="junit" artifactid="junit"]`

= What if I want a specific version with `[mvn-dependency]`? =

You can specify a version number by adding a version attribute to the `[mvn-dependency]` shortcode.

ex. `[mvn-dependency groupid="junit" artifactid="junit" version="4.11"]`

= What if I want the latest stable version? =

You can specify that you want only stable versions by inlcuding the attribute stable and setting it to true.

ex. `[mvn-dependency groupid="junit" artifactid="junit" stable="true"]`
ex. `[mvn-version groupid="junit" artifactid="junit" stable="true"]`

== Screenshots ==



== Changelog ==

= 0.1 =
* Initial release

== Upgrade Notice ==

= 0.1 =
Initial release of shorcode
