<?php
namespace Prototype\Mapping;

class NameMapper extends Mapper {
    
    public function __construct(\Erfurt_Store $store, $url, $vocabulary) {
        parent::__construct($store, $url, $vocabulary);
    }

    public function map(\Prototype\ContactInformation $contact) {
        $query = 'PREFIX ' . $this->vocabulary->name . ': <' . $this->vocabulary->prefix . '> '
        . 'SELECT ?familyName ?firstName '
        . 'WHERE { '
            . '{<' . $this->url . '> ' . $this->vocabulary->name . ':' . $this->vocabulary->attributes->lastname . ' ?familyName .} UNION '
            . '{<' . $this->url . '> ' . $this->vocabulary->name . ':' . $this->vocabulary->attributes->firstname . ' ?firstName .} '
        . '}';
        $result = $this->store->sparqlQuery($query);
        if (!empty($result[0]['familyName'])) {
            $contact->setLastname($result[0]['familyName']);
        }
        if (!empty($result[0]['firstName'])) {
            $contact->setFirstname($result[0]['firstName']);
        }
    }

}