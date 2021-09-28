<?php
use League\Csv\Reader;
use League\Csv\Statement;
use League\Csv\Writer;
class CityList{

    private array $cities;

    public function __construct($filename)
    {


//load the CSV document from a stream
        $stream = fopen($filename, 'r');
        $csv = Reader::createFromStream($stream);
        $csv->setHeaderOffset(0);

//build a statement
        $stmt = Statement::create();

//query your records from the document
        $records = $stmt->process($csv);
        foreach ($records as $record) {
            $this->cities[] = $record[0];
        }

    }

    /**
     * @return array
     */
    public function getCities(): array
    {
        return $this->cities;
    }

}