<?require_once ($_SERVER['DOCUMENT_ROOT'].'/config.php');

    $SITE->SetTemplate('New');
    $SITE->Template()->Header();
    $SITE->IncludeComponent('system:list', '', array());
    $SITE->Template()->Footer();