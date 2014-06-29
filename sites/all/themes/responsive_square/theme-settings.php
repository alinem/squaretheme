<?php
/**
 * Implements theme_form_FORM_ID_alter().
 */
function responsive_square_form_system_theme_settings_alter(&$form, &$form_state) {
  $key = 'responsive_square';
  $form['theme_square'] = array(
    '#type' => 'fieldset',
    '#title' => t('Square theme specific settings'),
    '#attributes' => array('class' => array('theme-settings-bottom')),
    '#weight' => -1,
  );
  $form['theme_square']['footer_about_us_text'] = array(
    '#type' => 'textarea',
    '#title' => t('Footer about us text'),
    '#default_value' => theme_get_setting('footer_about_us_text', $key),
    '#description' => t('Specify the text used for the footer about us block.'),
  );
  $form['theme_square']['footer_flickr_text'] = array(
    '#type' => 'textarea',
    '#title' => t('Footer Flickr text'),
    '#default_value' => theme_get_setting('footer_flickr_text', $key),
    '#description' => t('Specify the text to be used for flickr section.'),
  );
  $form['theme_square']['footer_flickr_user_set'] = array(
    '#type' => 'textfield',
    '#title' => t('Footer Flickr user set'),
    '#default_value' => theme_get_setting('footer_flickr_user_set', $key),
    '#description' => t('Footer Flickr user set to be used for images.'),
  );
  $form['theme_square']['footer_solution_menu'] = array(
    '#type' => 'textfield',
    '#title' => t('Footer Solutions menu'),
    '#default_value' => theme_get_setting('footer_solution_menu', $key),
    '#description' => t('Specify the menu to be rendered in footer Solution block.'),
  );
  $form['theme_square']['footer_newsletter_form'] = array(
    '#type' => 'textfield',
    '#title' => t('Footer newsletter form'),
    '#default_value' => theme_get_setting('footer_newsletter_form', $key),
    '#description' => t('Specify the form to be used in footer newsletter form.'),
  );
//  $form['#submit'][] = '_responsive_square_system_theme_settings_submit';
}

//function _responsive_square_system_theme_settings_submit($form, &$form_state) {
//  $fields = array(
//    'footer_about_us_text', 'footer_flickr_text', 'footer_flickr_user_set', 'footer_solution_menu', 'footer_newsletter_form',
//  );
//  // Save the settings.
//  foreach ($fields as $field) {
//    if (!empty($form_state['values'][$field])) {
//      variable_set($field, $form_state['values'][$field]);
//    }
//  }
//}