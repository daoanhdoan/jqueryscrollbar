<?php
namespace Drupal\jqueryscrollbar\Form;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * @file
 * JQuery Scrollbar settings form include file.
 */

class JqueryScrollbarSettings extends ConfigFormBase
{
  /**
   * Admin settings menu callback.
   *
   * @see jquery_autosize_menu()
   */
  public function buildForm(array $form, FormStateInterface $form_state)
  {
    $config = $this->config('jqueryscrollbar.settings');
    $form['variant'] = array (
      '#type' => 'radios',
      '#title' => t('Variant'),
      '#options' => array (
        'minified' => t('Production (minified)'),
        'uncompressed' => t('Development (uncompressed)'),
      ),
      '#default_value' => $config->get('variant'),
    );

    $form['enable'] = array (
      '#type' => 'checkbox',
      '#title' => t('Enable automatically scrollbar trigger class .scrollbar'),
      '#default_value' => $config->get('enable'),
    );

    $form['options'] = array (
      '#type' => 'fieldset',
      '#title' => t('Options'),
      '#collapsible' => TRUE,
      '#tree' => TRUE
    );
    $options = $config->get('options');
    $form['options']['showArrows'] = array (
      '#type' => 'checkbox',
      '#title' => t('Show Arrows'),
      '#default_value' => $options['showArrows'],
    );

    $form['options']['scrollx'] = array (
      '#type' => 'select',
      '#title' => t('Scroll X'),
      '#default_value' => $options['scrollx'],
      '#options' => array (
        '' => t('None'),
        'simple' => t('Simple'),
        'advanced' => t('Advanced'),
      ),
    );

    $form['options']['scrolly'] = array (
      '#type' => 'select',
      '#title' => t('Scroll Y'),
      '#default_value' => $options['scrolly'],
      '#options' => array (
        '' => t('None'),
        'simple' => t('Simple'),
        'advanced' => t('Advanced'),
      ),
    );

    $form['style'] = array (
      '#type' => 'select',
      '#title' => t('Scroll bar Style'),
      '#options' => array(
        'inner' => t('Simple Inner'),
        'outer' => t('Simple Outer'),
        'macosx' => t('Mac OS X Lion'),
        'light' => t('Light'),
        'rail' => t('Rail'),
        'dynamic' => t('Dynamic'),
        'chrome' => t('Chrome'),
      ),
      '#default_value' => $config->get('style'),
    );

    $form['trigger'] = array (
      '#type' => 'textarea',
      '#title' => t('Valid jQuery Classes/IDs to trigger scrollbar (One per line)'),
      '#default_value' => $config->get('trigger'),
      '#description' => t('Specify the class/ID of textareas to automatically adjust height, one per line. For example by providing "textarea" will convert any textareas'),
    );
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config('jqueryscrollbar.settings');
    $config->set('variant', $form_state->getValue('variant'));
    $config->set('enable', $form_state->getValue('enable'));
    $config->set('style', $form_state->getValue('style'));
    $config->set('options', $form_state->getValue('options'));
    $config->set('trigger', $form_state->getValue('trigger'));
    $config->save();
    $this->messenger()->addStatus($this->t('The Jquery scrollbar settings have been saved.'));
  }

  /**
   * @inheritDoc
   */
  protected function getEditableConfigNames()
  {
    return ['jqueryscrollbar.settings'];
  }

  /**
   * @inheritDoc
   */
  public function getFormId()
  {
    return "jqueryscrollbar_settings";
  }
}
