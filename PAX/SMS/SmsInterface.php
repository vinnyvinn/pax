<?php
namespace PAX\SMS;

interface SmsInterface
{
    public function send();
    public function message($message);
    public function to($to);
    public function getBalance();
}