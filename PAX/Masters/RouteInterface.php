<?php
namespace PAX\Masters;

interface RouteInterface {
    public function parse($request);
    public function validate();
    public function getRows(); 
    public function import();
}