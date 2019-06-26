<?php
namespace PAX\Masters;
interface RateCardImportInterface {
    public function parse($request);
    public function validate();
    public function getRows();
    public function import();
}