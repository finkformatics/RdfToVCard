<?php
/**
 * Contains the class ContactInformation
 */

/**
 * Main namespace for this prototype
 */
namespace Prototype;

/**
 * Class for containing contact information for a particular person.
 * 
 * @author Lukas Werner <kontakt@lwerner.de>
 */
class ContactInformation {
    
    const KEY_ADDRESS_POST_OFFICE_BOX = 'post-office-box';
    const KEY_ADDRESS_EXTENDED = 'extended-address';
    const KEY_ADDRESS_STREET = 'street';
    const KEY_ADDRESS_LOCALITY = 'locality';
    const KEY_ADDRESS_REGION = 'region';
    const KEY_ADDRESS_POSTAL_CODE = 'postal-code';
    const KEY_ADDRESS_COUNTRY = 'country';
    
    const KEY_GEODATA_LATITUDE = 'lat';
    const KEY_GEODATA_LONGITUDE = 'long';
    
    /**
     * The firstname of the person
     * @var string
     */
    private $firstname;
    /**
     * Additional names of the person, either comma-separated string or array
     * @var string|string[]
     */
    private $additionalNames;
    /**
     * The lastname of the person
     * @var string
     */
    private $lastname;
    /**
     * Honorific Prefixes such as 'Dr.', either comma-separated or in array
     * @var string|string[]
     */
    private $honorificPrefixes;
    /**
     * Honorific Suffixes such as 'Jr.' or 'M.D.', either comma-separated or in array
     * @var string|string[]
     */
    private $honorificSuffixes;
    /**
     * The full name of the person as string representation
     * @var string
     */
    private $fullname;
    /**
     * Structured address of the format (e.g.):
     * 
     * <code>
     * [
     *     'post-office-box' => 'Postfach',
     *     'extended-address' => 'Addresszusatz',
     *     'street' => 'Augustusplatz 1',
     *     'locality' => 'Leipzig',
     *     'region' => 'Saxony',
     *     'postal-code' => '04109',
     *     'country' => 'Germany',
     * ]
     * </code>
     * 
     * @var array[string]string 
     */
    private $address;
    /**
     * Birthday in the format yyyy-mm-dd
     * @var string 
     */
    private $birthday;
    /**
     * String array of categories/properties to describe the vcard object.
     * Either comma-separated string or array
     * @var string|string[]
     */
    private $categories;
    /**
     * E-Mail address of the vcard object
     * @var string
     */
    private $email;
    /**
     * Geo coordinates in the following format:
     * 
     * <code>
     * [
     *     'lat'  => 51.338952,
     *     'long' => 12.380554
     * ]
     * </code>
     * 
     * @var array[string]string
     */
    private $geodata;
    /**
     * The logo of the vcard object (mostly a uri to it)
     * @var string
     */
    private $logo;
    /**
     * The nickname of the vcard object
     * @var string
     */
    private $nickname;
    /**
     * Notes as a comment for the vcard object
     * @var string
     */
    private $notes;
    /**
     * The organisation of the vcard object
     * @var string
     */
    private $organisation;
    /**
     * A photo of the vcard object (mostly a uri to it)
     * @var string
     */
    private $photo;
    /**
     * Role, occupation or business category within an organisation
     * @var string
     */
    private $role;
    /**
     * Phone number of the vcard object
     * @var string
     */
    private $phone;
    /**
     * Job title, functional position or function of the vcard object
     * @var string
     */
    private $title;
    /**
     * Website of the vcard object
     * @var string
     */
    private $url;
    
    /**
     * Checks if there is an attribute for the given name. 
     * 
     * @param string $attributeName
     * @return bool TRUE if there is any, FALSE elsewise.
     */
    public function hasAttribute($attributeName) {
        return !empty($this->$attributeName);
    }
    
    /**
     * Gets an attribute of this class by its name. 
     * 
     * @param string $attributeName
     * @return mixed NULL if there isn't any, the value elsewise.
     */
    public function getAttribute($attributeName) {
        return $this->hasAttribute($attributeName) ? $this->$attributeName : NULL;
    }
    
    /**
     * Getter for firstname
     * 
     * @see ContactInformation::firstname
     * @return string the firstname
     */
    public function getFirstname() {
        return $this->firstname;
    }

    /**
     * Getter for additionalNames
     * 
     * @see ContactInformation::additionalNames
     * @return string|string[] the additional names
     */
    public function getAdditionalNames() {
        return $this->additionalNames;
    }

