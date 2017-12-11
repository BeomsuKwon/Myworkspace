<?php
const   MYSQL_HOST          = "localhost",
        MYSQL_USER          = "root",
        MYSQL_PASSWORD      = "autoset",
        MYSQL_DATABASE      = "voting_system";

const   FONT_SIZE           = 10,
        FONT_FAMILY         = './fonts/MalGun.ttf';

const   IMG_NAME_XPOS       = 50,
        IMG_VOTE_BAR_XPOS   = 100,
        IMG_VOTE_TEXT_XPOS  = 120,
        IMG_VOTE_RATIO_XPOS = 550;

$candidate = isset($_POST['candidate']) ? $_POST['candidate'] : null;

if($candidate){
    // mysql 연결
    @$conn = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    if($conn->connect_errno)
        exit($conn->connect_error);

    // form으로 부터 전달된 데이터가 유효한지 판단
    $res = $conn->query("SELECT * FROM candidates WHERE name = '$candidate'");
    if(!$res)
        exit();
    $votes = $res->fetch_array(MYSQLI_ASSOC);

    $votes = $votes ? ++$votes['votes'] : 1;
    $res = $conn->query("UPDATE candidates SET votes = $votes WHERE name = '$candidate'");

    // 총 투표수 구하기
    $res = $conn->query("SELECT sum(votes) AS count FROM candidates");
    $total_votes = $res->fetch_array(MYSQLI_ASSOC)['count'];

    // 투표 현황 가져오기
    $res = $conn->query("SELECT name, votes FROM candidates");
    $vote_res = $res->fetch_all(MYSQLI_ASSOC);

    // 모든 후보자의 수
    $numOfCandidates = $res->num_rows;

    // 디비로 부터 얻어진 데이터를 이미지로 출력
    $height = 100 * $numOfCandidates;
    $width = 600;

    $im = ImageCreateTrueColor($width, $height);
    $white      = ImageColorAllocate($im, 255, 255, 255);
    $black      = ImageColorAllocate($im, 0, 0, 0);
    $background = ImageColorAllocate($im, 100, 100, 100);
    $color[0] = ImageColorAllocate($im, 0, 0, 64);
    $color[1] = ImageColorAllocate($im, 64, 0, 0);
    $color[2] = ImageColorAllocate($im, 0, 64, 0);
    Imagefill($im, 0, 0, $background);
    
    // 후보자별로 그래프를 그린다
    foreach($vote_res as $order => $candidate){
        // 후보자별 y좌표 기준 설정
        $ref_height = ($order * 100) + 25;
        $text_r_height = $ref_height + 25;

        $vote_ratio = $candidate['votes'] / $total_votes * 100;
        ImagettfText($im, FONT_SIZE, 0, IMG_NAME_XPOS, $text_r_height, $black, FONT_FAMILY, $candidate['name']);
        ImageFilledRectangle($im, IMG_VOTE_BAR_XPOS, $ref_height, IMG_VOTE_BAR_XPOS + $vote_ratio * 4, $ref_height + 50, $color[$order]);
        ImagettfText($im, FONT_SIZE, 0, IMG_VOTE_TEXT_XPOS, $text_r_height, $white, FONT_FAMILY, $candidate['votes'] . "표");
        ImagettfText($im, FONT_SIZE, 0, IMG_VOTE_RATIO_XPOS, $text_r_height, $black, FONT_FAMILY, intVal($vote_ratio) . "%");
    }
    
    Header('Content-type: image/png');
    ImagePng($im);
    ImageDestroy($im);
}
?>