<?
class Tools{
    /**
     * Выбирает фразу в нужном склонении в зависимости от числа, например «1 товар», «5 товаров», и т.д.
     *
     * @param      integer  $number     Число
     * @param      <type>   $arEndings  Массив с фразами в склонении. Должен состоять из 3х элементов в порядке:
     *                       - фраза для числа 1 (и подобных)
     *                       - фраза для числа 2 (и подобных)
     *                       - фраза для числа 5 (и подобных)
     *
     * @return     <type>   Фраза в нужном склонении.
     */
    public static function getDeclPhraseEnding($number, $arEndings)
    {
        $number = $number % 100;
        if ($number >= 11 && $number <= 19) {
            $ending = $arEndings[2];
        } else {
            $i = $number % 10;
            switch ($i) {
                case (1):
                    $ending = $arEndings[0];
                    break;
                case (2):
                case (3):
                case (4):
                    $ending = $arEndings[1];
                    break;
                default: $ending = $arEndings[2];
            }
        }
        return $ending;
    }
    /**
     * Создаст константы, хранящие настройки приложения
     *
     * @param array $constatsNameAndValues массив, содержащий в качестве ключей имена констант,
     *  которые нужно объявить, а в качестве значений -- знчения этих констант
     */
    public static function defineConstants($constatsNameAndValues){
        foreach ($constatsNameAndValues as $constName => $constValue) {
            define($constName, $constValue);
        }
    }
}