    /**
     * Getter for lastname
     * 
     * @see ContactInformation::lastname
     * @return string the lastname
     */
    public function getLastname() {
        return $this->lastname;
    }

    /**
     * Getter for honorificPrefixes
     * 
     * @see ContactInformation::honorificPrefixes
     * @return string|string[] the honorific prefixes
     */
    public function getHonorificPrefixes() {
        return $this->honorificPrefixes;
    }

    /**
     * Getter for honorificSuffixes
     * 
     * @see ContactInformation::honorificSuffixes
     * @return string|string[] the honorific suffixes
     */
    public function getHonorificSuffixes() {
        return $this->honorificSuffixes;
    }

    /**
     * Getter for fullname
     * 
     * @see ContactInformation::fullname
     * @return string the fullname
     */
    public function getFullname() {
        return $this->fullname;
    }

    /**
     * Getter for address
     * 
     * @see ContactInformation::address
     * @return array[string]string the address
     */
    public function getAddress() {
        return $this->address;
    }
    
    /**
     * Gets the part of the address. The part must be a specified string given
     * by the KEY_ADDRESS_* constants of this class.
     * 
     * @param string $part specified path of the address to return
     * @return string part of the address
     * @throws Exception if the part isn't the value of one of the KEY_ADDRESS_* constants
     */
    public function getAddressPart($part) {
        if ($part != self::KEY_ADDRESS_COUNTRY
                && $part != self::KEY_ADDRESS_EXTENDED
                && $part != self::KEY_ADDRESS_LOCALITY
                && $part != self::KEY_ADDRESS_POSTAL_CODE
                && $part != self::KEY_ADDRESS_POST_OFFICE_BOX
                && $part != self::KEY_ADDRESS_REGION
                && $part != self::KEY_ADDRESS_STREET) {
            throw new Exception("There is no address part '$part'!");
        }
        return $this->address[$part];
    }

    /**
     * Getter for birthday
     * 
     * @see ContactInformation::birthday
     * @return string the birthday
     */
    public function getBirthday() {
        return $this->birthday;
    }

    /**
     * Getter for categories
     * 
     * @see ContactInformation::categories
     * @return string|string[] the categories
     */
    public function getCategories() {
        return $this->categories;
    }

    /**
     * Getter for email
     * 
     * @see ContactInformation::email
     * @return string the email
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Getter for geodata
     * 
     * @see ContactInformation::geodata
     * @return array[string]string the geodata
     */
    public function getGeodata() {
        return $this->geodata;
    }

    /**
     * Getter for logo
     * 
     * @see ContactInformation::logo
     * @return string the logo
     */
    public function getLogo() {
        return $this->logo;
    }

    /**
     * Getter for nickname
     * 
     * @see ContactInformation::nickname
     * @return string the nickname
     */
    public function getNickname() {
        return $this->nickname;
    }

    /**
     * Getter for notes
     * 
     * @see ContactInformation::notes
     * @return string the notes
     */
    public function getNotes() {
        return $this->notes;
    }

    /**
     * Getter for organisation
     * 
     * @see ContactInformation::organisation
     * @return string the organisation
     */
    public function getOrganisation() {
        return $this->organisation;
    }

    /**
     * Getter for photo
     * 
     * @see ContactInformation::photo
     * @return string the photo
     */
    public function getPhoto() {
        return $this->photo;
    }

    /**
     * Getter for role
     * 
     * @see ContactInformation::role
     * @return string the role
     */
    public function getRole() {
        return $this->role;
    }

    /**
     * Getter for phone
     * 
     * @see ContactInformation::phone
     * @return string the phone
     */
    public function getPhone() {
        return $this->phone;
    }

    /**
     * Getter for title
     * 
     * @see ContactInformation::title
     * @return string the title
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Getter for url
     * 
     * @see ContactInformation::url
     * @return string the url
     */
    public function getUrl() {
        return $this->url;
    }

    /**
     * Setter for firstname
     * 
     * @param string $firstname the firstname to set
     */
    public function setFirstname($firstname) {
        $this->firstname = $firstname;
    }

    /**
     * Setter for additionalNames
     * 
     * @param string|string[] $additionalNames the additionalNames to set
     */
    public function setAdditionalNames($additionalNames) {
        $this->additionalNames = $additionalNames;
    }

