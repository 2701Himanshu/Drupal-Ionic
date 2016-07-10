<?php

/**
 * @file
 * Contains \Drupal\single_page_site\Controller\SinglePageSiteController.
 */

namespace Drupal\single_page_site\Controller;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Extension\ModuleHandler;
use Drupal\Core\Link;
use Drupal\Core\Render\RendererInterface;
use Drupal\Core\Url;
use Drupal\single_page_site\Manager\SinglePageSiteManager;

/**
 * Class SinglePageSiteController
 * @package Drupal\single_page_site\Controller
 */
class SinglePageSiteController extends ControllerBase {

  protected $manager;
  protected $moduleHandler;
  protected $renderer;

  /**
   * SinglePageSiteController constructor.
   * @param \Drupal\single_page_site\Manager\SinglePageSiteManager $manager
   * @param \Drupal\Core\Extension\ModuleHandler $module_handler
   * @param \Drupal\Core\Render\RendererInterface $renderer
   */
  public function __construct(SinglePageSiteManager $manager, ModuleHandler $module_handler, RendererInterface $renderer) {
    $this->manager = $manager;
    $this->moduleHandler = $module_handler;
    $this->renderer = $renderer;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('single_page_site.manager'),
      $container->get('module_handler'),
      $container->get('renderer')
    );
  }

  /**
   * Sets title.
   */
  public function setTitle() {
    return $this->manager->getPageTitle();
  }

  /**
   * Renders single page.
   * @return array
   */
  public function render() {
    if ($menu = $this->manager->getMenu()) {
      $items = array();
      $current_item_count = 1;
      // Collect all drupal messages and store them, we will show them later on.
      $messages = drupal_get_messages();
      // Now fetch menu tree.
      $tree = $this->manager->getMenuChildren();

      foreach ($tree as $menu_item) {
        if ($menu_item_details = $this->manager->isMenuItemRenderable($menu_item)) {
          // Get route params.
          $params = $menu_item_details['route_parameters'];
          // Generate href.
          $href = Url::fromRoute($menu_item_details['route_name'], $params)
            ->toString();
          // Generate anchor.
          $anchor = $this->manager->generateAnchor($href);

          // At this point we can execute request to render content.
          $render = $this->manager->executeAndRenderSubRequest($href);
          $output = is_array($render) ? $this->renderer->render($render) : $render;
          // Let other modules makes changes to $output.
          $this->moduleHandler->alter('single_page_site_output', $output, $current_item_count);

          // Build renderable array.
          $item = array(
            'output' => $output,
            'anchor' => $anchor,
            'title' => $menu_item_details['title'],
            'tag' => $this->manager->getTitleTag(),
          );
          array_push($items, $item);
          $current_item_count++;
        }
      }
      // Re-inject the messages.
      foreach ($messages as $type => $data) {
        foreach ($data as $message) {
          drupal_set_message($message, $type);
        }
      }


      // Render output and attach JS files.
      $js_settings = array(
        'menuClass' => $this->manager->getMenuClass(),
        'distanceUp' => $this->manager->getDistanceUp(),
        'distanceDown' => $this->manager->getDistanceDown(),
        'updateHash' => $this->manager->updateHash(),
        'offsetSelector' => $this->manager->getOffsetSelector(),
      );

      $page_content = array(
        '#theme' => 'single_page_site',
        '#items' => $items,
        '#attached' => array(
          'library' => array(
            'single_page_site/single_page_site.scrollspy',
          ),
        ),
      );

      if ($this->manager->getSmoothScrolling()) {
        // Add smooth scrolling.
        $page_content['#attached']['library'][] = 'single_page_site/single_page_site.scroll';
      }
      $page_content['#attached']['drupalSettings']['singlePage'] = $js_settings;


      return $page_content;
    }
    else {
      // If settings aren't set.
      return array(
        '#markup' => $this->t('You have to !configure your single page before you can use it.',
          array('!configure' => Link::fromTextAndUrl(t('configure'), Url::fromUri('single_page_site.config'))))
      );
    }
  }
}
