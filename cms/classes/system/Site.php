<?
class Site{
    protected $template;
    protected $pages = [];

    function __construct(){
        $this->template = new Template();
        $this->SetTemplate('Default');
        $page_file = glob_tree_files('.');
        foreach ($page_file as $file){
            $page = new Page();
            $page->SetPath($file);
            $this->pages[] = $page;
        }
    }

    public function IncludeComponent($componentName, $componentTemplate, $arParams = array()){
        $comp = explode(":", $componentName);
        if ($componentTemplate == '') {
            $componentTemplate = 'default';
        }
        require(COMPONENT_PATH . '/' . $comp[0] . '/' . $comp[1] . '/class.php');
        require(COMPONENT_PATH . '/' . $comp[0] . '/' . $comp[1] . '/component.php');
        require(COMPONENT_PATH . '/' . $comp[0] . '/' . $comp[1] . '/template/' . $componentTemplate . '/template.php');
    }

    public function SetTemplate($template_name){
        $this->template->SetTemplate($template_name);
    }

    public function Template(){
        return $this->template;
    }

    public function Pages(){
        return $this->pages;
    }

    public function SetTitle(){
        #Устанавливает заголовок страницы.
    }

    public function ShowTitle(){
        #Отображает заголовок страницы
    }

    public function GetTitle(){
        #Возвращает заголовок страницы
    }

    public function ShowCSS(){
        #Отображает HTML для подключения CSS на странице
    }

    public function GetCSS(){
        #Возвращает HTML для подключения CSS на странице
    }

    public function SetTemplateCSS(){
        #Устанавливает путь к файлу с CSS стилями компонента
    }

    public function SetAdditionalCSS(){
        #Устанавливает путь к файлу с CSS стилями
    }

    public function ShowProperty(){
        #Отображает свойство страницы, учитывая свойства раздела
    }

    public function GetProperty(){
        #Возвращает свойство страницы, учитывая свойства раздела
    }

    public function GetPageProperty(){
        #Возвращает свойство страницы
    }

    public function GetCurUri(){
        #Возвращает адрес текущей страницы с параметрами
    }

    public function GetCurPage(){
        #Возвращает адрес текущей страницы без параметров
    }

    public function set_cookie(){
        #Устанавливает значение cookie
    }

    public function get_cookie(){
        #Возвращает значение cookie
    }

}

class Template {
    protected $template_name;
    protected $arCSS = [];
    protected $arJS = [];

    public function SetTemplate($name){
        $this->template_name = $name;
    }
    public function Header(){
        require(TEMPLATE_PATH . '/' . $this->template_name . '/header.php');
    }
    public function Footer(){
        require(TEMPLATE_PATH . '/' . $this->template_name . '/footer.php');
    }
    public function AddCSS(){

    }

    public function AddJS(){

    }
}

class Page {
    protected $path = '';
    protected $arCSS = [];
    protected $arJS = [];

    public function SetPath($path){
        $this->path = $path;
    }

    public function GetPath(){
        return $this->path;
    }

    public function AddCSS(){

    }

    public function AddJS(){

    }
}