<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

<script>
    //넘어온 검색어에 따른 변수셋팅
    <?php  if($this->input->get("search_word") == null){ ?>
        var search_word = null;
    <?php
        }
        else
        {
    ?>
    var search_word = <?php echo '"'.$this->input->get("search_word").'"'; ?>;
    <?php
    }
    ?>

    $(document).ready(function() {

        setListFunction();

    });



    function setListFunction(){
        $("#tbody").html('');


        var page = <?php echo $page;?>;

        //검색어가 없을때
        if(search_word == null || search_word == "") {

            var param = {"page": page};
            alert(1);

        //검색어가 있을때
        }else {

            var param = {"page" : page, "search_word" : search_word };
            alert(2);
        }

//            alert(param);

        $.ajax({
            url: "http://mma.qfun.kr/board/get_json",
            type: "GET",
            data: param,
            dataType: "json",
            success: function (result) {

                    alert(result[3].content);


//                    //-------------여기까지 했음------------//
//                    //console.log("totalRows" + responseData.totalRows);
//
                var contents = document.getElementById("t_contents").innerHTML;

                for (var i = 0; i < result.length; i++) {

                    var row = contents;

                    row = row.split("[num]").join(result[i].num);
                    row = row.split("[title]").join(result[i].title);
                    row = row.split("[name]").join(result[i].name);
                    row = row.split("[created]").join(result[i].created);

                    $("#tbody").append(row);

                }


            },

            error: function (request, status, error) {
                console.log('code: ' + request.status + "\n" + 'message: ' + request.responseText + "\n" + 'error: ' + error);
            }

        });


    }//end function()

    function search(){

        var val = $("#search_word").val();

        location.href = "/board/get?search_word="+val;

    }


</script>


<script id="t_contents" type="text/html">

    <tr>
        <td>[num]</td>
        <td><a href="/board/get_one/[num]">[title]</a></td>
        <td>[name]</td>
        <td>[created]</td>
    </tr>

</script>



<div class="span10">
<body style="text-align: center;">

    <h1>게시판</h1>
    <?php echo '게시글 수: '.$page."<br/>";
    echo '검색어: '.$search_word; ?>
    <hr>
        <table border="1" style="text-align: center;">
            <thead>
                <tr>
                    <td>번호</td>
                    <td>제목</td>
                    <td>작성자</td>
                    <td>날짜</td>
                </tr>
            </thead>

            <tbody id="tbody">
            </tbody>

        </table>

    <hr>

    <!--페이지네이션, 검색 및 글쓰기 버튼-->
    <div id="total" style="float:left;">
        <div id="page" style="margin: auto; width: 320px; float:left; border: 1px dotted; height: 20px;"><?php echo $link; ?></div>
        <div id="search"style="margin: auto; float: left width: 320px; height: 100%; text-align: right;">
            <form id="search_form">
                <input type="text" required="required" id="search_word" name="search_word" style="margin-top: 10px; height: 30px;">
                <button type="button" class="btn btn-default btn-success" onclick="search()">검색</button>
                <a href="/board/Write" class="btn">글쓰기</a>
            </form>
        </div>
    </div>


</body>
</div>