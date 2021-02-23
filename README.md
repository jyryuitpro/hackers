# 해커스 신입사원 과제

### 프로젝트 구조

* [admin]
  + [image]
  + [thumbnail]
  + index.php
  + modify.php
  + regist.php
  + step_01.php
  + step_02.php
  + thumbnail_download.php
* [database]
  + dbconfig.php
* [include]
  + footer.php
  + header.php
  + left.php
* [lecture_board]
  + [attachment_file]
  + [daumeditor]
  + [tmp_attachment_file]
  + attachment_file_download.php
  + attachment_file_upload.php
  + index.php
  + modify.php
  + regist.php
  + search.php
  + step_01.php
  + step_02.php
  + step_03.php
* [login]
  + find_id.php
  + find_id_completed.php
  + find_password.php
  + find_password_completed.php
  + login.php
  + logout.php
  + modify_password.php
* [member]
  + certification.php
  + duplication_check.php
  + identification.php
  + index.php
  + login.php
  + modify.php
  + modify_myinfo.php
  + regist.php
  + step_01.php
  + step_02.php
  + step_03.php
  + step_04.php
* [sql]
  + hackers.sql
* index.php > 메인페이지

### 1. 회원가입 및 로그인 기능구현

#### 메인페이지 변경건

* 기존의 구현된 페이지 모두 header, footer 공통파일을 구조화하여 include 구문으로 작성할것
* 최대한 공통적인 부분을 구조화된 스킨이 관리될 수 있도록 할것
  + ![02](https://user-images.githubusercontent.com/67634983/108848560-79d78600-7624-11eb-9fc7-bfcdfd465826.png)
* 최상단 회원가입을 눌러 회원가입 1단계로 진행할수 있게함.
  + ![03](https://user-images.githubusercontent.com/67634983/108849264-506b2a00-7625-11eb-946a-1155b7c68c3a.png)
* index.html
  + index.php로 확장자 변경하여 적용

#### 회원가입 1단계(약관동의)

* 동의체크박스를 모두 체크해야 다음단계로 넘어갈수 있게 개발할것
* /member/index.php?mode=step_01
  + ![image](https://user-images.githubusercontent.com/67634983/108849746-dedfab80-7625-11eb-9843-bacb8db336b8.png)

#### 회원가입 2단계(본인확인)

* 휴대폰인증만 구현
* SESSION 에 인증번호 고정[123456] 지정하여 매칭후 본인확인 패스
* 아이핀 인증기능은 생략
* /member/index.php?mode=step_02
  + ![image](https://user-images.githubusercontent.com/67634983/108850167-61686b00-7626-11eb-9d4c-05f203d3a678.png)

#### 회원가입 3단계(회원정보입력)

* 필수항목 : * 화된 모든 개인정보
* 아이디  중복체크기능 추가할것
* 우편번호 찾기 다음 API활용
* 2단계에 입력받은 휴대폰 번호는 재입력 하지 않도록 디폴트 세팅할것(인증용으로 사용된 정보는 수정불가임을 확인)
* /member/index.php?mode=step_03
  + ![image](https://user-images.githubusercontent.com/67634983/108851329-a5a83b00-7627-11eb-8c06-7e4aab02b681.png)

#### 회원가입 처리단계

* 넘어온 항목 유효성 체크할것(필수정보, 중복처리유무 등등)
  + JavaScript로 처리
* 비밀번호는 sha256 암호화처리
  + PHP로 처리
* /member/index.php?mode=regist

#### 회원가입완료

* 로그인이 되어있지 않은 상태이며 로그인 버튼 클릭시 로그인 페이지로 이동
* /member/index.php?mode=complete
  + ![image](https://user-images.githubusercontent.com/67634983/108851984-61696a80-7628-11eb-8ccf-d21f4b221dcd.png)

#### 로그인/로그아웃기능 구현

* 세션으로 로그인함.
* 로그인 성공시 리퍼러를 활용한 페이지 리다이렉트 처리
* 로그인 실패시 로그인 실패사유에 대한 경고창(alert) 발생 및 다시 로그인하도록 복귀
* 로그인 및 로그아웃 상태에서 상단 로그인/로그아웃 버튼 변경 필요
* /member/login.html
  + ![image](https://user-images.githubusercontent.com/67634983/108852338-d63ca480-7628-11eb-9b50-7d21b849bc4d.png)
  + ![image](https://user-images.githubusercontent.com/67634983/108852393-e6ed1a80-7628-11eb-91d7-38bb44536fe9.png)
  + ![image](https://user-images.githubusercontent.com/67634983/108853132-b5c11a00-7629-11eb-875a-355c9d7e71f5.png)

### 2. 아이디 찾기/ 내정보수정 구현

#### 아이디/패스워드 찾기 구현

* 휴대폰,이메일 인증 모두구현
* 실제 메일, 휴대폰 인증번호(패스워드) 고정[123456] 조회되도록 세션처리하여 인증번호 확인절차 진행
* /member/index.php?mode=find_id
* /member/index.php?mode=find_pass
  + ![image](https://user-images.githubusercontent.com/67634983/108853380-00db2d00-762a-11eb-92dd-e27e90943e93.png)
  + ![image](https://user-images.githubusercontent.com/67634983/108854064-c8881e80-762a-11eb-8d76-11ee02425358.png)
  + ![image](https://user-images.githubusercontent.com/67634983/108854131-d9389480-762a-11eb-9ac5-b549fa0f18d5.png)
  + ![image](https://user-images.githubusercontent.com/67634983/108854248-01c08e80-762b-11eb-804d-d99d33baea85.png)
  + ![image](https://user-images.githubusercontent.com/67634983/108855465-64665a00-762c-11eb-84ed-bdd841ac11c7.png)
  + ![image](https://user-images.githubusercontent.com/67634983/108855872-c7f08780-762c-11eb-8b2d-e6e4c4d76bae.png)

#### 내정보수정 페이지 구현

* /member/index.php?mode=modify
  + ![image](https://user-images.githubusercontent.com/67634983/108856029-f8382600-762c-11eb-83d3-40f4d72d5cc7.png)

### 3. 수강후기 게시판 만들기

#### 주의사항

* 기존작업물에 추가하여 작업할것
* 상단GNB > 직무교육안내 > 수강후기 클릭시 이동
* 좌측 LNB 또한 구조화 하여 INCLUDE 처리
  + ![image](https://user-images.githubusercontent.com/67634983/108861966-23257880-7633-11eb-80aa-30689c19bc56.png)

#### 강의Admin 페이지 구성

* test.hackers.com/admin/index.php
* admin 계정으로 로그인 했을경우만 해당페이지로 접근가능
* 강의(Lecture) Table 스키마 추가구성(테이블 스키마는 [수강후기상세]에 노출되는 정보를 베이스로 구성
* 기본 분류항목 : 일반직무, 산업직무, 공통역량, 어학 및 자격증
* 별도의 관리페이지 생성하여 해당기능 구현 : 강의 등록/수정/삭제 
* 강의 썸네일 파일첨부(파일첨부시 웹관련 파일 업로드 금지(ex. .php/.html/.c 등등)
  + ![image](https://user-images.githubusercontent.com/67634983/108853132-b5c11a00-7629-11eb-875a-355c9d7e71f5.png)
  + ![image](https://user-images.githubusercontent.com/67634983/108856847-d1c6ba80-762d-11eb-8616-50a51e8eefcc.png)
  + ![image](https://user-images.githubusercontent.com/67634983/108857324-51ed2000-762e-11eb-94e3-36fe36cf1a23.png)
  + ![image](https://user-images.githubusercontent.com/67634983/108858120-29195a80-762f-11eb-8e37-823423d11bdb.png)
  + ![image](https://user-images.githubusercontent.com/67634983/108858314-5c5be980-762f-11eb-9fb3-ece6dea1fec6.png)
  + ![image](https://user-images.githubusercontent.com/67634983/108858441-7f869900-762f-11eb-96f6-9f1febce67d7.png)

#### 수강후기 리스트 페이지

* /lecture_board/index.php?mode=list
* 작성되어진 게시글이 최신글이 페이지당 20개씩 항상 상위에 위치되도록 할것
* 단, 1페이지에는 BEST글이 항상 상단에 카운트가 가장 높은 순으로 3개 위치할것
* 상단 카테고리탭 검색기능 구현
* 페이징 처리(맨처음, 이전, 다음, 맨마지막 버튼 또한 구현)
* 분류 : 일반직무/산업직무/공통역량/어학 및 자격증
* 강의명/작성자 검색 구현

#### 수강후기 등록/수정 페이지

* /lecture_board/index.php?mode=write
* 로그인상태에서만 글쓰기/수정 허용
* 분류/강의명은 강의 Admin 페이지에서 등록된 정보 추출하여 노출할것
* 다음 또는 네이버 웹 에디터삽입 할것

#### 수강후기 뷰 페이지

* /lecture_board/index.php?mode=view
* 구분/제목/작성자/조회수/등록일
* 첨부파일 다운로드 가능
* 수정/삭제 기능(본인이 작성한 글만 사용가능)
* 하단에 리스트 노출(페이지 구조화하여 가소화)
