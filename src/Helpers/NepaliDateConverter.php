<?php

namespace Shreejan\FilamentNepaliDatePicker\Helpers;

class NepaliDateConverter
{
    /**
     * Date configuration mapping - same as JavaScript converter
     */
    private static $dateConfigMap = [
        '2000' => ['Baisakh' => 30, 'Jestha' => 32, 'Asar' => 31, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 30, 'Kartik' => 30, 'Mangsir' => 30, 'Poush' => 29, 'Magh' => 30, 'Falgun' => 29, 'Chaitra' => 31],
        '2001' => ['Baisakh' => 31, 'Jestha' => 31, 'Asar' => 32, 'Shrawan' => 31, 'Bhadra' => 31, 'Aswin' => 31, 'Kartik' => 30, 'Mangsir' => 29, 'Poush' => 30, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 30],
        '2002' => ['Baisakh' => 31, 'Jestha' => 31, 'Asar' => 32, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 30, 'Kartik' => 30, 'Mangsir' => 29, 'Poush' => 30, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 30],
        '2003' => ['Baisakh' => 31, 'Jestha' => 32, 'Asar' => 31, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 30, 'Kartik' => 30, 'Mangsir' => 30, 'Poush' => 29, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 31],
        '2004' => ['Baisakh' => 30, 'Jestha' => 32, 'Asar' => 31, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 30, 'Kartik' => 30, 'Mangsir' => 30, 'Poush' => 29, 'Magh' => 30, 'Falgun' => 29, 'Chaitra' => 31],
        '2005' => ['Baisakh' => 31, 'Jestha' => 31, 'Asar' => 32, 'Shrawan' => 31, 'Bhadra' => 31, 'Aswin' => 31, 'Kartik' => 30, 'Mangsir' => 29, 'Poush' => 30, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 30],
        '2006' => ['Baisakh' => 31, 'Jestha' => 31, 'Asar' => 32, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 30, 'Kartik' => 30, 'Mangsir' => 29, 'Poush' => 30, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 30],
        '2007' => ['Baisakh' => 31, 'Jestha' => 32, 'Asar' => 31, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 30, 'Kartik' => 30, 'Mangsir' => 30, 'Poush' => 29, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 31],
        '2008' => ['Baisakh' => 31, 'Jestha' => 31, 'Asar' => 31, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 31, 'Kartik' => 29, 'Mangsir' => 30, 'Poush' => 30, 'Magh' => 29, 'Falgun' => 29, 'Chaitra' => 31],
        '2009' => ['Baisakh' => 31, 'Jestha' => 31, 'Asar' => 32, 'Shrawan' => 31, 'Bhadra' => 31, 'Aswin' => 31, 'Kartik' => 30, 'Mangsir' => 29, 'Poush' => 30, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 30],
        '2010' => ['Baisakh' => 31, 'Jestha' => 31, 'Asar' => 32, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 30, 'Kartik' => 30, 'Mangsir' => 29, 'Poush' => 30, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 30],
        '2011' => ['Baisakh' => 31, 'Jestha' => 32, 'Asar' => 31, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 30, 'Kartik' => 30, 'Mangsir' => 30, 'Poush' => 29, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 31],
        '2012' => ['Baisakh' => 31, 'Jestha' => 31, 'Asar' => 31, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 31, 'Kartik' => 29, 'Mangsir' => 30, 'Poush' => 30, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 30],
        '2013' => ['Baisakh' => 31, 'Jestha' => 31, 'Asar' => 32, 'Shrawan' => 31, 'Bhadra' => 31, 'Aswin' => 31, 'Kartik' => 30, 'Mangsir' => 29, 'Poush' => 30, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 30],
        '2014' => ['Baisakh' => 31, 'Jestha' => 31, 'Asar' => 32, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 30, 'Kartik' => 30, 'Mangsir' => 29, 'Poush' => 30, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 30],
        '2015' => ['Baisakh' => 31, 'Jestha' => 32, 'Asar' => 31, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 30, 'Kartik' => 30, 'Mangsir' => 30, 'Poush' => 29, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 31],
        '2016' => ['Baisakh' => 31, 'Jestha' => 31, 'Asar' => 31, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 31, 'Kartik' => 29, 'Mangsir' => 30, 'Poush' => 30, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 30],
        '2017' => ['Baisakh' => 31, 'Jestha' => 31, 'Asar' => 32, 'Shrawan' => 31, 'Bhadra' => 31, 'Aswin' => 31, 'Kartik' => 30, 'Mangsir' => 29, 'Poush' => 30, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 30],
        '2018' => ['Baisakh' => 31, 'Jestha' => 32, 'Asar' => 31, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 30, 'Kartik' => 30, 'Mangsir' => 29, 'Poush' => 30, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 30],
        '2019' => ['Baisakh' => 31, 'Jestha' => 32, 'Asar' => 31, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 30, 'Kartik' => 30, 'Mangsir' => 30, 'Poush' => 29, 'Magh' => 30, 'Falgun' => 29, 'Chaitra' => 31],
        '2020' => ['Baisakh' => 31, 'Jestha' => 31, 'Asar' => 31, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 31, 'Kartik' => 30, 'Mangsir' => 29, 'Poush' => 30, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 30],
        '2021' => ['Baisakh' => 31, 'Jestha' => 31, 'Asar' => 32, 'Shrawan' => 31, 'Bhadra' => 31, 'Aswin' => 31, 'Kartik' => 30, 'Mangsir' => 29, 'Poush' => 30, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 30],
        '2022' => ['Baisakh' => 31, 'Jestha' => 32, 'Asar' => 31, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 30, 'Kartik' => 30, 'Mangsir' => 30, 'Poush' => 29, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 30],
        '2023' => ['Baisakh' => 31, 'Jestha' => 32, 'Asar' => 31, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 30, 'Kartik' => 30, 'Mangsir' => 30, 'Poush' => 29, 'Magh' => 30, 'Falgun' => 29, 'Chaitra' => 31],
        '2024' => ['Baisakh' => 31, 'Jestha' => 31, 'Asar' => 31, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 31, 'Kartik' => 30, 'Mangsir' => 29, 'Poush' => 30, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 30],
        '2025' => ['Baisakh' => 31, 'Jestha' => 31, 'Asar' => 32, 'Shrawan' => 31, 'Bhadra' => 31, 'Aswin' => 31, 'Kartik' => 30, 'Mangsir' => 29, 'Poush' => 30, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 30],
        '2026' => ['Baisakh' => 31, 'Jestha' => 32, 'Asar' => 31, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 30, 'Kartik' => 30, 'Mangsir' => 30, 'Poush' => 29, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 31],
        '2027' => ['Baisakh' => 30, 'Jestha' => 32, 'Asar' => 31, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 30, 'Kartik' => 30, 'Mangsir' => 30, 'Poush' => 29, 'Magh' => 30, 'Falgun' => 29, 'Chaitra' => 31],
        '2028' => ['Baisakh' => 31, 'Jestha' => 31, 'Asar' => 32, 'Shrawan' => 31, 'Bhadra' => 31, 'Aswin' => 31, 'Kartik' => 30, 'Mangsir' => 29, 'Poush' => 30, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 30],
        '2029' => ['Baisakh' => 31, 'Jestha' => 31, 'Asar' => 32, 'Shrawan' => 31, 'Bhadra' => 32, 'Aswin' => 30, 'Kartik' => 30, 'Mangsir' => 29, 'Poush' => 30, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 30],
        '2030' => ['Baisakh' => 31, 'Jestha' => 32, 'Asar' => 31, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 30, 'Kartik' => 30, 'Mangsir' => 30, 'Poush' => 29, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 31],
        '2031' => ['Baisakh' => 30, 'Jestha' => 32, 'Asar' => 31, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 30, 'Kartik' => 30, 'Mangsir' => 30, 'Poush' => 29, 'Magh' => 30, 'Falgun' => 29, 'Chaitra' => 31],
        '2032' => ['Baisakh' => 31, 'Jestha' => 31, 'Asar' => 32, 'Shrawan' => 31, 'Bhadra' => 31, 'Aswin' => 31, 'Kartik' => 30, 'Mangsir' => 29, 'Poush' => 30, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 30],
        '2033' => ['Baisakh' => 31, 'Jestha' => 31, 'Asar' => 32, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 30, 'Kartik' => 30, 'Mangsir' => 29, 'Poush' => 30, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 30],
        '2034' => ['Baisakh' => 31, 'Jestha' => 32, 'Asar' => 31, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 30, 'Kartik' => 30, 'Mangsir' => 30, 'Poush' => 29, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 31],
        '2035' => ['Baisakh' => 30, 'Jestha' => 32, 'Asar' => 31, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 31, 'Kartik' => 29, 'Mangsir' => 30, 'Poush' => 30, 'Magh' => 29, 'Falgun' => 29, 'Chaitra' => 31],
        '2036' => ['Baisakh' => 31, 'Jestha' => 31, 'Asar' => 32, 'Shrawan' => 31, 'Bhadra' => 31, 'Aswin' => 31, 'Kartik' => 30, 'Mangsir' => 29, 'Poush' => 30, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 30],
        '2037' => ['Baisakh' => 31, 'Jestha' => 31, 'Asar' => 32, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 30, 'Kartik' => 30, 'Mangsir' => 29, 'Poush' => 30, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 30],
        '2038' => ['Baisakh' => 31, 'Jestha' => 32, 'Asar' => 31, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 30, 'Kartik' => 30, 'Mangsir' => 30, 'Poush' => 29, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 31],
        '2039' => ['Baisakh' => 31, 'Jestha' => 31, 'Asar' => 31, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 31, 'Kartik' => 29, 'Mangsir' => 30, 'Poush' => 30, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 30],
        '2040' => ['Baisakh' => 31, 'Jestha' => 31, 'Asar' => 32, 'Shrawan' => 31, 'Bhadra' => 31, 'Aswin' => 31, 'Kartik' => 30, 'Mangsir' => 29, 'Poush' => 30, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 30],
        '2041' => ['Baisakh' => 31, 'Jestha' => 31, 'Asar' => 32, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 30, 'Kartik' => 30, 'Mangsir' => 29, 'Poush' => 30, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 30],
        '2042' => ['Baisakh' => 31, 'Jestha' => 32, 'Asar' => 31, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 30, 'Kartik' => 30, 'Mangsir' => 30, 'Poush' => 29, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 31],
        '2043' => ['Baisakh' => 31, 'Jestha' => 31, 'Asar' => 31, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 31, 'Kartik' => 29, 'Mangsir' => 30, 'Poush' => 30, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 30],
        '2044' => ['Baisakh' => 31, 'Jestha' => 31, 'Asar' => 32, 'Shrawan' => 31, 'Bhadra' => 31, 'Aswin' => 31, 'Kartik' => 30, 'Mangsir' => 29, 'Poush' => 30, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 30],
        '2045' => ['Baisakh' => 31, 'Jestha' => 31, 'Asar' => 32, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 30, 'Kartik' => 30, 'Mangsir' => 29, 'Poush' => 30, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 30],
        '2046' => ['Baisakh' => 31, 'Jestha' => 32, 'Asar' => 31, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 30, 'Kartik' => 30, 'Mangsir' => 30, 'Poush' => 29, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 31],
        '2047' => ['Baisakh' => 30, 'Jestha' => 32, 'Asar' => 31, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 30, 'Kartik' => 30, 'Mangsir' => 30, 'Poush' => 29, 'Magh' => 30, 'Falgun' => 29, 'Chaitra' => 31],
        '2048' => ['Baisakh' => 31, 'Jestha' => 31, 'Asar' => 32, 'Shrawan' => 31, 'Bhadra' => 31, 'Aswin' => 31, 'Kartik' => 30, 'Mangsir' => 29, 'Poush' => 30, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 30],
        '2049' => ['Baisakh' => 31, 'Jestha' => 31, 'Asar' => 32, 'Shrawan' => 31, 'Bhadra' => 32, 'Aswin' => 30, 'Kartik' => 30, 'Mangsir' => 29, 'Poush' => 30, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 30],
        '2050' => ['Baisakh' => 31, 'Jestha' => 32, 'Asar' => 31, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 30, 'Kartik' => 30, 'Mangsir' => 30, 'Poush' => 29, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 31],
        '2051' => ['Baisakh' => 30, 'Jestha' => 32, 'Asar' => 31, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 30, 'Kartik' => 30, 'Mangsir' => 30, 'Poush' => 29, 'Magh' => 30, 'Falgun' => 29, 'Chaitra' => 31],
        '2052' => ['Baisakh' => 31, 'Jestha' => 31, 'Asar' => 32, 'Shrawan' => 31, 'Bhadra' => 31, 'Aswin' => 31, 'Kartik' => 30, 'Mangsir' => 29, 'Poush' => 30, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 30],
        '2053' => ['Baisakh' => 31, 'Jestha' => 31, 'Asar' => 32, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 30, 'Kartik' => 30, 'Mangsir' => 29, 'Poush' => 30, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 30],
        '2054' => ['Baisakh' => 31, 'Jestha' => 32, 'Asar' => 31, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 30, 'Kartik' => 30, 'Mangsir' => 30, 'Poush' => 29, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 31],
        '2055' => ['Baisakh' => 30, 'Jestha' => 32, 'Asar' => 31, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 31, 'Kartik' => 29, 'Mangsir' => 30, 'Poush' => 30, 'Magh' => 29, 'Falgun' => 29, 'Chaitra' => 31],
        '2056' => ['Baisakh' => 31, 'Jestha' => 31, 'Asar' => 32, 'Shrawan' => 31, 'Bhadra' => 31, 'Aswin' => 31, 'Kartik' => 30, 'Mangsir' => 29, 'Poush' => 30, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 30],
        '2057' => ['Baisakh' => 31, 'Jestha' => 31, 'Asar' => 32, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 30, 'Kartik' => 30, 'Mangsir' => 29, 'Poush' => 30, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 30],
        '2058' => ['Baisakh' => 31, 'Jestha' => 32, 'Asar' => 31, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 30, 'Kartik' => 30, 'Mangsir' => 30, 'Poush' => 29, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 31],
        '2059' => ['Baisakh' => 31, 'Jestha' => 31, 'Asar' => 31, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 31, 'Kartik' => 29, 'Mangsir' => 30, 'Poush' => 30, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 30],
        '2060' => ['Baisakh' => 31, 'Jestha' => 31, 'Asar' => 32, 'Shrawan' => 31, 'Bhadra' => 31, 'Aswin' => 31, 'Kartik' => 30, 'Mangsir' => 29, 'Poush' => 30, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 30],
        '2061' => ['Baisakh' => 31, 'Jestha' => 31, 'Asar' => 32, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 30, 'Kartik' => 30, 'Mangsir' => 29, 'Poush' => 30, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 30],
        '2062' => ['Baisakh' => 31, 'Jestha' => 32, 'Asar' => 31, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 30, 'Kartik' => 30, 'Mangsir' => 30, 'Poush' => 29, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 31],
        '2063' => ['Baisakh' => 31, 'Jestha' => 31, 'Asar' => 31, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 31, 'Kartik' => 29, 'Mangsir' => 30, 'Poush' => 30, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 30],
        '2064' => ['Baisakh' => 31, 'Jestha' => 31, 'Asar' => 32, 'Shrawan' => 31, 'Bhadra' => 31, 'Aswin' => 31, 'Kartik' => 30, 'Mangsir' => 29, 'Poush' => 30, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 30],
        '2065' => ['Baisakh' => 31, 'Jestha' => 31, 'Asar' => 32, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 30, 'Kartik' => 30, 'Mangsir' => 29, 'Poush' => 30, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 30],
        '2066' => ['Baisakh' => 31, 'Jestha' => 32, 'Asar' => 31, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 30, 'Kartik' => 30, 'Mangsir' => 30, 'Poush' => 29, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 31],
        '2067' => ['Baisakh' => 30, 'Jestha' => 32, 'Asar' => 31, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 30, 'Kartik' => 30, 'Mangsir' => 30, 'Poush' => 29, 'Magh' => 30, 'Falgun' => 29, 'Chaitra' => 31],
        '2068' => ['Baisakh' => 31, 'Jestha' => 31, 'Asar' => 32, 'Shrawan' => 31, 'Bhadra' => 31, 'Aswin' => 31, 'Kartik' => 30, 'Mangsir' => 29, 'Poush' => 30, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 30],
        '2069' => ['Baisakh' => 31, 'Jestha' => 31, 'Asar' => 32, 'Shrawan' => 31, 'Bhadra' => 32, 'Aswin' => 30, 'Kartik' => 30, 'Mangsir' => 29, 'Poush' => 30, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 30],
        '2070' => ['Baisakh' => 31, 'Jestha' => 32, 'Asar' => 31, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 30, 'Kartik' => 30, 'Mangsir' => 30, 'Poush' => 29, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 31],
        '2071' => ['Baisakh' => 30, 'Jestha' => 32, 'Asar' => 31, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 30, 'Kartik' => 30, 'Mangsir' => 30, 'Poush' => 29, 'Magh' => 30, 'Falgun' => 29, 'Chaitra' => 31],
        '2072' => ['Baisakh' => 31, 'Jestha' => 31, 'Asar' => 32, 'Shrawan' => 31, 'Bhadra' => 31, 'Aswin' => 31, 'Kartik' => 30, 'Mangsir' => 29, 'Poush' => 30, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 30],
        '2073' => ['Baisakh' => 31, 'Jestha' => 31, 'Asar' => 32, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 30, 'Kartik' => 30, 'Mangsir' => 29, 'Poush' => 30, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 30],
        '2074' => ['Baisakh' => 31, 'Jestha' => 32, 'Asar' => 31, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 30, 'Kartik' => 30, 'Mangsir' => 30, 'Poush' => 29, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 31],
        '2075' => ['Baisakh' => 30, 'Jestha' => 32, 'Asar' => 31, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 31, 'Kartik' => 29, 'Mangsir' => 30, 'Poush' => 30, 'Magh' => 29, 'Falgun' => 29, 'Chaitra' => 31],
        '2076' => ['Baisakh' => 31, 'Jestha' => 31, 'Asar' => 32, 'Shrawan' => 31, 'Bhadra' => 31, 'Aswin' => 31, 'Kartik' => 30, 'Mangsir' => 29, 'Poush' => 30, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 30],
        '2077' => ['Baisakh' => 31, 'Jestha' => 31, 'Asar' => 32, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 30, 'Kartik' => 30, 'Mangsir' => 29, 'Poush' => 30, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 30],
        '2078' => ['Baisakh' => 31, 'Jestha' => 32, 'Asar' => 31, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 30, 'Kartik' => 30, 'Mangsir' => 30, 'Poush' => 29, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 31],
        '2079' => ['Baisakh' => 31, 'Jestha' => 31, 'Asar' => 31, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 31, 'Kartik' => 29, 'Mangsir' => 30, 'Poush' => 30, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 30],
        '2080' => ['Baisakh' => 31, 'Jestha' => 31, 'Asar' => 32, 'Shrawan' => 31, 'Bhadra' => 31, 'Aswin' => 31, 'Kartik' => 30, 'Mangsir' => 29, 'Poush' => 30, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 30],
        '2081' => ['Baisakh' => 31, 'Jestha' => 31, 'Asar' => 32, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 30, 'Kartik' => 30, 'Mangsir' => 29, 'Poush' => 30, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 30],
        '2082' => ['Baisakh' => 31, 'Jestha' => 32, 'Asar' => 31, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 30, 'Kartik' => 30, 'Mangsir' => 30, 'Poush' => 29, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 31],
        '2083' => ['Baisakh' => 31, 'Jestha' => 31, 'Asar' => 31, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 31, 'Kartik' => 29, 'Mangsir' => 30, 'Poush' => 30, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 30],
        '2084' => ['Baisakh' => 31, 'Jestha' => 31, 'Asar' => 32, 'Shrawan' => 31, 'Bhadra' => 31, 'Aswin' => 31, 'Kartik' => 30, 'Mangsir' => 29, 'Poush' => 30, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 30],
        '2085' => ['Baisakh' => 31, 'Jestha' => 31, 'Asar' => 32, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 30, 'Kartik' => 30, 'Mangsir' => 29, 'Poush' => 30, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 30],
        '2086' => ['Baisakh' => 31, 'Jestha' => 32, 'Asar' => 31, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 30, 'Kartik' => 30, 'Mangsir' => 30, 'Poush' => 29, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 31],
        '2087' => ['Baisakh' => 30, 'Jestha' => 32, 'Asar' => 31, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 30, 'Kartik' => 30, 'Mangsir' => 30, 'Poush' => 29, 'Magh' => 30, 'Falgun' => 29, 'Chaitra' => 31],
        '2088' => ['Baisakh' => 31, 'Jestha' => 31, 'Asar' => 32, 'Shrawan' => 31, 'Bhadra' => 31, 'Aswin' => 31, 'Kartik' => 30, 'Mangsir' => 29, 'Poush' => 30, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 30],
        '2089' => ['Baisakh' => 31, 'Jestha' => 31, 'Asar' => 32, 'Shrawan' => 31, 'Bhadra' => 32, 'Aswin' => 30, 'Kartik' => 30, 'Mangsir' => 29, 'Poush' => 30, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 30],
        '2090' => ['Baisakh' => 31, 'Jestha' => 32, 'Asar' => 31, 'Shrawan' => 32, 'Bhadra' => 31, 'Aswin' => 30, 'Kartik' => 30, 'Mangsir' => 30, 'Poush' => 29, 'Magh' => 29, 'Falgun' => 30, 'Chaitra' => 31]
    ];

