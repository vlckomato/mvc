<?php

class notFoundException extends Exception {
    public function notFound() {
      //error message
      $errorMsg = 'This route not exist';
      return $errorMsg;
    }

    public function methodNotFound() {
        //error message
        $errorMsg = 'This method nots exist';
        return $errorMsg;
      }
  }

?>