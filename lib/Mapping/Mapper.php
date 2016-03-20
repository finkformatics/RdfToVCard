<?php
namespace Prototype\Mapping;

abstract class Mapper {
    
    /**
     *
     * @var \Erfurt_Store
     */
    protected $store;
    protected $url;
    protected $vocabulary;
    
    public function __construct(\Erfurt_Store $store, $url, $vocabulary) {
        $this->store = $store;
        $this->url = $url;
        $this->vocabulary = $vocabulary;
    }
    
    public function simpleValue($propertyName) {
        $query = 'PREFIX ' . $this->vocabulary->name . ': <' . $this->vocabulary->prefix . '> '
        . 'SELECT ?' . $propertyName . ' '
        . 'WHERE { '
            . '<' . $this->url . '> ' . $this->vocabulary->name . ':' . $propertyName . ' ?' . $propertyName . ' '
        . '}';
        $result = $this->store->sparqlQuery($query);
        if (!empty($result[0][$propertyName])) {
            return $result[0][$propertyName];
        }
        return NULL;
    }
    
    public abstract function map(\Prototype\ContactInformation $contact);
    
}