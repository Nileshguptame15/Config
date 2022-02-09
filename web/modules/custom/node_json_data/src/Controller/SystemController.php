<?php

namespace Drupal\node_json_data\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Database;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class SystemController extends ControllerBase
{
  public function getData($apikey, $content_type, $node_id)
  {
    $config = \Drupal::config('system.site');
    //Retrieve the Apikey from system.site configuration
    $api = $config->get('api');
    //Checking whether the node id and content type are available in the available nodes
    $nid = Database::getConnection()->select('node', 'n');
    $nid->fields('n', array('nid'));
    $nid->condition('nid', $node_id);
    $nid->condition('type', $content_type);
    // Returns the row data from the node table
    $results = $nid->execute();
    // Checking if any row is returned from the above query or not
    if (empty($results->fetchCol())) {
      return new Response('Node or content type is not valid');
    }
    //Checking if passed api value is available in the system.site configuration
    if ($apikey == $api) {
      return new JsonResponse(array('apikey' => $api));
    } else {
      return [
        '#markup' => $this->t('Hello World!')
      ];
    }
  }
}
