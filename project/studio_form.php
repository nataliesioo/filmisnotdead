<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "등록";
$action = "studio_insert.php";

if (array_key_exists("lab_no", $_GET)) {
    $lab_no = $_GET["lab_no"];
    $query =  "select * from lab";
    $res = mysqli_query($conn, $query);
    $lab = mysqli_fetch_array($res);
    if(!$lab) {
        msg("물품이 존재하지 않습니다.");
    }
  /*  $mode = "수정";
    $action = "studio_modify.php";*/
}

?>
    <div class="container">
        <form name="studio_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="lab_no" value="<?=$lab['lab_no']?>"/>
            <h3>현상소 <?=$mode?></h3> 
            <p>
                <label for="lab_name">현상소</label>
                <input type="text" placeholder="현상소 입력" id="lab_name" name="lab_name" value="<?=$lab['lab_name']?>"/>
            </p>
            
            <p>
                <label for="tel">전화번호</label>
                <input type="text" placeholder="000-0000-0000형식으로 입력해주세요" id="tel" name="tel" value="<?=$lab['tel']?>"/>
            </p>
            

            <br><p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>


            <script>	
                function validate() {
                    if(document.getElementById("lab_name").value == "") {
                        alert ("현상소를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("tel").value == "-1") {
                        alert ("전화번호를 선택해 주십시오"); return false;
                    }

                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>