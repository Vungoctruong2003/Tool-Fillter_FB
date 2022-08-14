<?php

function xuong_dong($text)
{
    return (explode("\n", $text));
}

function tach_cot($record)
{
    return (explode("|", $record));
}

function convert_data($data)
{
    $total_record = xuong_dong($data);
    for ($i = 0; $i < count($total_record); $i++) {
        $total_record[$i] = tach_cot($total_record[$i]);
    }
    return $total_record;
}
