<?php
require_once("../database/dbconfig.php");
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
//session_start();

$f_name = $_SESSION['f_name'];
$f_id = $_SESSION['f_id'];
$f_num = $_GET['f_num'];

//var_dump($f_num);

// 일반 게시글
$sql = 'SELECT * FROM BOARD WHERE F_NUM = '. $f_num;
$result_normal = $conn->query($sql);
$row = $result_normal->fetch_assoc();

$sql = 'UPDATE BOARD SET F_COUNT = F_COUNT + 1 WHERE F_NUM = '. $f_num;
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
    <?php include '../include/left.php'; ?>

	<div id="content" class="content">
		<div class="tit-box-h3">
			<h3 class="tit-h3">수강후기</h3>
			<div class="sub-depth">
				<span><i class="icon-home"><span>홈</span></i></span>
				<span>직무교육 안내</span>
				<strong>수강후기</strong>
			</div>
		</div>

		<table border="0" cellpadding="0" cellspacing="0" class="tbl-bbs-view">
			<caption class="hidden">수강후기</caption>
			<colgroup>
				<col style="*"/>
				<col style="width:20%"/>
			</colgroup>
			<tbody>
				 <tr>
					<th scope="col" name="f_title" id="f_title"><?php echo $row['F_TITLE'] ?></th>
                    <th scope="col" class="user-id">작성자 | <?php echo $row['F_ID'] ?><br>조회수 | <?php echo $row['F_COUNT'] ?><br>등록일 | <?php echo $row['F_REG_TIME'] ?></th>
				 </tr>
				<tr>
					<td colspan="2">
						<div class="box-rating">
							<span class="tit_rating">강의만족도</span>
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
						</div>
                        <?php echo $row['F_CONTENTS'] ?>
					</td>
				</tr>
			</tbody>
		</table>
		<?php
        $sql = "SELECT a.F_LECTURE as F_LECTURE,  a.F_INSTRUCTOR as F_INSTRUCTOR, a.F_LEARNING_TIME as F_LEARNING_TIME, a.F_LECTURE_COUNT as F_LECTURE_COUNT, a.F_GRADE as F_GRADE, b.F_THUMBNAIL_NAME_CRYPTO as F_THUMBNAIL_NAME_CRYPTO";
        $sql = $sql .= " FROM LECTURE a join THUMBNAIL b on a.F_THUMBNAIL_ID = b.F_THUMBNAIL_ID where a.F_LECTURE = (SELECT F_LECTURE FROM BOARD WHERE F_NUM = '$f_num')";
        $result_lecture = $conn->query($sql);
        $row_lecture = $result_lecture->fetch_assoc();
