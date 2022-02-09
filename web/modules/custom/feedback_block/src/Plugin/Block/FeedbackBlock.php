<?php
/**
 * @file
 * contains \Drupal\feedback_block\Plugin\Block\FeedbackBlock
 */
namespace Drupal\feedback_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides an Feedback Block
 * @Block(
 *   id= "feedback_block",
 *   admin_label = @Translation("Feedback Block"),
 *   )
 */

class FeedbackBlock extends BlockBase
{
    /**
     * (@inheritDoc)
     */
    public function build()
    {
        // For fetching the form from Drupal\feedback_block\Form\Feedback Directory
        return \Drupal::formBuilder()->getForm('Drupal\feedback_block\Form\Feedback');
    }
}
