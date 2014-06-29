<?php
/**
 * Created by PhpStorm.
 * User: Alin
 * Date: 5/20/14
 * Time: 12:39 AM
 */

function responsive_square_preprocess_page(&$vars) {
  // Get the entire main menu tree
  $main_menu_tree = menu_tree_all_data('main-menu', NULL, 2);

  // Add the rendered output to the $main_menu_expanded variable
  $vars['footer_menu'] = $vars['main_menu'];
  $vars['main_menu'] = menu_tree_output($main_menu_tree);
  $children = element_children($vars['main_menu']);
  foreach ($children as $nr => $key) {
    $class = 'color-default';
    if ($nr !== 0) {
      $class = 'color-shade-' . $nr;
    }
    $vars['main_menu'][$key]['#attributes']['class'] = array($class);
    $vars['main_menu'][$key]['#localized_options']['attributes']['class'] = array('sf-with-ul');
    // We only display the first 2 levels.
    if (!empty($vars['main_menu'][$key]['#below'])) {
      $below_children = element_children($vars['main_menu'][$key]['#below']);
      foreach ($below_children as $nr_below => $below) {
        $vars['main_menu'][$key]['#below'][$below]['#attributes']['class'] = array('color-shade-' . ($nr_below + $nr));
        $vars['main_menu'][$key]['#below']['#prefix'] = '<ul class="sub-menu">';
        $vars['main_menu'][$key]['#below']['#suffix'] = '</ul>';
        unset($vars['main_menu'][$key]['#below']['#theme_wrappers']);
      }
    }
  }
  $vars['main_menu']['#prefix'] = '<ul class="sf-menu sf-js-enabled" id="sf-menu">';
  $vars['main_menu']['#suffix'] = '</ul>';
  unset($vars['main_menu']['#theme_wrappers']);

  _responsive_square_footer($vars['page']['bottom']);
}

/**
 * Implements hook_theme().
 */
function responsive_square_theme() {
  $items = array();
  $items['footer_newsletter'] = array(
    'variables' => array('form' => array()),
    'template' => 'templates/responsive_square_footer_newsletter',
  );
  $items['footer_about_us'] = array(
    'variables' => array('text' => NULL),
    'template' => 'templates/responsive_square_footer_about_us',
  );
  $items['footer_solutions'] = array(
    'variables' => array('links' => NULL),
    'template' => 'templates/responsive_square_footer_solutions',
  );
  $items['footer_flickr'] = array(
    'variables' => array('text' => NULL, 'user_set' => NULL),
    'template' => 'templates/responsive_square_footer_flickr',
  );
  $items['footer_contact'] = array(
    'variables' => array('text' => NULL, 'media' => NULL),
    'template' => 'templates/responsive_square_footer_contact',
  );

  return $items;
}

/**
 * Helper function to theme the footer.
 */
function _responsive_square_footer(&$bottom) {
  // About Us 'block'.
  $text = theme_get_setting('footer_about_us_text');
  if (!empty($text)) {
    $bottom['first_row']['about_us']['#markup'] = theme('footer_about_us', array(
      'text' => $text,
    ));
  }
  // Flickr "block".
  $user_set = theme_get_setting('footer_flickr_user_set');
  if (!empty($user_set)) {
    $text = theme_get_setting('footer_flickr_text');
    $bottom['first_row']['flickr']['#markup'] = theme('footer_flickr', array(
      'text' =>  $text,
      'user_set' => $user_set,
    ));
  }
  // Solutions menu "block".
  $menu = theme_get_setting('footer_solution_menu');
  if (!empty($menu)) {
    $menu_tree = menu_tree($menu);
    unset($menu_tree['#theme_wrappers']);
    $menu_tree['#prefix'] = '<ul class="dot">';
    $menu_tree['#suffix'] = '</ul>';

    $bottom['first_row']['solutions']['#markup'] = theme('footer_solutions', array(
      'links' =>  $menu_tree,
    ));
  }
  //TODO change it to a setting.
  if (!empty($user_set)) {
    $bottom['second_row']['contact']['#markup'] = theme('footer_contact', array(
      'text' =>  '',
      'links' => '',
    ));
  }
  // Newsletter "block".
  $form = theme_get_setting('footer_newsletter_form');
  if (!empty($form) && function_exists($form)) {
    $bottom['second_row']['newsletter']['#markup'] = theme('footer_newsletter', array(
      'form' => drupal_get_form($form),
    ));
  }
  if (isset($bottom['first_row'])) {
    $bottom['first_row']['#prefix'] = '<div class="row">';
    $bottom['first_row']['#suffix'] = '</div>';
  }
  if (isset($bottom['second_row'])) {
    $bottom['second_row']['#prefix'] = '<div class="row">';
    $bottom['second_row']['#suffix'] = '</div>';
  }
}