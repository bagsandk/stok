<?php


function text(string $type, string $table, array $field = [], array $relation = [], array $firstValue = [], array $secondValue = []): string
{
    if ($type == 'Insert') {
        // if ($table != 'product_kendaraan' && $table != 'kartu_stok_non_aset' && $table != 'kartu_stok_aset') {
        if ($relation == null) {
            $isi = [];
            foreach ($firstValue as $key => $val) {
                if (in_array($key, $field)) {
                    array_push($isi, ucfirst(str_replace('_', ' ', $key)) . ' = ' . $val);
                }
            }
            $nil = implode(', ', $isi);
            $text = 'Menambahkan data ' . ucfirst(str_replace('_', ' ', $table)) . ' dengan nilai ' . $nil;
        } else {
            $isi = [];
            foreach ($firstValue as $key => $val) {
                if (in_array($key, $field)) {
                    array_push($isi, ucfirst(str_replace('_', ' ', $key)) . ' = ' . $val);
                }
            }
            $end = ' dan termasuk ke dalam ';
            $yy = [];
            foreach ($relation as $key => $val) {
                $temp = [];
                foreach ($val['field'] as $k => $v) {
                    array_push($temp, ucfirst(str_replace('_', ' ', $v)) . ' = ' . view($val['table'], [$val['pk'] => $val['valuePk']], $v));
                }
                $im = implode(', ', $temp);
                $textTemp = $val['table'] . ' dengan ' . $im;
                array_push($yy, $textTemp);
            }
            $nil = implode(', ', $isi);
            $rel = implode(', ', $yy);
            $text = 'Menambahkan data ' . ucfirst(str_replace('_', ' ', $table)) . ' dengan nilai ' . $nil . $end . $rel;
        }
        // } elseif ($table != 'kartu_stok_aset' && $table != 'product_kendaraan') {
        //     $isi = [];
        //     foreach ($firstValue as $key => $val) {
        //         if (in_array($key, $field)) {
        //             array_push($isi, ucfirst(str_replace('_', ' ', $key)) . ' = ' . $val);
        //         }
        //     }

        //     $end = ' dan termasuk ke dalam ';
        //     $yy = [];
        //     foreach ($relation as $key => $val) {
        //         $temp = [];
        //         foreach ($val['field'] as $k => $v) {
        //             array_push($temp, ucfirst(str_replace('_', ' ', $v)) . ' = ' . view($val['table'], [$val['pk'] => $val['valuePk']], $v));
        //         }
        //         $im = implode(', ', $temp);
        //         $textTemp = $val['table'] . ' dengan ' . $im;
        //         array_push($yy, $textTemp);
        //     }
        //     $nil = implode(', ', $isi);
        //     $rel = implode(', ', $yy);
        //     $text = 'Menambahkan data ' . ucfirst(str_replace('_', ' ', $table)) . ' dengan nilai ' . $nil . $end . $rel;
        //     // var_dump($text);
        //     // die;
        // }
    }
    if ($type == 'Update') {
        // if ($table != 'product_kendaraan' && $table != 'kartu_stok_non_aset' && $table != 'kartu_stok_aset' && $table != 'product') {
        if ($relation == null) {
            $merge = array_merge($firstValue, $secondValue);
            $unique = array_unique($merge);
            $isi = [];
            foreach ($unique as $key => $val) {
                if (in_array($key, $field) && $val != $firstValue[$key]) {
                    array_push($isi, ucfirst(str_replace('_', ' ', $key)) . ' = ' . $firstValue[$key] . ' ke ' . $secondValue[$key]);
                }
            }
            $nil = implode(', ', $isi);
            if ($isi == null) {
                $text = '';
            } else {
                $text = 'Mengubah data ' . ucfirst(str_replace('_', ' ', $table)) . ' dengan nilai ' . $nil;
            }
        } else {
            $merge = array_merge($firstValue, $secondValue);
            $unique = array_unique($merge);
            $isi = [];
            foreach ($unique as $key => $val) {
                if (in_array($key, $field) && $val != $firstValue[$key]) {
                    array_push($isi, ucfirst(str_replace('_', ' ', $key)) . ' = ' . $firstValue[$key] . ' ke ' . $secondValue[$key]);
                }
            }
            $end = ' dan termasuk ke dalam ';
            $yy = [];
            foreach ($relation as $key => $val) {
                $temp = [];
                foreach ($val['field'] as $k => $v) {
                    array_push($temp, ucfirst(str_replace('_', ' ', $v)) . ' = ' . view($val['table'], [$val['pk'] => $val['valuePk']], $v));
                }
                $im = implode(', ', $temp);
                $textTemp = $val['table'] . ' dengan ' . $im;
                array_push($yy, $textTemp);
            }
            $nil = implode(', ', $isi);
            $rel = implode(', ', $yy);
            if ($isi == null) {
                $text = '';
            } else {
                $text = 'Mengubah data ' . ucfirst(str_replace('_', ' ', $table)) . ' dengan nilai ' . $nil . $end . $rel;
            }
        }
        // } elseif ($table != 'kartu_stok_aset' && $table != 'product_kendaraan') {
        //     $merge = array_merge($firstValue, $secondValue);
        //     $unique = array_unique($merge);
        //     $isi = [];
        //     foreach ($unique as $key => $val) {
        //         if (in_array($key, $field) && $val != $firstValue[$key]) {
        //             array_push($isi, ucfirst(str_replace('_', ' ', $key)) . ' = ' . $firstValue[$key] . ' ke ' . $secondValue[$key]);
        //         }
        //     }
        //     $end = ' dan termasuk ke dalam ';
        //     $yy = [];
        //     foreach ($relation as $key => $val) {
        //         $temp = [];
        //         foreach ($val['field'] as $k => $v) {
        //             array_push($temp, ucfirst(str_replace('_', ' ', $v)) . ' = ' . view($val['table'], [$val['pk'] => $val['valuePk']], $v));
        //         }
        //         $im = implode(', ', $temp);
        //         $textTemp = $val['table'] . ' dengan ' . $im;
        //         array_push($yy, $textTemp);
        //     }
        //     $nil = implode(', ', $isi);
        //     $rel = implode(', ', $yy);
        //     if ($isi == null) {
        //         $text = '';
        //     } else {
        //         $text = 'Mengubah data ' . ucfirst(str_replace('_', ' ', $table)) . ' dengan nilai ' . $nil . $end . $rel;
        //     }
        // }
    }
    if ($type == 'Delete') {
        $isi = [];
        foreach ($firstValue as $key => $val) {
            if (in_array($key, $field)) {
                array_push($isi, ucfirst(str_replace('_', ' ', $key)) . ' = ' . $val);
            }
        }
        $nil = implode(', ', $isi);
        $text = 'Mengahapus data ' . ucfirst(str_replace('_', ' ', $table)) . ' dengan nilai ' . $nil;
    }
    return $text;
}

// Menambahkan data Kelompok dengan nilai NamaKelompok = coba, KodeGol = d6e258ff-719a-4fb5-95ac-a5290f9a765f dan termasuk ke dalam golongan dengan NamaGolongan = 
