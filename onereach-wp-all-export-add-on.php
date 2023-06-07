<?php
/*
Plugin Name: OneReach WP All Export Add-on
Plugin URI: 
Description: WP All Export Add-on for updating fields. Use this plugin with 'WP All Export'
Version: 0.0.1
Author: Vlad Filonenko
*/

function onereach_wp_all_export_csv_rows($articles, $options, $export_id)
{
  return array_map(function ($article) {
    if (array_key_exists('alternative_header_image', $article)) {
      $acf_field = get_field('alternative_header_image', $article['ID']);
      if ($acf_field && isset($acf_field['url'])) {
        $article['alternative_header_image'] = $acf_field['url'];
      }
    }
    if (array_key_exists('carousel_thumbnail', $article)) {
      $acf_field = get_field('carousel_thumbnail', $article['ID']);
      if ($acf_field && isset($acf_field['url'])) {
        $article['Featured'] = $acf_field['url'];
        $article['carousel_thumbnail'] = $acf_field['url'];
      }
    }

    return $article;
  }, $articles);
}
add_filter('wp_all_export_csv_rows', 'onereach_wp_all_export_csv_rows', 10, 3);