    private static $epochYear = 2000;
    private static $beginEnglish = ['year' => 1943, 'month' => 3, 'date' => 13, 'day' => 3];
    private static $nepaliNumbers = ['०', '१', '२', '३', '४', '५', '६', '७', '८', '९'];
    private static $nepaliMonths = ['बैशाख', 'जेठ', 'असार', 'साउन', 'भदौ', 'असोज', 'कार्तिक', 'मंसिर', 'पौष', 'माघ', 'फागुन', 'चैत'];
    private static $nepaliDays = ['आइत', 'सोम', 'मंगल', 'बुध', 'बिही', 'शुक्र', 'शनि'];

    // Pre-computed mappings like JavaScript
    private static $yearDaysMapping = null;
    private static $monthDaysMappings = null;

    /**
     * Initialize mappings like JavaScript converter
     */
    private static function initializeMappings()
    {
        if (self::$yearDaysMapping !== null) {
            return;
        }

        // Initialize year month days mapping
        $yearMonthDaysMapping = [];
        foreach (self::$dateConfigMap as $year => $months) {
            $yearMonthDaysMapping[] = array_values($months);
        }

        // Initialize month days mappings
        self::$monthDaysMappings = [];
        foreach ($yearMonthDaysMapping as $yearMappings) {
            $daySum = 0;
            $monthMapping = [];
            foreach ($yearMappings as $monthDays) {
                $monthMapping[] = [$monthDays, $daySum];
                $daySum += $monthDays;
            }
            self::$monthDaysMappings[] = $monthMapping;
        }

        // Initialize year days mapping
        $daysPassed = 0;
        self::$yearDaysMapping = [];
        foreach ($yearMonthDaysMapping as $yearMappings) {
            $daysInYear = array_sum($yearMappings);
            self::$yearDaysMapping[] = [$daysInYear, $daysPassed];
            $daysPassed += $daysInYear;
        }
    }

