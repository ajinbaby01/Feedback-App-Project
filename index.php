<?php include 'inc/header.php' ?>

<?php
$name = $email = $body = '';
$nameErr = $emailErr = $bodyErr = '';

if (isset($_POST['submit'])) {
  if (empty($_POST['name'])) {
    $nameErr = 'Name is required';
  } else {
    $name = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  }

  if (empty($_POST['email'])) {
    $emailErr = 'Email is required';
  } else {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  }

  if (empty($_POST['body'])) {
    $bodyErr = 'Feedback is required';
  } else {
    $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  }

  if (empty($nameErr) && empty($emailErr) && empty($bodyErr)) {
    $sql = "INSERT INTO feedback(name, email, body) VALUES('$name', '$email','$body')";

    if (mysqli_query($conn, $sql)) {
      header('Location: feedback.php');
    } else {
      echo 'Error' . mysqli_error($conn);
    }
  }
}
?>

<img src="/php-crash/feedback/img/open.jpeg" class="w-25 mb-3" alt="">
<h2>Feedback</h2>
<p class="lead text-center">Leave feedback for OPEN</p>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" class="mt-4 w-75">

  <div class="mb-3">
    <label for="name" class="form-label">Name
      <?php if (isset($_POST['submit']) && empty($name)) : ?>
        <pre>     Name is required</pre>
      <?php endif; ?>
    </label>
    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name">
  </div>

  <div class="mb-3">
    <label for="email" class="form-label">Email
      <?php if (isset($_POST['submit']) && empty($email)) : ?>
        <pre>     Email is required</pre>
      <?php endif; ?>
    </label>
    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
  </div>

  <div class="mb-3">
    <label for="body" class="form-label">Feedback
      <?php if (isset($_POST['submit']) && empty($body)) : ?>
        <pre>     Feedback is required</pre>
      <?php endif; ?>
    </label>
    <textarea class="form-control" id="body" name="body" placeholder="Enter your feedback"></textarea>
  </div>

  <div class="mb-3">
    <input type="submit" name="submit" value="Send" class="btn btn-dark w-100">
  </div>
</form>

<?php include 'inc/footer.php' ?>