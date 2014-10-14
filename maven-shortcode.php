<?php
/**
 * Plugin Name: Maven Shortcode
 * Plugin URI: http://example.com
 * Description: A shortcode plugin that injects maven dependencies
 * Version: 1.0
 * Author: Ben Sechrist
 * Author URI: http://boffin.sechristfamily.com
 * License: GPL2
 */

defined('ABSPATH') or die("No script kiddies please!");

function is_stable($str) {
	$not_stable = array("beta", "alpha");
  foreach($not_stable as $a) {
  	// echo "stripos(" . $str . ", " . $a . ");";
  	if (!(stripos($str,$a) === false)) return false;
  }
  return true;
}

function inject_maven_dependency($atts) {
	if (empty($atts['groupid']))
		return "Group ID needed<br />";
	if (empty($atts['artifactid']))
		return "Artifact ID needed<br />";
	if (empty($atts['version']))
		$atts['version'] = "";
	if (empty($atts['stable']))
		$atts['stable'] = "false";

	$json_string = file_get_contents("http://search.maven.org/solrsearch/select?q=g:%22" 
		. $atts['groupid'] . "%22%20AND%20a%3A%22" . $atts['artifactid'] 
		. "%22%20AND%20v%3A%22" . $atts['version'] . "%22&core=gav&wt=json");
	$json = json_decode($json_string);

	if ($atts['stable'] === "true") {
		foreach ($json->response->docs as $result) {
			if (!empty($first_result->latestVersion)) {
				if (is_stable($result->latestVersion)) {
					$first_result = $result;
					break;
				}
			} else {
				if (is_stable($result->v)) {
					$first_result = $result;
					break;
				}
			}
		}
	} else {
		$first_result = $json->response->docs[0];
	}

	if (empty($first_result))
		return "Dependency not found<br/>";

	$output = "&lt;dependency&gt;<br />";
	$output .= "&nbsp;&nbsp;&lt;groupId&gt;" . $first_result->g 
		. "&lt;/groupId&gt;<br />";
	$output .= "&nbsp;&nbsp;&lt;artifactId&gt;" . $first_result->a 
		. "&lt;/artifactId&gt;<br />";
	if (!empty($first_result->latestVersion))
		$output .= "&nbsp;&nbsp;&lt;version&gt;" . $first_result->latestVersion 
			. "&lt;/version&gt;<br />";
	else
		$output .= "&nbsp;&nbsp;&lt;version&gt;" . $first_result->v 
			. "&lt;/version&gt;<br />";
	$output .= "&lt;/dependency&gt;<br />";
	$output .= "<br />";

	return $output;
}

add_shortcode('mvn-dependency', 'inject_maven_dependency');

function inject_maven_version($atts) {
	if (empty($atts['groupid']))
		return "Group ID needed<br />";
	if (empty($atts['artifactid']))
		return "Artifact ID needed<br />";
	if (empty($atts['stable']))
		$atts['stable'] = "false";
	
	$json_string = file_get_contents("http://search.maven.org/solrsearch/select?q=g:%22" 
		. $atts['groupid'] . "%22%20AND%20a%3A%22" . $atts['artifactid'] . "%22&core=gav&wt=json");
	$json = json_decode($json_string);
	
	if ($atts['stable'] === "true") {
		foreach ($json->response->docs as $result) {
			if (!empty($first_result->latestVersion)) {
				if (is_stable($result->latestVersion)) {
					$first_result = $result;
					break;
				}
			} else {
				if (is_stable($result->v)) {
					$first_result = $result;
					break;
				}
			}
		}
	} else {
		$first_result = $json->response->docs[0];
	}

	if (empty($first_result))
		return "Dependency not found<br/>";

	if (!empty($first_result->latestVersion))
		return $first_result->latestVersion;
	else
		return $first_result->v;
}

add_shortcode('mvn-version', 'inject_maven_version');