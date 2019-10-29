<?php

if (!function_exists('safe_mul')) {
    function safe_mul($a, $b, $scale = 18)
    {
        $a = safe_format($a);
        $b = safe_format($b);

        return bcmul($a, $b, $scale);
    }
}

if (!function_exists('safe_add')) {
    function safe_add($a, $b, $scale = 18)
    {
        $a = safe_format($a);
        $b = safe_format($b);

        return bcadd($a, $b, $scale);
    }
}

if (!function_exists('safe_sub')) {
    function safe_sub($a, $b, $scale = 18)
    {
        $a = safe_format($a);
        $b = safe_format($b);

        return bcsub($a, $b, $scale);
    }
}

if (!function_exists('safe_div')) {
    function safe_div($a, $b, $scale = 18)
    {
        $a = safe_format($a);
        $b = safe_format($b);

        return $a == 0 ? 0 : bcdiv($a, $b, $scale);
    }
}

if (!function_exists('safe_pow')) {
    function safe_pow($a, $b, $scale = 18)
    {
        $a = safe_format($a);
        return bcpow($a, $b, $scale);
    }
}

if (!function_exists('safe_comp')) {
    function safe_comp($a, $b, $scale = 18)
    {
        $a = safe_format($a);
        $b = safe_format($b);
        return bccomp($a, $b, $scale);
    }
}

if (! function_exists('safe_comp_between')) {
    function safe_comp_between($value, $min, $max, $scale = 18)
    {
        $value = safe_format($value);
        $min = safe_format($min);
        $max = safe_format($max);

        return safe_comp($value, $min, $scale) != -1 && safe_comp($value, $max, $scale) != 1;
    }
}

if (!function_exists('safe_format')) {
    function safe_format($num, $scale = 18)
    {
        $string = strtolower((string)$num);
        if ($pos = stripos($string, 'e+')) {
            $base = substr($string, 0, $pos);
            $times = substr($string, $pos + 2);
            return safe_mul($base, safe_pow(10, $times), $scale);
        } elseif ($pos = stripos($string, 'e-')) {
            $base = substr($string, 0, $pos);
            $times = substr($string, $pos + 2);
            return safe_div($base, safe_pow(10, $times), $scale);
        } elseif ($pos = stripos($string, 'e')) {
            $base = substr($string, 0, $pos);
            $times = substr($string, $pos + 1);
            return safe_mul($base, safe_pow(10, $times), $scale);
        } else {
            return $num;
        }
    }
}
if (! function_exists('safe_abs')) {
    function safe_abs($num, $scale = 18)
    {
        $number = safe_format($num, $scale);
        if (is_negative($number)) {
            $number = (string)substr($number, 1);
        }
        return $number;
    }
}

if (! function_exists('safe_intval')) {
    function safe_intval($num)
    {
        $number = safe_add($num, 0, 0);
        return $number;
    }
}

if (! function_exists('is_negative')) {
    function is_negative(string $number)
    {
        return 0 === strncmp('-', $number, 1);
    }
}

if (!function_exists('random_float')) {
    function random_float($min, $max, $decimals = 0)
    {
        $scale = pow(10, $decimals);
        return random_int($min * $scale, $max * $scale) / $scale;
    }
}

if (!function_exists('mask_email')) {
    function mask_email($email, $len = 3)
    {
        list($name, $domain) = explode('@', $email);
        $name = substr($name, 0, 3);
        return $name . str_repeat('*', $len) . '@' . $domain;
    }
}
