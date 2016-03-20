<?php
namespace Prototype\Mapping;

class NicknameMapper extends Mapper {

    public function __construct(\Erfurt_Store $store, $url, $vocabulary) {
        parent::__construct($store, $url, $vocabulary);
    }

    public function map(\Prototype\ContactInformation $contact) {
        $value = $this->simpleValue($this->vocabulary->attributes->nickname);
        if (!empty($value)) {
            $contact->setNickname($value);
        }
    }

}