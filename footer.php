<?php    session_start(); ?>
<div class="newsletter" id="main_section">
                                <h4 class="footer-title">Subscribe To Our Newsletter</h4>
                                <label>Stay updated with our latest newsletter release.</label>
                                <form action="http://www.front-end.development-env.com/tekprotek/Newsletter.php" method="POST">
                                    <input type="email" name="email" placeholder="Email Address">
                                    <?php $_SESSION['previous'] = 'http://'. $_SERVER[HTTP_HOST]. $_SERVER[REQUEST_URI]; ?>
                                    <input type="hidden" name="location" value="<?php echo $_SESSION['previous'] ?>">
                                    <button class="banner-btn">Subscribe</button>
                                </form>
                             
                                <?php
                                
                                    if(isset($_GET['success']))
                                    {
                                       echo '<div class="success_message text-danger">';
                                       echo $_GET['success'];
                                        echo '</div>';
                                    }
                                   
                                 ?>
                            </div>