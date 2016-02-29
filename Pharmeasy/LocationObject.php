<?php
   class LocationObject {
      /* Member variables */
      var $latitude;
      var $longitude;
	  var $city;
      
      /* Member functions */
      function setLatitude($par){
         $this->latitude = $par;
      }
      
      function getLatitude(){
         echo $this->latitude ."<br/>";
      }
      
      function setLongitude($par){
         $this->longitude = $par;
      }
      
      function getLongitude(){
         echo $this->longitude ." <br/>";
      }
	  function setCity($par){
         $this->city = $par;
      }
      
      function getCity(){
         echo $this->city ." <br/>";
      }
   }
?>