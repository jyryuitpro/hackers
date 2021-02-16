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
    <?php include 'header.php'; ?>
<div id="container" class="container-full">
	<div id="content" class="content">
		<div class="inner">
			<div class="tit-box-h3">
				<h3 class="tit-h3">회원가입</h3>
				<div class="sub-depth">
					<span><i class="icon-home"><span>홈</span></i></span>
					<strong>회원가입</strong>
				</div>
			</div>

			<div class="join-step-bar">
				<ul>
					<li><i class="icon-join-agree"></i> 약관동의</li>
					<li><i class="icon-join-chk"></i> 본인확인</li>
					<li class="last on"><i class="icon-join-inp"></i> 정보입력</li>
				</ul>
			</div>

			<div class="section-content">
				<table border="0" cellpadding="0" cellspacing="0" class="tbl-col-join">
					<caption class="hidden">강의정보</caption>
					<colgroup>
						<col style="width:15%"/>
						<col style="*"/>
					</colgroup>

					<tbody>
						<tr>
							<th scope="col"><span class="icons">*</span>이름</th>
							<td><input type="text" class="input-text" style="width:302px" name="f_name" id="f_name"/></td>
						</tr>
						<tr>
							<th scope="col"><span class="icons">*</span>아이디</th>
							<td><input type="text" class="input-text" style="width:302px" name="f_id" id="f_id" placeholder="영문자로 시작하는 4~15자의 영문소문자, 숫자"/><a href="#" class="btn-s-tin ml10">중복확인</a></td>
						</tr>
						<tr>
							<th scope="col"><span class="icons">*</span>비밀번호</th>
							<td><input type="password" class="input-text" style="width:302px" name="f_password_0" id="f_password_0" placeholder="8-15자의 영문자/숫자 혼합"/></td>
						</tr>
						<tr>
							<th scope="col"><span class="icons">*</span>비밀번호 확인</th>
							<td><input type="password" class="input-text" style="width:302px" name="f_password_1" id="f_password_1"/></td>
						</tr>
						<tr>
							<th scope="col"><span class="icons">*</span>이메일주소</th>
							<td>
								<input type="text" class="input-text" style="width:138px" name="f_email_0" id="f_email_0"/> @ <input type="text" class="input-text" style="width:138px" name="f_email_1" id="f_email_1"/>
								<select class="input-sel" style="width:160px">
									<option value="">선택입력</option>
									<option value="">선택입력</option>
									<option value="">선택입력</option>
									<option value="">선택입력</option>
									<option value="">선택입력</option>
								</select>
							</td>
						</tr>
						<tr>
							<th scope="col"><span class="icons">*</span>휴대폰 번호</th>
							<td>
								<input type="text" class="input-text" style="width:50px"/> - 
								<input type="text" class="input-text" style="width:50px"/> - 
								<input type="text" class="input-text" style="width:50px"/>
							</td>
						</tr>
						<tr>
							<th scope="col"><span class="icons"></span>일반전화 번호</th>
							<td><input type="text" class="input-text" style="width:88px"/> - <input type="text" class="input-text" style="width:88px"/> - <input type="text" class="input-text" style="width:88px"/></td>
						</tr>
						<tr>
							<th scope="col"><span class="icons">*</span>주소</th>
							<td>
								<p >
									<label>우편번호 <input type="text" class="input-text ml5" style="width:242px" disabled /></label><a href="#" class="btn-s-tin ml10">주소찾기</a>
								</p>
								<p class="mt10">
									<label>기본주소 <input type="text" class="input-text ml5" style="width:719px"/></label>
								</p>
								<p class="mt10">
									<label>상세주소 <input type="text" class="input-text ml5" style="width:719px"/></label>
								</p>
							</td>
						</tr>
						<tr>
							<th scope="col"><span class="icons">*</span>SMS수신</th>
							<td>
								<div class="box-input">
									<label class="input-sp">
										<input type="radio" name="radio" id="" checked="checked"/>
										<span class="input-txt">수신함</span>
									</label>
									<label class="input-sp">
										<input type="radio" name="radio" id="" />
										<span class="input-txt">미수신</span>
									</label>
								</div>
								<p>SMS수신 시, 해커스의 혜택 및 이벤트 정보를 받아보실 수 있습니다.</p>
							</td>
						</tr>
						<tr>
							<th scope="col"><span class="icons">*</span>메일수신</th>
							<td>
								<div class="box-input">
									<label class="input-sp">
										<input type="radio" name="radio2" id="" checked="checked"/>
										<span class="input-txt">수신함</span>
									</label>
									<label class="input-sp">
										<input type="radio" name="radio2" id="" />
										<span class="input-txt">미수신</span>
									</label>
								</div>
								<p>메일수신 시, 해커스의 혜택 및 이벤트 정보를 받아보실 수 있습니다.</p>
							</td>
						</tr>
					</tbody>
				</table>

				<div class="box-btn">
					<a href="#" class="btn-l">회원가입</a>
				</div>
			</div>
		</div>
	</div>
</div>
    <?php include 'footer.php'; ?>
</div>
</body>
</html>
