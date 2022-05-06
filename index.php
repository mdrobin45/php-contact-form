<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Email Sender</title>
</head>
<body>
    <?php
    // If submit form
    if(isset($_POST['submit'])){
        // Form input value
        $fName = $_POST['fName'];
        $lName = $_POST['lName'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];

        // Form status variable
        $formNoticeClass = "";
        $formNoticeText = "";

        // Message template
        $messageTemplate = "<b>Name: </b>".$fName." ".$lName. "<br>". "<b>Email: </b>". $email. "<br>". "<b>Message: </b><br>". $message;
        
        // Headers type and version
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html\n";

        // Message send status
        $formNotice = array(
            array("sent", "noticeSuccess", "Your Message was sent Successfully!"),
            array("failed", "noticeFailed", "Sorry! Message was not sent, Try again Later."),
            array("empty", "noticeFailed", "All field is required")
        );
        
        // If input field is not empty then mail() function will be executed
        if($email !== "" && $subject !== "" && $message !== ""){
            $sendMail = mail("robin4500bd@gmail.com", $subject, $messageTemplate, $headers );
            if($sendMail === true){
                $formNoticeText = $formNotice[0][2];
                $formNoticeClass = $formNotice[0][1];

                // Auto reply to user form send message
                $autoReplySubject = "We received your message";
                $autoReplyMsgTemplate = "Hello ". $fName. " ". $lName. ","."<br>"."Thank you for your email. We just received your email. We reply your email soon". "<br><br>". "Thanks and Regards". "<br>". "Md Robin Rana";
                mail($email, $autoReplySubject, $autoReplyMsgTemplate, $headers);
            }else{
                $formNoticeText = $formNotice[1][2];
                $formNoticeClass = $formNotice[1][1];
            }
        }else{
            $formNoticeText = $formNotice[2][2];
            $formNoticeClass = $formNotice[2][1];
        }
        
    }  
    ?>
    <!-- END PHP -->
    <div class="container">
        <div class="row">
            <div class="col-md-6 bg-light rounded p-3 position-absolute top-50 start-50 translate-middle text-center">
                <h2 class="fw-bold">Send Message</h2>
                <p>Send an email with php mailer</p>
                <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                    <div class="mb-3 <?php 
                        if(isset($formNoticeClass)){
                            echo $formNoticeClass;
                        }
                    ?>">
                        <p class="d-block noticeText">
                            <?php 
                                if(isset($formNoticeText)){
                                    echo $formNoticeText;
                                }
                            ?>
                        </p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="w-50 me-2 mb-3">
                            <input name="fName" type="text" class="form-control p-3" id="exampleFormControlInput1" placeholder="First Name">
                        </div>
                        <div class="w-50 me-2 mb-3">
                            <input name="lName" type="text" class="form-control p-3" id="exampleFormControlInput1" placeholder="Last Name">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <input name="email" type="email" class="form-control p-3" id="exampleFormControlInput1" placeholder="Your Email">
                    </div>
                    <div class="mb-3">
                        <input name="subject" type="text" class="form-control p-3" id="exampleFormControlInput1" placeholder="Subject">
                    </div>
                    <div class="mb-3">
                        <textarea name="message" placeholder="Write Message" class="form-control" id="exampleFormControlTextarea1" rows="7"></textarea>
                    </div>
                    <div class="mb-3">
                        <input name="submit" id="submit-btn" value="Send" type="submit" class="w-100 p-3 rounded">
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</body>
</html>