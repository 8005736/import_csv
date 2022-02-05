<?php

namespace App\Console\Commands;

use App\Models\Customer;
use Illuminate\Console\Command;
use League\Csv\Reader;

class ImportCsv extends Command {
    public $delimiter = ",";
    public $failed = [];

    protected $signature = "import:csv";
    protected $description = "Импорт данных из файла в базу с валидацией";

    public function __construct() {
        parent::__construct();
    }

    public function handle() {
        Customer::truncate();

        $file = storage_path("app/public/random.csv");

        $csv = Reader::createFromPath($file, "r");
        $csv->setDelimiter($this->delimiter);
        $csv->setHeaderOffset(0);

        $header = $csv->getHeader();
        $header = explode($this->delimiter, $header[0]);

        $records = $csv->getRecords();

        foreach ($records as $key => $record) {
            $this->parseRecord($record);
        }

        if (count($this->failed)) {
            $header[] = "error";
            $this->table($header, $this->failed);
        }

        return 0;
    }

    public function parseRecord($record) {
        foreach ($record as $key => $value) {
            $header = explode($this->delimiter, $key);
            $body = explode($this->delimiter, $value);

            $prepared = array_combine($header, $body);

            $validated = $this->validateData($prepared);

            if ($validated) {
                $this->createCustomer($validated);
            }
        }
    }

    public function validateData($prepared) {
        // валидация емайла
        if (!filter_var($prepared["email"], FILTER_VALIDATE_EMAIL)) {
            $prepared["error"] = "Некорректный email";
            $this->failed[] = $prepared;

            return false;
        }

        // проверка возраста
        $prepared["age"] = (int) $prepared["age"];
        if (!(($prepared["age"] >= 18) && ($prepared["age"] <= 99))) {
            $prepared["error"] = "Некорректный возраст";
            $this->failed[] = $prepared;

            return false;
        }

        // проверка локации
        if (!$prepared["location"]) {
            $prepared["location"] = "Unknown";
        }

        return $prepared;
    }

    public function createCustomer($validated) {
        // в идеале локация должна жить в отдельной таблице, а в Customer только location_id.

        $customer = new Customer();
        $customer->fill($validated);
        $customer->save();
    }
}
