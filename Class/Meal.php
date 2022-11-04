<?php

namespace kitchen;
use PDO;

class Meal extends Connect
{
    public function get_todays_meal($name) : array
    {
        $meal = $this -> pdo -> prepare("SELECT $name FROM $this->meal_table WHERE date= :date");
        $meal -> bindValue('date', $this->today);
        $meal -> execute();
        return json_decode($meal -> fetchColumn());
    }



    // check if user is added in today's meal
//    public function is_user_added_in_todays_launch() : bool
//    {
//        $all_launch = $this->get_todays_meal('launch');
//        return in_array((int)User::get_user_id(), $all_launch);
//    }
//
//    public function is_user_added_in_todays_dinner() : bool
//    {
//        $all_dinner = $this->get_todays_meal('dinner');
//        return in_array(User::get_user_id(), $all_dinner);
//    }
    // add from meal
    public function add_user_to_meal($name) : void
    {
        $all_meal = $this->get_todays_meal($name);
        $all_meal[] = User::get_user_id();
        $meal = $this -> pdo -> prepare("UPDATE $this->meal_table SET $name = :meal WHERE date = :date");
        $meal->bindValue('meal', json_encode($all_meal));
        $meal->bindValue('date', $this -> today);
        $meal->execute();
    }
    //remove from meal
    public function remove_user_from_meal($name) : void
    {
        $all_meal = $this->get_todays_meal($name);
        unset($all_meal[array_search(User::get_user_id(), $all_meal)]);
        $meal = $this -> pdo -> prepare("UPDATE $this->meal_table SET $name = :meal WHERE date = :date");
        $meal->bindValue('meal', json_encode($all_meal));
        $meal->bindValue('date', $this -> today);
        $meal->execute();
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

    public function edit_meal($data) : void
    {
        $meal_name = Validate::validate_string($data['special_meal_name']);
        $meal_day = Validate::validate_string($data['day']);
        $meal_instead_of = Validate::validate_string($data['instead_of']);
        $meal_price = (int)Validate::validate_string($data['special_meal_price']);
        $id = (int)Validate::validate_string($data['id']);
        // add data to pricing table
        $meal_rate_management = $this -> pdo -> prepare("UPDATE $this->pricing_table SET name = :name, price = :price, day = :day, instead_of = :instead_of WHERE id = :id");
        $meal_rate_management -> bindValue('name', $meal_name );
        $meal_rate_management -> bindValue('price', $meal_price );
        $meal_rate_management -> bindValue('day', $meal_day );
        $meal_rate_management -> bindValue('instead_of', $meal_instead_of );
        $meal_rate_management -> bindValue('id', $id );
        $meal_rate_management -> execute();

        // rename column of meal table
        $old_column_name = Validate::validate_string($data['special_meal_old_name']);
        $meal_count_management = $this -> pdo -> prepare("ALTER TABLE $this->meal_table RENAME COLUMN $old_column_name TO $meal_name");
        $meal_count_management -> execute();
    }

    public function get_special_meals_days($name) : array
    {
        $special_meals = $this -> pdo -> prepare("SELECT day from $this->pricing_table WHERE instead_of = :instead_of");
        $special_meals -> bindValue('instead_of', Validate::validate_string($name));
        $special_meals -> execute();
        return $special_meals -> fetchAll(PDO::FETCH_COLUMN);
    }
    public function is_any_special_meal_in($name, $day_name) : bool
    {
        if (in_array($day_name, $this->get_special_meals_days($name), true)) {
            return true;
        }
        return false;
    }
    public function get_all_meal_arr() : array
    {
        $meals = $this -> pdo -> prepare("SELECT name FROM $this->pricing_table");
        $meals -> execute();
        return $meals -> fetchAll(PDO::FETCH_COLUMN);
    }

    public function get_meal_schema($meal_name):array
    {
        $schema_data = $this -> pdo -> prepare("SELECT * FROM $this->pricing_table WHERE name = :name");
        $schema_data -> bindValue('name', Validate::validate_string($meal_name));
        $schema_data -> execute();
        return $schema_data -> fetchAll(PDO::FETCH_ASSOC);
    }
}