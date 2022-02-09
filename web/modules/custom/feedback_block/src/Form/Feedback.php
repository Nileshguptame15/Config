<?php

namespace Drupal\feedback_block\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class Feedback extends FormBase
{
    /**
     * (@inheritDoc)
     */
    public function getFormId()
    {
        // Creates and returns a form_id
        return 'feedback_block';
    }
    /**
     * (@inheritDoc)
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        // Creating a field of name type textfield 
        $form['name'] = array(
            '#type' => 'textfield',
            '#title' => 'Your Name',
            '#size' => 64,
            '#description' => 'Enter your Name',
            '#default_value' => 'Anonymous'
        );
        // Created a radio type field connected with the 5 options for feedback on the scale from 1 to 5
        $form['rating'] = array(
            '#type' => 'radios',
            '#title' => $this->t('Rating'),
            '#maxlength' => 1,
            '#description' => $this->t('Please give your feedback for our service'),
            '#options' => array(0 => '1', 1 => '2', 3 => '3', 4 => '4', 5 => '5'),
            '#required' => TRUE,
        );
        // Created a submit button for storing the ratings
        $form['submit'] = array(
            '#type' => 'submit',
            '#value' => 'Submit',
        );
        return $form;
    }
    /**
     * (@inheritDoc)
     */
    public function validateForm(array &$form, FormStateInterface $form_state)
    {
    }
    /**
     * (@inheritDoc)
     */
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        // Started a connection to store the data into the database
        \Drupal::database()->insert('feedback_block')->fields(array(
            'name' => $form_state->getValue('name'),
            'rating' => $form_state->getValue('rating'),
            'created' => time(),
        ))->execute();
        \Drupal::messenger()->addMessage('Thanks for your Feedback, Your feedback is so much valueable for us');
    }
}
