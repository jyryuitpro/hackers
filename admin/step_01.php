<?php
require_once("../database/dbconfig.php");
//error_reporting(E_ALL);
//ini_set("display_errors", 1);

session_start();
$f_name = $_SESSION['f_name'];
$f_id = $_SESSION['f_id'];

// query string 게시글 URI에 추가 세팅
$data = array();

if (isset($_GET['f_category_id'])) {
    $data["f_category_id"] = $_GET['f_category_id'];
}

if (isset($_GET['f_lecture'])) {
    $data["f_lecture"] = $_GET['f_lecture'];
}

if (isset($_GET['f_instructor'])) {
    $data["f_instructor"] = $_GET['f_instructor'];
}

if (isset($_GET['f_admin_name'])) {
    $data["f_admin_name"] = $_GET['f_admin_name'];
}

$query_string = http_build_query($data);
$query_string_add = '';
if ($query_string) {
    $query_string_add = '&' . $query_string;
}

// 페이징 생성 시작
if (isset($_GET['page'])) { // $_GET['page']가 있는 경우
    $page = $_GET['page'];
} else { // $_GET['page']가 없는 경우
    $page = 1;
}

$search = 'WHERE 1=1 ';

// search.php에서 생성한 query string으로 페이지에 보여줄 강의 리스트 검색조건 만들기 (SQL)
if (isset($_GET['f_category_id']) && $_GET['f_category_id'] != "all") {
    $f_category_id = $_GET['f_category_id'];
    $search .= "AND F_CATEGORY_ID = '$f_category_id'";
}

// LIKE 검색
if (isset($_GET['f_lecture'])) {
    $f_lecture = $_GET['f_lecture'];
    $search .= "AND F_LECTURE LIKE '%$f_lecture%'";
}

// LIKE 검색
if (isset($_GET['f_instructor'])) {
    $f_instructor = $_GET['f_instructor'];
    $search .= "AND F_INSTRUCTOR LIKE '%$f_instructor%'";
}

// LIKE 검색
if (isset($_GET['f_admin_name'])) {
    $f_admin_name = $_GET['f_admin_name'];
    $search .= "AND F_ADMIN_NAME LIKE '%$f_admin_name%'";
}

// 페이징을 하기 위해서 등록된 전체 강의 갯수 가져오기
$sql = "SELECT count(*) as cnt FROM LECTURE ".$search." ORDER BY F_NUM DESC";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

//전체 강의 갯수
$allPost = $row['cnt']; // 44
// 한 페이지에 보여줄 게시글의 수
$onePage = 5;
// 전체 페이지의 수
// ceil() : 소수점 아래의 숫자를 모두 버리고, 정수부에 1일 더해주는 함수
$allPage = ceil($allPost / $onePage); // 9

// 페이징 에러
if($page < 1 || ($allPage && $page > $allPage)) {
    echo '<script> alert("존재하지 않는 페이지입니다."); history.back(); </script>';
}

// 한번에 보여줄 섹션 페이지 번호
$oneSection = 3;
// 현재 섹션 : 섹션 1) [1,2,3], 섹션 2) [4,5,6], 섹션 3) [7,8,9]
$currentSection = ceil($page / $oneSection);

// 전체 섹션의 수 : [1,2,3] [4,5,6] [7,8,9]
$allSection = ceil($allPage / $oneSection); // 3

//현재 섹션의 처음 페이지 : 1, 4, 7
$firstPage = ($currentSection * $oneSection) - ($oneSection - 1);

if ($currentSection == $allSection) {
    $lastPage = $allPage; // 현재 섹션이 마지막 섹션이라면 $allPage가 마지막 페이지가 된다.
} else {
    $lastPage = $currentSection * $oneSection; //현재 섹션의 마지막 페이지
}

// 전체 섹션의 수 : [1,2,3] [4,5,6] [7,8,9]
//$prevPage = (($currentSection - 1) * $oneSection); // 이전 섹션으로 이동
//$nextPage = (($currentSection + 1) * $oneSection) - ($oneSection - 1); // 다음 섹션으로 이동

// 섹션 단위가 아닌 페이지 단위로 변경
$prevPage = $page - 1; // 이전 섹션으로 이동
$nextPage = $page + 1; // 다음 섹션으로 이동

// 페이징을 저장할 변수
$paging = '<ul>';
//첫 페이지가 아니라면 처음 섹션 버튼을 생성
if($page != 1) {
    $paging .= '<a href="/admin/step_01.php?page=1'.$query_string_add.'"><i class="icon-first"><span class="hidden">첫 페이지</span></i></a>';
}

//첫 섹션이 아니라면 이전 버튼을 생성
//if($currentSection != 1) {
//    $paging .= '<a href="/admin/step_01.php?page=' . $prevPage . $query_string_add. '"><i class="icon-prev"><span class="hidden">이전 섹션</span></i></a>';
//}

