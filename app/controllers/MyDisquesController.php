<?php

use \Ajax\bootstrap\html\base\CssRef;

class MyDisquesController extends \ControllerBase {
	/**
	 * Affiches les disques de l'utilisateur
	 */
	public function indexAction() {
        $user = Auth::getUser($this);

        if ($user) {
            $addDisk = $this->jquery->bootstrap()->htmlGlyphButton('qcath-btnAdd', 86, 'Ajouter un disque', CssRef::CSS_PRIMARY);
            $lg      = $this->jquery->bootstrap()->htmlListGroup('qcath-lg');
            $disks   = Disque::find(array(
                'conditions' => 'idUtilisateur = ' . $user->getId()
            ));

            $lg->fromDatabaseObjects($disks, function($disk) {

                $result = '';

                $tarif      = ModelUtils::getDisqueTarif($disk);
                $occupation = round($disk->Historiques[0]->getOccupation() / ModelUtils::sizeConverter($tarif->getUnite()), 2);
                $total      = $tarif->getQuota();
                $perCent    = $occupation / $total * 100;
                $element    = new \Ajax\bootstrap\html\base\HtmlDoubleElement("p-1");

                $element->setContent($disk->getNom());
                $element->addLabel($occupation . ' / ' . $total . ' ' . $tarif->getUnite());

                $progress   = $this->jquery->bootstrap()->htmlProgressbar('qcath-pb-' . $disk->getId(), 'success', $perCent);
                $progress->setStriped(true)->setActive(true);
                $progress->setStyleLimits(array( 'progress-bar-info' => 10, 'progress-bar-success' => 50, 'progress-bar-warning' => 80, 'progress-bar-danger' => 100 ));

                $openBtn     = $this->jquery->bootstrap()->htmlGlyphButton($disk->getId(), 120, 'Ouvrir');
                $openBtn->setStyle('primary btn-block');
                $openBtn->getOnClick('scan/index', '#content');

                $result .= $element;
                $result .= $progress;
                $result .= $openBtn;

                return $result;

            });

            $this->view->setVars(compact('lg', 'user', 'addDisk', 'disks'));
        } else {
            $alert = $this->jquery->bootstrap()->htmlAlert('alert-1', 'Vous devez être connecté pour afficher vos disques', 'alert-danger');
            $this->view->setVar('alert', $alert);
        }

        $this->jquery->compile($this->view);
	}
}