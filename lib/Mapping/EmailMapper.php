<?php
namespace Prototype\Mapping;

class EmailMapper extends Mapper {
    
    public function __construct(\Erfurt_Store $store, $url, $vocabulary) {
        parent::__construct($store, $url, $vocabulary);
    }

    public function map(\Prototype\ContactInformation $contact) {
        $value = $this->simpleValue($this->vocabulary->attributes->email);
        if (!empty($value)) {
            $contact->setEmail(str_replace('mailto:', '', $value));
        }
    }

}