<?
class Site{
    protected static $template;

    function __construct()
    {
        self::$template = new Template();
    }

    public function IncludeComponent($componentName, $componentTemplate, $arParams = array())
    {
        $comp = explode(":", $componentName);
        if ($componentTemplate == '') {
            $componentTemplate = 'default';
        }
        require(COMPONENT_PATH . '/' . $comp[0] . '/' . $comp[1] . '/class.php');
        require(COMPONENT_PATH . '/' . $comp[0] . '/' . $comp[1] . '/component.php');
        require(COMPONENT_PATH . '/' . $comp[0] . '/' . $comp[1] . '/template/' . $componentTemplate . '/template.php');
    }

    public function AddCSS(){

    }

    public function AddJS(){

    }

    public function GetCurrentUrl(){

    }

    public function SetTemplate($template_name){
        self::$template->SetTemplate($template_name);
    }

    public function Template(){
        return self::$template;
    }
}

class Template {
    protected static $template_name;

    public function SetTemplate($name){
        self::$template_name = $name;
    }
    public function Header(){
        require(TEMPLATE_PATH . '/' . self::$template_name . '/header.php');
    }
    public function Footer(){
        require(TEMPLATE_PATH . '/' . self::$template_name . '/footer.php');
    }
    public function AddCSS(){

    }

    public function AddJS(){

    }
}

class Page {
    public function AddCSS(){

    }

    public function AddJS(){

    }
}