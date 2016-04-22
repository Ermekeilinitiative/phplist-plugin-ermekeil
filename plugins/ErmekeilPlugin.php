<?php
class ErmekeilPlugin extends phplistPlugin
{
    public $name = 'Ermekeil Plugin';
    public $version = '0.1.1';
    public $authors = 'Ermekeilinitiative e.V.';
    public $description = 'phpList plugin for site ermekeilkarree.de';
    public $documentationUrl = '';
 
    function __construct()
    {
        $this->coderoot = dirname(__FILE__) . '/' . __CLASS__ . '/';

        parent::__construct();
    }

    /* 
    * parseOutgoingTextMessage
    * @param integer messageid: ID of the message
    * @param string  content: entire text content of a message going out
    * @param string  destination: destination email
    * @param array   userdata: associative array with data about user
    * @return string parsed content
    */
    public function parseOutgoingTextMessage($messageid, $content, $destination, $userdata = null)
    {
        // Remove default "powered by" signature
        $signaturePosition = strrpos($content, "\n\n-- powered");

        if($signaturePosition !== false) {
            return substr($content, 0, $signaturePosition);
        } else {
            return $content;
        }
    }
}
?>
