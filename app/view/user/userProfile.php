<?php
class UserProfile{
    private $view;

    public function __construct($action){
        $this->view = new View($action);
    }

    function showProfile(){
    $profileData = 
        "<div id='services' class='section-content'>
            <div class='row'>
                <div class='col-md-12'>
                    <div class='section-title'>
                            <h2>Perfil</h2>
                    </div> 
                </div> 
            </div>
            <div class='row contact-form'>
                <form id='form_register' action='../UserController/editarPerfil' method='POST'>
                    <div class='col-md-12'>
                        <input type='hidden' value='". $_SESSION["id_user"] ."' name='id_user' id='id_user'/>
                        <label>Nombre: ".$_SESSION["name"]."</label>
                    </div> 
                    <div class='col-md-12'>
                        <label>Email: ".$_SESSION["email"]."</label>
                    </div>
                    <div class='col-md-12'>
                        <label>Nombre de usuario: ".$_SESSION["username"]."</label>
                    </div>
                    <div class='col-md-4'>
                        <div class='submit-btn'>
                            <input type='submit' class='largeButton servicesBgColor' value='Editar'/>
                        </div> 
                    </div> 
                </form>
            </div>
	</div>";

    return $this->view->getHTMLstuff().$this->view->getHeader(). $this->view->getSideBar("Perfil"). $this->view->getContainerStart().$profileData.$this->view->getContainerEnd().$this->view->getFooter().$this->view->getHTMLclosure();
    }
    
    function editUserProfile(){
     $profileData = 
        "<div id='services' class='section-content'>
            <div class='row'>
                    <div class='col-md-12'>
                            <div class='section-title'>
                                    <h2>Perfil</h2>
                            </div> 
                    </div> 
            </div>
            <div class='row contact-form'>
                    <div class='col-md-12'>
                    <form id='form_register' action='../UserController/saveProfile' method='POST'>
                    <input type='hidden' value='".$_SESSION["id_user"]."' name='id_user' id='id_user'/>
                            <label>Nombre:</label>
                            <input name='name' type='text' id='name' maxlength='50' value='".$_SESSION["name"]."'>
                    </div> 
                    <div class='col-md-12'>
                            <label>Email:</label>
                            <input name='email' type='text' id='email' maxlength='50' value='".$_SESSION["email"]."'>
                    </div> 
                    <div class='col-md-12'>
                            <label>Nombre de usuario:</label>
                            <input name='username' type='text' id='username' maxlength='13' value='".$_SESSION["username"]."'>
                    </div> 
                    
                    <div class='col-md-4'>
                            <label for='password'>Contraseña nueva:</label>
                            <input name='password' type='password' id='password' maxlength='50' value='".$_SESSION["password"]."'>
                    </div> 
                    
                    <div class='col-md-4'>
                            <div class='submit-btn'>
                                    <!--<a href='#' class='largeButton contactBgColor'>Send Message</a>-->
                                    <input type='submit' class='largeButton servicesBgColor' value='Guardar'>
                            </div> 
                    </form>
                    </div> 
            </div>
	</div>";

    return $this->view->getHTMLstuff().$this->view->getHeader(). $this->view->getSideBar("Perfil"). $this->view->getContainerStart().$profileData.$this->view->getContainerEnd().$this->view->getFooter().$this->view->getHTMLclosure();
    }
}
?>
