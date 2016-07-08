<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Scheduler</title>
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <!-- 합쳐지고 최소화된 최신 CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <!-- 합쳐지고 최소화된 최신 자바스크립트 -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

    <style>
        .selected {
            background-color: #FFF7F7;
        }
    </style>

    <script type="text/javascript">

        var mouseEvent = (function () {
            var dragStart = 0;
            var dragEnd = 0;
            var isDragging = false;
            var strDate;
            var endDate;

            function mouseDown (e) {
                if (isRightClick(e)) {
                    return false;
                } else {
                    var allCells = $("#tbody tr td");
                    dragStart = allCells.index($(this));
                    isDragging = true;

                    //strDate = e.target.textContent; // 마우스 드래그 시작 날짜 가져오기!!
                    mouseEvent.setStrDate(e);

                    if (typeof e.preventDefault != 'undefined') { e.preventDefault(); }
                    document.documentElement.onselectstart = function () { return false; };
                }
            }

            function mouseUp(e) {
                if (isRightClick(e)) {
                    return false;
                } else {
                    var allCells = $("#tbody tr td");
                    dragEnd = allCells.index($(this));



                    //endDate = e.target.textContent; // 마우스 드래그 제일 끝 날짜 가져오기!!
                    mouseEvent.setEndDate(e);
//                    $("#scheduleStart").html(strDate); // 해당 기간을 p 태그에 출력!
//                    $("#scheduleEnd").html(endDate); // 해당 기간을 p 태그에 출력!
                    $("#insert_modal").modal('show'); // show 모달!
                    isDragging = false;
                    if (dragEnd != 0) {
                        drawScope();
                    }

                    document.documentElement.onselectstart = function () { return true; };
                }
            }

            function mouseMove(e) {
                if (isDragging) {
                    var allCells = $("#tbody tr td");
                    dragEnd = allCells.index($(this));
                    drawScope();
                }
            }

            function mouseLeave(e) { // 마우스가 td 밖으로 이동하면 백그라운드 모두 삭제!
                $("#tbody tr td").removeClass('selected');
            }

            function drawScope() { // 선택된 부분들에 배경 색칠하기!
                $("#tbody tr td").removeClass('selected');
                if (dragEnd + 1 < dragStart) { // reverse select
                    $("#tbody tr td").slice(dragEnd, dragStart + 1).addClass('selected');
                } else {
                    $("#tbody tr td").slice(dragStart, dragEnd + 1).addClass('selected');
                }
            }

            function isRightClick(e) { // 마우스 우클릭 방지
                if (e.which) {
                    return (e.which == 3);
                } else if (e.button) {
                    return (e.button == 2);
                }
                return false;
            }

            return { // 아래 init과 scheduleInsert는 어디서든지 접근할 수 있는 publick이 됨
                init: function () { // monthView와 weekView에서 호출해야되므로 public으로!
                    $("#tbody tr td")
                        .mousedown(mouseDown)
                        .mouseup(mouseUp)
                        .mousemove(mouseMove)
                        .mouseleave(mouseLeave);
                },

                // 일정 시작일과 끝일을 getter / setter 로 만들어 놓는다.
                setStrDate : function(e) {
                    strDate = e.target.textContent;
                },

                getStrDate : function() {
                    return strDate;
                },

                setEndDate : function(e) {
                    endDate = e.target.textContent;
                },

                getEndDate : function() {
                    return endDate;
                },

            };

        })(); // mouseEvent 모듈 End



