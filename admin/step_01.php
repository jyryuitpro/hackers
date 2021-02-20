<?php
require_once("../database/dbconfig.php");
//error_reporting(E_ALL);
//ini_set("display_errors", 1);

session_start();
$f_name = $_SESSION['f_name'];
$f_id = $_SESSION['f_id'];

$data = array();

//$data = array( 'f_category_id' => $_GET['f_category_id'],
//    'f_lecture' => $_GET['f_lecture'],
//    'f_admin_name' => $_GET['f_admin_name'],
//);

if (isset($_GET['f_category_id'])) {
    $data["f_category_id"] = $_GET['f_category_id'];
}

if (isset($_GET['f_lecture'])) {
    $data["f_lecture"] = $_GET['f_lecture'];
}

if (isset($_GET['f_admin_name'])) {
    $data["f_admin_name"] = $_GET['f_admin_name'];
}

$query_string = http_build_query($data);
$query_string_add = '';
if ($query_string) {
    $query_string_add = '&' . $query_string;
}

// paging
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

$search_category = 'WHERE 1=1 ';

if (isset($_GET['f_category_id']) && $_GET['f_category_id'] != "all") {
    $f_category_id = $_GET['f_category_id'];
    $search_category .= "AND F_CATEGORY_ID = '$f_category_id'";
}

if (isset($_GET['f_lecture'])) {
    $f_lecture = $_GET['f_lecture'];
    $search_category .= "AND F_LECTURE = '$f_lecture'";
}

if (isset($_GET['f_admin_name'])) {
    $f_admin_name = $_GET['f_admin_name'];
    $search_category .= "AND F_ADMIN_NAME = '$f_admin_name'";
}

$sql = "SELECT count(*) as cnt FROM LECTURE ".$search_category." ORDER BY F_NUM DESC";

$result = $conn->query($sql);
$row = $result->fetch_assoc();

$allPost = $row['cnt']; //전체 게시글의 수

$onePage = 5; // 한 페이지에 보여줄 게시글의 수
$allPage = ceil($allPost / $onePage); // 전체 페이지의 수

if ($page < 1 || ($page > $allPage)) {
    echo "존재하지 않는 페이지입니다.";
}

$oneSection = 3; // 한번에 보여줄 총 페이지 개수
$currentSection = ceil($page / $oneSection); // 현재 섹션

$allSection = ceil($allPage / $oneSection); // 전체 섹션의 수

$firstPage = ($currentSection * $oneSection) - ($oneSection - 1); //현재 섹션의 처음 페이지

if ($currentSection == $allSection) {
    $lastPage = $allPage; // 현재 섹션이 마지막 섹션이라면 $allPage가 마지막 페이지가 된다.
} else {
    $lastPage = $currentSection * $oneSection; //현재 섹션의 마지막 페이지
}

$prevPage = (($currentSection - 1) * $oneSection); //이전 페이지, 11~20일 때 이전을 누르면 10 페이지로 이동.
$nextPage = (($currentSection + 1) * $oneSection) - ($oneSection - 1); //다음 페이지, 11~20일 때 다음을 누르면 21 페이지로 이동.

$paging = '<ul>'; // 페이징을 저장할 변수
//첫 페이지가 아니라면 처음 버튼을 생성
if($page != 1) {
    $paging .= '<a href="/admin/step_01.php?page=1'.$query_string_add.'"><i class="icon-first"><span class="hidden">첫페이지</span></i></a>';
}

//첫 섹션이 아니라면 이전 버튼을 생성
//var_dump($currentSection);
if($currentSection != 1) {
    $paging .= '<a href="/admin/step_01.php?page=' . $prevPage . $query_string_add. '"><i class="icon-prev"><span class="hidden">이전페이지</span></i></a>';
}

for($i = $firstPage; $i <= $lastPage; $i++) {
    if($i == $page) {
        $paging .= '<a href="#" class="active">'.$i.'</a>';
    } else {
        $paging .= '<a href="/admin/step_01.php?page=' . $i .$query_string_add. '">' . $i . '</a>';
    }
}

//마지막 섹션이 아니라면 다음 버튼을 생성
if($currentSection != $allSection) {
    $paging .= '<a href="/admin/step_01.php?page=' . $nextPage . $query_string_add. '"><i class="icon-next"><span class="hidden">다음페이지</span></i></a>';
}

//마지막 페이지가 아니라면 끝 버튼을 생성
if($page != $allPage) {
    $paging .= '<a href="/admin/step_01.php?page=' . $allPage . $query_string_add. '"><i class="icon-last"><span class="hidden">마지막페이지</span></i></a>';
}

$paging .= '</ul>';

