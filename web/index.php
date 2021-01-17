<!--
  Create landing page for the rest of the course
    1) Introduction about yourself. Include a section about your interests
    2) Assignment page -- Coming soon!
        -Professional look and feel
        -Create html from scratch you can use libraries
        -Use external stylesheets
        -Use at least one image
        -Include colors to show creativity
        -No run time errors
        -Use php to do something
  -->


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CSE 341 - Rolando Rodriguez</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="./styles/main.css">
</head>
<body>
  

  <div id="container">
  <!-- Page header -->
  <?php
    include_once('./partials/header.php');
  ?>
  <!-- Page content -->
    <main>
      <div>
        <img id="profile-pic" src="./img/img.jpg" alt="Rolando Rodriguez">
      </div>
      <section>
        <h1>About me</h1>
        <p>
          My name is Rolando Rodriguez, my friends usually call me Rolo.
          I was born and raised in the Dominican Republic. I am an Industrial Engineer seeking
          a degree in Computer Programming from BYU Idaho. I have always been amazed by 
          the power of computers. I believe there are many opportunities to make 
          our lives better by using them properly.
        </p>
        <h1>My interests</h1>
        <ol>
          <li>Computer programming</li>
          <li>Star Wars, Lord of the Rings, Japanese Anime</li>
          <li>Language Learning: English, Spanish, Japanese</li>
          <li>Martial Arts</li>
          <li>Travel</li>
        </ol>
      </section>
    </main>
    <?php
    include_once('./partials/footer.php');
    ?>
  </div>

</body>
<script src="./js/main.js"></script>
</html> 