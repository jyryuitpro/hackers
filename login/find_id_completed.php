<?php
session_start();
//var_dump($_SESSION['find_name']);
//var_dump($_SESSION['find_id']);
?>
<?php include '../include/header.php'; ?>
<div id="container" class="container-full">
	<div id="content" class="content">
		<div class="inner">
			<div class="tit-box-h3">
				<h3 class="tit-h3">아이디/비밀번호 찾기</h3>
				<div class="sub-depth">
					<span><i class="icon-home"><span>홈</span></i></span>
					<strong>아이디/비밀번호 찾기</strong>
				</div>
			</div>

			<ul class="tab-list">
				<li class="on"><a href="/member/index.php?mode=find_id">아이디 찾기</a></li>
				<li><a href="/member/index.php?mode=find_pass">비밀번호 찾기</a></li>
			</ul>

			<div class="tit-box-h4">
				<h3 class="tit-h4">아이디 조회결과</h3>
			</div>

			<div class="guide-box">
				<p class="fs16 mb5"><?php echo $_SESSION['find_name']; ?> 회원님의 아이디는 아래와 같습니다.</p>
				<strong class="big-title tc-brand"><?php echo $_SESSION['find_id']; ?></strong>
			</div>

			<div class="box-btn mt30">
				<a href="/member/index.php?mode=login" class="btn-l">로그인하러 가기</a>
				<a href="/member/index.php?mode=find_pass" class="btn-l-line ml5">비밀번호 찾기</a>
			</div>

		</div>
	</div>
</div>
<?php include '../include/footer.php'; ?>
