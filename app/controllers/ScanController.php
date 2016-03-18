<?php

class ScanController extends ControllerBase {

	/**
	 * Affiche les informations relatives à l'id du disque passé en paramétre
	 * @param int $idDisque id du disque à afficher
	 */
	public function indexAction($idDisque) {
		//TODO 4.3
		$disk = Disque::findFirst(explode('-', $idDisque)[1]);

		$diskName = $disk->getNom();


		$this->jquery->execOn("click", "#ckSelectAll", "$('.toDelete').prop('checked', $(this).prop('checked'));$('#btDelete').toggle($('.toDelete:checked').length>0)");
		$this->jquery->execOn("click","#btUpload","$('#tabsMenu a:last').tab('show');");
		$this->jquery->doJQueryOn("click","#btDelete", "#panelConfirmDelete", "show");
		$this->jquery->postOn("click", "#btConfirmDelete", "scan/delete","$('.toDelete:checked').serialize()","#ajaxResponse");
		$this->jquery->doJQueryOn("click", "#btFrmCreateFolder", "#panelCreateFolder", "toggle");
		$this->jquery->postFormOn("click", "#btCreateFolder", "Scan/createFolder", "frmCreateFolder","#ajaxResponse");
		$this->jquery->exec("window.location.hash='';scan('".$diskName."')",true);

		$this->jquery->compile($this->view);
	}

	/**
	 * Etablit le listing au format JSON du contenu d'un disque
	 * @param string $dir Disque dont le contenu est à lister
	 */
	public function filesAction($dir="Datas"){
		$this->view->disable();
		$cloud=$this->config->cloud;
		$root=$cloud->root.$cloud->prefix.$this->session->get("activeUser")->getLogin()."/";
		$response = DirectoryUtils::scan($root.$dir,$root);
		header('Content-type: application/json');
		echo json_encode(array(
				"name" => $dir,
				"type" => "folder",
				"path" => $dir,
				"items" => $response,
				"root" => $root
		));
	}




	/**
	 * Action d'upload d'un fichier
	 */
	public function uploadAction(){
		$this->view->disable();
		header('Content-Type: application/json');
		$allowed = array('png', 'jpg', 'gif','zip');
		if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){
			$extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);
			if(!in_array(strtolower($extension), $allowed)){
				echo '{"status":"error"}';
				exit;
			}
			if(move_uploaded_file($_FILES['upl']['tmp_name'], $_POST["activeFolder"].'/'.$_FILES['upl']['name'])){
				echo '{"status":"success"}';
				exit;
			}
		}
		echo '{"status":"error"}';
	}

	/**
	 * Action de suppresion d'un fichier
	 */
	public function deleteAction(){
		$message=array();
		if(array_key_exists("toDelete", $_POST)){
			foreach ($_POST["toDelete"] as $f){
				if(DirectoryUtils::deleteFile($f)===false){
					$message[]="Impossible de supprimer `{$f}`";
				}
			}
			if(sizeof($message)==0){
				$this->jquery->exec("scan()",true);
			}else{
				echo $this->showMessage(implode("<br>", $message), "warning");
			}
			$this->jquery->doJquery("#panelConfirmDelete", "hide");
			echo $this->jquery->compile();
		}
	}

	public function createFolderAction(){
		if(array_key_exists("folderName", $_POST)){
			$pathname=$_POST["activeFolder"].DIRECTORY_SEPARATOR.$_POST["folderName"];
			if(DirectoryUtils::mkdir($pathname)===false){
				echo $this->showMessage("Impossible de créer le dossier `".$pathname."`", "warning");
			}else{
				$this->jquery->exec("scan()",true);
			}
			$this->jquery->doJquery("#panelCreateFolder", "hide");
			echo $this->jquery->compile();
		}
	}

	/**
	 * Action permettant de mettre à jour l'historique du jour de tous les diques
	 */
	public function updateAllDaySizeAction(){
		$cloud=$this->config->cloud;
		DirectoryUtils::updateAllDaySize($cloud);
	}

	/**
	 * Affiche un message dans une alert Bootstrap
	 * @param String $message
	 * @param String $type Class css du message (info, warning...)
	 * @param number $timerInterval Temps d'affichage en ms
	 * @param string $dismissable Alert refermable
	 * @param string $visible
	 */
	public function showMessage($message,$type,$timerInterval=5000,$dismissable=true,$visible=true){
		$message=new DisplayedMessage($message,$type,$timerInterval,$dismissable,$visible);
		return $message->compile($this->jquery);
	}
}