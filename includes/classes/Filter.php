<?php 
require 'User.php';
/**
 * Jobs Filter Class
 * @param database $con Database Connection
 * @param int $userid Loggined User Id
 */
class Filter{
    private $user_obj;
	private $con;

	public function __construct($con, $user){
		$this->con = $con;
		$this->user_obj = new User($con, $user);
	}

    public function get_towns($city_name){
        if (strpos($city_name, ',') === FALSE){
            $sql = $this->con->prepare("SELECT * FROM uk_towns WHERE name=?");
            $sql->execute([trim($city_name)]);
            $results= $sql->fetch();
            return $results;
          }else{
            $city = explode(',', $city_name);
            $sql = $this->con->prepare("SELECT * FROM uk_towns WHERE `name`=? AND `county`=?");
            $sql->execute([trim($city[0]),trim($city[1])]);
            $results= $sql->fetch();
            return $results;
          }
    }
    public function distance($lat1, $lon1, $lat2, $lon2, $unit) {

        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);
      
        if ($unit == "K") {
            return intval($miles * 1.609344);
        } else if ($unit == "N") {
            return intval($miles * 0.8684);
        } else {
            return intval($miles);
        }
      }
}