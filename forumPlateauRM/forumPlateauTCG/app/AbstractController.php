<?php
    namespace App;

    abstract class AbstractController
    {

        public function index() {}
        
        public function redirectTo($ctrl = null, $action = null, $id = null)
        {

            if($ctrl != "home")
            {
                $url = $ctrl ? "?ctrl=".$ctrl : "";
                $url.= $action ? "&action=".$action : ""; 
                $url.= $id ? "&id=".$id : "";
                // $url.= ".html";
            }
            else $url = "/";
            
            header("Location: $url");
            die();

        }

        public function restrictTo($role)
        {
            
            if(!Session::getUser() || !Session::getUser()->hasRole($role))
            {
                $this->redirectTo("forum", "home");
            }
            return;
        }

    }