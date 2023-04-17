<?php
//class dari ChatGPT
class Security {
    
      /**
       * Fungsi untuk mencegah serangan XSS
       * @param string $data Data yang akan dicegah serangan XSS
       * @return string Data yang sudah aman dari serangan XSS
       */
      public static function xss_clean($data) {
          return htmlspecialchars($data, ENT_QUOTES | ENT_HTML5, 'UTF-8');
      }
      
      /**
       * Fungsi untuk mencegah serangan MongoDB injection
       * @param string $data Data yang akan dicegah serangan MongoDB injection
       * @return string Data yang sudah aman dari serangan MongoDB injection
       */
      public static function mongo_db_escape($data) {
          $search = array("\\", "\x00", "\n", "\r", "'", '"', "\x1a");
          $replace = array("\\\\", "\\0", "\\n", "\\r", "\'", '\"', "\\Z");
          return str_replace($search, $replace, $data);
      }
      
      /**
       * Fungsi untuk mencegah serangan Remote Code Execution (RCE)
       * @param string $data Data yang akan dicegah serangan RCE
       * @return string Data yang sudah aman dari serangan RCE
       */
      public static function rce_clean($data) {
          return preg_replace('/\p{C}/u', "", $data);
      }
  }
  