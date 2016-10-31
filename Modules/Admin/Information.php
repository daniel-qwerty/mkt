<?PHP

class Admin_Information extends Com_Module_Information {

    public function init() {

        $obj = get('userType');
        if ($obj == 1) {
            
        }
        // Com_Helper_Menu::getInstance()->add("Dashboard", "/Admin/Admin", "Dashboard", "th-large",null);
        // Com_Helper_Menu::getInstance()->add("Statistics", "/Admin/Statistics", "Estad&iacute;sticas", "stats",null);

        /**
         * Menu Contenido
         */
        Com_Helper_Menu::getInstance()->add("Content", null, "Pagina", "globe");
        Com_Helper_Menu::getInstance()->add("Menu", "/Admin/Menu", "Menu", "menu", "Content");
        Com_Helper_Menu::getInstance()->add("Texts", "/Admin/Texts", "Textos", "texts", "Content");
        Com_Helper_Menu::getInstance()->add("Pages", "/Admin/Pages", "P&aacute;ginas", "pages", "Content");
        Com_Helper_Menu::getInstance()->add("Links", "/Admin/Links", "Links", "Links", "Content");
        Com_Helper_Menu::getInstance()->add("Imagenes", "/Admin/Images", "Imagenes", "Imagenes", "Content");
        Com_Helper_Menu::getInstance()->add("SlidesShows", "/Admin/SlideShows", "SlideShow", "slideShow", "Content");

        /**
         * Menu Notas
         */
        Com_Helper_Menu::getInstance()->add("Notes", null, "Notas", "pencil");
        Com_Helper_Menu::getInstance()->add("Categorias", "/Admin/Categories", "Categorias", "Categorias", "Notes");
        Com_Helper_Menu::getInstance()->add("Item", "/Admin/Notes", "Items", "Item", "Notes");
        
        /**
         * Menu Tools
         */
        Com_Helper_Menu::getInstance()->add("Tools", null, "Tools", "briefcase");
        Com_Helper_Menu::getInstance()->add("Tools Categorias", "/Admin/CatTools", "Categorias", "Tools", "Tools");
        Com_Helper_Menu::getInstance()->add("Item", "/Admin/Tools", "Items", "Tools", "Tools");
        Com_Helper_Menu::getInstance()->add("Slide", "/Admin/SlideShowsTools", "SlideShow", "Tools", "Tools");
        
        /**
         * Menu Book Mall
         */
        Com_Helper_Menu::getInstance()->add("Book", null, "Book Mall", "book");        
        Com_Helper_Menu::getInstance()->add("Item", "/Admin/Books", "Items", "Item", "Book");
        Com_Helper_Menu::getInstance()->add("Slide", "/Admin/SlideShowBookMall", "SlideShow", "SlideShow", "Book");
        
        /**
         * Menu Eventos
         */
        Com_Helper_Menu::getInstance()->add("Events", null, "Eventos", "calendar");
        Com_Helper_Menu::getInstance()->add("Categorias", "/Admin/CatEvents", "Categorias", "Categorias", "Events");
        Com_Helper_Menu::getInstance()->add("Item", "/Admin/Events", "Items", "Item", "Events");
        Com_Helper_Menu::getInstance()->add("Slide", "/Admin/SlideShowsEvents", "SlideShow", "SlideShow", "Events");
        
        /**
         * Menu Publicidad
         */
        Com_Helper_Menu::getInstance()->add("Pub", null, "Publicidad", "bullhorn");        
        Com_Helper_Menu::getInstance()->add("Categorias", "/Admin/CatAdvertising", "Categorias", "Categorias", "Pub");
        Com_Helper_Menu::getInstance()->add("Item", "/Admin/Advertising", "Items", "Item", "Pub");     

        /**
         * Menu Administracion
         */
        Com_Helper_Menu::getInstance()->add("Administration", null, "Administraci&oacute;n", "cog");
        Com_Helper_Menu::getInstance()->add("Contact", "/Admin/Contact", "Contacto", "contact", "Administration");
        Com_Helper_Menu::getInstance()->add("Users", "/Admin/Users", "Usuarios", "users", "Administration");
        Com_Helper_Menu::getInstance()->add("Languages", "/Admin/Language", "Idiomas", "languages", "Administration");
        Com_Helper_Menu::getInstance()->add("Configurations", "/Admin/Configurations", "Configuraciones", "configurations", "Administration");
    }

}
