<div class="span10">
    <article>
        <h1>글확인</h1>
        <hr>
        제목 : <input type="hidden" name="title" placeholder="제목" class="span12" value="<?php echo $lists[0]->title?>"/><?php echo $lists[0]->title?><br/>
        본문 : <input type="hidden" name="content" placeholder="본문" class="span12" rows="15"><?php echo $lists[0]->content?></><br/>
        이름 : <input type="hidden" name="name" placeholder="이름" class="span12" value="<?php $lists[0]->name?>"/><?php echo $lists[0]->name?>
        <hr>
        <a href="" class="btn">수정</a>
        <a href="/board/get" class="btn">목록</a>
        <hr>

    </article>
    <div>

    </div>

</div>