    /**
     * Find passed days since epoch (April 13, 1943) - same as JavaScript
     */
    private static function findPassedDaysAD($year, $month, $date)
    {
        $epochDate = \Carbon\Carbon::create(1943, 4, 13);
        $targetDate = \Carbon\Carbon::create($year, $month + 1, $date);
        return $epochDate->diffInDays($targetDate);
    }

    /**
     * Map days to BS date - same logic as JavaScript
     */
    private static function mapDaysToDate($daysPassed)
    {
        self::initializeMappings();

        $MIN_DAY = 0;
        $MAX_DAY = 33000; // Approximate max days

        if ($daysPassed < $MIN_DAY || $daysPassed > $MAX_DAY) {
            throw new \Exception("The epoch difference is not within the boundaries {$MIN_DAY} - {$MAX_DAY}");
        }

        // Find year index
        $yearIndex = -1;
        for ($i = 0; $i < count(self::$yearDaysMapping); $i++) {
            $year = self::$yearDaysMapping[$i];
            if ($daysPassed > $year[1] && $daysPassed <= $year[1] + $year[0]) {
                $yearIndex = $i;
                break;
            }
        }

        if ($yearIndex === -1) {
            throw new \Exception("Year not found for days: {$daysPassed}");
        }

        $monthRemainder = $daysPassed - self::$yearDaysMapping[$yearIndex][1];
        
        // Find month index
        $monthIndex = -1;
        for ($i = 0; $i < count(self::$monthDaysMappings[$yearIndex]); $i++) {
            $month = self::$monthDaysMappings[$yearIndex][$i];
            if ($monthRemainder > $month[1] && $monthRemainder <= $month[1] + $month[0]) {
                $monthIndex = $i;
                break;
            }
        }

        if ($monthIndex === -1) {
            throw new \Exception("Month not found for remainder: {$monthRemainder}");
        }

        $date = $monthRemainder - self::$monthDaysMappings[$yearIndex][$monthIndex][1];

        return [
            'year' => 2000 + $yearIndex,
            'month' => $monthIndex,
            'date' => $date
        ];
    }

