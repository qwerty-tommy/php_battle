<!doctype html>
<head>
	<meta charset="UTF-8">
	<title>게시판</title>
	<link rel="stylesheet" href="../style/style_board.css">

</head>
<body>
<div id="board_area"> 
  <h1>게시판</h1>
  
  <div id="search_box">
    <form action="search/search_result.php" method="get">
      <select name="catgo">
        <option value="title">제목</option>
        <option value="name">글쓴이</option>
        <option value="content">내용</option>
      </select>
      <input type="text" name="search" size="40" required="required" /> <button>검색</button>
      <input type="hidden" name="page" value="1" />
    </form>
    </div>
    
    <table class="list-table">
      <thead>
          <tr>
          <hr>
              <th width="70">번호</th>
                <th width="500">제목</th>
                <th width="120">글쓴이</th>
                <th width="100">작성일</th>
                <th width="100">조회수</th>
            </tr>
        </thead>
        <?php
          require_once('../../config/login_config.php');
          $sql = mysqli_query($conn,"ALTER TABLE board AUTO_INCREMENT=1");
          $sql = mysqli_query($conn,"SET @COUNT = 0");
          $sql = mysqli_query($conn,"UPDATE board SET board.idx = @COUNT:=@COUNT+1");
          
          
           if(isset($_GET['page'])){
          $page = $_GET['page'];
            }else{
              $page = 1;
            }
              $sql = mysqli_query($conn,"select * from board");
              $row_num = mysqli_num_rows($sql); 
              $list = 10; 
              $block_ct = 5; 

              $block_num = ceil($page/$block_ct); 
              $block_start = (($block_num - 1) * $block_ct) + 1; 
              $block_end = $block_start + $block_ct - 1; 

              $total_page = ceil($row_num / $list);
              if($block_end > $total_page) $block_end = $total_page; 
              $total_block = ceil($total_page/$block_ct); 
              $start_num = ($page-1) * $list; //시작번호 (page-1)에서 $list를 곱한다.

              $sql2 = mysqli_query($conn,"select * from board order by idx desc limit $start_num, $list"); 
          
          
          
            while($board = $sql2->fetch_array())
            {
              $title=$board["title"]; 
              if(strlen($title)>30)
              { 
                $title=str_replace($board["title"],mb_substr($board["title"],0,30,"utf-8")."...",$board["title"]);
              }
        ?>
      <tbody>
        <tr>
          <td width="70"><?php echo $board['idx']; ?></td>
          <td width="500"><a href="read.php?idx=<?php echo $board["idx"];?>"><?php echo $title;?></a></td>
          <td width="120"><?php echo $board['name']?></td>
          <td width="100"><?php echo $board['date']?></td>
          <td width="100"><?php echo $board['hit']; ?></td>
        </tr>
      </tbody>
      <?php } ?>
    </table>
     <hr>
    <div id="page_num">
      <ul>
        <?php
          
          if($page <= 1)
          { 
            
          }else{
          $pre = $page-1; 
            echo "<li><a href='?page=$pre'>이전</a></li>"; 
          }
          for($i=$block_start; $i<=$block_end; $i++){ 
            
            if($page == $i){ 
              echo "<li class='fo_re'>[$i]</li>"; 
            }else{
              echo "<li><a href='?page=$i'>[$i]</a></li>"; 
            }
          }
          if($block_num >= $total_block){ 
          }else{
            $next = $page + 1; 
            echo "<li><a href='?page=$next'>다음</a></li>"; 
          }
         
        ?>
      </ul>
    </div>
   <br>
   <br>
    <div id="write_btn">
      <a href="write.php"><button>글쓰기</button></a>
    </div>
  </div>
</body>
</html>
