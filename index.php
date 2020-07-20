<?require_once ($_SERVER['DOCUMENT_ROOT'].'/config.php');
    dump($SITE->Pages(), 0);

    $SITE->Template()->Header();
    $SITE->IncludeComponent('system:list', '', array());
    $SITE->Template()->Footer();