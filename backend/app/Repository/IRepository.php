<?php

namespace App\Repository;

interface IRepository {

    public function find(int $id);

    public function all();

    public function save(array $data) : bool;

    public function delete(int $id) : bool;
}
