<?php
namespace Prototype\Mapping;

class UrlMapper extends Mapper {

    public function __construct(\Erfurt_Store $store, $url, $vocabulary) {
        parent::__construct($store, $url, $vocabulary);
    }

    public function map(\Prototype\ContactInformation $contact) {
        $value = $this->simpleValue($this->vocabulary->attributes->url);
        if (!empty($value)) {
            $contact->setUrl($value);
        }
    }

}