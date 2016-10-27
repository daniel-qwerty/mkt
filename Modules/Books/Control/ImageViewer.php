<?PHP

class Books_Control_ImageViewer extends Com_Wizard_Form_Control_ImageViewer {

    /**
     * @access public
     */
    public function renderControl() {
        foreach ($this->default as $obj) {
            ?>
            <li>
                <img src="<?PHP echo Com_Helper_Url::getInstance()->getResources(); ?>/Uploads/Image/<?PHP echo $obj->MedImage; ?>"/>
                <input type="hidden" name="<?PHP echo $this->name ?>Id[]" value="<?PHP echo $obj->MedId; ?>"/>
                <textarea name="<?PHP echo $this->name ?>Video[]" class="form-control" placeholder="Video de YouTube o Vimeo"><?PHP echo $obj->MedYoutube; ?></textarea>
                <input type="text" name="<?PHP echo $this->name ?>Footer[]" value="<?PHP echo $obj->MedFooter; ?>" class="form-control"/>
                <a type="text" href="<?PHP echo Com_Helper_Url::getInstance()->urlBase; ?>/Admin/BookMall/DeleteMedia/lan/<?PHP echo $obj->MedLanId; ?>/id/<?PHP echo $obj->MedBookId; ?>/media/<?PHP echo $obj->MedId; ?>" class="browser form-control">Elminar</a>
            </li>
            <?PHP
        }
    }

}