//        var_dump($sql);
        ?>
		
		<p class="mb15"><strong class="tc-brand fs16"><?php echo $row['F_ID'] ?>님의 수강하신 강의 정보</strong></p>
		
		<table border="0" cellpadding="0" cellspacing="0" class="tbl-lecture-list">
			<caption class="hidden">강의정보</caption>
			<colgroup>
				<col style="width:166px"/>
				<col style="*"/>
				<col style="width:110px"/>
			</colgroup>
			<tbody>
				<tr>
					<td>
						<a href="#" class="sample-lecture">
							<img src="../admin/thumbnail/<?php echo $row_lecture['F_THUMBNAIL_NAME_CRYPTO'] ?>" alt="" width="144" height="101" />
							<span onclick='location.href="/admin/thumbnail_download.php?f_thumbnail_name_crypto=<?php echo $row_lecture['F_THUMBNAIL_NAME_CRYPTO'] ?>"' class="tc-brand" >첨부파일 다운로드</span>
						</a>
					</td>
					<td class="lecture-txt">
						<em class="tit mt10"><?php echo $row_lecture['F_LECTURE'] ?></em>
						<p class="tc-gray mt20">강사: <?php echo $row_lecture['F_INSTRUCTOR'] ?> |
                            학습난이도 :
                            <span class="star-rating">
                            <?php
                            if ($row_lecture['F_GRADE'] == 5) {
                                ?>
                                <span class="star-inner" style="width:100%"></span>
                                <?php
                            } else if ($row_lecture['F_GRADE'] == 4) {
                                ?>
                                <span class="star-inner" style="width:80%"></span>
                                <?php
                            } else if ($row_lecture['F_GRADE'] == 3) {
                                ?>
                                <span class="star-inner" style="width:60%"></span>
                                <?php
                            } else if ($row_lecture['F_GRADE'] == 2) {
                                ?>
                                <span class="star-inner" style="width:40%"></span>
                                <?php
                            } else if ($row_lecture['F_GRADE'] == 1) {
                                ?>
                                <span class="star-inner" style="width:20%"></span>
                                <?php
                            }
                            ?>
                            </span> |
                            교육시간: <?php echo $row_lecture['F_LEARNING_TIME'] ?>시간 (<?php echo $row_lecture['F_LECTURE_COUNT'] ?>강)</p>
					</td>
					<td class="t-r"><a href="#" class="btn-square-line">강의<br />상세</a></td>
				</tr>
			</tbody>
		</table>

        <div class="box-btn t-r">
            <a href="/lecture_board/index.php?mode=list" class="btn-m-gray">목록</a>
            <?php
            if (isset($_SESSION['f_name']) && ($_SESSION['f_id'] == $row['F_ID'])) {
            ?>
            <a href="/lecture_board/index.php?mode=write&f_gubun=modify&f_num=<?php echo $row['F_NUM'] ?>" class="btn-m ml5">수정</a>
            <a href="/lecture_board/modify.php?f_gubun=delete&f_num=<?php echo $f_num ?>" class="btn-m-dark">삭제</a>
            <?php
            }
            ?>
        </div>
        <?php
        $data_list = array();
        $data_page = array();

        if (isset($_GET['page'])) {
            $data_list["page"] = $_GET['page'];
        }

        if (isset($_GET['f_num'])) {
            $data_page["f_num"] = $_GET['f_num'];
        }

        if (isset($_GET['f_category_id'])) {
            $data_list["f_category_id"] = $_GET['f_category_id'];
            $data_page["f_category_id"] = $_GET['f_category_id'];
        }

        if (isset($_GET['f_lecture'])) {
            $data_list["f_lecture"] = $_GET['f_lecture'];
            $data_page["f_lecture"] = $_GET['f_lecture'];
        }

        if (isset($_GET['f_name'])) {
            $data_list["f_name"] = $_GET['f_name'];
            $data_page["f_name"] = $_GET['f_name'];
        }

        if (isset($_GET['f_search_content'])) {
            $data_list["f_search_content"] = $_GET['f_search_content'];
            $data_page["f_search_content"] = $_GET['f_search_content'];
        }

        $query_string_list = http_build_query($data_list);
        $query_string_page = http_build_query($data_page);
        $query_string_list = '&' . $query_string_list;
        $query_string_add = '&' . $query_string_page;

        // paging
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }

        $search_category = 'WHERE 1=1 ';

        if (isset($_GET['f_category_id'])) {
            $f_category_id = $_GET['f_category_id'];
            $search_category .= "AND F_CATEGORY_ID = '$f_category_id'";
        }

        if (isset($_GET['f_lecture'])) {
            $f_lecture = $_GET['f_lecture'];
            $search_category .= " AND F_LECTURE = '$f_lecture'";
        }

        if (isset($_GET['f_name'])) {
            $f_name = $_GET['f_name'];
            $search_category .= " AND F_NAME = '$f_name'";
        }

        $sql = "SELECT count(*) as cnt FROM BOARD ".$search_category." ORDER BY F_NUM DESC";

//        var_dump($sql);

        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        $allPost = $row['cnt']; //전체 게시글의 수

        $onePage = 5; // 한 페이지에 보여줄 게시글의 수
        $allPage = ceil($allPost / $onePage); // 전체 페이지의 수

//        if ($page < 1 || ($page > $allPage)) {
//            echo "존재하지 않는 페이지입니다.";
//        } else {
//            echo "존재하는 페이지입니다.";
//        }

        $oneSection = 6; // 한번에 보여줄 총 페이지 개수
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
            $paging .= '<a href="/lecture_board/step_03.php?page=1'.$query_string_add.'"><i class="icon-first"><span class="hidden">첫페이지</span></i></a>';
        }

        //첫 섹션이 아니라면 이전 버튼을 생성
        //var_dump($currentSection);
        if($currentSection != 1) {
            $paging .= '<a href="/lecture_board/step_03.php?page=' . $prevPage . $query_string_add. '"><i class="icon-prev"><span class="hidden">이전페이지</span></i></a>';
        }

        for($i = $firstPage; $i <= $lastPage; $i++) {
            if($i == $page) {
                $paging .= '<a href="#" class="active">'.$i.'</a>';
            } else {
                $paging .= '<a href="/lecture_board/step_03.php?page=' . $i .$query_string_add. '">' . $i . '</a>';
            }
        }

        //마지막 섹션이 아니라면 다음 버튼을 생성
        if($currentSection != $allSection) {
            $paging .= '<a href="/lecture_board/step_03.php?page=' . $nextPage . $query_string_add. '"><i class="icon-next"><span class="hidden">다음페이지</span></i></a>';
        }

        //마지막 페이지가 아니라면 끝 버튼을 생성
        if($page != $allPage) {
            $paging .= '<a href="/lecture_board/step_03.php?page=' . $allPage . $query_string_add. '"><i class="icon-last"><span class="hidden">마지막페이지</span></i></a>';
        }

        $paging .= '</ul>';

        $currentLimit = ($onePage * $page) - $onePage; //몇 번째의 글부터 가져오는지
