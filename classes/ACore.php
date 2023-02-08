<?php 
    //header("Content-Type:text/html:charset=UTF-8");
    require_once('config.php');
    abstract class ACore {

        protected $db;
    
        public function __construct() {
            $this->db = mysqli_connect(HOST,USER,PASSWORD,DB);
            if(!$this->db){
                exit("Ошибка соединения с базой данных".mysqli_connect_error());
            }
            if(!mysqli_select_db($this->db,DB)){
                exit("Нет такой базы данных".mysqli_connect_error());
            }
            mysqli_query($this->db,"SET NAMES 'UTF8'");
        }
    
        protected function get_header() {
            include "header.php";
        }
    
        protected function get_menu(){
            $row = $this->menu_array();
            echo '<div id="sidemenu">
            <!--h2>Навигация</h2-->
            <ul>';
    
            echo '<li class="current_page_item"><a href="?option=main">Главная</a><li>';
            foreach($row as $item){
                printf("<div class='toplinks'><a href='?option=menu&id_menu=%s'>%s</a></div>",$item['id_menu'],$item['name_menu']);
            }
            echo "</div></div>";
        }
    
        protected function menu_array(){
            $query = "SELECT id_menu,name_menu FROM menu";
    
            $result = mysqli_query($this->db,$query);
            if(!$result){
                exit(mysqli_connect_error());
            };
    
            $row = array();
            for($i=0;$i<mysqli_num_rows($result); $i++){
                $row[] = mysqli_fetch_array($result,MYSQLI_ASSOC);
            }
            return $row;
        }
    
    
        public function get_body() {
            $this->get_header();
            $this->get_menu();
            $this->get_content();
        }
    
        abstract function get_content();
    }
?>
