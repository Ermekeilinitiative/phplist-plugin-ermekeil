<?php
class ErmekeilPlugin extends phplistPlugin
{
    public $name = 'Ermekeil Plugin';
    public $version = '0.2.1';
    public $authors = 'Ermekeilinitiative e.V.';
    public $description = 'phpList plugin for site ermekeilkarree.de';
    public $documentationUrl = '';
 
    function __construct()
    {
        $this->coderoot = dirname(__FILE__) . '/' . __CLASS__ . '/';

        parent::__construct();
    }

    /**
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

    /**
     * sendMessageTabSave
     * called before a campaign is being saved. All data will be saved by phpList,
     * but you can capture it here, manipulate data or save it somewhere else if you need to.
     *
     * Here, we check whether it is better to switch the message format to text
     * only. This might be necessary, if the user intended to write a text only
     * message but forgot to switch the send format.
     *
     * @param messageid integer: id of the campaign
     * @param messagedata array: associative array with all data
     */
    public function sendMessageTabSave($messageid = 0, $data = array())
    {
	if(mb_strlen($data['textmessage']) > mb_strlen($data['message'])) {
	    // The text content seems to be longer than the regular message.
	    // In this case, it is better to switch to text format directly.
	    $data['sendformat'] = 'text';
	}

	// Return a "resultMsg"..it does not seem to be used later on.
	return '';
    }
}
?>