$currentLimit = ($onePage * $page) - $onePage; //몇 번째의 글부터 가져오는지
$sqlLimit = ' LIMIT ' . $currentLimit . ', ' . $onePage; //limit sql 구문

$sql = "SELECT * FROM LECTURE ".$search_category." ORDER BY F_NUM DESC ". $sqlLimit; //원하는 개수만큼 가져온다. (0번째부터 20번째까지)
$result_normal = $conn->query($sql);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ko" lang="ko">
<!--[if (IE 7)]><html class="no-js ie7" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ko" lang="ko"><![endif]-->
<!--[if (IE 8)]><html class="no-js ie8" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ko" lang="ko"><![endif]-->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" id="X-UA-Compatible" content="IE=EmulateIE8" />
<title>해커스 HRD</title>
<meta name="description" content="해커스 HRD" />
<meta name="keywords" content="해커스, HRD" />

<!-- 파비콘설정 -->
<link rel="shortcut icon" type="image/x-icon" href="http://img.hackershrd.com/common/favicon.ico" />

<!-- xhtml property속성 벨리데이션 오류/확인필요 -->
<meta property="og:title" content="해커스 HRD" />
<meta property="og:type" content="website" />
<meta property="og:url" content="http://www.hackershrd.com/" />
<meta property="og:image" content="http://img.hackershrd.com/common/og_logo.png" />

<link type="text/css" rel="stylesheet" href="http://q.hackershrd.com/worksheet/css/common.css" />
<link type="text/css" rel="stylesheet" href="http://q.hackershrd.com/worksheet/css/bxslider.css" />
<link type="text/css" rel="stylesheet" href="http://q.hackershrd.com/worksheet/css/main.css" /><!-- main페이지에만 호출 -->
<link type="text/css" rel="stylesheet" href="http://q.hackershrd.com/worksheet/css/sub.css" /><!-- sub페이지에만 호출 -->
<link type="text/css" rel="stylesheet" href="http://q.hackershrd.com/worksheet/css/login.css" /><!-- login페이지에만 호출 -->

<script type="text/javascript" src="http://q.hackershrd.com/worksheet/js/jquery-1.12.4.min.js"></script>
<script type="text/javascript" src="http://q.hackershrd.com/worksheet/js/plugins/bxslider/jquery.bxslider.min.js"></script>
<script type="text/javascript" src="http://q.hackershrd.com/worksheet/js/plugins/bxslider/bxslider.js"></script>
<script type="text/javascript" src="http://q.hackershrd.com/worksheet/js/ui.js"></script>
<!--[if lte IE 9]> <script src="/js/common/place_holder.js"></script> <![endif]-->

</head><body>
<!-- skip nav -->
<div id="skip-nav">
<a href="#content">본문 바로가기</a>
</div>
<!-- //skip nav -->

<div id="wrap">
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
                    <select class="input-sel" style="width:158px" name="f_category_id" id="f_category_id" ?> >
                        <option value="all">전체</option>
                        <option value="1" <? if($_GET['f_category_id'] == 1) { echo "selected"; } ?> >어학 및 자격증</option>
                        <option value="2" <? if($_GET['f_category_id'] == 2) { echo "selected"; } ?> >공통역량</option>
                        <option value="3" <? if($_GET['f_category_id'] == 3) { echo "selected"; } ?> >일반직무</option>
                        <option value="4" <? if($_GET['f_category_id'] == 4) { echo "selected"; } ?> >산업직무</option>
                        <option value="R">수강후기</option>
                    </select>
                    <select class="input-sel" style="width:158px" name="f_search_detatil" id="f_search_detatil">
                        <option value="f_lecture" <? if(isset($_GET['f_lecture'])) { echo "selected"; } ?>>강의명</option>
                        <option value="f_admin_name" <? if(isset($_GET['f_admin_name'])) { echo "selected"; } ?>>관리자</option>
                    </select>
                    <input type="text" class="input-text" placeholder="상세조건 입력하세요." style="width:345px" name="f_search_content" id="f_search_content"
                           value="<?php if (isset($_GET['f_lecture'])) echo $_GET['f_lecture']; if (isset($_GET['f_admin_name'])) echo $_GET['f_admin_name'];?>"/>
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
                        <a href="/admin/index.php?mode=view&f_gubun=modify&f_num=<?php echo $row['F_NUM'] ?><?php echo $query_string_add ?>">
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
                echo '검색된 수강후기가 없습니다. 다른 검색조건으로 검색해주세요.';
            }
            ?>
        </div>

		<div class="box-btn t-r">
			<a href="/admin/index.php?mode=write" class="btn-m">강의 등록</a>
		</div>
	</div>
</div>
    <?php include '../include/footer.php'; ?>
</div>
</body>
</html>
