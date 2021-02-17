
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

<link rel="stylesheet" href="./daumeditor/css/editor.css" type="text/css" charset="utf-8"/>
<script src="./daumeditor/js/editor_loader.js?environment=development" type="text/javascript" charset="utf-8"></script>
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

		<div class="user-notice">
			<strong class="fs16">유의사항 안내</strong>
			<ul class="list-guide mt15">
				<li class="tc-brand">수강후기는 신청하신 강의의 학습진도율 25%이상 달성시 작성가능합니다. </li>
				<li>욕설(욕설을 표현하는 자음어/기호표현 포함) 및 명예훼손, 비방,도배글, 상업적 목적의 홍보성 게시글 등 사회상규에 반하는 게시글 및 강의내용과 상관없는 서비스에 대해 작성한 글들은 삭제 될 수 있으며, 법적 책임을 질 수 있습니다.</li>
			</ul>
		</div>

		<table border="0" cellpadding="0" cellspacing="0" class="tbl-col">
			<caption class="hidden">강의정보</caption>
			<colgroup>
				<col style="width:15%"/>
				<col style="*"/>
			</colgroup>

			<tbody>
				<tr>
					<th scope="col">강의</th>
					<td>
						<select class="input-sel" style="width:160px">
							<option value="">분류</option>
						</select>
						<select class="input-sel ml5" style="width:454px">
							<option value="">강의명</option>
						</select>
					</td>
				</tr>
				<tr>
					<th scope="col">제목</th>
					<td><input type="text" class="input-text" style="width:611px"/></td>
				</tr>
				<tr>
					<th scope="col">강의만족도</th>
					<td>
						<ul class="list-rating-choice">
							<li>
								<label class="input-sp ico">
									<input type="radio" name="radio" id="" checked="checked"/>
									<span class="input-txt">만점</span>
								</label>
								<span class="star-rating">
									<span class="star-inner" style="width:100%"></span>
								</span>
							</li>
							<li>
								<label class="input-sp ico">
									<input type="radio" name="radio" id=""/>
									<span class="input-txt">만점</span>
								</label>
								<span class="star-rating">
									<span class="star-inner" style="width:80%"></span>
								</span>
							</li>
							<li>
								<label class="input-sp ico">
									<input type="radio" name="radio" id=""/>
									<span class="input-txt">만점</span>
								</label>
								<span class="star-rating">
									<span class="star-inner" style="width:60%"></span>
								</span>
							</li>
							<li>
								<label class="input-sp ico">
									<input type="radio" name="radio" id=""/>
									<span class="input-txt">만점</span>
								</label>
								<span class="star-rating">
									<span class="star-inner" style="width:40%"></span>
								</span>
							</li>
							<li>
								<label class="input-sp ico">
									<input type="radio" name="radio" id=""/>
									<span class="input-txt">만점</span>
								</label>
								<span class="star-rating">
									<span class="star-inner" style="width:20%"></span>
								</span>
							</li>
						</ul>
					</td>
				</tr>
			</tbody>
		</table>

		<div class="editor-wrap">
            <!-- 에디터 컨테이너 시작 -->
            <div id="tx_trex_container1" class="tx-editor-container">
                <!-- 사이드바 -->
                <div id="tx_sidebar1" class="tx-sidebar">
                    <div class="tx-sidebar-boundary">
                        <!-- 사이드바 / 첨부 -->
                        <ul class="tx-bar tx-bar-left tx-nav-attach">
                            <!-- 이미지 첨부 버튼 시작 -->
                            <!--
                                @decsription
                                <li></li> 단위로 위치를 이동할 수 있다.
                            -->
                            <li class="tx-list" style="z-index: 4;">
                                <div unselectable="on" id="tx_image1" class="tx-image tx-btn-trans">
                                    <a href="javascript:;" title="사진" onclick="Editor.switchEditor(1)" class="tx-text">사진</a>
                                </div>
                            </li>
                            <!-- 이미지 첨부 버튼 끝 -->
                            <li class="tx-list" style="z-index: 4;">
                                <div unselectable="on" id="tx_file1" class="tx-file tx-btn-trans">
                                    <a href="javascript:;" title="파일" onclick="Editor.switchEditor(1)" class="tx-text">파일</a>
                                </div>
                            </li>
                        </ul>
                        <!-- 사이드바 / 우측영역 -->
                        <ul class="tx-bar tx-bar-right">
                            <li class="tx-list" style="z-index: 4;">
                                <div unselectable="on" class="tx-btn-lrbg tx-fullscreen" id="tx_fullscreen1">
                                    <a href="javascript:;" class="tx-icon" title="넓게쓰기 (Ctrl+M)">넓게쓰기</a>
                                </div>
                            </li>
                        </ul>
                        <ul class="tx-bar tx-bar-right tx-nav-opt">
                            <li class="tx-list" style="z-index: 4;">
                                <div unselectable="on" class=" tx-switchtoggle" id="tx_switchertoggle1">
                                    <a href="javascript:;" title="에디터 타입">에디터</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- 툴바 - 기본 시작 -->
                <!--
                    @decsription
                    툴바 버튼의 그룹핑의 변경이 필요할 때는 위치(왼쪽, 가운데, 오른쪽) 에 따라 <li> 아래의 <div>의 클래스명을 변경하면 된다.
                    tx-btn-lbg: 왼쪽, tx-btn-bg: 가운데, tx-btn-rbg: 오른쪽, tx-btn-lrbg: 독립적인 그룹

                    드롭다운 버튼의 크기를 변경하고자 할 경우에는 넓이에 따라 <li> 아래의 <div>의 클래스명을 변경하면 된다.
                    tx-slt-70bg, tx-slt-59bg, tx-slt-42bg, tx-btn-43lrbg, tx-btn-52lrbg, tx-btn-57lrbg, tx-btn-71lrbg
                    tx-btn-48lbg, tx-btn-48rbg, tx-btn-30lrbg, tx-btn-46lrbg, tx-btn-67lrbg, tx-btn-49lbg, tx-btn-58bg, tx-btn-46bg, tx-btn-49rbg
                -->
                <div id="tx_toolbar_basic1" class="tx-toolbar tx-toolbar-basic">
                    <div class="tx-toolbar-boundary">
                        <ul class="tx-bar tx-bar-left">
                            <li class="tx-list" style="z-index: 4;">
                                <div id="tx_fontfamily1" unselectable="on" class="tx-fontfamily tx-slt-70bg">
                                    <a href="javascript:;" title="글꼴"><span>돋움</span></a>
                                </div>
                                <div id="tx_fontfamily_menu1" class="tx-fontfamily-menu tx-menu" unselectable="on"></div>
                            </li>
                        </ul>
                        <ul class="tx-bar tx-bar-left">
                            <li class="tx-list" style="z-index: 4;">
                                <div unselectable="on" class="tx-slt-42bg tx-fontsize" id="tx_fontsize1">
                                    <a href="javascript:;" title="글자크기"><span>10pt</span></a>
                                </div>
                                <div id="tx_fontsize_menu1" class="tx-fontsize-menu tx-menu" unselectable="on"></div>
                            </li>
                        </ul>
                        <ul class="tx-bar tx-bar-left tx-group-font">

                            <li class="tx-list" style="z-index: 4;">
                                <div unselectable="on" class="tx-btn-lbg tx-bold" id="tx_bold1">
                                    <a href="javascript:;" class="tx-icon" title="굵게 (Ctrl+B)">굵게</a>
                                </div>
                            </li>
                            <li class="tx-list" style="z-index: 4;">
                                <div unselectable="on" class="tx-underline tx-btn-bg" id="tx_underline1">
                                    <a href="javascript:;" class="tx-icon" title="밑줄 (Ctrl+U)">밑줄</a>
                                </div>
                            </li>
                            <li class="tx-list" style="z-index: 4;">
                                <div unselectable="on" class="tx-italic tx-btn-bg" id="tx_italic1">
                                    <a href="javascript:;" class="tx-icon" title="기울임 (Ctrl+I)">기울임</a>
                                </div>
                            </li>
                            <li class="tx-list" style="z-index: 4;">
                                <div unselectable="on" class="tx-strike tx-btn-bg" id="tx_strike1">
                                    <a href="javascript:;" class="tx-icon" title="취소선 (Ctrl+D)">취소선</a>
                                </div>
                            </li>
                            <li class="tx-list" style="z-index: 4;">
                                <div unselectable="on" class="tx-forecolor tx-slt-tbg" id="tx_forecolor1" style="background-color: rgb(18, 52, 86);">
                                    <a href="javascript:;" class="tx-icon" title="글자색">글자색</a>
                                    <a href="javascript:;" class="tx-arrow" title="글자색 선택">글자색 선택</a>
                                </div>
                                <div id="tx_forecolor_menu1" class="tx-menu tx-forecolor-menu tx-colorpallete" unselectable="on"></div>
                            </li>
                            <li class="tx-list" style="z-index: 4;">
                                <div unselectable="on" class="tx-slt-brbg tx-backcolor" id="tx_backcolor1" style="background-color: rgb(154, 165, 234);">
                                    <a href="javascript:;" class="tx-icon" title="글자 배경색">글자 배경색</a>
                                    <a href="javascript:;" class="tx-arrow" title="글자 배경색 선택">글자 배경색 선택</a>
                                </div>
                                <div id="tx_backcolor_menu1" class="tx-menu tx-backcolor-menu tx-colorpallete" unselectable="on"></div>
                            </li>
                        </ul>
                        <ul class="tx-bar tx-bar-left tx-group-align">
                            <li class="tx-list" style="z-index: 4;">
                                <div unselectable="on" class="tx-alignleft tx-btn-lbg-pushed" id="tx_alignleft1">
                                    <a href="javascript:;" class="tx-icon" title="왼쪽정렬 (Ctrl+,)">왼쪽정렬</a>
                                </div>
                            </li>
                            <li class="tx-list" style="z-index: 4;">
                                <div unselectable="on" class="tx-btn-bg tx-aligncenter" id="tx_aligncenter1">
                                    <a href="javascript:;" class="tx-icon" title="가운데정렬 (Ctrl+.)">가운데정렬</a>
                                </div>
                            </li>
                            <li class="tx-list" style="z-index: 4;">
                                <div unselectable="on" class="tx-btn-bg tx-alignright" id="tx_alignright1">
                                    <a href="javascript:;" class="tx-icon" title="오른쪽정렬 (Ctrl+/)">오른쪽정렬</a>
                                </div>
                            </li>
                            <li class="tx-list" style="z-index: 4;">
                                <div unselectable="on" class="tx-btn-rbg tx-alignfull" id="tx_alignfull1">
                                    <a href="javascript:;" class="tx-icon" title="양쪽정렬">양쪽정렬</a>
                                </div>
                            </li>
                        </ul>
                        <ul class="tx-bar tx-bar-left tx-group-tab">
                            <li class="tx-list" style="z-index: 4;">
                                <div unselectable="on" class="tx-btn-lbg tx-indent" id="tx_indent1">
                                    <a href="javascript:;" title="들여쓰기 (Tab)" class="tx-icon">들여쓰기</a>
                                </div>
                            </li>
                            <li class="tx-list" style="z-index: 4;">
                                <div unselectable="on" class="tx-outdent tx-btn-rbg" id="tx_outdent1">
                                    <a href="javascript:;" title="내어쓰기 (Shift+Tab)" class="tx-icon">내어쓰기</a>
                                </div>
                            </li>
                        </ul>
                        <ul class="tx-bar tx-bar-left tx-group-list">
                            <li class="tx-list" style="z-index: 4;">
                                <div unselectable="on" class="tx-lineheight tx-slt-31lbg" id="tx_lineheight1">
                                    <a href="javascript:;" class="tx-icon" title="줄간격"><span>줄간격</span></a>
                                    <a href="javascript:;" class="tx-arrow" title="줄간격">줄간격 선택</a>
                                </div>
                                <div id="tx_lineheight_menu1" class="tx-lineheight-menu tx-menu" unselectable="on"></div>
                            </li>
                            <li class="tx-list" style="z-index: 4;">
                                <div unselectable="on" class="tx-styledlist tx-slt-31rbg" id="tx_styledlist1">
                                    <a href="javascript:;" class="tx-icon" title="리스트"><span>리스트</span></a>
                                    <a href="javascript:;" class="tx-arrow" title="리스트">리스트 선택</a>
                                </div>
                                <div id="tx_styledlist_menu1" class="tx-styledlist-menu tx-menu" unselectable="on"></div>
                            </li>
                        </ul>
                        <ul class="tx-bar tx-bar-left tx-group-etc">
                            <li class="tx-list" style="z-index: 4;">
                                <div unselectable="on" class="tx-emoticon tx-btn-lbg" id="tx_emoticon1">
                                    <a href="javascript:;" class="tx-icon" title="이모티콘">이모티콘</a>
                                </div>
                                <div id="tx_emoticon_menu1" class="tx-emoticon-menu tx-menu" unselectable="on"></div>
                            </li>
                            <li class="tx-list" style="z-index: 4;">
                                <div unselectable="on" class="tx-link tx-btn-bg" id="tx_link1">
                                    <a href="javascript:;" class="tx-icon" title="링크 (Ctrl+K)">링크</a>
                                </div>
                                <div id="tx_link_menu1" class="tx-link-menu tx-menu"></div>
                            </li>
                            <li class="tx-list" style="z-index: 4;">
                                <div unselectable="on" class="tx-specialchar tx-btn-bg" id="tx_specialchar1">
                                    <a href="javascript:;" class="tx-icon" title="특수문자">특수문자</a>
                                </div>
                                <div id="tx_specialchar_menu1" class="tx-specialchar-menu tx-menu"></div>
                            </li>
                            <li class="tx-list" style="z-index: 4;">
                                <div unselectable="on" class="tx-table tx-btn-bg" id="tx_table1">
                                    <a href="javascript:;" class="tx-icon" title="표만들기">표만들기</a>
                                </div>
                                <div id="tx_table_menu1" class="tx-table-menu tx-menu" unselectable="on">
                                    <div class="tx-menu-inner">
                                        <div class="tx-menu-preview"></div>
                                        <div class="tx-menu-rowcol"></div>
                                        <div class="tx-menu-deco"></div>
                                        <div class="tx-menu-enter"></div>
                                    </div>
                                </div>
                            </li>
                            <li class="tx-list" style="z-index: 4;">
                                <div unselectable="on" class="tx-horizontalrule tx-btn-rbg" id="tx_horizontalrule1">
                                    <a href="javascript:;" class="tx-icon" title="구분선">구분선</a>
                                </div>
                                <div id="tx_horizontalrule_menu1" class="tx-horizontalrule-menu tx-menu" unselectable="on"></div>
                            </li>
                        </ul>
                        <ul class="tx-bar tx-bar-left">
                            <li class="tx-list" style="z-index: 4;">
                                <div unselectable="on" class="tx-richtextbox tx-btn-lbg" id="tx_richtextbox1">
                                    <a href="javascript:;" class="tx-icon" title="글상자">글상자</a>
                                </div>
                                <div id="tx_richtextbox_menu1" class="tx-richtextbox-menu tx-menu">
                                    <div class="tx-menu-header">
                                        <div class="tx-menu-preview-area">
                                            <div class="tx-menu-preview"></div>
                                        </div>
                                        <div class="tx-menu-switch">
                                            <div class="tx-menu-simple tx-selected">
                                                <a><span>간단 선택</span></a>
                                            </div>
                                            <div class="tx-menu-advanced">
                                                <a><span>직접 선택</span></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tx-menu-inner"></div>
                                    <div class="tx-menu-footer">
                                        <img class="tx-menu-confirm" src="./daumeditor/images/icon/editor/btn_confirm.gif?rv=1.0.1" alt="">
                                        <img class="tx-menu-cancel" hspace="3" src="./daumeditor/images/icon/editor/btn_cancel.gif?rv=1.0.1" alt="">
                                    </div>
                                </div>
                            </li>
                            <li class="tx-list" style="z-index: 4;">
                                <div unselectable="on" class="tx-quote tx-btn-bg" id="tx_quote1">
                                    <a href="javascript:;" class="tx-icon" title="인용구 (Ctrl+Q)">인용구</a>
                                </div>
                                <div id="tx_quote_menu1" class="tx-quote-menu tx-menu" unselectable="on"></div>
                            </li>
                            <li class="tx-list" style="z-index: 4;">
                                <div unselectable="on" class="tx-background tx-btn-bg" id="tx_background1">
                                    <a href="javascript:;" class="tx-icon" title="배경색">배경색</a>
                                </div>
                                <div id="tx_background_menu1" class="tx-menu tx-background-menu tx-colorpallete" unselectable="on"></div>
                            </li>

                        </ul>
                        <ul class="tx-bar tx-bar-left tx-group-undo">
                            <li class="tx-list" style="z-index: 4;">
                                <div unselectable="on" class="tx-undo tx-btn-lbg" id="tx_undo1">
                                    <a href="javascript:;" class="tx-icon" title="실행취소 (Ctrl+Z)">실행취소</a>
                                </div>
                            </li>
                            <li class="tx-list" style="z-index: 4;">
                                <div unselectable="on" class="tx-redo tx-btn-rbg" id="tx_redo1">
                                    <a href="javascript:;" class="tx-icon" title="다시실행 (Ctrl+Y)">다시실행</a>
                                </div>
                            </li>
                        </ul>
                        <ul class="tx-bar tx-bar-right" style="">
                            <li class="tx-list" style="z-index: 4;">
                                <div unselectable="on" class="tx-advanced tx-btn-nlrbg" id="tx_advanced1">
                                    <a href="javascript:;" class="tx-icon" title="툴바 더보기">툴바 더보기</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- 툴바 - 기본 끝 -->
                <!-- 툴바 - 더보기 시작 -->
                <div id="tx_toolbar_advanced1" class="tx-toolbar tx-toolbar-advanced">
                    <div class="tx-toolbar-boundary">
                        <ul class="tx-bar tx-bar-left">
                            <li class="tx-list">
                                <div class="tx-tableedit-title"></div>
                            </li>
                        </ul>
                        <ul class="tx-bar tx-bar-left tx-group-align">
                            <li class="tx-list" style="z-index: 4;">
                                <div unselectable="on" class="tx-btn-lbg tx-mergecells" id="tx_mergecells1">
                                    <a href="javascript:;" class="tx-icon2" title="병합"><span>병합</span></a>
                                </div>
                                <div id="tx_mergecells_menu1" class="tx-mergecells-menu tx-menu" unselectable="on"></div>
                            </li>
                            <li class="tx-list" style="z-index: 4;">
                                <div unselectable="on" class="tx-btn-bg tx-insertcells" id="tx_insertcells1">
                                    <a href="javascript:;" class="tx-icon2" title="삽입"><span>삽입</span></a>
                                </div>
                                <div id="tx_insertcells_menu1" class="tx-insertcells-menu tx-menu" unselectable="on"></div>
                            </li>
                            <li class="tx-list" style="z-index: 4;">
                                <div unselectable="on" class="tx-btn-rbg tx-deletecells" id="tx_deletecells1">
                                    <a href="javascript:;" class="tx-icon2" title="삭제"><span>삭제</span></a>
                                </div>
                                <div id="tx_deletecells_menu1" class="tx-deletecells-menu tx-menu" unselectable="on"></div>
                            </li>
                        </ul>

                        <ul class="tx-bar tx-bar-left tx-group-align">
                            <li class="tx-list" style="z-index: 4;">
                                <div id="tx_cellslinepreview1" unselectable="on" class="tx-slt-70lbg tx-cellslinepreview">
                                    <a href="javascript:;" title="선 미리보기"><span><table width="43" cellpadding="0" style="line-height:0"><tbody><tr><td valign="center" height="14"><div style="border-bottom:1pt solid #7c84ef;width:43px;height:2px;overflow:hidden;"></div></td></tr></tbody></table></span></a>
                                </div>
                                <div id="tx_cellslinepreview_menu1" class="tx-cellslinepreview-menu tx-menu" unselectable="on"></div>
                            </li>
                            <li class="tx-list" style="z-index: 4;">
                                <div id="tx_cellslinecolor1" unselectable="on" class="tx-slt-tbg tx-cellslinecolor" style="background-color: rgb(124, 132, 239);">
                                    <a href="javascript:;" class="tx-icon2" title="선색">선색</a>

                                    <div class="tx-colorpallete" unselectable="on"></div>
                                </div>
                                <div id="tx_cellslinecolor_menu1" class="tx-cellslinecolor-menu tx-menu tx-colorpallete" unselectable="on"></div>
                            </li>
                            <li class="tx-list" style="z-index: 4;">
                                <div id="tx_cellslineheight1" unselectable="on" class="tx-btn-bg tx-cellslineheight">
                                    <a href="javascript:;" class="tx-icon2" title="두께"><span>두께</span></a>
                                </div>
                                <div id="tx_cellslineheight_menu1" class="tx-cellslineheight-menu tx-menu" unselectable="on"></div>
                            </li>
                            <li class="tx-list" style="z-index: 4;">
                                <div id="tx_cellslinestyle1" unselectable="on" class="tx-btn-bg tx-cellslinestyle">
                                    <a href="javascript:;" class="tx-icon2" title="스타일"><span>스타일</span></a>
                                </div>
                                <div id="tx_cellslinestyle_menu1" class="tx-cellslinestyle-menu tx-menu" unselectable="on"></div>
                            </li>
                            <li class="tx-list" style="z-index: 4;">
                                <div id="tx_cellsoutline1" unselectable="on" class="tx-btn-rbg tx-cellsoutline">
                                    <a href="javascript:;" class="tx-icon2" title="테두리"><span>테두리</span></a>
                                </div>
                                <div id="tx_cellsoutline_menu1" class="tx-cellsoutline-menu tx-menu" unselectable="on"></div>
                            </li>
                        </ul>
                        <ul class="tx-bar tx-bar-left">
                            <li class="tx-list" style="z-index: 4;">
                                <div id="tx_tablebackcolor1" unselectable="on" class="tx-btn-lrbg tx-tablebackcolor" style="background-color:#9aa5ea;">
                                    <a href="javascript:;" class="tx-icon2" title="테이블 배경색">테이블 배경색</a>
                                </div>
                                <div id="tx_tablebackcolor_menu1" class="tx-tablebackcolor-menu tx-menu tx-colorpallete" unselectable="on"></div>
                            </li>
                        </ul>
                        <ul class="tx-bar tx-bar-left">
                            <li class="tx-list" style="z-index: 4;">
                                <div id="tx_tabletemplate1" unselectable="on" class="tx-btn-lrbg tx-tabletemplate">
                                    <a href="javascript:;" class="tx-icon2" title="테이블 서식">테이블 서식</a>
                                </div>
                                <div id="tx_tabletemplate_menu1" class="tx-tabletemplate-menu tx-menu tx-colorpallete" unselectable="on"></div>
                            </li>
                        </ul>

                    </div>
                </div>
                <!-- 툴바 - 더보기 끝 -->
                <!-- 편집영역 시작 -->
                <!-- 에디터 Start -->
                <div id="tx_canvas1" class="tx-canvas">
                    <div id="tx_loading1" class="tx-loading" style="display: none;">
                        <div><img src="./daumeditor/images/icon/editor/loading2.png" width="113" height="21" align="absmiddle"></div>
                    </div>
                    <div id="tx_canvas_wysiwyg_holder1" class="tx-holder" style="display:block;"><div class="tx-table-row-resize-dragger" style="position: absolute; overflow: hidden; top: 0px; left: 0px; width: 100%; height: 3px; cursor: row-resize; display: none;"></div><div class="tx-table-col-resize-dragger" style="position: absolute; overflow: hidden; top: 0px; left: 0px; width: 3px; height: 100%; cursor: col-resize; display: none;"></div>
                        <iframe id="tx_canvas_wysiwyg1" name="tx_canvas_wysiwyg" allowtransparency="true" frameborder="0" style="height: 414px;"></iframe>
                    </div>
                    <div class="tx-source-deco">
                        <div id="tx_canvas_source_holder1" class="tx-holder" style="display: none;">
                            <textarea id="tx_canvas_source1" rows="30" cols="30" style="background-color: rgb(255, 255, 255); color: rgb(18, 52, 86);"></textarea>
                        </div>
                    </div>
                    <div id="tx_canvas_text_holder1" class="tx-holder" style="display: none;">
                        <textarea id="tx_canvas_text1" rows="30" cols="30"></textarea>
                    </div>
                </div>
                <!-- 높이조절 Start -->
                <div id="tx_resizer1" class="tx-resize-bar">
                    <div class="tx-resize-bar-bg"></div>
                    <img id="tx_resize_holder1" src="./daumeditor/images/icon/editor/skin/01/btn_drag01.gif" width="58" height="12" unselectable="on" alt="">
                </div>
                <div class="tx-side-bi" id="tx_side_bi1"></div>
                <!-- 편집영역 끝 -->
                <!-- 첨부박스 시작 -->
                <!-- 파일첨부박스 Start -->
                <div id="tx_attach_div1" class="tx-attach-div">
                    <div id="tx_attach_txt1" class="tx-attach-txt"> 파일 첨부 </div>
                    <div id="tx_attach_box1" class="tx-attach-box">
                        <div class="tx-attach-box-inner">
                            <div id="tx_attach_preview1" class="tx-attach-preview">
                                <p></p>
                                <img src="./daumeditor/images/icon/editor/pn_preview.gif" width="147" height="108" unselectable="on">
                            </div>
                            <div class="tx-attach-main">
                                <div id="tx_upload_progress1" class="tx-upload-progress">
                                    <div>0%</div>
                                    <p>파일을 업로드하는 중입니다.</p>
                                </div>
                                <ul class="tx-attach-top">
                                    <li id="tx_attach_delete1" class="tx-attach-delete"><a>전체삭제</a></li>
                                    <li id="tx_attach_size1" class="tx-attach-size">
                                        파일: <span id="tx_attach_up_size1" class="tx-attach-size-up"></span> / <span id="tx_attach_max_size1"></span>
                                    </li>
                                    <li id="tx_attach_tools1" class="tx-attach-tools"></li>
                                </ul>
                                <ul id="tx_attach_list1" class="tx-attach-list"></ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 첨부박스 끝 -->
            </div>
            <!-- 에디터 컨테이너 끝 -->
		</div>
        <!-- 에디터 끝 -->
        <script type="text/javascript">
            var id = [];
            var value = [];
            var num = "";
            var formname = "";

            function daumeditor(formname, num, id, value) {
                var config = [];
                for (var i = 1; i <= num; i++) {
                    config[i] = {
                        txHost : '', /* 런타임 시 리소스들을 로딩할 때 필요한 부분으로, 경로가 변경되면 이 부분 수정이 필요. ex) http://xxx.xxx.com */
                        txPath : '', /* 런타임 시 리소스들을 로딩할 때 필요한 부분으로, 경로가 변경되면 이 부분 수정이 필요. ex) /xxx/xxx/ */
                        txService : 'sample', /* 수정필요없음. */
                        txProject : 'sample', /* 수정필요없음. 프로젝트가 여러개일 경우만 수정한다. */
                        initializedId : i, /* 대부분의 경우에 빈문자열 */
                        wrapper : "tx_trex_container" + i, /* 에디터를 둘러싸고 있는 레이어 이름(에디터 컨테이너) */
                        form : formname, /* 등록하기 위한 Form 이름 */
                        txIconPath : "./daumeditor/images/icon/editor/", /*에디터에 사용되는 이미지 디렉터리, 필요에 따라 수정한다. */
                        txDecoPath : "./daumeditor/images/deco/contents/", /*본문에 사용되는 이미지 디렉터리, 서비스에서 사용할 때는 완성된 컨텐츠로 배포되기 위해 절대경로로 수정한다. */
                        canvas : {
                            styles : {
                                color : "#123456", /* 기본 글자색 */
                                fontFamily : "돋움", /* 기본 글자체 */
                                fontSize : "10pt", /* 기본 글자크기 */
                                backgroundColor : "#fff", /*기본 배경색 */
                                lineHeight : "1.5", /*기본 줄간격 */
                                padding : "8px" /* 위지윅 영역의 여백 */
                            },
                            showGuideArea : false
                        },
                        events : { preventUnload : false },
                        sidebar : {
                            attachbox : { show : true },
                            attacher : { file : { popPageUrl : "./daumeditor/pages/trex/file.php?config=" + i } }
                        },
                        size : { }
                    };
                }
                EditorJSLoader.ready(function(Editor) {
                    var execString = "";
                    var temp = "";
                    $(".tx-editor-container").each(function(key, val){
                        execString = eventstring(key+1, temp);
                        temp = execString;
                    });
                    eval(execString);

                });
            }

            function eventstring(num, orig){
                var valuenum=num-1;

                var temp = "new Editor(config["+num+"]);Editor.getCanvas().observeJob(Trex.Ev.__IFRAME_LOAD_COMPLETE, function() {Editor.modify({content : value["+valuenum+"]}); "+ orig+" });";
                return temp;
            }
        </script>
		<div class="box-btn t-r">
			<a href="#" class="btn-m-gray">목록</a>
			<a href="#" class="btn-m ml5">저장</a>
		</div>
        <script type="text/javascript">
            // DaumEditor 관련
            var content = Array("wr_content");
            var EditorValue = Array("");
            // 다음에디터 갯수 중복일 경우
            var max = 1;

            var f = $("#fwrite");
            // submit 전 다음에디터 validation체크
            function validForm(editor) {
                var validator = new Trex.Validator();
                var content = editor.getContent();
                if (!validator.exists(content)) {
                    alert('내용을 입력하세요');
                    return false;
                }
                return true;
            }

            //validForm 함수가 true로 return된 후에 동작하는 함수
            function setForm(editor) {
                var form = editor.getForm();
                var content = editor.getContent();
                var textarea = document.createElement('textarea');
                //textarea를 생성하여 해당태그에 에디터 입력값들을 신규생성 textarea에 담는다
                textarea.name = 'wr_content';
                textarea.value = content;
                form.createField(textarea);
                return true;
            }

            $(function(){
                // daumeditor('폼이름','갯수','아이디','값');
                daumeditor('fwrite', max, content, EditorValue);
                if($(f).find('.tx-editor-container')) {
                    $('.tx-editor-container').each(function(key, val){
                        Editor.switchEditor(key+1);
                        Editor.modify({ "wr_content" : EditorValue[key] });
                    });
                }

                $("#btn_submit").on("click", function(){

                    if( $("#wr_2").val() =="" ){
                        alert("강의를 선택해주세요.")
                        $("#wr_2").focus();
                        return false;
                    }

                    if( $("#wr_4").val() =="" ){
                        alert("평점을 선택해주세요.")
                        $("#wr_4").focus();
                        return false;
                    }

                    if( $("#wr_subject").val() =="" ){
                        alert("제목을 입력해주세요.    ");
                        $("#wr_subject").focus();
                        return false;
                    }


                    var action_url = "./sub/epilogue/write.update.skin.php";
                    $("#fwrite").attr("action", action_url);

                    Editor.save(); // 이 함수를 호출하여 글을 등록하면 된다.

                });

            });


            function lectureListReload(tval){
                //alert(tval);
                var url = "./sub/epilogue/ajax.php";
                $.ajax({
                    type : "POST",
                    url : url,
                    cache : false,
                    data: {
                        "mode" : "lectureList",
                        "ca_name" : tval,
                        "mb_id" : "jyryujiyoung",

                    },
                    dataType: "JSON",
                    success : function(r){
                        $("#wr_2").html("");
                        $("#wr_2").html(r.opt_text);
                    }
                });

            }

        </script>
	</div>
</div>
    <?php include '../include/footer.php'; ?>
</div>
</body>
</html>
