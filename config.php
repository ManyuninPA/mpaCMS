<?
use Database\Mysql\Mysql as Mysql;

try {
    ini_set('error_reporting', E_ALL);
    ini_set('display_errors','On');
    ini_set('display_startup_errors', 'On');

    date_default_timezone_set("Europe/Moscow");

    $CMS_CONF = array();
    $CMS_CONF["CLASS_PATH"] = "cms/classes";
    $CMS_CONF["TEMPLATE_PATH"] = "cms/templates";
    $CMS_CONF["COMPONENT_PATH"] = "cms/components";

    include 'config-local.php';

    require_once($CMS_CONF["CLASS_PATH"] . "/autoload.php");
    Tools::defineConstants($CMS_CONF);
    $DB = Mysql::create(DB_HOST, DB_LOGIN, DB_PASS)->setDatabaseName(BD_DATABASE)->setCharset(DB_CHARSET);

    include 'cms/init.php';
    $SITE = new Site();

} catch (Exception $ex) {
    echo "При загрузке конфигураций возникла проблема!<br><br>";
    error_log($ex->getMessage());
}
?>