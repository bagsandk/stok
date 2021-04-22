<?php
function history(string $type, string $query): bool
{
    $CI = &get_instance();
    $CI->load->model('Global_model');
    $params = [
        'user_id' => $CI->session->userdata('user_id'),
        'type' => $type,
        'query' => $query
    ];
    $CI->Global_model->insert_history('history', $params);
    return true;
}

function view(string $table, array $where, string $field): string
{
    $CI = &get_instance();
    $CI->load->model('Global_model');
    $data = $CI->Global_model->get_data($table, $where, false);
    return $data ? $data[$field] : '';
}

function alert(string $type, string $title, string $description)
{
    $CI = &get_instance();
    return $CI->session->set_flashdata('message', "<script>
				Swal.fire({
						icon: '" . $type . "',
						title: '" . $title . "',
						text: '" . $description . "',
					})
				</script>");
}
// $time_elapsed = timeAgo($time_ago); //The argument $time_ago is in timestamp (Y-m-d H:i:s)format.

//Function definition

function timeAgo($time_ago)
{
    $time_ago = strtotime($time_ago);
    $cur_time   = time();
    $time_elapsed   = $cur_time - $time_ago;
    $seconds    = $time_elapsed;
    $minutes    = round($time_elapsed / 60);
    $hours      = round($time_elapsed / 3600);
    $days       = round($time_elapsed / 86400);
    $weeks      = round($time_elapsed / 604800);
    $months     = round($time_elapsed / 2600640);
    $years      = round($time_elapsed / 31207680);
    // Seconds
    if ($seconds <= 60) {
        return "just now";
    }
    //Minutes
    else if ($minutes <= 60) {
        if ($minutes == 1) {
            return "one minute ago";
        } else {
            return "$minutes minutes ago";
        }
    }
    //Hours
    else if ($hours <= 24) {
        if ($hours == 1) {
            return "an hour ago";
        } else {
            return "$hours hrs ago";
        }
    }
    //Days
    else if ($days <= 7) {
        if ($days == 1) {
            return "yesterday";
        } else {
            return "$days days ago";
        }
    }
    //Weeks
    else if ($weeks <= 4.3) {
        if ($weeks == 1) {
            return "a week ago";
        } else {
            return "$weeks weeks ago";
        }
    }
    //Months
    else if ($months <= 12) {
        if ($months == 1) {
            return "a month ago";
        } else {
            return "$months months ago";
        }
    }
    //Years
    else {
        if ($years == 1) {
            return "one year ago";
        } else {
            return "$years years ago";
        }
    }
}
function getInventaris($departement)
{
    $CI = &get_instance();
    $get = $CI->db->like('noInventaris', $departement, 'boot')->order_by('noInventaris', 'desc')->get('kartu_stok_aset')->row_array();
    if ($get != null) {
        $last = $get['noInventaris'];
        $x = explode('-', $last);
        $invID = $x[0] + 1;
    } else {
        $invID = 1;
    }
    $invID = str_pad($invID, 4, '0', STR_PAD_LEFT);
    $newInv = $invID . '-' . $departement . '-' . getMonthRomawi(date('n')) . '-' . date('Y');
    return $newInv;
}
function getMonthRomawi($m)
{
    $roman = ['I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
    $result = '';
    foreach ($roman as $i => $r) {
        if (($i + 1) == $m) {
            $result .= $r;
        }
    }
    return $result;
}