//        function test(hetd){
//            var $hetd =$(hetd);
//            alert($hetd.attr('data-year')+'년');
//            alert($hetd.attr('data-month')+'월');
//            alert($hetd.attr('data-date')+'일');
//            alert('td-id값: '+hetd.id);
//        }
//
//        var mouseEvent = (function(){
//
//            //전역변수로 일정 시작 날짜와 마지막 날짜 받아와서 세팅
//            var startDate = "";
//            var endDate = "";
//            //일정 등록 마지막 날짜에서 마우스를 뗐을 때
//            function mouseDown(e){
////                startDate = $("#tbody tr td").attr();
////                alert(startDate);
////                alert($(this));
//                if(isRightClick(e)) {
//                    return false;
//                }else {
//                    var $this = $(this);
//                    var tdId = $this.attr('id');
//                    $("tdId").backgroundColor = "red";
////                    alert(tdId);
//                    startDate = $this.attr('data-year') +'-'+ $this.attr('data-month')+'-'+$this.attr('data-date');
////                    alert(startDate);
//                }
//
//
////                alert($this.attr('data-year')+'년');
////                alert($this.attr('data-month')+'월');
////                alert($this.attr('data-date')+'일');
//            }
//
//            //일정 등록 시작 날짜에서 마우스 눌렀을 때
//            function mouseUp(e){
//                drawScope();
////                alert(2);
////                $(tdId).style.backgroundColor = "#c1c1c1";
//
//            }
//
//            //마우스를 드레그 할 때
//            function mouseMove(e){
//                alert(3);
//
//            }
//
//            //선택한 날짜 범위를 색칠해주는 함수
//            function drawScope(e){
////                alert(tdId);
//
//            }
//
//            function isRightClick(e) { // 마우스 우클릭 방지
//                if (e.which) {
//                    return (e.which == 3);
//                } else if (e.button) {
//                    return (e.button == 2);
//                }
//                return false;
//            }
//
//
//            return {
//
//                init : function(){
//                    $("#tbody tr td")
//                        .mousedown(mouseDown)
//                        .mouseup(mouseUp);
////                    alert(document.getElementById("2").innerHTML);
////                    alert($("#tbody_body tr td").attr('1'));
//                }
//
//            };
//
//        })();


        // 매달의 총 일 수와 해당 월의 시작일이 무슨요일인지 구하는 모듈
        var dateObj = (function (){

            return {

                //총 일수를 구함
                getTotal: function (year, month) {

                    if (month == 3 || month == 5 || month == 8 || month == 10) {
                        return 30;
                    }
                    else if (month == 1) //2월
                    {
                        if ((year % 4 == 0 && year % 100 != 0) || year % 400 == 0) { //2월이면서 윤년
                            return 29;
                        } else {
                            return 28;
                        }
                    } else {
                        return 31;
                    }
                }, //end getTotal

                //해당 월의 시작일이 무슨요일인지 구함
                getStartDay: function (year, month) {
                    var date = new Date();
                    date.setFullYear(year);
                    date.setMonth(month);
                    date.setDate(1);
                    return date.getDay(); // 해당 year, month의 시작 요일을 구해서 리턴
                } // end getStartDay()

            };

        })(); //end dateObj


        //달력을 '월','주'에 따라 그려주는 모듈
        var dateDraw = (function() {

            return {

                //'월' 달력을 그려주기 위한 함수
                monthView : function(year, month) {
                    var nowTotalDate = dateObj.getTotal(year, month); //현재 달의 총 일수
                    var preTotalDate = dateObj.getTotal(year, month-1); //이전 달의 총 일수
                    var startDay = dateObj.getStartDay(year, month); //현재 달의 시작 요일
                    var start_preDate = preTotalDate - startDay + 1; //현재 달력에서 이전 달의 시작하는 일자를 구함

                    var view = '<tr align="center">';

                    var count = 0;

                    //이전달 일부 들어가는 부분
                    if(startDay > 0){
                        //1월일 때
                        if(month == 0){
                            year = year-1;
                            month = 12;

                            for(var i = 0; i<startDay; i++) {
                                view += '<td id="' + 'tdId' +count + '" style="height: 120px;color:gray" ' +
                                    'data-year="'+year+'" data-month="'+month+'" data-date="'+start_preDate+'">' + start_preDate + '</td>';
                                start_preDate++;
                                count++;
                            }
                            year++;
                            month = 0;

                        //2월~12월일 때
                        }else{
                            for(var i = 0; i<startDay; i++) {
                                view += '<td id="' + 'tdId' + count + '" style="height: 120px;color:gray" ' +
                                    'data-year="'+year+'" data-month="'+month+'" data-date="'+start_preDate+'">' + start_preDate + '</td>';
                                start_preDate++;
                                count++;
                            }
                        }

                    }


                    //현재달 들어가는 부분
                    for(var i = 1; i<=nowTotalDate; i++) {

                        date = new Date();

                        if(i ==  date.getDate() && month == date.getMonth()){ //오늘 날짜 굵은 글씨
                            view += '<td id="' + 'tdId' + count + '" data-year="'+year+'" data-month="'+(month+1)+'" data-date="'+i+'" ><b>'+i+'</b></td>';
                            startDay++;
                            count++;
                        }

                        else if(startDay == 0) //요일이 일요일 일때 글씨색 붉은색으로 함
                        {
                            view += '<td id="' + 'tdId' + count + '" style="height: 120px;color:red" data-year="'+year+'" data-month="'+(month+1)+'" data-date="'+i+'">'+i+'</td>';
                            startDay++;
                            count++;
                        }
                        else if(startDay == 6) //요일이 토요일일때 글씨색 파란색으로 함
                        {
                            view += '<td id="' + 'tdId' + count + '" style="color:blue" data-year="'+year+'" data-month="'+(month+1)+'" data-date="'+i+'">'+i+'</td>';
                            startDay++;
                            count++;
                        }
                        else //평일 일때 글씨색 검정색으로 함
                        {
                            view += '<td id="' + 'tdId' + count + '" data-year="'+year+'" data-month="'+(month+1)+'" data-date="'+i+'">'+i+'</td>';
                            startDay++;
                            count++;
                        }

                        if(startDay > 6 && i < nowTotalDate) //테이블의 새로운 행을 추가
                        {
                            startDay = 0;
                            view += '</tr>';
                            view += '<tr align="center">';
                        }
                    }


                    //다음달 일부 들어가는 부분
                    if(startDay < 7) {
                        //12월일 때
                        if(month == 11){
                            year = year+1;
                            month = -1;
                        }

                        for (i = 1; startDay <= 6; i++) {
                            view += '<td id="' + 'tdId' + count + '" style="color:gray" data-year="'+year+'" data-month="'+(month+2)+'" data-date="'+i+'">'+i+'</td>';
                            startDay++;
                            count++;
                        }
                    }

                    $("#tbody").html(view); //해당 달의 view를 뿌려줌
                    mouseEvent.init();



                },//end monthView


                //'주' 달력을 그려주기 위한 함수
                weekView : function (date, week) {
                    date.setDate(date.getDate()+ week); // 현재 주간의 시작 '일요일'로 세팅

                    var title = date.getFullYear() + "년 " + (date.getMonth()+1)+ "월 " + date.getDate() + "일 ~ "; //주간

                    //세팅된 현재 주간의 일요일 날짜부터 토요일 날짜까지 +1씩 해주면서 td에 세팅
                    var view = "<tr align='center' >";

                    date2 = new Date();
                    var month2 = date2.getMonth();

                    for(var i=0; i<7; i++){
                        if(date.getDate() == date2.getDate() && month2 == date.getMonth()){
                            view += '<td style="height: 120px;"><b>'+ date.getDate() + '</b></td>';
                        }else{
                            view += '<td style="height: 120px;">'+ date.getDate() + '</td>';
                        }

                        date.setDate(date.getDate() + 1); //해당 주간 세팅
                    }
                    view += '</tr>';

                    title += date.getFullYear() + "년 " + (date.getMonth()+1) + "월 " + (date.getDate() -1) + "일";

                    date.setDate(date.getDate() - 7); // 다시 현재 주간의 일요일 세팅

                    $("#ym").html(title);
                    $("#tbody").html(view);

                } //end weekView

            };

        })(); //end dateDraw


    </script>


    <script type="text/javascript">

        $(function(){
            var flag = 1; // '월' 버튼 상태일 경우 1, '주' 버튼 상태일 경우 2로바꾸자

            var date = new Date();
            var year = date.getFullYear(); // 현재 로컬 시간의 년도를 구한다.
            var month = date.getMonth(); // 현재 로컬 시간의 월을 구한다.
            $("#ym").html(year + "년 " + (month+1) +"월"); // 현재 년도와 월을 입력한다.
            //var nowDate = date.getDate(); // 현재 '일'
            //var nowDay = date.getDay(); // 현재 '요일', 0부터 시작 (0-일요일, 1-월요일 ...)

            date = new Date(); // 주간의 현재 날짜 구하기

            dateDraw.monthView(year, month);

            var weekDate;

            // '월' 을 눌렀을 경우
            $("#month").click(function(e){
                flag = 1;
                e.preventDefault();
                $("#ym").html(year+"년 " + (month+1) +"월");
                dateDraw.monthView(year, month);
            }); //end month

            // '주'를 눌렀을 경우
            $("#week").click(function(e){
                flag = 2;
                e.preventDefault();

                date.setDate(date.getDate() - date.getDay()); // 현재 날짜의 첫 주 구하기
                dateDraw.weekView(date, 0); // 첫 주를 구했기 때문에 더할 숫자가 없다.
            }); //end week

            //오늘날짜로 돌아가기
            $("#today").click(function(e){
                e.preventDefault();
                if(flag == 1) {

                    date = new Date();
                    year = date.getFullYear();
                    month = date.getMonth();
                    $("#ym").html(year + "년 " + (month+1) + "월");
                    dateDraw.monthView(year,month);

                }else{

                    date = new Date();
                    date.setDate(date.getDate() - date.getDay());
                    dateDraw.weekView(date, 0);

                }
            }); //end today

            //이전 달로 가기
            $('#prev').click(function(e){
                e.preventDefault();
                if (flag == 1) {
//                    alert(month);
                    month = month - 1; // 월을 -1
                    if (month == -1) { // 1월일 경우
                        year = year - 1;
                        month = 11; // 12월 값이다.
                    }
                    $("#ym").html(year+"년 " + (month+1) +"월");
                    dateDraw.monthView(year, month);
                }
                else
                {
                    e.preventDefault();
                    dateDraw.weekView(date, -7); // 현재 주간 일요일에서 이전 주간의 일요일 날짜를 구하기 위해 -1이 필요!
                }
            }); //end prev

            //다음 달로 가기
            $("#next").click(function(e){
                e.preventDefault();
                // '월' 버튼 클릭 시
                if (flag == 1) {
                    month = month + 1;
                    if (month == 12) {
                        year = year + 1;
                        month = 0; // 1월 값이다.
                    }
                    $("#ym").html(year+"년 " + (month+1) +"월");
                    dateDraw.monthView(year, month);
                }
                // '주' 버튼 클릭 시
                else {
                    e.preventDefault();
                    dateDraw.weekView(date, 7); // 현재 주간 일요일에서 다음 주간 일요일 날짜를 구하기 위해 +1이 필요!
                }
            }); //end next

            $("#insert").click(function(){
                window.open('scheduler/insert','일정등록','width=400,height=300, top=150, right=200, menubar=no, status=no, toolbar=no, location=false');
            });
        });

    </script>

