<script type="text/javascript">
    $(document).ready(function(){
        //main_slider_applyclass
        var bnrWrap = $('.slider-applyclass')
        var bnr_slider = bnrWrap.find('.bxslider');

        slider = bnr_slider.bxSlider({
            auto: true,
            mode : 'fade',
            cutLimit: 4,
            speed: 500,
            autoStart:true,
            pagerCustom: '#bx-pager-apply',
            onSliderLoad: function(selector){
                bnrWrap.css("overflow","visible");
            }
        });
        $('.page-applyclass').mouseover(function(){
            slider.startAuto();
        });
    });
</script>

<div id="footer" class="footer">
    <div class="inner p-r">
        <img src="http://img.hackershrd.com/common/logo_footer.png" class="logo-footer" alt="해커스 HRD LOGO" width="165" height="37"/>
        <div class="site-info">
            <div class="link-box">
                <a href="#">해커스 소개</a>
                <a href="#">이용약관</a>
                <a href="#"><strong class="tc-brand">개인정보취급방침</strong></a>
                <a href="#">CONTACT US</a>
                <a href="#">상담/고객센터</a>
                <?php
                if ($_SESSION['f_authority'] == '0') {
                ?>
                <a href="/admin/index.php?mode=list"><img src="/admin/image/btn_hackershrd_inconve.png"> 관리자</a>
                <?php
                }
                ?>
            </div>
            <div class="address">
                ㈜챔프스터디 | 사업자등록번호 [120-87-09984] | TEL : 02)537-5000<br />
                서울특별시 서초구 강남대로61길 23(서초동 1316-15) 현대성우빌딩 203호<br />
                대표이사 : 전재윤 | 개인정보관리책임자 : 김병철<br />
                통신판매업신고(제 2008-서울서초-0396호) 정보조회 부가통신사업신고(신고번호 : 013760)<br />
            </div>
        </div>
        <a href="javascript:void(window.open('https://pgweb.uplus.co.kr/pg/wmp/mertadmin/jsp/mertservice/s_escrowYn.jsp?mertid=champescrow','','scrollbars=no,width=340,height=262,top=150,left=550'))" class="lg-info"><img src="http://img.hackershrd.com/common/lg_info.gif" alt="고객님은 안전거래를 위해 교재(유료)가 포함된 상품을 무통장 입금으로 결제하시는 경우 챔프스터디가 가입한 LG U+의 구매안전 서비스를 이용하실 수 있습니다.* LG U+의 결제대금예치업 등록번호 : 02-006-00001" width="163" height="114"/></a>
    </div>
</div>