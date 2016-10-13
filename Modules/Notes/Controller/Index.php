<?php

class Notes_Controller_Index extends Public_Controller_Index
{

    public function Index()
    {
        $this->setLayout("template1");
        $this->setView("list");
        $url = get('REQUEST_URI');
        $url = explode("/", $url);
        $url = $url[count($url) - 1];
        
        $this->assign("categoryId", $url);

        $category = Categories_Model_Category::getInstance()->getMenuList($this->lan->LanId,$url); 
        
       
        $this->assign("category", $category);
        
       
        $notes = Notes_Model_Note::getInstance()->getListByParent($this->lan->LanId,$url,20);        
        if($notes == NULL){
            $notes = Notes_Model_Note::getInstance()->getList($this->lan->LanId,$url,20);
            $this->assign("notes", $notes);
        }  else {
            $this->assign("notes", $notes);
        }
        //print_r($notes);
        //$blog = Blog_Model_Blog::getInstance()->get($article->BitemBlogId, $this->lan->LanId);
        // $user = Users_Model_User::getInstance()->get($article->BitemAuthor);
        
        // $this->assign("blog", $blog);
        // $this->assign("user", $user);
    }

    public function Lista()
    {
        $this->setLayout("article");
        $this->setView("articles");
        $url = get('REQUEST_URI');
        $url = explode("/", $url);
        $url = $url[count($url) - 1];

        //print_r($url);
        //exit();

        //$blog = Articles_Model_BlogItem::getInstance()->getListArticlesRecent($this->lan->LanId, 10);
        // $this->assign("blog", $blog);

    }

    public function step1()
    {

        $this->setLayout("wizard");
        $this->setView("step1");
        $url = get('REQUEST_URI');

        $url = explode("/", $url);
        $url = $url[count($url) - 1];
        $persona = new Personas_Model_Personas();
        if (!empty($_POST['persona'])) {
            if (empty($_SESSION['PerId'])) {
                $PerId = $persona->doInsert($_POST['persona']);
                set('PerId', $PerId, 'SESSION');
            } else {
                $persona->doUpdate($_SESSION['PerId'], $_POST['persona']);
            }

            $this->redirect(Com_Helper_Url::getInstance()->generateUrl("es", "step2"));
        }

        if (!empty($_SESSION['PerId'])) {
            $persona = Personas_Model_Personas::getInstance()->get($_SESSION['PerId']);
        }

        //$blog = Articles_Model_BlogItem::getInstance()->getListArticlesRecent($this->lan->LanId, 10);
        $this->assign("persona", $persona);

    }

    public function step2()
    {
        $this->setLayout("wizard");
        $this->setView("step2");
        $url = get('REQUEST_URI');
        $url = explode("/", $url);
        $url = $url[count($url) - 1];

        if(!empty($_POST['idioma']))
        {
            Idiomas_Model_Idiomas::getInstance()->doInsert($_SESSION['PerId'],$_POST['idioma']);
        }

        if(!empty($_POST['action']) && $_POST['action'] == 2)
        {
            Idiomas_Model_Idiomas::getInstance()->doDelete($_POST['IdiId']);
        }
        $idiomas = Idiomas_Model_Idiomas::getInstance()->getListPerId($_SESSION['PerId']);
        //$blog = Articles_Model_BlogItem::getInstance()->getListArticlesRecent($this->lan->LanId, 10);
        $this->assign("idiomas", $idiomas);
    }

    public function step3()
    {
        $this->setLayout("wizard");
        $this->setView("step3");
        $url = get('REQUEST_URI');
        $url = explode("/", $url);
        $url = $url[count($url) - 1];


        //$blog = Articles_Model_BlogItem::getInstance()->getListArticlesRecent($this->lan->LanId, 10);
        // $this->assign("blog", $blog);

    }

    public function step4()
    {
        $this->setLayout("wizard");
        $this->setView("step4");
        $url = get('REQUEST_URI');
        $url = explode("/", $url);
        $url = $url[count($url) - 1];


        //$blog = Articles_Model_BlogItem::getInstance()->getListArticlesRecent($this->lan->LanId, 10);
        // $this->assign("blog", $blog);

    }

    public function step5()
    {
        $this->setLayout("wizard");
        $this->setView("step5");
        $url = get('REQUEST_URI');
        $url = explode("/", $url);
        $url = $url[count($url) - 1];


        //$blog = Articles_Model_BlogItem::getInstance()->getListArticlesRecent($this->lan->LanId, 10);
        // $this->assign("blog", $blog);

    }

    public function step6()
    {
        $this->setLayout("wizard");
        $this->setView("step6");
        $url = get('REQUEST_URI');
        $url = explode("/", $url);
        $url = $url[count($url) - 1];


        //$blog = Articles_Model_BlogItem::getInstance()->getListArticlesRecent($this->lan->LanId, 10);
        // $this->assign("blog", $blog);

    }

    public function step7()
    {
        $this->setLayout("wizard");
        $this->setView("step7");
        $url = get('REQUEST_URI');
        $url = explode("/", $url);
        $url = $url[count($url) - 1];


        //$blog = Articles_Model_BlogItem::getInstance()->getListArticlesRecent($this->lan->LanId, 10);
        // $this->assign("blog", $blog);

    }

    public function step8()
    {
        $this->setLayout("wizard");
        $this->setView("step8");
        $url = get('REQUEST_URI');
        $url = explode("/", $url);
        $url = $url[count($url) - 1];


        //$blog = Articles_Model_BlogItem::getInstance()->getListArticlesRecent($this->lan->LanId, 10);
        // $this->assign("blog", $blog);

    }

    public function step9()
    {
        $this->setLayout("wizard");
        $this->setView("step9");
        $url = get('REQUEST_URI');
        $url = explode("/", $url);
        $url = $url[count($url) - 1];


        //$blog = Articles_Model_BlogItem::getInstance()->getListArticlesRecent($this->lan->LanId, 10);
        // $this->assign("blog", $blog);

    }


}
