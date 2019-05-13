<?php session_start(); 

$page="" ; 

if(!defined( 'IN_GS')){ die( 'you cannot load this page directly.'); } 

/**************************************************** * 
* @File: template.php 
* @Package: GetSimple 
* @Action: gsStellar theme for GetSimple CMS 
* @Author: KingArchee | kingarchee.pl 
* @Adapted by: CodeCobber 
* *****************************************************/ 
?>

<!DOCTYPE HTML>
<html>

<head>
    <title>
        <?php get_page_clean_title(); ?> |
        <?php get_site_name(); ?>
    </title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--[if lte IE 8]><script src="<?php get_theme_url(); ?>/assets/js/ie/html5shiv.js"></script><![endif]-->

    <!--[if lte IE 9]><link rel="stylesheet" href="<?php get_theme_url(); ?>/assets/css/ie9.css" /><![endif]-->
    <!--[if lte IE 8]><link rel="stylesheet" href="<?php get_theme_url(); ?>/assets/css/ie8.css" /><![endif]-->
    <link rel="stylesheet" href="<?php get_theme_url(); ?>/assets/css/formmain.css" />
    <?php get_header(); ?>
    <meta name="description" content="<?php get_page_meta_desc(); ?>" />
    <meta name="keywords" content="<?php get_page_meta_keywords(); ?>" />


</head>

