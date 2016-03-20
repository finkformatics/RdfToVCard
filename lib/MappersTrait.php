<?php
namespace Prototype;

/**
 * Trait MappersTrait, can be used wherever required.
 * @package Prototype the main application package/namespace
 * @author Lukas Werner <kontakt@lwerner.de>
 */
trait MappersTrait {
    
    /**
     * Method for getting all supported mappers
     *
     * @param \Erfurt_Store $store the store to use
     * @return \Prototype\Mapping\Mapper[] the mappers as an array
     */
    public function getMappers(\Erfurt_Store $store, $url, $vocabulary) {
        $mappers = array();
        $mappers[] = new Mapping\FullnameMapper($store, $url, $vocabulary);
        $mappers[] = new Mapping\NameMapper($store, $url, $vocabulary);
        $mappers[] = new Mapping\AddressMapper($store, $url, $vocabulary);
        $mappers[] = new Mapping\EmailMapper($store, $url, $vocabulary);
        $mappers[] = new Mapping\BirthdayMapper($store, $url, $vocabulary);
        $mappers[] = new Mapping\CategoriesMapper($store, $url, $vocabulary);
        $mappers[] = new Mapping\GeodataMapper($store, $url, $vocabulary);
        $mappers[] = new Mapping\LogoMapper($store, $url, $vocabulary);
        $mappers[] = new Mapping\NicknameMapper($store, $url, $vocabulary);
        $mappers[] = new Mapping\NotesMapper($store, $url, $vocabulary);
        $mappers[] = new Mapping\OrganisationMapper($store, $url, $vocabulary);
        $mappers[] = new Mapping\PhotoMapper($store, $url, $vocabulary);
        $mappers[] = new Mapping\RoleMapper($store, $url, $vocabulary);
        $mappers[] = new Mapping\PhoneMapper($store, $url, $vocabulary);
        $mappers[] = new Mapping\TitleMapper($store, $url, $vocabulary);
        $mappers[] = new Mapping\UrlMapper($store, $url, $vocabulary);
        return $mappers;
    }
    
}