//        var_dump($currentLimit); // 15
        $sqlLimit = ' LIMIT ' . $currentLimit . ', ' . $onePage; //limit sql 구문

        // 일반 게시글
        $sql = "SELECT * FROM BOARD ".$search_category." ORDER BY F_NUM DESC". $sqlLimit; //원하는 개수만큼 가져온다. (0번째부터 20번째까지)
        $result_normal = $conn->query($sql);
//        var_dump($sql);
        ?>
        <form name="search" method="post" action="/lecture_board/search.php">
            <div class="search-info">
                <input type="hidden" class="input-text" style="width:611px" name="mode" id="mode" value="view"/>
                <input type="hidden" class="input-text" style="width:611px" name="f_num" id="f_num" value="<?php echo @$_GET['f_num']?>"/>
                <div class="search-form f-r">
                    <select class="input-sel" style="width:158px" name="f_category_id" id="f_category_id" ?> >
                        <option value="all">전체</option>
                        <option value="1" <? if(@$_GET['f_category_id'] == 1) { echo "selected"; } ?> >어학 및 자격증</option>
                        <option value="2" <? if(@$_GET['f_category_id'] == 2) { echo "selected"; } ?> >공통역량</option>
                        <option value="3" <? if(@$_GET['f_category_id'] == 3) { echo "selected"; } ?> >일반직무</option>
                        <option value="4" <? if(@$_GET['f_category_id'] == 4) { echo "selected"; } ?> >산업직무</option>
                    </select>
                    <select class="input-sel" style="width:158px" name="f_search_detatil" id="f_search_detatil">
                        <option value="f_lecture" <? if(isset($_GET['f_lecture'])) { echo "selected"; } ?>>강의명</option>
                        <option value="f_name" <? if(isset($_GET['f_name'])) { echo "selected"; } ?>>작성자</option>
                    </select>
                    <input type="text" class="input-text" placeholder="상세조건 입력하세요." style="width:158px" name="f_search_content" id="f_search_content"\
                            value="<?php if (isset($_GET['f_lecture'])) echo $_GET['f_lecture']; if (isset($_GET['f_name'])) echo $_GET['f_name'];?>"/>
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
                <th scope="col">강좌만족도</th>
                <th scope="col">작성자</th>
            </tr>
            </thead>

            <tbody>
            <?php
            $sql = "SELECT * FROM BOARD ORDER BY F_COUNT DESC, F_NUM DESC LIMIT 3"; //원하는 개수만큼 가져온다. (0번째부터 20번째까지
            $result_best = $conn->query($sql);

            while ($row = $result_best->fetch_assoc()) {
                ?>
                <tr class="bbs-sbj">
                    <td><span class="txt-icon-line"><em>BEST</em></span></td>
                    <td><?php echo $row['F_CATEGORY'] ?></td>
                    <td>
                        <a href="/lecture_board/index.php?mode=view&f_num=<?php echo $row['F_NUM'] ?><?php echo $query_string_list ?>">
                            <span class="tc-gray ellipsis_line">수강 강의명 : <?php echo $row['F_LECTURE'] ?></span>
                            <strong class="ellipsis_line"><?php echo $row['F_TITLE'] ?></strong>
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
                    <td class="last"><?php echo $row['F_NAME'] ?></td>
                </tr>
                <?php
            }
            ?>
            <!-- set -->
            <?php
            while ($row = $result_normal->fetch_assoc()) {
                ?>
                <tr class="bbs-sbj">
                    <td><?php echo $row['F_NUM'] ?></td>
                    <td><?php echo $row['F_CATEGORY'] ?></td>
                    <td>
                        <a href="/lecture_board/index.php?mode=view&f_num=<?php echo $row['F_NUM'] ?><?php echo $query_string_list ?>">
                            <span class="tc-gray ellipsis_line">수강 강의명 : <?php echo $row['F_LECTURE'] ?></span>
                            <strong class="ellipsis_line"><?php echo $row['F_TITLE'] ?></strong>
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
                    <td class="last"><?php echo $row['F_NAME'] ?></td>
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
	</div>
</div>
    <?php include '../include/footer.php'; ?>
</div>
</body>
</html>
