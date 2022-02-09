<?php

namespace Drupal\node_json_data\Form;

// Classes referenced in this class:
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\ConfigFormBase;

// This is the form being extended:
use Drupal\system\Form\SiteInformationForm;

/**
 * Configure site information settings for this site.
 */
class ApiSiteSiteInformationForm extends SiteInformationForm
{

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state)
  {
    // Retrieve the system.site configuration
    $site_config = $this->config('system.site');

    // Get the original form from the class we are extending
    $form = parent::buildForm($form, $form_state);

    // Add a textfield to the site information section of the form for the api
    $form['api'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Api Key'),
      // The default value is the new value that was added to the configuration
      '#size' => 16,
      '#default_value' => $site_config->get('api'),
      '#description' => $this->t('The Apikey of the site'),
    ];

    return $form;
  }
  /**
   * {@inheritDoc}
   */
  function validateForm(array &$form, FormStateInterface $form_state)
  {
    $api = $form_state->getValue('api');
    //Check if Api key is given or not
    if ($api == '') {
      $form_state->setErrorByName('api', 'No api key is saved');
    }
  }
  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    $config = $this->config('system.site');

    // The api is retrieved from the submitted form values
    // and saved to the 'api' element of the system.site configuration.
    $new_api = $form_state->getValue('api');
    $config->set('api', $new_api);
    $config->save();

    // Pass the remaining values off to the parent form that is being extended,
    // so that that the parent form can process the values.
    parent::submitForm($form, $form_state);
  }
}
