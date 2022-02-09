<?php

/**
 * @file
 * contains \Drupal\node_json_data\Form\RSVPSettingsForm
 */

namespace Drupal\node_json_data\Form;

use Drupal\Core\Form\ConfigFormBase;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Core\Form\FormStateInterface;

/**
 * Defines a form to configure RSVP List module settings
 */
class APISettingsForm extends ConfigFormBase
{
    /**
     * {@inheritDoc}
     */
    public function getFormId()
    {
        return 'apikey_admin_setting';
    }
    /**
     *  @inheritDoc
     */
    protected function getEditableConfigNames()
    {
        return ['apikey.settings'];
    }
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $form['apikey'] = array(
            '#title' => 'Please enter the API Key',
            '#type' => 'textfield',
            '#size' => 16,
            '#maxlength' => 16,
            '#description' => "We'll store your API Key in our Database",
            '#required' => TRUE,
        );
        return parent::buildForm($form, $form_state);
    }
    /**
     *  @inheritDoc
     */
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        $apikey = $form_state->getValue('apikey');
        $apikeyjson = $form_state->getValues();
        $this->config('apikey.settings')
            ->set('apikey', $apikey)
            ->save();
    }
}
