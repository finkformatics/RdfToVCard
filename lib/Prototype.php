<?php
namespace Prototype;

/**
 * Class Prototype
 * The main application logic
 *
 * @package Prototype The root package/namespace for this project.
 * @author Lukas Werner <kontakt@lwerner.de>
 */
class Prototype {

    /**
     * To not overload this class
     */
    use MappersTrait;
    
    /**
     * Singleton instance
     * @var Prototype
     */
    private static $instance;
    
    /**
     * Erfurt app instance
     * @var \Erfurt_App
     */
    private $erfurt;
    /**
     * Sabre CardDAV BackendInterface (replaceable)
     * @var \Sabre\CardDAV\Backend\BackendInterface
     */
    private $cardDav;
    /**
     * The available vocabularies (see /vocabularies for examples)
     * @var mixed
     */
    private $vocabularies;

    /**
     * Prototype constructor.
     * Sets Erfurt instance, authenticates the app, creates CardDAV PDO Backend interface and loads vocabularies
     */
    private function __construct() {
        $this->erfurt = \Erfurt_App::getInstance();
        $this->authenticate();
        $pdo = new \PDO('mysql:host=localhost;dbname=carddav', 'carddav', 'carddav');
        $this->cardDav = new \Sabre\CardDAV\Backend\PDO($pdo);
        $this->loadVocabularies();
    }

    /**
     * Loads vocabularies
     */
    private function loadVocabularies() {
        $this->vocabularies = [];
        $handle = NULL;
        if (!$handle = opendir(VOC_DIR)) {
            die("Error on opening vocabularies directory!");
        }
        while (false !== ($entry = readdir($handle))) {
            if ((($temp = strlen($entry) - strlen('.json')) >= 0 && strpos($entry, '.json', $temp) !== FALSE)) {
                $voc = json_decode(file_get_contents(VOC_DIR . $entry));
                $this->vocabularies[$voc->name] = $voc;
            }
        }
        closedir($handle);
    }

    /**
     * Authenticates the app at the Erfurt store
     *
     * @throws \Erfurt_Exception if something goes wrong
     * @throws \Erfurt_Store_Exception if something goes wrong
     */
    private function authenticate() {
        $db_user = $this->erfurt->getStore()->getDbUser();
        $db_pass = $this->erfurt->getStore()->getDbPassword();
        $this->erfurt->authenticate($db_user, $db_pass);
    }
    
    /**
     * Getter for the Erfurt store
     *
     * @return \Erfurt_Store the Erfurt store to get
     */
    public function getStore() {
        return $this->erfurt->getStore();
    }
    
    /**
     * Create ContactInformation object from URI by given vocabulary
     *
     * @param string $uri the person's URI
     * @return \Prototype\ContactInformation the created ContactInformation object
     */
    public function createContact($uri, $vocabulary) {
        $contact = new ContactInformation();

        $mappers = $this->getMappers($this->getStore(), $uri, $vocabulary);
        foreach ($mappers as $mapper) {
            $mapper->map($contact);
        }
        
        return $contact;
    }
    
    /**
     * Converts ContactInformation object to VCard
     *
     * @param \Prototype\ContactInformation $contact contact information object
     * @return \Sabre\VObject\Component\VCard created vcard
     */
    public function contactToVCard(ContactInformation $contact) {
        $converter = new ContactToVCard();
        return $converter->convert($contact);
    }

    /**
     * Main processing method.
     * Fetches all foaf persons from RDF store, creates ContactInformation objects out of them and converts them to
     * vcards. The vcards will be stored in the CardDAV backend and printed.
     *
     * @throws \Erfurt_Store_Exception if something goes wrong
     */
    public function convert() {
        $query = 'PREFIX ' . $this->vocabularies['foaf']->name . ': <' . $this->vocabularies['foaf']->prefix . '> '
               . 'SELECT ?person '
               . 'WHERE { '
                   . '?person a ' . $this->vocabularies['foaf']->name . ':' . $this->vocabularies['foaf']->entityName . ' . '
               . '}';
        $result = $this->getStore()->sparqlQuery($query);
        foreach ($result as $person) {
            $name_arr = explode('/', $person['person']);
            $name = $name_arr[count($name_arr) - 1] . '.vcf';
            $vcard = $this->contactToVCard($this->createContact($person['person'], $this->vocabularies['foaf']))->serialize();
            $this->cardDav->createCard(1, $name, $vcard);
            echo $vcard . "\n";
        }
    }
    
    /**
     * Singleton method to get instance
     *
     * @return \Prototype\Prototype the instance
     */
    public static function getInstance() {
        if (self::$instance === NULL) {
            self::$instance = new Prototype();
        }
        return self::$instance;
    }
    
}