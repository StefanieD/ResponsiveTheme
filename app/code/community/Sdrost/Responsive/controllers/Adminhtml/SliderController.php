<?php

/**
 * Description of Slider
 *
 * @author Stefanie Drost <stefaniedrost@gmx.de>
 * @package
 * @version 0.1.0
 */
class Sdrost_Responsive_Adminhtml_SliderController 
    extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        /*$this->_addContent($this->getLayout()
                ->createBlock('form/adminhtml_form_edit'))
                ->_addLeft($this->getLayout()
                ->createBlock('form/adminhtml_form_edit_tabs'));*/
        $this->renderLayout();
    }

}
