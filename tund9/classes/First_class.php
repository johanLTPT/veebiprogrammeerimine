<?php
    class First {
        //muutujad, klassis omadused (properties)
        private $mybusiness;
        public $everybodysbusiness;
        function __construct($limit){
            $this->mybusiness = mt_rand(0,$limit);
            $this->everybodysbusiness = mt_rand(0,100);
            echo "arvude korrutis on " . $this->mybusiness * $this->everybodysbusiness;
            $this->tellSecret();
        }
        function __destruct()
        {
            echo "nägite hulka mõtetut infot";
        }
        //funktsioonid, klassis meetodid(methods)
        public function tellMe(){
            echo "Salajane arv on:" .$this->mybusiness;
        }
        private function tellSecret(){
            echo "saladusi võib ka välja õelda";
        }
    }
    