if($page != 1) {
    $paging .= '<a href="/admin/step_01.php?page=' . $prevPage . $query_string_add. '"><i class="icon-prev"><span class="hidden">이전 섹션</span></i></a>';
}

// 페이지 번호 생성
for($i = $firstPage; $i <= $lastPage; $i++) {
    if($i == $page) {
        // 현재 페이지
        $paging .= '<a class="active">'.$i.'</a>';
    } else {
        $paging .= '<a href="/admin/step_01.php?page=' . $i .$query_string_add. '">' . $i . '</a>';
    }
}

//마지막 섹션이 아니라면 다음 섹션 버튼을 생성
//if($currentSection != $allSection) {
//    $paging .= '<a href="/admin/step_01.php?page=' . $nextPage . $query_string_add. '"><i class="icon-next"><span class="hidden">다음 섹션</span></i></a>';
//}

if($page != $allPage) {
    $paging .= '<a href="/admin/step_01.php?page=' . $nextPage . $query_string_add. '"><i class="icon-next"><span class="hidden">다음 섹션</span></i></a>';
}

//마지막 페이지가 아니라면 끝 섹션 버튼을 생성
if($page != $allPage) {
    $paging .= '<a href="/admin/step_01.php?page=' . $allPage . $query_string_add. '"><i class="icon-last"><span class="hidden">마지막 페이지</span></i></a>';
}

// 페이징 생성 끝
$paging .= '</ul>';

//몇 번째의 글부터 가져오는지 확인
$currentLimit = ($onePage * $page) - $onePage;

