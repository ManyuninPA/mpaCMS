<?
class Page {
    public function IncludeComponent($componentName, $componentTemplate, $arParams = array()){
        $comp = explode(":", $componentName);
        require(COMPONENT_PATH.'/'.$comp[0].'/'.$comp[1].'/component.php');
        if ($componentTemplate == ''){
            $componentTemplate = 'default';
        }
        require(COMPONENT_PATH.'/'.$comp[0].'/'.$comp[1].'/template/'.$componentTemplate.'/template.php');
    }
}
