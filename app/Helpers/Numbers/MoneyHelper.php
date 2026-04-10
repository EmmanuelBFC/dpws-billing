<?php

namespace App\Helpers\Numbers;

class MoneyHelper
{
    const SPACE = ' ';
    const NUMBER_DEFAULT_DECIMAL_PRECISION = 2;
    const PRICE_DEFAULT_DECIMAL_PRECISION = 2;
    const DEFAULT_CURRENCY_SYMBOL = 'FCFA';

    public static function number($number, $add_plus_sign = false, $decimal_part_length = null, $avoid_rounding = true)
    {
        $nb = (double)$number;

        // sign to add before number
        $sign = ($add_plus_sign && $nb > 0.0) ? '+' : '';

        // set precision. Note : will do rounding if necessary in number_format()
        $precision = is_null($decimal_part_length) ? self::NUMBER_DEFAULT_DECIMAL_PRECISION : (int)$decimal_part_length;

        if ($avoid_rounding)
        {
            // compute precision, so as to avoid rounding
            $tab = explode('.', (string)$nb);
            $dec_length = isset($tab[1]) ? strlen(rtrim($tab[1], '0')) : 0;
            if ($dec_length > $precision)
                $precision = $dec_length;
        }

        $formatted = number_format($nb, $precision, ',', self::SPACE);
        return $sign . $formatted;
    }

    public static function price($price, $add_plus_sign = false, $currency_symbol = null,
                                 $decimal_part_length = null, $avoid_rounding = true){

        if (is_null($currency_symbol))
            $currency_symbol = self::DEFAULT_CURRENCY_SYMBOL;

        if (is_null($decimal_part_length))
            $decimal_part_length = self::PRICE_DEFAULT_DECIMAL_PRECISION;

        $formatted = static::number($price, $add_plus_sign, $decimal_part_length, $avoid_rounding);
        return $formatted . self::SPACE . $currency_symbol;
    }
}
