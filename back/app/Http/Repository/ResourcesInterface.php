<?php

namespace App\Http\Repository;

interface ResourcesInterface {

    // Default Resources method

    public function all();

    public function single($id);

    public function add(array $data);

    public function change(array $data,$id);

    public function delete($id);

    //Add Eloquent
    public function where(string $key,$value,string $option);

    //Generate ID
    public function createID(string $key,$len);

}