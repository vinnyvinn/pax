<?php

namespace PAX\Processor;

use Carbon\Carbon;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Http\UploadedFile;
use PHPExcel;
use PHPExcel_IOFactory;

class Excel
{
    const SET_NULL = 0;

    const SET_VALUE = 1;

    const EXCLUDE_ROW = 2;

    protected $additionalColumns = [];

    protected $headers = [];

    protected $headerRow = 0;

    /**
     * @var PHPExcel
     */
    protected $excel;

    protected $rows;

    protected $onNull = self::SET_NULL;

    protected $nullValue = null;

    protected $excludeKey = null;

    protected $excludeValues = [];

    protected $dates = [];

    public static function validateExcel(UploadedFile $file)
    {
        if (! $file || ! $file->isValid()) {
            return false;
        }

        $mime = explode('.', $file->getClientOriginalExtension());
        $currentMime = $mime[count($mime) - 1];

        if (strtoupper($currentMime) != 'XLS' && strtoupper($currentMime) != 'XLSX') {
            return false;
        }

        return true;
    }

    public static function prepare(UploadedFile $file)
    {
        $excel = new self;
        $excel->excel = PHPExcel_IOFactory::load($file);

        return $excel;
    }

    public function withHeaderRow($rowNumber = 0)
    {
        $this->headerRow = $rowNumber;

        return $this;
    }

    /**
     * @param int                 $action
     * @param null | string | int $replace
     *
     * @return $this
     */
    public function whenNull($action = self::SET_NULL, $replace = null)
    {
        if (! in_array($action, [0, 1, 2])) {
            throw new InvalidArgumentException('Invalid action attribute passed.');
        }

        $this->onNull = $action;
        $this->nullValue = $replace;

        return $this;
    }

    public function usingHeaders($headers = [])
    {
        $this->headers = $headers;

        return $this;
    }

    public function includeColumns($columns = [])
    {
        $this->additionalColumns = $columns;

        return $this;
    }

    public function withDates($columns = [])
    {
        $this->dates = $columns;

        return $this;
    }

    public function excludeRows($key = null, $values = [])
    {
        $this->excludeKey = $key;
        $this->excludeValues = array_map(function ($value) {
            return strtoupper($value);
        }, $values);

        return $this;
    }

    public function get()
    {
        return $this->getRows();
    }

    private function getRows()
    {
        $sheet = $this->excel
            ->getSheet()
            ->toArray($this->getNullValue());

        $headers = $this->cleanHeader($sheet[$this->headerRow]);
        for ($i = 0; $i <= $this->headerRow; $i++) {
            unset($sheet[$i]);
        }

        return array_values($this->mapRows($headers, $sheet));
    }

    private function getNullValue()
    {
        switch ($this->onNull) {
            default:
            case self::SET_NULL:
                return null;
            case self::EXCLUDE_ROW:
                return null;
            case self::SET_VALUE:
                return $this->nullValue;
        }
    }

    private function cleanHeader($header = [])
    {
        $fromExcel = array_map(function ($item) {
            return strtolower(str_replace(' ', '_', $item));
        }, $header);

        if (count($fromExcel) != count($this->headers)) {
            return $fromExcel;
        }

        return $this->headers;
    }

    private function mapRows($header, $rows)
    {
        $cleaned = $this->manageNulls($rows);

        $mapped = array_map(function ($row) use ($header) {
            $mapped = [];
            foreach ($row as $index => $item) {
                $mapped[$header[$index]] = in_array($header[$index], $this->dates) ? Carbon::parse($item) : $item;

                if ($header[$index] == $this->excludeKey && in_array($item, $this->excludeValues)) {
                    return null;
                }
            }

            return array_merge($mapped, $this->additionalColumns);
        }, $cleaned);

        return array_filter($mapped, function ($row) {
            return ! is_null($row);
        });
    }

    private function manageNulls($rows)
    {
        if ($this->onNull != self::EXCLUDE_ROW) {
            return $rows;
        }

        return array_filter($rows, function ($entry) {
            return ! in_array(null, array_values($entry));
        });
    }
}
