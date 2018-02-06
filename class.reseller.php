<?php 
   class reseller
   {
      public $api_url = 'http://domain.com/api.php?';
      public $api_key = 'YOURKEY';
      public function order($link,$type,$quantity)
      { // Add order
        return json_decode($this->connect(array(
          'key' => $this->api_key,
          'action' => 'add',
          'type' => $type,
          'amount' => $quantity,
          'link' => $link
        )));
      }
      public function status($order_id)
      { // Get status
        return json_decode($this->connect(array(
          'key' => $this->api_key,
          'action' => 'status',
          'order' => $order_id
        )));
      }
      private function connect($post)
      {
        
        $_post = Array();
        if (is_array($post)) {
          foreach ($post as $name => $value) {
            $_post[] = $name.'='.$value;
          }
        }
        
        if (is_array($post))
        {
          $url_complete = join('&', $_post);
        }
        
        $url = $this->api_url.$url_complete;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'API SmmHelps (compatible; MSIE 5.01; Windows NT 5.0)');
        $result = curl_exec($ch);
        if (curl_errno($ch) != 0 && empty($result))
        {
          $result = false;
        }
        curl_close($ch);
        return $result;
      }
   }

?>