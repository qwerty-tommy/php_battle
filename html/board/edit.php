<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header('Location: ../login/login.php');
    exit();
}

require_once('../../config/login_config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bno = $_POST['bno'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    // 게시물 업데이트 쿼리 실행
    $sql = "UPDATE board SET title = '$title', content = '$content' WHERE idx = '$bno'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // 수정 성공 시
        echo "<script>alert('게시물이 수정되었습니다.');</script>";
        echo "<script>location.href = 'board.php';</script>";
        exit();
    } else {
        // 수정 실패 시
        echo "<script>alert('게시물 수정에 실패했습니다.');</script>";
        echo "<script>history.back();</script>";
        exit();
    }
} else {
    // GET 요청일 경우 게시물 정보 가져오기
    $bno = $_GET['bno'];

    $sql = "SELECT * FROM board WHERE idx = '$bno'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $board = mysqli_fetch_assoc($result);
    } else {
        // 해당 게시물이 존재하지 않을 경우
        echo "<script>alert('존재하지 않는 게시물입니다.');</script>";
        echo "<script>history.back();</script>";
        exit();
    }
}
?>

<!-- HTML 부분 -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>게시물 수정</title>
</head>
<body>
    <h2>게시물 수정</h2>
    <form method="post" action="edit_post.php">
        <input type="hidden" name="bno" value="<?php echo $board['idx']; ?>">
        <div>
            <label for="title">제목</label>
            <input type="text" id="title" name="title" value="<?php echo $board['title']; ?>">
        </div>
        <div>
            <label for="content">내용</label>
            <textarea id="content" name="content"><?php echo $board['content']; ?></textarea>
        </div>
        <button type="submit">수정하기</button>
    </form>
</body>
</html>