    /**
     * Setter for lastname
     * 
     * @param string $lastname the lastname to set
     */
    public function setLastname($lastname) {
        $this->lastname = $lastname;
    }

    /**
     * Setter for honorificPrefixes
     * 
     * @param string|string[] $honorificPrefixes the honorificPrefixes to set
     */
    public function setHonorificPrefixes($honorificPrefixes) {
        $this->honorificPrefixes = $honorificPrefixes;
    }

    /**
     * Setter for honorificSuffixes
     * 
     * @param string|string[] $honorificSuffixes the honorificSuffixes to set
     */
    public function setHonorificSuffixes($honorificSuffixes) {
        $this->honorificSuffixes = $honorificSuffixes;
    }

    /**
     * Setter for fullname
     * 
     * @param string $fullname the fullname to set
     */
    public function setFullname($fullname) {
        $this->fullname = $fullname;
    }

    /**
     * Sets a part of the address by given part and value.
     * 
     * @param string $part part of the address (one of the KEY_ADDRESS_* constants)
     * @param string $value value to set
     * @throws Exception if the part isn't one of the specified KEY_ADDRESS_* constants
     */
    public function setAddressPart($part, $value) {
        if ($part != self::KEY_ADDRESS_COUNTRY
                && $part != self::KEY_ADDRESS_EXTENDED
                && $part != self::KEY_ADDRESS_LOCALITY
                && $part != self::KEY_ADDRESS_POSTAL_CODE
                && $part != self::KEY_ADDRESS_POST_OFFICE_BOX
                && $part != self::KEY_ADDRESS_REGION
                && $part != self::KEY_ADDRESS_STREET) {
            throw new Exception("You can not set undefined address parts ($part)!");
        }
        $this->address[$part] = $value;
    }

    /**
     * Setter for birthday
     * 
     * @param string $birthday the birthday to set
     */
    public function setBirthday($birthday) {
        $this->birthday = $birthday;
    }

    /**
     * Setter for categories
     * 
     * @param string|string[] $categories the categories to set
     */
    public function setCategories($categories) {
        $this->categories = $categories;
    }

    /**
     * Setter for email
     * 
     * @param string $email the email to set
     */
    public function setEmail($email) {
        $this->email = $email;
    }

    /**
     * Sets the geodata
     * 
     * @param array $geodata geodata of the forn ['lat' => 123.123, 'long' => 123.123]
     * @throws Exception if the array keys aren't the specified KEY_GEODATA_* constants
     */
    public function setGeodata(array $geodata) {
        if (!isset($geodata[self::KEY_GEODATA_LATITUDE]) || !isset($geodata[self::KEY_GEODATA_LONGITUDE])) {
            throw new Exception("There must be '" . self::KEY_GEODATA_LATITUDE . "' and '" . self::KEY_GEODATA_LONGITUDE . "' keys in the array!");
        }
        $this->geodata = $geodata;
    }

    /**
     * Setter for logo
     * 
     * @param string $logo the logo to set
     */
    public function setLogo($logo) {
        $this->logo = $logo;
    }

    /**
     * Setter for nickname
     * 
     * @param string $nickname the nickname to set
     */
    public function setNickname($nickname) {
        $this->nickname = $nickname;
    }

    /**
     * Setter for notes
     * 
     * @param string $notes the notes to set
     */
    public function setNotes($notes) {
        $this->notes = $notes;
    }

    /**
     * Setter for organisation
     * 
     * @param string $organisation the organisation to set
     */
    public function setOrganisation($organisation) {
        $this->organisation = $organisation;
    }

    /**
     * Setter for photo
     * 
     * @param string $photo the photo to set
     */
    public function setPhoto($photo) {
        $this->photo = $photo;
    }

    /**
     * Setter for role
     * 
     * @param string $role the role to set
     */
    public function setRole($role) {
        $this->role = $role;
    }

    /**
     * Setter for phone
     * 
     * @param string $phone the phone to set
     */
    public function setPhone($phone) {
        $this->phone = $phone;
    }

    /**
     * Setter for title
     * 
     * @param string $title the title to set
     */
    public function setTitle($title) {
        $this->title = $title;
    }

    /**
     * Setter for url
     * 
     * @param string $url the url to set
     */
    public function setUrl($url) {
        $this->url = $url;
    }
    
}