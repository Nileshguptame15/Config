<?php

namespace Drupal\node_json_data\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

/**
 * Listens to the dynamic route events.
 */
class ApiRouting extends RouteSubscriberBase
{
  /**
   * {@inheritdoc}
   */
  protected function alterRoutes(RouteCollection $collection)
  {
    // Change form for the system.site_information_settings route
    // to Drupal\node_json_data\Form\ApiSiteSiteInformationForm
    // Act only on the system.site_information_settings route.
    if ($route = $collection->get('system.site_information_settings')) {
      // Next, set the value for _form to the form override.
      $route->setDefault('_form', 'Drupal\node_json_data\Form\ApiSiteSiteInformationForm');
    }
  }
}
