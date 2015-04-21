<?php
class UserFriends{
	private $view;
	private $action;

	public function __construct($action){
		$this->view = new View($action);
		$this->action = $action;
	}

    public function getFriendsContent($usersList, $pFriends){
        $userFriends = $this->getUsersFriends($usersList);
        $posibleFriends = $this->getPosibleFriends($pFriends);

        return  $this->view->getHTMLstuff().$this->view->getHeader().$this->view->getSideBar($this->action).$this->view->getContainerStart().$userFriends.$posibleFriends.$this->view->getContainerEnd().$this->view->getHTMLclosure();;

    }

	public function getUsersFriends($usersList){
        if (empty($usersList)) {
            $usersTable = "";
        }else{
            $usersTable = "<table class='friendsTb'>".
                                "<thead>
                                    <th>Nombre de usuario</th><th>Nombre</th><th></th>
                                </thead>";

            foreach($usersList as $userArray){
                $usersTable = $usersTable. "<tr>";
                foreach ($userArray as $key => $value) {
                    if ($key == "name" || $key == "username") {
                        $usersTable = $usersTable."<td>".$value."</td>";
                    }
                }
                $usersTable = $usersTable. "<td><a href='../UserController/deleteUser?id_user=" . $userArray["id_user"] . "'><i class='fa fa-user-times 2x' style ='color:#EE4035'></i></a></td>".
                    "</tr>";
            }

            $usersTable = $usersTable."</table>";
        }

		$userFriends = "<div id='contact' class='section-content'>
            <div class='row'>
                <div class='col-md-12'>
                    <div class='section-title'>
                        <h2>
                            Mis amigos
                        </h2>
                        ".$usersTable."
                    </div>
                </div>
            </div>
        </div>";

            return $userFriends;
	}

	public function getPosibleFriends($usersList){
        if (empty($usersList)) {
            $usersTable = "";
        }else{
            $usersTable = "<table class='friendsTb'>".
                                "<thead>
                                    <th>Nombre de usuario</th><th>Nombre</th><th></th>
                                </thead>";

            foreach($usersList as $userArray){
                $usersTable = $usersTable. "<tr>";
                foreach ($userArray as $key => $value) {
                    if ($key == "name" || $key == "username") {
                        $usersTable = $usersTable."<td>".$value."</td>";
                    }
                }
                $usersTable = $usersTable. "<td><a href='../UserController/deleteUser?id_user=" . $userArray["id_user"] . "'><i class='fa fa-user-plus 2x' style ='color:#169f60'></i></a></td>".
                    "</tr>";
            }

            $usersTable = $usersTable."</table>";
        }

		$userPosibleFriends = "<div id='contact' class='section-content'>
            <div class='row'>
                <div class='row contact-form'>
                    <div class='col-md-12'>
                            <div class='section-title'>
                                <h2>
                                    Buscar amigos
                                </h2>
                            </div>
                        <div class='col-md-8'>
                                    <form id='form_register' method='POST' action='../UserController/buscarAmigos'>
                                    <input type='text' name='search_string'>
                        </div>
                        <div class='col-md-4'>
                                    <input type='submit' class = 'largeButton contactBgColor' value='Buscar'>
                                </form>
                        </div>
                            ".$usersTable."
                    </div>
                </div>
            </div>
        </div>";

            return $userPosibleFriends;
	}


}
?>