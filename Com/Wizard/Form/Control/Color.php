<?php

class Com_Wizard_Form_Control_Color extends Com_Wizard_Form_Control {

    /**
     * @access public
     */
    public function renderControl() {
        ?>
        
        <input name="<?PHP echo $this->name; ?>" <?php echo $this->getParameters(); ?> 
                          <?PHP echo ($this->readOnly ? "readonly" : ""); ?>  type="text" class="form-control" id="cp1" value="">
        <?PHP
    }

}
