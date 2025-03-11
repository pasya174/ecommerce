<?php

use NumberToWords\NumberToWords;

function format_rupiah($nominal)
{
    return 'Rp ' . number_format($nominal, 0, ',', '.');
}
