<?php

/**
 * Guestbook entries collection.
 *
 * @author Stefanie Drost <stefanie.drost@web.de>
 */
class Sdrost_Responsive_Model_Mysql4_Sliderimages_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{

    protected function _construct()
    {
        $this->_init('responsive/sliderimages');
    }

}