//limit sql 구문
$sqlLimit = ' LIMIT ' . $currentLimit . ', ' . $onePage;
$sql = "SELECT * FROM LECTURE ".$search." ORDER BY F_NUM DESC ". $sqlLimit;
$result_normal = $conn->query($sql);
?>
<?php include '../include/header.php'; ?>
<div id="container" class="container">
	<div id="nav-left" class="nav-left">
		<div class="nav-left-tit"> 
			<span>HRD ADMIN</span>
		</div>
		<ul class="nav-left-lst">
			<li <?php if($_GET['f_category_id'] == 'all' || !isset($_GET['f_category_id'])) echo 'class="on" '; ?> ><a href="/admin/index.php?mode=list">전체</a></li>
			<li <?php if($_GET['f_category_id'] == 1) echo 'class="on" '; ?> ><a href="/admin/index.php?mode=list&f_category_id=1">어학 및 자격증</a></li>
			<li <?php if($_GET['f_category_id'] == 2) echo 'class="on" '; ?> ><a href="/admin/index.php?mode=list&f_category_id=2">공통역량</a></li>
			<li <?php if($_GET['f_category_id'] == 3) echo 'class="on" '; ?> ><a href="/admin/index.php?mode=list&f_category_id=3">일반직무</a></li>
			<li <?php if($_GET['f_category_id'] == 4) echo 'class="on" '; ?> ><a href="/admin/index.php?mode=list&f_category_id=4">산업직무</a></li>
		</ul>
	</div>

	<div id="content" class="content">
		<div class="tit-box-h3">
			<h3 class="tit-h3">관리자</h3>
			<div class="sub-depth">
				<span><i class="icon-home"><span>홈</span></i></span>
				<span>관리자</span>
                <strong>
                <?php
                if ($_GET['f_category_id'] == 1) {
                    echo '어학 및 자격증';
                } else if ($_GET['f_category_id'] == 2) {
                    echo '공통역량';
                } else if ($_GET['f_category_id'] == 3) {
                    echo '일반직무';
                } else if ($_GET['f_category_id'] == 4) {
                    echo '산업직무';
                } else {
                    echo '전체';
                }
                ?>
				</strong>
			</div>
		</div>

		<ul class="tab-list tab5">
			<li <?php if($_GET['f_category_id'] == 'all' || !isset($_GET['f_category_id'])) echo 'class="on" '; ?> ><a href="/admin/index.php?mode=list">전체</a></li>
			<li <?php if($_GET['f_category_id'] == 1) echo 'class="on" '; ?> ><a href="/admin/index.php?mode=list&f_category_id=1">어학 및 자격증</a></li>
			<li <?php if($_GET['f_category_id'] == 2) echo 'class="on" '; ?> ><a href="/admin/index.php?mode=list&f_category_id=2">공통역량</a></li>
			<li <?php if($_GET['f_category_id'] == 3) echo 'class="on" '; ?> ><a href="/admin/index.php?mode=list&f_category_id=3">일반직무</a></li>
			<li <?php if($_GET['f_category_id'] == 4) echo 'class="on" '; ?> ><a href="/admin/index.php?mode=list&f_category_id=4">산업직무</a></li>
		</ul>
        <form name="search" method="post" action="/admin/search.php">
            <div class="search-info">
                <div class="search-form f-r">
                    <select class="input-sel" style="width:158px" name="f_category_id" id="f_category_id">
                        <option value="all">전체</option>
                        <option value="1" <? if($_GET['f_category_id'] == 1) { echo "selected"; } ?> >어학 및 자격증</option>
                        <option value="2" <? if($_GET['f_category_id'] == 2) { echo "selected"; } ?> >공통역량</option>
                        <option value="3" <? if($_GET['f_category_id'] == 3) { echo "selected"; } ?> >일반직무</option>
                        <option value="4" <? if($_GET['f_category_id'] == 4) { echo "selected"; } ?> >산업직무</option>
                    </select>
                    <select class="input-sel" style="width:158px" name="f_search_detatil" id="f_search_detatil">
                        <option value="f_lecture" <? if(isset($_GET['f_lecture'])) { echo "selected"; } ?>>강의명</option>
                        <option value="f_instructor" <? if(isset($_GET['f_instructor'])) { echo "selected"; } ?>>강사명</option>
                        <option value="f_admin_name" <? if(isset($_GET['f_admin_name'])) { echo "selected"; } ?>>관리자</option>
                    </select>
                    <input type="text" class="input-text" placeholder="상세조건 입력하세요." style="width:345px" name="f_search_content" id="f_search_content"
                           value="<?php if (isset($_GET['f_lecture'])) echo $_GET['f_lecture']; if (isset($_GET['f_instructor'])) echo $_GET['f_instructor']; if (isset($_GET['f_admin_name'])) echo $_GET['f_admin_name'];?>"/>
                    <button type="submit" class="btn-s-dark">검색</button>
                </div>
            </div>
        </form>

		<table border="0" cellpadding="0" cellspacing="0" class="tbl-bbs">
			<caption class="hidden">수강후기</caption>
			<colgroup>
				<col style="width:8%"/>
				<col style="width:8%"/>
				<col style="*"/>
				<col style="width:15%"/>
				<col style="width:12%"/>
			</colgroup>

			<thead>
				<tr>
					<th scope="col">번호</th>
					<th scope="col">분류</th>
					<th scope="col">제목</th>
					<th scope="col">학습난이도</th>
					<th scope="col">관리자</th>
				</tr>
			</thead>
	 
			<tbody>

            <!-- set -->
            <?php
            while ($row = $result_normal->fetch_assoc()) {
                ?>
                <tr class="bbs-sbj">
                    <td><?php echo $row['F_NUM'] ?></td>
                    <td><?php echo $row['F_CATEGORY'] ?></td>
                    <td>
                        <!-- 강의명 또는 강사명 클릭 시, 강의 수정 페이지로 이동위한 구분 값 f_gunbun 설정 -->
                        <a href="/admin/index.php?mode=view&f_gubun=modify&f_category_id=<?php echo $row['F_CATEGORY_ID'] ?>&f_num=<?php echo $row['F_NUM'] ?><?php echo $query_string_add ?>">
                            <span class="tc-gray ellipsis_line">강의명 : <?php echo $row['F_LECTURE'] ?></span>
                            <strong class="ellipsis_line">강사명 : <?php echo $row['F_INSTRUCTOR'] ?></strong>
                        </a>
                    </td>
                    <td>
                        <span class="star-rating">
                        <?php
                        if ($row['F_GRADE'] == 5) {
                            ?>
                            <span class="star-inner" style="width:100%"></span>
                            <?php
                        } else if ($row['F_GRADE'] == 4) {
                            ?>
                            <span class="star-inner" style="width:80%"></span>
                            <?php
                        } else if ($row['F_GRADE'] == 3) {
                            ?>
                            <span class="star-inner" style="width:60%"></span>
                            <?php
                        } else if ($row['F_GRADE'] == 2) {
                            ?>
                            <span class="star-inner" style="width:40%"></span>
                            <?php
                        } else if ($row['F_GRADE'] == 1) {
                            ?>
                            <span class="star-inner" style="width:20%"></span>
                            <?php
                        }
                        ?>
                        </span>
                    </td>
                    <td class="last"><?php echo $row['F_ADMIN_NAME'] ?></td>
                </tr>
                <?php
            }
            ?>
            <!-- //set -->
			</tbody>
		</table>

        <div class="box-paging">
            <?php
            if ($allPost != 0) {
                echo $paging;
            } else {
                echo '검색된 결과가 없습니다.';
            }
            ?>
        </div>

		<div class="box-btn t-r">
			<a href="/admin/index.php?mode=write" class="btn-m">강의 등록</a>
		</div>
	</div>
</div>
<?php include '../include/footer.php'; ?>