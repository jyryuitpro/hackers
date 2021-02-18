<?php
session_start();
$f_name = $_SESSION['f_name'];
$f_id = $_SESSION['f_id'];

$db = new mysqli('192.168.56.108', 'root', '', 'hackers');
if($db->connect_error) {
    die('데이터베이스 연결 문제');
}
$db->set_charset("utf-8");

$f_num = $_GET['f_num'];

// 일반 게시글
$sql = 'SELECT * FROM BOARD WHERE F_NUM = '. $f_num;
$result_normal = $db->query($sql);
$row = $result_normal->fetch_assoc();
//var_dump($row);
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
					<th scope="col" class="user-id">작성자 | <?php echo $row['F_ID'] ?></th>
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
							<img src="http://via.placeholder.com/144x101" alt="" width="144" height="101" />
							<span class="tc-brand">샘플강의 ▶</span>
						</a>
					</td>
					<td class="lecture-txt">
						<em class="tit mt10"><?php echo $row['F_LECTURE'] ?></em>
						<p class="tc-gray mt20">강사: 최환규 | 학습난이도 : 하 | 교육시간: 18시간 (18강)</p>
					</td>
					<td class="t-r"><a href="#" class="btn-square-line">강의<br />상세</a></td>
				</tr>
			</tbody>
		</table>

		<div class="box-btn t-r">
			<a href="/lecture_board/index.php?mode=list" class="btn-m-gray">목록</a>
			<a href="/lecture_board/index.php?mode=write&f_gubun=modify&f_num=<?php echo $row['F_NUM'] ?>" class="btn-m ml5">수정</a>
			<a href="#" class="btn-m-dark">삭제</a>
		</div>

        <?php
        $db = new mysqli('192.168.56.108', 'root', '', 'hackers');
        if($db->connect_error) {
            die('데이터베이스 연결에 문제');
        }
        $db->set_charset("utf-8");

        // paging
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }

        $sql = "SELECT count(*) as cnt FROM BOARD ORDER BY F_NUM DESC";
        $result = $db->query($sql);
        $row = $result->fetch_assoc();

        $allPost = $row['cnt']; //전체 게시글의 수
        $onePage = 5; // 한 페이지에 보여줄 게시글의 수
        $allPage = ceil($allPost / $onePage); // 전체 페이지의 수

        if ($page < 1 || ($page > $allPage)) {
            echo "존재하지 않는 페이지입니다.";
        } else {
            echo "존재하는 페이지입니다.";
        }

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
            $paging .= '<a href="/lecture_board/step_01.php?page=1"><i class="icon-first"><span class="hidden">첫페이지</span></i></a>';
        }

        //첫 섹션이 아니라면 이전 버튼을 생성
        //var_dump($currentSection);
        if($currentSection != 1) {
            $paging .= '<a href="/lecture_board/step_01.php?page=' . $prevPage . '"><i class="icon-prev"><span class="hidden">이전페이지</span></i></a>';
        }

        for($i = $firstPage; $i <= $lastPage; $i++) {
            if($i == $page) {
                $paging .= '<a href="#" class="active">'.$i.'</a>';
            } else {
                $paging .= '<a href="/lecture_board/step_01.php?page=' . $i . '">' . $i . '</a>';
            }
        }

        //마지막 섹션이 아니라면 다음 버튼을 생성
        if($currentSection != $allSection) {
            $paging .= '<a href="/lecture_board/step_01.php?page=' . $nextPage . '"><i class="icon-next"><span class="hidden">다음페이지</span></i></a>';
        }

        //마지막 페이지가 아니라면 끝 버튼을 생성
        if($page != $allPage) {
            $paging .= '<a href="/lecture_board/step_01.php?page=' . $allPage . '"><i class="icon-last"><span class="hidden">마지막페이지</span></i></a>';
        }

        $paging .= '</ul>';

        $currentLimit = ($onePage * $page) - $onePage; //몇 번째의 글부터 가져오는지
        $sqlLimit = ' LIMIT ' . $currentLimit . ', ' . $onePage; //limit sql 구문

        // 일반 게시글
        $sql = 'SELECT * FROM BOARD ORDER BY F_NUM DESC'. $sqlLimit; //원하는 개수만큼 가져온다. (0번째부터 20번째까지
        $result_normal = $db->query($sql);

        ?>

		<div class="search-info">
			<div class="search-form f-r">
				<select class="input-sel" style="width:158px">
					<option value="">분류</option>
				</select>
				<select class="input-sel" style="width:158px">
					<option value="">강의명</option>
					<option value="">작성자</option>
				</select>
				<input type="text" class="input-text" placeholder="강의명을 입력하세요." style="width:158px"/>
				<button type="button" class="btn-s-dark">검색</button>
			</div>
		</div>

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
            <!-- set -->
            <tr class="bbs-sbj">
                <td><span class="txt-icon-line"><em>BEST</em></span></td>
                <td>CS</td>
                <td>
                    <a href="/lecture_board/index.php?mode=view">
                        <span class="tc-gray ellipsis_line">수강 강의명 : Beyond Trouble, 조직을 감동시키는 관계의 기술</span>
                        <strong class="ellipsis_line">절대 후회 없는 강의 예요!</strong>
                    </a>
                </td>
                <td>
						<span class="star-rating">
							<span class="star-inner" style="width:80%"></span>
						</span>
                </td>
                <td class="last">이름</td>
            </tr>
            <!-- //set -->
            <!-- set -->
            <?php
            while ($row = $result_normal->fetch_assoc()) {
                ?>
                <tr class="bbs-sbj">
                    <td><?php echo $row['F_NUM'] ?></td>
                    <td><?php echo $row['F_CATEGORY'] ?></td>
                    <td>
                        <a href="/lecture_board/index.php?mode=view&f_num=<?php echo $row['F_NUM'] ?>">
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
            <?php echo $paging ?>
        </div>
	</div>
</div>
    <?php include '../include/footer.php'; ?>
</div>
</body>
</html>
