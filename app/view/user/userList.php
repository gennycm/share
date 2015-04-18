<?php

class UserList{
	private $view;
	private $usersList = array();

	public function __construct($action){
		$this->view = new View($action);
	}

	public function showUsersList($usersList){
		$usersTable = "<table border='1' solid width='100%' style='text-align: center;'>".
							"<thead>
								<th>Username</th><th>E-mail</th><th>Name</th><th>Options</th>
							</thead>";

		foreach($usersList as $userArray){
			$usersTable = $usersTable. "<tr>";
			foreach ($userArray as $key => $value) {
				if ($key != "id_user" && $key!="password") {
					$usersTable = $usersTable."<td>".$value."</td>";
				}
			}
			$usersTable = $usersTable. "<td><a href='../UserController/modify?id_user=" . $userArray["id_user"] . "'>Edit</a> | <a href='../UserController/deleteUser?id_user=" . $userArray["id_user"] . "'>Delete</a></td>".
	            "</tr>";
	    }

	    $usersTable = $usersTable."</table>";
		$totalOutput = $this->view->getHTMLstuff().$this->view->getHeader(). $usersTable . $this->view->getFooter().$this->view->getHTMLclosure();

		return $totalOutput;
	}


}

?>