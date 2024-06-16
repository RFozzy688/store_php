<h1>Main store page</h1>

<?php

if ($this->get_db() === null)
{
  echo 'Ошибка подключения';
}
else
{
  echo 'Подключение успешно';
}

?>