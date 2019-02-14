<?php
/**Функция экранирования вносимых данных
 *@param array $data
 */
 function escape_str($data)
 {
    if(is_array($data))
    {
        if(get_magic_quotes_gpc())
           $strip_data = array_map("stripslashes", $data);
           $result = array_map("mysql_real_escape_string", $strip_data);
           return  $result;
    }
    else
    {
        if(get_magic_quotes_gpc())
           $data = stripslashes($data);
           $result = mysql_real_escape_string($data);
           return $result;
    }
 }

/**Простой генератор соли
 * @param string  $sql
 */
 function salt()
 {
 $salt = substr(md5(uniqid()), -8);
 return $salt;
 }
 ?>
