<?php

class LanguageController
{
    public function __construct(){

    }

    public function changeLanguage($lang): bool
    {
        $result = false;
        switch ($lang) {
            case 'fr':
                setcookie('lang', 'fr', time() + (365 * 24 * 60 * 60), '/audit-admin/');
                $result = true;
                break;
            case 'en':
                setcookie('lang', 'en', time() + (365 * 24 * 60 * 60), '/audit-admin/');
                $result = true;
                break;
            default:
                break;
        }
        return $result;
    }

}