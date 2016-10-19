<?php

class Public_Widget_Newsletter extends Com_Object {

    public $lan;

    /**
     *
     * @static
     * @access public
     * @return Public_Widget_Newsletter
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public function setLan($lan) {
        $this->lan = $lan;
        return $this;
    }

    public function render() {
        ?>
        <div class="sidebar-module module-newsletter bg-darker text-left">
            <h5><?= Texts_Helper_Text::getInstance()->get($this->lan, "titleNewsletter")->TxtDescription ?></h5>

            <p><?= Texts_Helper_Text::getInstance()->get($this->lan, "txtNewsletter")->TxtDescription ?></p>
            <!-- Rd Mailform result field-->
            <div class="rd-mailform-validate"></div>
            <form data-result-class="rd-mailform-validate" data-form-type="subscribe" method="post"
                  action="bat/rd-mailform.php" class="rd-mailform subscribe text-left offset-top-30">
                <input type="text" name="email" data-constraints="@NotEmpty @Email"
                       placeholder="<?= Texts_Helper_Text::getInstance()->get($this->lan, "placeHolderNewsletter")->TxtDescription ?>">
                <button class="btn btn-transparent btn-sm"><?= Texts_Helper_Text::getInstance()->get($this->lan, "btnNewsletter")->TxtDescription ?></button>
            </form>
        </div>
        <?PHP
    }

}