    /**
     * Convert English date to Nepali date using the same logic as JavaScript converter
     */
    public static function convertToBS($englishDate)
    {
        $date = \Carbon\Carbon::parse($englishDate);
        $year = $date->year;
        $month = $date->month - 1; // Convert to 0-based month
        $day = $date->day;
        
        // Calculate days since epoch (April 13, 1943) - same as JavaScript
        $daysPassed = self::findPassedDaysAD($year, $month, $day);
        
        // Convert to BS using the same algorithm as JavaScript
        $bsDate = self::mapDaysToDate($daysPassed);
        
        return [
            'year' => $bsDate['year'],
            'month' => $bsDate['month'] + 1, // Convert to 1-based month
            'day' => $bsDate['date']
        ];
    }
    
    /**
     * Convert English numbers to Nepali numbers
     */
    public static function convertToNepaliNumbers($number)
    {
        $result = '';
        $numberStr = (string) $number;
        for ($i = 0; $i < strlen($numberStr); $i++) {
            $digit = (int) $numberStr[$i];
            $result .= self::$nepaliNumbers[$digit] ?? $numberStr[$i];
        }
        return $result;
    }
    
    /**
     * Format Nepali date in different formats
     */
    public static function formatNepaliDate($englishDate, $format = 'nepali-numbers')
    {
        $bsDate = self::convertToBS($englishDate);
        $date = \Carbon\Carbon::parse($englishDate);
        
        switch ($format) {
            case 'nepali-numbers':
                // Format: २०८२-०५-२९
                return self::convertToNepaliNumbers($bsDate['year']) . '-' . 
                       self::convertToNepaliNumbers(str_pad($bsDate['month'], 2, '0', STR_PAD_LEFT)) . '-' . 
                       self::convertToNepaliNumbers(str_pad($bsDate['day'], 2, '0', STR_PAD_LEFT));
                       
            case 'english-numbers':
                // Format: 2082-05-29
                return $bsDate['year'] . '-' . str_pad($bsDate['month'], 2, '0', STR_PAD_LEFT) . '-' . str_pad($bsDate['day'], 2, '0', STR_PAD_LEFT);
                
            case 'nepali-text':
                // Format: बुध, असोज २९, २०८२
                // Use the day of week from the English date, not the BS date
                $dayName = self::$nepaliDays[$date->dayOfWeek] ?? 'बुध';
                $monthName = self::$nepaliMonths[$bsDate['month'] - 1] ?? 'असोज';
                return "{$dayName}, {$monthName} " . self::convertToNepaliNumbers($bsDate['day']) . ", " . self::convertToNepaliNumbers($bsDate['year']);
                
            default:
                return self::convertToNepaliNumbers($bsDate['year']) . '-' . 
                       self::convertToNepaliNumbers(str_pad($bsDate['month'], 2, '0', STR_PAD_LEFT)) . '-' . 
                       self::convertToNepaliNumbers(str_pad($bsDate['day'], 2, '0', STR_PAD_LEFT));
        }
    }
}