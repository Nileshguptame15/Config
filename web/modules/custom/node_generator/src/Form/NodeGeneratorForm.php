<?php

namespace Drupal\node_generator\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\devel\Plugin\Devel\Dumper\Kint;
use Drupal\node\Entity\Node;

class NodeGeneratorForm extends FormBase
{
    /**
     * (@inheritDoc)
     */
    public function getFormId()
    {
        return 'node_generator';
    }
    /**
     * (@inheritDoc)
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        // Fetching the defined content types
        $types = node_type_get_names();
        // Content type field of the form
        $form['content_type'] = array(
            '#type' => 'select',
            '#title' => 'The Content types',
            '#options' => $types,
            '#description' => 'Select content type for generating nodes',
        );
        // Allowing the user to enter the number of nodes from the users
        $form['nodes'] = array(
            '#type' => 'textfield',
            '#title' => 'Number of nodes',
            '#size' => 10,
            '#maxlength' => 10,
            '#minlength' => 2,
            '#description' => 'Enter number of nodes for generating content',
        );
        // adding a submit button to direct the data to submitform function
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
        // retrieves the submitted data of number of nodes
        $nodenumber = $form_state->getValue('nodes');
        // Changing the value into integer
        $value = (int)$nodenumber;
        // Checking if the number of nodes is less than 2 or more than 10
        if ($value < 2) {
            $form_state->setErrorByName('nodes', 'The number nodes are less than 2');
        } elseif ($value > 10) {
            $form_state->setErrorByName('nodes', 'The number nodes are more than 10');
        }
    }
    /**
     * (@inheritDoc)    
     */
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        // retrieves the submitted data of number of nodes for generating nodes
        $nodenumber = $form_state->getValue('nodes');
        $contentSelected = $form_state->getValue('content_type');
        // Intializing the i variable for using the while loop
        $i = 0;
        // Starting a while for generating the node
        while ($i < $nodenumber) {
            // Creating nodes
            $node = Node::create(array(
                'type' => $contentSelected,
                'title' => 'Programmitically generated node',
                'langcode' => 'en',
                'uid' => '1',
                'status' => 1,
                'field_fields' => array(),
            ));
            $node->save();
            $i++;
        }
    }
}
