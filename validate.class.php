<?php
class validate
{
    public $errors = [];
    public function str($value)
    {
        return htmlspecialchars(trim($value));
    }
}
