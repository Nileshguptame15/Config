<?php

namespace Drupal\node_json_data\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Database;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class MainController extends ControllerBase
{
  public function getData($apikey, $node_id)
  {
    $config = \Drupal::config('apikey.settings');
    //Retrieve the Apikey from api.settings configuration
    $api = $config->get('apikey');
    //Checking whether the node id is available in the available nodes
    $nid = Database::getConnection()->select('node', 'n');
    $nid->fields('n', array('nid'));
    $nid->condition('nid', $node_id);
    // Returns the row data from the node table
    $results = $nid->execute();
    // Checking if any row is returned from the above query or not
    if (empty($results->fetchCol())) {
      return new Response('Node not available');
    }
    //Checking if passed api value is available in the apikey.settings configuration
    if ($apikey == $api) {
      return new JsonResponse(array('apikey' => $api));
    } else {
      return [
        '#markup' => $this->t('Hello World!')
      ];
    }
  }
}
