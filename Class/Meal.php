<?php

namespace kitchen;
use PDO;

class Meal extends Connect
{
    public function get_todays_launch() : array
    {
        $launch = $this -> pdo -> prepare("SELECT launch FROM $this->meal_table WHERE date= :date");
        $launch -> bindValue('date', $this->today);
        $launch -> execute();
        return json_decode($launch -> fetchColumn());
    }

    public function get_todays_dinner() : array
    {
        $dinner = $this -> pdo -> prepare("SELECT dinner FROM $this->meal_table WHERE date= :date");
        $dinner -> bindValue('date', $this->today);
        $dinner -> execute();
        return json_decode($dinner -> fetchColumn());
    }
    // check if user is added in today's meal
    public function is_user_added_in_todays_launch() : bool
    {
        $all_launch = $this->get_todays_launch();
        return in_array((int)User::get_user_id(), $all_launch);
    }

    public function is_user_added_in_todays_dinner() : bool
    {
        $all_dinner = $this->get_todays_dinner();
        return in_array(User::get_user_id(), $all_dinner);
    }
    // add from meal
    public function add_user_to_launch() : void
    {
        $all_launch = $this->get_todays_launch();
        $all_launch[] = User::get_user_id();
        $launch = $this -> pdo -> prepare("UPDATE $this->meal_table SET launch = :launch WHERE date = :date");
        $launch->bindValue('launch', json_encode($all_launch));
        $launch->bindValue('date', $this -> today);
        $launch->execute();
    }
    public function add_user_to_dinner() : void
    {
        $all_dinner = $this->get_todays_dinner();
        $all_dinner[] = User::get_user_id();
        $dinner = $this -> pdo -> prepare("UPDATE $this->meal_table SET dinner = :dinner WHERE date = :date");
        $dinner->bindValue('dinner', json_encode($all_dinner));
        $dinner->bindValue('date', $this -> today);
        $dinner->execute();
    }
    //remove from meal
    public function remove_user_from_launch() : void
    {
        $all_launch = $this->get_todays_launch();
        unset($all_launch[array_search(User::get_user_id(), $all_launch)]);
        $launch = $this -> pdo -> prepare("UPDATE $this->meal_table SET launch = :launch WHERE date = :date");
        $launch->bindValue('launch', json_encode($all_launch));
        $launch->bindValue('date', $this -> today);
        $launch->execute();
    }
    public function remove_user_from_dinner() : void
    {
        $all_dinner = $this->get_todays_dinner();
        unset($all_dinner[array_search(User::get_user_id(), $all_dinner)]);
        $launch = $this -> pdo -> prepare("UPDATE $this->meal_table SET dinner = :dinner WHERE date = :date");
        $launch->bindValue('dinner', json_encode($all_dinner));
        $launch->bindValue('date', $this -> today);
        $launch->execute();
    }
    public function count_total_meal($id, $name) : int
    {
        $count = 0;
        $meal_name = Validate::validate_string(strtolower($name));
        $meal= $this -> pdo -> prepare("SELECT $meal_name FROM $this->meal_table");
        $meal -> execute();
        $all_meal_array = $meal -> fetchAll(PDO::FETCH_COLUMN);
        for($i = 0; $i < count($all_meal_array); $i++){
            $single_day_meal_array = json_decode($all_meal_array[$i]) ;
            $availability = array_search($id, $single_day_meal_array);
            if((string)$availability){
                $count++;
            }
        }
        return $count;

    }

    public function meal_overview() : array
    {
        $overview = [];
        $user = new User();
        $all_user_id = $user -> get_all_user_id();
        foreach ($all_user_id as $user_id) {
            $user_data =  $user -> user_data($user_id);
            $overview_single = [];
            $overview_single['id'] = $user_data['id'];
            $overview_single['username'] = $user_data['username'];
            $overview_single['launch'] = $this->count_total_meal($user_data['id'], 'launch');
            $overview_single['dinner'] = $this->count_total_meal($user_data['id'], 'dinner');
            $overview_single['total'] = $overview_single['launch'] + $overview_single['dinner'];
            $overview[] = $overview_single;
        }
        return $overview;
    }

    public function add_special_meal($data) : void
    {
        $meal_name = Validate::validate_string($data['special_meal_name']);
        $meal_day = Validate::validate_string($data['day']);
        $meal_instead_of = Validate::validate_string($data['instead_of']);
        $meal_price = (int)Validate::validate_string($data['special_meal_price']);
        // add data to pricing table
        $meal_rate_management = $this -> pdo -> prepare("INSERT INTO $this->pricing_table(name, price, day, instead_of) VALUES(:name, :price, :day, :instead_of)");
        $meal_rate_management -> bindValue('name', $meal_name );
        $meal_rate_management -> bindValue('price', $meal_price );
        $meal_rate_management -> bindValue('day', $meal_day );
        $meal_rate_management -> bindValue('instead_of', $meal_instead_of );
        $meal_rate_management -> execute();

        // add column to meal table
        $meal_count_management = $this -> pdo -> prepare("ALTER TABLE $this->meal_table ADD $meal_name TEXT");
        $meal_count_management -> execute();

    }
}