<?php

namespace App\Models;

class CustomerRepository {
    public function create($array) {
        // в идеале локация должна жить в отдельной таблице, а в Customer только location_id.

        $item = new Customer();
        $item->fill($array);
        $item->save();

        return $item;
    }

    public function validateData($prepared) {
        // валидация емайла
        if (!filter_var($prepared["email"], FILTER_VALIDATE_EMAIL)) {
            $prepared["error"] = "Некорректный email";
        }

        // проверка возраста
        $prepared["age"] = (int) $prepared["age"];
        if (!(($prepared["age"] >= 18) && ($prepared["age"] <= 99))) {
            $prepared["error"] = "Некорректный возраст";
        }

        // проверка локации
        if (!$prepared["location"]) {
            $prepared["location"] = "Unknown";
        }

        return $prepared;
    }

    public function truncate() {
        Customer::truncate();
    }
}