</head>


<body>



<div >

    <div>
        <button id="prev" style="height:25px; position: relative; bottom: 1px; left: 20px;" value=""><<</button>
        <button id="next" style="height:25px; position: relative; bottom: 1px; left: 20px;" value="">>></button>

        <button id="week" style="width: 50px; height:25px; position: relative; left: 200px;">주</button>
        <button id="month" style="width: 50px; height:25px; position: relative; left: 200px;">월</button>
        <button id="today" style="width: 50px; height:25px; position: relative; left: 200px;">오늘</button>
        <button id="insert" style="height:25px; position: relative; left: 200px;">일정등록</button>
    </div>

    <br/><br/>

    <div class="row">
        <div id="ym" class="col-xs-12" style="height: 25px; background-color: #faebcc; width: 100%; text-align: left; font-size: 20px; padding-left: 35px;">
        </div>
    </div>

    <br/><br/>

    <div>

        <table width='1200px' cellpadding='0' cellspacing='1' border="1px">
            <thead>
                <th height="30" align="center" bgcolor="#DDDDDD" onmousedown="mouseEvent.mouseStart()">일</th>
                <th align="center" bgcolor="#DDDDDD">월</th>
                <th align="center" bgcolor="#DDDDDD">화</th>
                <th align="center" bgcolor="#DDDDDD">수</th>
                <th align="center" bgcolor="#DDDDDD">목</th>
                <th align="center" bgcolor="#DDDDDD">금</th>
                <th align="center" bgcolor="#DDDDDD">토</th>
            </thead>
            <tbody id="tbody"></tbody>

        </table>

    </div>

    <button ondrag="mouseEvent.mouseStart()">클릭</button>

</div>

<!--Modal-->
<div class="modal fade bs-example-modal-lg" id="insert_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            ...
        </div>
    </div>
</div>



</body>

</html>
