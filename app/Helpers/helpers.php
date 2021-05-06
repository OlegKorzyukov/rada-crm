<?php

if (!function_exists('checkboxToBoolean')) {
   function checkboxToBoolean($value)
   {
      return filter_var($value, FILTER_VALIDATE_BOOLEAN);
   }
}

if (!function_exists('latinToCyrillic')) {
   function latinToCyrillic($latinString)
   {
      $cyr = [
         'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п',
         'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я',
         'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П',
         'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я'
      ];
      $lat = [
         'a', 'b', 'v', 'g', 'd', 'e', 'io', 'zh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p',
         'r', 's', 't', 'u', 'f', 'h', 'ts', 'ch', 'sh', 'sht', 'a', 'i', 'y', 'e', 'yu', 'ya',
         'A', 'B', 'V', 'G', 'D', 'E', 'Io', 'Zh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P',
         'R', 'S', 'T', 'U', 'F', 'H', 'Ts', 'Ch', 'Sh', 'Sht', 'A', 'I', 'Y', 'e', 'Yu', 'Ya'
      ];
      return str_replace($lat, $cyr, $latinString);
   }
}

if (!function_exists('cyrillicToLatin')) {
   function cyrillicToLatin($cyrillicString)
   {
      $cyr = [
         'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п',
         'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я',
         'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П',
         'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я'
      ];
      $lat = [
         'a', 'b', 'v', 'g', 'd', 'e', 'io', 'zh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p',
         'r', 's', 't', 'u', 'f', 'h', 'ts', 'ch', 'sh', 'sht', 'a', 'i', 'y', 'e', 'yu', 'ya',
         'A', 'B', 'V', 'G', 'D', 'E', 'Io', 'Zh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P',
         'R', 'S', 'T', 'U', 'F', 'H', 'Ts', 'Ch', 'Sh', 'Sht', 'A', 'I', 'Y', 'e', 'Yu', 'Ya'
      ];
      return str_replace($cyr, $lat, $cyrillicString);
   }
}


if (!function_exists('todayDateTask')) {
   function todayDateTask()
   {
      $date = new \DateTime();
      $date->setTimezone(new \DateTimeZone('Europe/Kiev'));
      return $date->format('Y-m-d');
   }
}
if (!function_exists('futureDateTask')) {
   function futureDateTask()
   {
      $date = new \DateTime();
      $date->add(new \DateInterval('P1M'));
      $date->setTimezone(new \DateTimeZone('Europe/Kiev'));
      return $date->format('Y-m-d');
   }
}


if (!function_exists('sliceString')) {
   function sliceString(string $string, int $length): string
   {
      return mb_strimwidth($string, 0, $length, "...");
   }
}


if (!function_exists('dateConverter')) {
   function dateConverter($date, $key = 'date'): string
   {
      $date = new \DateTime($date);
      if ($key === 'date') {
         return $date->format('d.m.Y');
      } else if ($key === 'time') {
         return $date->format('H:i:s');
      }
   }
}
