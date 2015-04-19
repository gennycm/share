<?php
class UserProfile{
    private $view;

    public function __construct($action){
        $this->view = new View($action);
    }

    function showProfile(){
        $profileData = 
//        "<form id='' method='POST' action='../UserController/editProfile'>
//                <label>Nombre:</label> <input type='text' name='name' value=''><br>
//                <label>Usuario:</label> <input type='text' name='username' value=''><br>
//                <label>E-mail:</label> <input type='text' name='email' value=''><br>
//                <input type='hidden' name='operation' value='ai'>
//                <input type='submit' value='Editar'>
//        </form>";
        
        "<div id='contact' class='section-content'>
            <div class='row'>
                    <div class='col-md-12'>
                            <div class='section-title'>
                                    <h2>Contact Us</h2>
                            </div> 
                    </div> 
            </div>
            <div class='row'>
                    <div class='col-md-12'>
                            <div class='map-holder'>
                                    <div class='google-map-canvas' id='map-canvas'>
            </div>
                            </div> <!-- /.map-holder -->
                    </div> <!-- /.col-md-12 -->
            </div> <!-- /.row -->
            <div class='row contact-form'>
                    <div class='col-md-4'>
                            <label for='name-id' class='required'>Name:</label>
                            <input name='name-id' type='text' id='name-id' maxlength='40'>
                    </div> <!-- /.col-md-4 -->
                    <div class='col-md-4'>
                            <label for='email-id' class='required'>Email:</label>
                            <input name='email-id' type='text' id='email-id' maxlength='40'>
                    </div> <!-- /.col-md-4 -->
                    <div class='col-md-4'>
                            <label for='subject-id'>Subject:</label>
                            <input name='subject-id' type='text' id='subject-id' maxlength='60'>
                    </div> <!-- /.col-md-4 -->
                    <div class='col-md-12'>
                            <label for='message-id' class='required'>Message:</label>
                            <textarea name='message-id' id='message-id' rows='6'></textarea>
                    </div> <!-- /.col-md-12 -->
                    <div class='col-md-12'>
                            <div class='submit-btn'>
                                    <a href='#' class='largeButton contactBgColor'>Send Message</a>
                            </div> <!-- /.submit-btn -->
                    </div> <!-- /.col-md-12 -->
            </div>
	</div>";

    //return $this->view->getHTMLstuff().$this->view->getHeader(). $profileData. $this->view->getFooter().$this->view->getHTMLclosure();
    
    return $this->view->getHTMLstuff().$this->view->getHeader(). $this->view->getSideBar("Perfil"). $this->view->getContainerStart().$profileData.$this->view->getContainerEnd().$this->view->getFooter().$this->view->getHTMLclosure();
    }
    
    function editProfile(){
        $editProfileForm = "";

    return $this->view->getHTMLstuff().$this->view->getHeader(). $editProfileForm. $this->view->getFooter().$this->view->getHTMLclosure();
    }
}
?>
