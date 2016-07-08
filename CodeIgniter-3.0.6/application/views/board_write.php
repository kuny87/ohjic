<body>

    <form action="/board/Write" method="post" class="span10">
        <?php echo validation_errors(); ?>
        <h1>글쓰기</h1>
        <hr>
        <input type="text" id="title" name="title" placeholder="제목" class="span12"/>
        <textarea name="content" placeholder="본문" class="span12" rows="15"></textarea>
        <input type="text" id="name" name="name" placeholder="이름" class="span12"/>
        <hr>
        <input type="submit" class="btn" id="btn" />
        <a href="/board/get" class="btn">목록</a>
    </form>

</body>