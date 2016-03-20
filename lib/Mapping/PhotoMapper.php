<?php
namespace Prototype\Mapping;

class PhotoMapper extends Mapper {

    public function __construct(\Erfurt_Store $store, $url, $vocabulary) {
        parent::__construct($store, $url, $vocabulary);
    }

    public function map(\Prototype\ContactInformation $contact) {
        // Doesn't work yet
//        $value = $this->simpleValue(['name' => 'foaf', 'value' => 'http://xmlns.com/foaf/0.1/'], 'depiction');
//        if (!empty($value)) {
//            $image = file_get_contents($value);
//            $temp = explode('.', $value);
//            $extension = $temp[count($temp) - 1];
//            $contact->setPhoto('ENCODING=b;TYPE=' . $extension . ':' . $image);
//        }
    }

}