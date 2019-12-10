<?php

namespace Sukohi\LaravelJpPostalCode\App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Sukohi\LaravelJpPostalCode\App\JpPostalCode;

class ImportJpPostalCodeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:jp-postal-code';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Japanese postal codes';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Importing...');

        JpPostalCode::truncate();

        $csv_path = config('jp_postal_code.import_path');

        if(!file_exists($csv_path)) {

            $this->error('`'. $csv_path .'` not found.');
            die();

        }

        $converted_csv_path = storage_path('app/csv/postal_code_utf8.csv');
        file_put_contents(
            $converted_csv_path,
            mb_convert_encoding(
                file_get_contents($csv_path),
                'UTF-8',
                'SJIS-win'
            )
        );

        $file = new \SplFileObject($converted_csv_path);
        $file->setFlags(\SplFileObject::READ_CSV);

        foreach ($file as $index => $row) {

            $line_number = $index + 1;

            if($line_number > 1 && $line_number % 1000 === 0) {

                $this->info(number_format($line_number) .' lines imported.');

            }

            if(!is_null($row[0])) {

                JpPostalCode::create([
                    'first_code' => intval(substr($row[2], 0, 3)),
                    'last_code' => intval(substr($row[2], 3, 4)),
                    'prefecture' => $row[6],
                    'city' => $row[7],
                    'address' => (Str::contains($row[8], '（')) ? current(explode('（', $row[8])) : $row[8]
                ]);

            }

        }

        @unlink($converted_csv_path);
        $this->info('Done!');

    }
}
