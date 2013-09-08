<?php

/**
 * Mysql4 slider images model.
 *
 * @author Stefanie Drost <stefanie.drost@web.de>
 */
class Sdrost_Responsive_Model_Mysql4_Sliderimages extends Mage_Core_Model_Mysql4_Abstract
{

    protected function _construct()
    {
        $this->_init('responsive/sliderimages', 'id');
    }

}