<body class="<?php get_page_slug(); ?>">

    <?php include( 'assets/includes/imageId.php'); ?>

    <!-- Wrapper -->
    <div id="wrapper">
        <?php include( "assets/includes/flags.php") ?>

        <!-- Header -->
        <header id="header">
            <span class="image main">
						<img src="<?php get_site_url(); ?>data/uploads/<?php echo $page ?>.png" alt="<?php get_page_slug(); ?>" />
					</span>
            <h1><?php get_page_title(); ?></h1>
            <p>
                <?php get_page_meta_desc(); ?>
            </p>
        </header>

        <!-- Nav -->
        <nav id="nav">
            <ul>

                <?php get_i18n_navigation(return_page_slug()); ?>

            </ul>
            <small id="breadcrumbsNav">
							<a href="<?php echo find_url('index',null); ?>">
								<?php echo $_SESSION['home'] ?>
								<?php get_i18n_breadcrumbs(return_page_slug()); ?>				
							</a>
						</small>
        </nav>

        <!-- Main -->
        <div id="main">

            <section id="content" class="main">
                <?php 
                // define variables and set to empty values $nameErr=$ emailErr=$ genderErr=$ websiteErr="" ; $name=$ email=$ gender=$ comment=$ website="" ; if ($_SERVER[ "REQUEST_METHOD"]=="POST" ) { if (empty($_POST[ "name"])) { $nameErr="Name is required" ; } else { $name=t est_input($_POST[ "name"]); // check if name only contains letters and whitespace if (!preg_match( "/^[a-zA-Z ]*$/",$name)) { $nameErr="Only letters and white space allowed" ; } } if (empty($_POST[ "email"])) { $emailErr="Email is required" ; } else { $email=t est_input($_POST[ "email"]); // check if e-mail address is well-formed if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { $emailErr="Invalid email format" ; } } if (empty($_POST[ "website"])) { $website="" ; } else { $website=t est_input($_POST[ "website"]); // check if URL address syntax is valid (this regular expression also allows dashes in the URL) if (!preg_match( "/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) { $websiteErr="Invalid URL" ; } } if (empty($_POST[ "comment"])) { $comment="" ; } else { $comment=t est_input($_POST[ "comment"]); } if (empty($_POST[ "gender"])) { $genderErr="Gender is required" ; } else { $gender=t est_input($_POST[ "gender"]); } } function test_input($data) { $data=t rim($data); $data=s tripslashes($data); $data=h tmlspecialchars($data); return $data; } ?>

                <h2>PHP Form Validation Example</h2>
                <p><span class="error">* required field.</span>
                </p>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF "]);?>">
                    Name:
                    <input type="text" name="name" value="<?php echo $name;?>">
                    <span class="error">* <?php echo $nameErr;?></span>
                    <br>
                    <br> E-mail:
                    <input type="text" name="email" value="<?php echo $email;?>">
                    <span class="error">* <?php echo $emailErr;?></span>
                    <br>
                    <br> Website:
                    <input type="text" name="website" value="<?php echo $website;?>">
                    <span class="error"><?php echo $websiteErr;?></span>
                    <br>
                    <br> Comment:
                    <textarea name="comment" rows="5" cols="40">
                        <?php echo $comment;?>
                    </textarea>
                    <br>
                    <br> Gender:
                    <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female" ) echo "checked";?> value="female">Female
                    <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male" ) echo "checked";?> value="male">Male
                    <span class="error">* <?php echo $genderErr;?></span>
                    <br>
                    <br>
                    <input type="submit" name="submit" value="Submit">
                </form>

                <?php echo "<h2>Your Input:</h2>"; echo $name; echo "<br>"; echo $email; echo "<br>"; echo $website; echo "<br>"; echo $comment; echo "<br>"; echo $gender; ?>

            </section>
        </div>

        <!-- Footer -->
        <footer id="footer">
            <span style="margin:0 auto">
					<?php include("assets/includes/flags.php") ?></span>

            <p class="copyright">&copy;
                <?php echo date( "Y"); ?>
                <?php get_site_name(); ?>.
                <?php get_site_credits(); ?>. Design based on Stellar by HTML5up</p>
        </footer>

    </div>

    <!-- Scripts -->
    <script src="<?php get_theme_url(); ?>/assets/js/navCon.js"></script>
    <script src="<?php get_theme_url(); ?>/assets/js/jquery.min.js"></script>
    <script src="<?php get_theme_url(); ?>/assets/js/jquery.scrollex.min.js"></script>
    <script src="<?php get_theme_url(); ?>/assets/js/jquery.scrolly.min.js"></script>
    <script src="<?php get_theme_url(); ?>/assets/js/skel.min.js"></script>
    <script src="<?php get_theme_url(); ?>/assets/js/util.js"></script>
    <!--[if lte IE 8]><script src="<?php get_theme_url(); ?>/assets/js/ie/respond.min.js"></script><![endif]-->
    <script src="<?php get_theme_url(); ?>/assets/js/main.js"></script>

    

    <?php get_footer(); 


    //EMAIL ---------------------------------------------------------------

    $post_name = "";
    $post_email = "";
    $post_website = "";
    $post_comment = "";
    $post_gender = "";

    $count=0;

    $fields = array('name','email','website','comment','gender');

    // loop through the array and check if post data has been sent

    while($count<sizeof($fields)){
        if(isset($_POST[$fields[$count]])){
            ${'post_'.$fields[$count]} = htmlspecialchars($_POST[$fields[$count]]);
        }
        $count++;
    }

    //check for required fields value and send email
    if(!empty($post_name) && !empty($post_email)){

        $to = "codecobber@gmail.com";
        $subject = "HIML form test email";

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: HIML site' . "\r\n";
        $headers .= 'Cc: craig.adams@nhs24.scot.nhs.uk' . "\r\n";

        $message = "<table style='color:#000'>
                        <tr>
                            <td><b>Name:</b> $post_name</td>
                        </tr>
                        <tr> 
                            <td><b>Email:</b> $post_email</td>
                        </tr>
                        <tr>
                            <td><b>Website:</b> $post_website</td>
                        </tr>
                        <tr>
                            <td><b>Comment:</b> $post_comment</td>
                        </tr>
                        <tr>
                            <td><b>Gender:</b> $post_gender</td>
                        </tr>
                    </table>";

        mail($to,$subject,$message,$headers);
    }

   // END EMAIL --------------------------------------------------------

    ?>
</body>

</html>