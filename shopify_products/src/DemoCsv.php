<?php

namespace Drupal\shopify_products;

use Drupal\migrate_source_csv\CSVFileObject;

/**
 * Custom CSV file object implementation.
 */
class DemoCsv extends CSVFileObject {

  /**
   * Keep track of which styles we have done.
   *
   * @var array
   */
  public $importedProduct = [];

  /**
   * The current style we're looking at.
   *
   * @var string
   */
  public $name = '';

  /**
   * Custom implementation to make unique rows.
   *
   * Since the CSV file has multiple rows for each product, we only want a
   * single "representative" line to be used. So we override the iterator
   * in such a way as to skip all of the duplicates and only grab a single
   * line.
   */
  public function next() {
    $row = $this->current();

    if ($this->name == '') {
      $this->name = $row['Handle'];
    }
    while (($this->name == $row['Handle'] || in_array($row['Handle'], $this->importedProduct)) && !$this->eof()) {
      parent::next();
      $row = $this->current();
    }
    $this->name = $row['Handle'];
    $this->importedProduct[] = $row['Handle'];
  }

  /**
   * Returns the count of the number of items.
   *
   * For some reason, the regular SPL Filter iterator has issues, so
   * we're overriding this so that the counts match up.
   *
   * @return mixed
   *   The count.
   */
  public function count() {
    $this->next();

    $names = [];
    while ($this->valid()) {
      $row_data = $this->current();
      $this->next();

      $names[] = $row_data['Name'];
    }
    $items = array_unique($names);
    $items = array_filter($items);

    return count($items);
  }

}
