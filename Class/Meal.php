<?php

namespace kitchen;

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
    public function is_user_added_in_launch() : bool
    {
        $all_launch = $this->get_todays_launch();
        return in_array((int)User::get_user_id(), $all_launch);
    }

    public function is_user_added_in_dinner() : bool
    {
        $all_dinner = $this->get_todays_dinner();
        return in_array(User::get_user_id(), $all_dinner);
    }
    // add from meal
    public function add_user_to_launch() : void
    {
        $all_launch = $this->get_todays_launch();
        $all_launch[] = User::get_user_id();
        $launch = $this -> pdo -> prepare("UPDATE $this->meal_table SET launch = :launch");
        $launch->bindValue('launch', json_encode($all_launch));
        $launch->execute();
    }
    public function add_user_to_dinner() : void
    {
        $all_dinner = $this->get_todays_dinner();
        $all_dinner[] = User::get_user_id();
        $dinner = $this -> pdo -> prepare("UPDATE $this->meal_table SET dinner = :dinner");
        $dinner->bindValue('dinner', json_encode($all_dinner));
        $dinner->execute();
    }
    //remove from meal
    public function remove_user_from_launch() : void
    {
        $all_launch = $this->get_todays_launch();
        unset($all_launch[array_search(User::get_user_id(), $all_launch)]);
        $launch = $this -> pdo -> prepare("UPDATE $this->meal_table SET launch = :launch");
        $launch->bindValue('launch', json_encode($all_launch));
        $launch->execute();
    }
    public function remove_user_from_dinner() : void
    {
        $all_dinner = $this->get_todays_dinner();
        unset($all_dinner[array_search(User::get_user_id(), $all_dinner)]);
        $launch = $this -> pdo -> prepare("UPDATE $this->meal_table SET dinner = :dinner");
        $launch->bindValue('dinner', json_encode($all_dinner));
        $launch->execute();
    }
}