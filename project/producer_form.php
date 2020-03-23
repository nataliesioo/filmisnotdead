<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "producer_insert.php";

if (array_key_exists("producer_no", $_GET)) {
    $producer_no = $_GET["producer_no"];
    $query =  "select * from producer where producer_no = $producer_no;";
    $res = mysqli_query($conn, $query);
    $producer = mysqli_fetch_array($res);
    if(!$producer) {
        msg("물품이 존재하지 않습니다.");
    }
}

?>
    <div class="container">
        <form name="producer_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="producer_no" value="<?=$producer['producer_no']?>"/>
            <h3>제조사 정보 <?=$mode?></h3> 
            <p>
                <label for="film_name">제조사</label>
                <input type="text" placeholder="제조사 입력" id="producer_name" name="producer_name" value="<?=$producer['producer_name']?>"/>
            </p>
           
            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            
            
            <script>	
                function validate() {
                	if(document.getElementById("producer_name").value == "") {
                        alert ("제조사를 선택해 주십시오"); return false;
                    }

                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>