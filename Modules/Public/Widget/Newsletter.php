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
        <div class="sidebar-module module-newsletter bg-darker text-left text-white">
            <h5><?= Texts_Helper_Text::getInstance()->get($this->lan, "titleNewsletter")->TxtDescription ?></h5>

            <p><?= Texts_Helper_Text::getInstance()->get($this->lan, "txtNewsletter")->TxtDescription ?></p>

            <form  action="https://lb.benchmarkemail.com//code/lbform" method=post name="frmLB764725" accept-charset="UTF-8" onsubmit="return _checkSubmit764725(this);" >
                <input type=hidden name=successurl value="http://www.benchmarkemail.com/Code/ThankYouOptin?language=spanish" />
                <input type=hidden name=errorurl value="http://lb.benchmarkemail.com//Code/Error" />
                <input type=hidden name=token value="mFcQnoBFKMSSZV1BmPtxRuZXUawFafLCbQK3uXf2KumZ5kqONGyEzw%3D%3D" />
                <input type=hidden name=doubleoptin value="" /><fieldset><div class="formbox-title-764725"></div></fieldset>
                <input type=text placeholder="Nombre *" class="formbox-field-764725 hidden" name="fldfirstname" maxlength=100 value="-"  />
                <input type=text placeholder="Email *" class="formbox-field-764725 form-control" name="fldEmail" maxlength=100 />
                <button type="submit" id="btnSubmit" krydebug="1751" class="btn btn-transparent btn-sm"><?= Texts_Helper_Text::getInstance()->get($this->lan, "btnNewsletter")->TxtDescription ?></button>
            </form>
        </div>

        <?PHP
    }

}
