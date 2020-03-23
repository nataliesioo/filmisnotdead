<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("producer_no", $_GET)) {
    $producer_no = $_GET["producer_no"];
    $query = "select * from producer where producer_no = $producer_no";
    $res = mysqli_query($conn, $query);
    $producer = mysqli_fetch_assoc($res);
    if(!$producer) {
        msg("물품이 존재하지 않습니다.");
    }
}

?>

<div class="container fullwidth">

        <br>
        <h3><b>제조사 정보 상세 보기</h3></b>
        <br>
        
        <p>
            <label for="producer_no">No.</label>
            <input readonly type="text" id="producer_no" name="producer_no" value="<?= $producer['producer_no'] ?>"/>
        </p>
        
        <p>
            <label for="producer_name">제조사</label>
            <input readonly type="text" id="producer_name" name="producer_name" value="<?= $producer['producer_name'] ?>"/>
        </p>
        
        
    </div>
<? include("footer.php") ?>