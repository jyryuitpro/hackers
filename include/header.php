<?php
session_start();
?>
<div id="header" class="header">
    <div class="nav-section">
        <div class="inner p-r">
            <h1><a href="/"><img src="http://img.hackershrd.com/common/logo.png" alt="해커스 HRD LOGO" width="165" height="37"/></a></h1>
            <div class="nav-box">
                <h2 class="hidden">주메뉴 시작</h2>

                <ul class="nav-main-lst">
                    <li class="mnu">
                        <a href="#">어학 및 자격증</a>
                        <ul class="nav-sub-lst">
                            <li><a href="#">영어</a></li>
                            <li><a href="#">일본어</a></li>
                            <li><a href="#">중국어</a></li>
                            <li><a href="#">기타언어</a></li>
                            <li><a href="#">OA자격</a></li>
                        </ul>
                    </li>
                    <li class="mnu2">
                        <a href="#">공통역량</a>
                        <ul class="nav-sub-lst">
                            <li><a href="#">커뮤니케이션</a></li>
                            <li><a href="#">관계/협상</a></li>
                            <li><a href="#">업무관리/문제해결</a></li>
                            <li><a href="#">자기계발/교양</a></li>
                            <li><a href="#">OA</a></li>
                            <li><a href="#">법/법정교육</a></li>
                        </ul>
                    </li>
                    <li class="mnu3">
                        <a href="#">일반직무</a>
                        <ul class="nav-sub-lst">
                            <li><a href="#">경제일반</a></li>
                            <li><a href="#">경영일반</a></li>
                            <li><a href="#">마케팅</a></li>
                            <li><a href="#">영업</a></li>
                            <li><a href="#">인사/노무</a></li>
                            <li><a href="#">CS</a></li>
                            <li><a href="#">디자인</a></li>
                        </ul>
                    </li>
                    <li class="mnu4">
                        <a href="#">산업직무</a>
                        <ul class="nav-sub-lst">
                            <li><a href="#">금융/보험</a></li>
                            <li><a href="#">건설/환경</a></li>
                            <li><a href="#">IT/통신</a></li>
                        </ul>
                    </li>
                    <li class="mnu5">
                        <a href="#">직무교육 안내</a>
                        <ul class="nav-sub-lst">
                            <li><a href="#">서비스소개</a></li>
                            <li><a href="#">사업주지원과정 안내</a></li>
                            <li><a href="#">근로자카드 안내</a></li>
                            <li><a href="#">학습안내</a></li>
                            <li><a href="/lecture_board/index.php?mode=list">수강후기</a></li>
                            <li><a href="#">역량강화 자료모음</a></li>
                            <li><a href="#">실무 활용 무료자료</a></li>
                        </ul>
                    </li>
                    <li class="mnu6">
                        <a href="#">내 강의실</a>
                        <ul class="nav-sub-lst">
                            <li><a href="#">학습중인 강의</a></li>
                            <li><a href="#">학습 완료 강의</a></li>
                            <li><a href="#">결제/환불</a></li>
                            <li><a href="#">무통장입금</a></li>
                            <li><a href="#">환불문의</a></li>
                            <li><a href="#">관심강의</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

        <div class="nav-sub-box">
            <div class="inner"><!-- <a href="#"><img src="/" alt="배너이미지" width="171" height="196"></a> --></div>
        </div>

    </div>

    <div class="top-section">
        <div class="inner">
            <div class="link-box">
                <?php
                if (!$_SESSION['f_id']){
                ?>
                <!-- 로그인전 -->
                <a href="/member/index.php?mode=login">로그인</a>
                <a href="/member/index.php?mode=step_01">회원가입</a>
                <a href="#">상담/고객센터</a>
                <a href="#">관리자</a>
                <?php
                } else {
                ?>
                <!-- 로그인후 -->
                <a href="/member/index.php?mode=logout">로그아웃</a>
                <a href="/member/index.php?mode=modify">내정보</a>
                <a href="#">상담/고객센터</a>
                <a href="#">관리자</a>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>