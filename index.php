<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "portfolio";

try {
    
    $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

    
    $about = [];
    $sql = "SELECT * FROM about LIMIT 1"; 
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $about = $stmt->fetch(PDO::FETCH_ASSOC);

   
    $projects = [];
    $sql = "SELECT * FROM projects"; 
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}


$conn = null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="script.js"></script>
</head>
<body>
    <header class="header">
        <a href="#" class="logo"><span>Yedidiya</span></a>
        <nav class="navbar">
           
            <a href="#home">Home</a>
            <a href="#projects">Project</a>
            <a href="#about">About</a>
        </nav>
        <a href="#contact" class="contact">Contact</a>
    </header>
    <section id="home" class="home">
        <div class="home-content">
        <h3>Hello</h3>

        <h1>I am <span>Yedidiya<br></span>a Website Developer & Designer</h1>
        <p>
            Hi, I'm Yedidiya, a passionate web developer with a love for creating clean, functional, and visually appealing websites. 
             I specialize in front-end and back-end development, ensuring that every project 
            I work on is not only beautiful but also highly functional and user-friendly.
        </p>
    
        <p>
            Let's work together to bring your ideas to life! Feel free to <a href="#contact" class="btn">contact me</a> if you'd like to collaborate 
            or just say hello.
        </p>
        </div>
        <div class="img">
            <img src="img.jpg" alt="">
        </div>
    </section>
    <section id="about" class="about">
    <div class="about-img">
    <img src="<?php echo $about['image_url']; ?>" alt="About Image">
    </div>
    <div class="about-content">
    <h2 class="heading"><?php echo $about['title']; ?></h2>
            <h3><?php echo $about['subtitle']; ?></h3>
            <p><?php echo $about['description']; ?></p>
            
    </div>
    </section>
    <section id="projects" class="projects">
        <?php foreach ($projects as $project): ?>
            <div class="project-item">
                <h3><?php echo $project['title']; ?></h3>
                <p><?php echo $project['description']; ?></p>
                <img src="<?php echo $project['image_url']; ?>" alt="<?php echo $project['title']; ?>">
                <a href="<?php echo $project['link']; ?>" class="btn">View Project</a>
                <!-- <a href="#" class="btn">projects</a> -->
            </div>
        <?php endforeach; ?>
    </section>
    <section id="contact" class="contact">
        <h2 class="contact-me">Contact Me </h2>
        <form action="submit_contact.php" method="POST">
            <div class="input-box">
                <input type="text" placeholder="Full Name" require>
                <input type="email" placeholder="Email"required>
            </div>

            <div class="input-box">
        <input type="number" name="phone_number" placeholder="Phone Number">
        <input type="text" name="subject" placeholder="Subject">
    </div>
    <textarea name="message" placeholder="Your Message" required></textarea>
            <input type="submit" value="Send Message" class="btn">
            <footer class="footer">
                <div class="social">
                    <a href="#"><i class='bx bxl-linkedin-square' ></i></a>
                    <a href="#"><i class='bx bxl-facebook-circle' ></i></a>
                    <a href="#"><i class='bx bxl-instagram' ></i></a>
                    <a href="#"><i class='bx bxl-github' ></i></a>
                </div>
                <ul class="list">
                    <li>
                        <a href="#">FAQ</a>
                    </li>
                    <li>
                        <a href="#">Project</a>
                    </li>
                    <li>
                        <a href="#">About Me</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                    <li>
                        <a href="#">Privacy Policy</a>
                    </li>
                </ul>
                <p class="copyright">@ 2024 Yedidiya |All Rights Reserved</p>
            </footer>



        </form>
    </section>
</body>
</html>