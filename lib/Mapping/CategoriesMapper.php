<?php
namespace Prototype\Mapping;

class CategoriesMapper extends Mapper {

    public function __construct(\Erfurt_Store $store, $url, $vocabulary) {
        parent::__construct($store, $url, $vocabulary);
    }

    public function map(\Prototype\ContactInformation $contact) {
        // TODO: Not implemented yet
    }

}