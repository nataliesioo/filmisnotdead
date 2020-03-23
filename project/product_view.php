<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $mode = "뒤로 가기";

if (array_key_exists("film_no", $_GET)) {
    $film_no = $_GET["film_no"];
    $query = "select * from film natural join producer natural join cat where film_no = $film_no";
    $res = mysqli_query($conn, $query);
    $film = mysqli_fetch_assoc($res);
    if(!$film) {
        msg("물품이 존재하지 않습니다.");
    }
}

?>

<div class="container fullwidth">

        <br>
        <h3><b>필름 정보 상세 보기</h3></b>
        <br>
        
       <!-- <p>
            <label for="film_no">No.</label>
            <input readonly type="text" id="film_no" name="film_no" value="<?= $film['film_no'] ?>"/>
        </p> -->
        
        <p>
            <label for="film_name">필름명</label>
            <input readonly type="text" id="film_name" name="film_name" value="<?= $film['film_name'] ?>"/>
        </p>
        
        <p>
            <label for="producer_name">제조사</label>
            <input readonly type="text" id="producer_name" name="producer_name" value="<?= $film['producer_name'] ?>"/>
        </p>

        <p>
            <label for="format"> 폼맷</label>
            <input readonly type="text" id="format" name="format" value="<?= $film['format'] ?>"/>
        </p>

        <p>
            <label for="iso">감도(ISO)</label>
            <input readonly type="text" id="iso" name="iso" value="<?= $film['iso'] ?>"/>
        </p>

        <p>
            <label for="cut">컷수</label>
            <input readonly type="text" id="cut" name="cut" value="<?= $film['cut'] ?>"/>
        </p>

        <p>
            <label for="cat_name">종류</label>
            <input readonly type="text" id="cat_name" name="cat_name" value="<?= $film['cat_name'] ?>"/>
        </p><br>
        
     <p align="center"><a href='product_list.php'><button class="button primary small" onclick="javascript:return validate();"><?=$mode?></button>

    </div>
<? include("footer.php") ?>