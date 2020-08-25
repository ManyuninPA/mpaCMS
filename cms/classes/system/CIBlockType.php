<?php

class CIBlockType{
    public static function GetList($arSort = false, $arFilter = false, $limit = false){
        global $DB;
        $arrFilter = false;
        $arrSort = false;
        if($arFilter && count($arFilter) > 0){
            $i = 0;
            foreach($arFilter as $key => $val){
                if(!empty($key)){
                    if(
                        $key == "ID" ||
                        $key == "DATE_INSERT" ||
                        $key == "DATE_UPDATE" ||
                        $key == "TITLE" ||
                        $key == "CODE" ||
                        $key == "ACTIVE"
                    ){
                        if($i > 0)
                            $arrFilter .= " AND ";
                        $arrFilter .= "ts.".$key." = '".$val."' ";
                        ++$i;
                    }
                }
            }
            if(!empty($arrFilter)){
                $arrFilter = "WHERE ".$arrFilter;
            }
        }
        if($arSort && count($arSort) > 0) {
            $i = 0;
            foreach($arSort as $key => $val){
                if(!empty($key)){
                    if(
                        (
                            $key == "ID" ||
                            $key == "DATE_INSERT" ||
                            $key == "DATE_UPDATE" ||
                            $key == "TITLE" ||
                            $key == "CODE" ||
                            $key == "ACTIVE"
                        )
                        &&
                        (
                            strtoupper($val) == "DESC" ||
                            strtoupper($val) == "ASC"
                        )
                    )
                    {
                        if($i > 0)
                            $arrSort .= " , ";
                        $arrSort .= "ts.".$key." ".$val." ";
                        ++$i;
                    }
                }
            }
            if(!empty($arrSort)){
                $arrSort = "ORDER BY ".$arrSort;
            }
        }

        global $DB;
        $strSql = "
			SELECT
				*
			FROM
				`t_s_iblockType` AS ts
			".(($arrFilter) ? $arrFilter : "")."
			".(($arrSort) ? $arrSort : "ORDER BY ts.ID ASC")."
			".(($limit) ? " LIMIT ".$limit : "")."
		";
        $res = $DB->query($strSql)->fetch_assoc_array();
        return $res;
    }

    public static function GetByID($id){
        return self::GetList(false, array('ID' => $id))[0];
    }

    public static function Add($arrList){
        global $DB;
        $time_now =  date ('Y-m-d H:i:s');
        $arrList['DATE_INSERT'] = $time_now;
        $arrList['DATE_UPDATE'] = $time_now;
        $DB->query('INSERT INTO `t_s_iblockType` SET ?As', $arrList);
        $id = $DB->getLastInsertId();
        if ($id > 0){
            return $id;
        }else{
            return null;
        }
    }
    public static function Update($id, $arrList){
        global $DB;
        unset($arrList['DATE_INSERT']);
        unset($arrList['ID']);
        $time_now =  date ('Y-m-d H:i:s');
        $arrList['DATE_UPDATE'] = $time_now;
        $DB->query("UPDATE `t_s_iblockType` SET ?As WHERE ID = '".intval($id)."'", $arrList);
        return $id;
    }
    public static function Delete($id){
        global $DB;
        $strSql = "DELETE FROM `t_s_iblockType` WHERE ID = '".intval($id)."' limit 1";
        $DB->query($strSql);
        return true;
    }

}