<?php
namespace Prototype;

use Sabre\VObject;

/**
 * Class ContactToVCard
 * Offers functionality to convert ContactInformation objects to vcards. Utilizes the Sabre\VObject library.
 *
 * @package Prototype the main application package/namespace
 * @author Lukas Werner <kontakt@lwerner.de>
 */
class ContactToVCard {
    
    /**
     * Attribute map with ContactInformation attributes as keys and vcard 
     * attributes as values.
     * 
     * @var array[string]string
     */
    private static $attributeMap = [
        'fullname' => 'FN',
        'address' => 'ADR',
        'geodata' => 'GEO',
        'categories' => 'CATEGORIES',
        'birthday' => 'BDAY',
        'email' => 'EMAIL',
        'logo' => 'LOGO',
        'nickname' => 'NICKNAME',
        'notes' => 'NOTE',
        'organisation' => 'ORG',
        'photo' => 'PHOTO',
        'role' => 'ROLE',
        'phone' => 'TEL',
        'title' => 'TITLE',
        'url' => 'URL'
    ];
    
    /**
     * Converts a ContactInformation object into a vcard
     * 
     * @param \Prototype\ContactInformation $contact contact information to convert
     * @return \Sabre\VObject\Component\VCard created vcard
     */
    public function convert(ContactInformation $contact) {
        $vcard = new VObject\Component\VCard();
        if ($contact->hasAttribute('lastname') 
                || $contact->hasAttribute('firstname') 
                || $contact->hasAttribute('additionalNames') 
                || $contact->hasAttribute('honorificPrefixes') 
                || $contact->hasAttribute('honorificSuffixes')) {
            $N = [
                $contact->hasAttribute('lastname') ? $contact->getAttribute('lastname') : '',
                $contact->hasAttribute('firstname') ? $contact->getAttribute('firstname') : '',
                $contact->hasAttribute('additionalNames') ? $contact->getAttribute('additionalNames') : '',
                $contact->hasAttribute('honorificPrefixes') ? $contact->getAttribute('honorificPrefixes') : '',
                $contact->hasAttribute('honorificSuffixes') ? $contact->getAttribute('honorificSuffixes') : ''
            ];
            $vcard->add('N', $N);
        }
        foreach (self::$attributeMap as $key => $value) {
            if ($contact->hasAttribute($key)) {
                $vcard->add($value, $contact->getAttribute($key));
            }
        }
        return $vcard;
    }
    
}
