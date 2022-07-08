<?php

namespace Drupal\devjobs_module\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;
use Drupal\file\Entity\File;
use Drupal\image\Entity\ImageStyle;

class DevjobsController extends ControllerBase
{
    public function main_page()
    {
      $title = \Drupal::request()->query->get('title');
      $location = \Drupal::request()->query->get('location');
      $checkbox = \Drupal::request()->query->get('full-time');

      $node_storage = \Drupal::entityTypeManager()->getStorage('node');

      $nids = $node_storage->getQuery()
              ->condition('status', 1)
              ->condition('type', 'job')
              ->sort('nid', 'ASC')
              ->execute();

      if(!empty($title) && !empty($location) && $checkbox === 'on') {
        $nids = $node_storage->getQuery()
          ->condition('status', 1)
          ->condition('type', 'job')
          ->condition('field_job_type', 'Full Time', '=')
          ->condition('title', $title, 'CONTAINS')
          ->condition('field_country', $location, 'CONTAINS')
          ->sort('nid', 'ASC')
          ->execute();
      }

      if(!empty($title)) {
        $nids = $node_storage->getQuery()
          ->condition('status', 1)
          ->condition('type', 'job')
          ->condition('title', $title, 'CONTAINS')
          ->sort('nid', 'ASC')
          ->execute();
      }

      if(!empty($location)) {
        $nids = $node_storage->getQuery()
                ->condition('type', 'job')
                ->condition('field_country', $location, 'CONTAINS')
                ->sort('nid', 'ASC')
                ->execute();
      }

      if(empty($title) && empty($location) && $checkbox === 'on'){
        $nids = $node_storage->getQuery()
          ->condition('status', 1)
          ->condition('type', 'job')
          ->condition('field_job_type', 'Full Time', '=')
          ->sort('nid', 'ASC')
          ->execute();
      }

      $jobs = [];

      foreach($nids as $nid) {
        $node = Node::load($nid);

        $target_id = $node->field_company_logo->getValue()[0]['target_id'];
        $file = File::load($target_id);
        $image_uri = $file->getFileUri();
        $style = ImageStyle::load('thumbnail');
        $url = $style->buildUrl($image_uri);

        $jobs[$nid] = [
          'title' => $node->getTitle(),
          'body' => $node->body->getValue()[0]['value'] ?? null,
          'published_on' => date("d-m-Y, H:i",$node->field_published_on->getValue()[0]['value']),
          'company' => $node->field_company->getValue()[0]['value'],
          'country' => $node->field_country->getValue()[0]['value'],
          'job_type' => $node->field_job_type->getValue()[0]['value'],
          'company_logo' => $url,
          'nid' => $nid,
        ];
      }

      return [
        '#theme' => 'devjobs_module_theme_hook',
        '#jobs' => $jobs,
      ];

    }
}
