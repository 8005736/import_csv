<?php

namespace App\Console\Commands;

use App\Models\Customer;
use App\Models\CustomerRepository;
use Illuminate\Console\Command;
use League\Csv\Reader;

class ImportCsv extends Command {
    public $delimiter = ",";
    public $failed = [];

    protected $repository;
    protected $signature = "import:csv";
    protected $description = "Импорт данных из файла в базу с валидацией";

    public function __construct(CustomerRepository $repository) {
        $this->repository = $repository;
        parent::__construct();
    }

    public function handle() {
        $this->repository->truncate();

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

            $validated = $this->repository->validateData($prepared);

            if (isset($validated["error"])) {
                $this->failed[] = $validated;
            } else {
                $this->repository->create($prepared);
            }
        }
    }
}
