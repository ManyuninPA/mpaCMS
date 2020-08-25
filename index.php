<?require_once ($_SERVER['DOCUMENT_ROOT'].'/config.php');
    global $SITE;
    $pages = $SITE->Pages();

    $SITE->Template()->Header();
    #$id = CIBlockType::Add(array('TITLE' =>'Новости', 'CODE' => 'news', 'ACTIVE' => 'Y'));
    #$res = CIBlockType::GetList(array('ID' => 'asc'));
    #dump($res, 0);
    $IBLOCK_TYPE = CIBlockType::GetByID('1');
    dump($IBLOCK_TYPE, 0);
    #$res = CIBlockType::Delete(3);
    #$res[0]['TITLE'] = 'Контент';
    #$res = CIBlockType::Update($res[0]['ID'], $res[0]);
    #$id = CIBlock::Add(array('IBLOCK_TYPE_ID' => $IBLOCK_TYPE['ID'], 'NAME' => 'Новости', 'CODE' => 'news', 'ACTIVE' => 'Y'));
    #dump($id, 1);
    $IBLOCK = CIBlock::GetByID('1');
    dump($IBLOCK, 0);
    $SITE->IncludeComponent('system:list', '', array());
    $SITE->Template()->Footer();