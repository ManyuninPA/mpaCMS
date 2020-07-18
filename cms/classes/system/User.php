<?php
/**
 *  Класс User v. 0.1.0.0
 *      Класс авторизации и регистрации пользователя.

 *  Примечание:
 *      Класс статичный, потому любой метод надо вызывать через двойное двоеточие.

 *  Метод check ()
 *      Проверяет, авторизировался ли пользователь, этот метод следует вызвать до вызова любого другого метода класса

 *  Метод isLogged ()
 *      Возвращает значение, залогинен ли пользователь в этом сеансе
 *      @ Return boolean

 *  Метод register (String $nick, String $pass)
 *      Регистрирует пользователя с ником $nick (если не занят) и паролем $pass
 *      @ Return TRUE или "NickBusy"
 *      ВНИМАНИЕ: Данный метод нуждается в доработке, если вы хотите его использовать у себя на сайте
 *          подробнее - в комментариях метода

 *  Метод login (String $nick, String $pass)
 *      Авторизует пользователя с ником $nick (если существует) и паролем $pass (если правильный)
 *      @ Return TRUE или "WrongPass" или "WrongNick"
 *      ВНИМАНИЕ: Данный метод нуждается в доработке, если вы хотите его использовать у себя на сайте
 *          подробнее - в комментариях метода

 *  Метод logout ()
 *      Делает пользователя неавторизированным на сайте и запоминает это состояние
 *      ВНИМАНИЕ: Данный метод нуждается в доработке, если вы хотите его использовать у себя на сайте
 *          подробнее - в комментариях метода

 *  Метод getInstance ()
 *      Возвращает объект пользователя. В этом объекте могут быть данные о имени, дате регистрации,
 *      количестве сообщений и так далее. Вы можете отредактировать класс так, чтобы возвращался
 *      ассоциативный массив вместо объекта. Смотрите код и комментарии методов register, login и logout
 *      @ Return Object

 */

class User {
    const USER_GUEST = 0;
    const USER_ADMIN = 1;
    const USER_EDITOR = 2;

    protected static $instance = null;
    protected static $logined = false;
    protected static $admin = false;
 
    public static function сheck() {
        Session::start();
        if ($data = Session::get('User')) {
            $data = unserialize($data);
            self::$instance = $data['instance'];
            self::$logined  = $data['logined'];
            self::$admin = $data['admin'];
        } else {
            Session::Restart();
            self::logout();
        }
    }
 
    public static function isLogged() {
        return self::$logined;
    }

    public static function isAdmin(){
        return self::$admin;
    }

    private static function create($arrUser){
        global $db;
        $db->query('INSERT INTO `USERS` SET ?As', $arrUser);
        $id = $db->getLastInsertId();
        if ($id > 0){
            return $id;
        }else{
            return null;
        }
    }

    public static function getByLogin($login){
        global $db;
        $user = $db->query('SELECT * FROM `USERS` WHERE `LOGIN` = "?s"', $login)->fetch_assoc();
        return $user;
    }

    public static function getByID($id){
        global $db;
        $user = $db->query('SELECT * FROM `USERS` WHERE `ID` = "?i"', $id)->fetch_assoc();
        return $user;
    }

    private static function isRegistedUser($login){
        $user = self::getbyLogin($login);
        if ($user != null && $user['LOGIN'] == $login){
            return true;
        }else{
            return false;
        }
    }

    public static function register($arrUser) {
        if (self::isRegistedUser($arrUser['LOGIN'])) {
            return false;
        } else {
            self::$instance = self::create($arrUser);
            if ($arrUser['ROLE'] == self::USER_ADMIN){
                self::$admin = true;
            }
            self::$logined  = true;
            self::addToSession();
            return true;
        }
    }
 
    public static function login($login, $pass) {
        $user = self::getByLogin($login);
        if ($user) {
            if ($user['PASSWORD'] === md5($pass)) {
                self::$instance = $user['ID'];
                self::$logined  = true;
                if ($user['ROLE'] == self::USER_ADMIN){
                    self::$admin = true;
                }
                self::addToSession();
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
 
    public static function logout() {
        self::$instance = null;
        self::$logined  = false;
        self::$admin = false;
        self::addToSession();
    }
 
    public static function getInstance() {
        return self::$instance;
    }
 
    private static function addToSession() {
        Session::set("User", serialize(array(
            "instance" => self::$instance,
            "logined" => self::$logined,
            "admin" => self::$admin
        )));
    }
}
