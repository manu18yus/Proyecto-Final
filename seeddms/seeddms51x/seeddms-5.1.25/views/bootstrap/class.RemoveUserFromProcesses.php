<?php
/**
 * Implementation of RemoveUserFromProcesses view
 *
 * @category   DMS
 * @package    SeedDMS
 * @license    GPL 2
 * @version    @version@
 * @author     Uwe Steinmann <uwe@steinmann.cx>
 * @copyright  Copyright (C) 2017 Uwe Steinmann
 * @version    Release: @package_version@
 */

/**
 * Include parent class
 */
//require_once("class.Bootstrap.php");

/**
 * Include class to preview documents
 */
require_once("SeedDMS/Preview.php");

/**
 * Class which outputs the html page for RemoveUserFromProcesses view
 *
 * @category   DMS
 * @package    SeedDMS
 * @author     Uwe Steinmann <uwe@steinmann.cx>
 * @copyright  Copyright (C) 2017 Uwe Steinmann
 * @version    Release: @package_version@
 */
class SeedDMS_View_RemoveUserFromProcesses extends SeedDMS_Theme_Style {

	public function js() { /* {{{ */
		header('Content-Type: application/javascript; charset=UTF-8');
		parent::jsTranslations(array('cancel', 'splash_move_document', 'confirm_move_document', 'move_document', 'confirm_transfer_link_document', 'transfer_content', 'link_document', 'splash_move_folder', 'confirm_move_folder', 'move_folder'));
		$this->printDeleteDocumentButtonJs();
		/* Add js for catching click on document in one page mode */
		$this->printClickDocumentJs();
?>
$(document).ready( function() {
  $('body').on('click', 'label.checkbox, td span', function(ev){
    ev.preventDefault();
    $('#kkkk.ajax').data('action', $(this).data('action'));
    $('#kkkk.ajax').trigger('update', {userid: $(this).data('userid'), task: $(this).data('task')});
  });
});
<?php
	} /* }}} */

	function printList() { /* {{{ */
		$dms = $this->params['dms'];
		$user = $this->params['user'];
    $settings = $this->params['settings'];
    $cachedir = $this->params['cachedir'];
    $rootfolder = $this->params['rootfolder'];
    $previewwidth = $this->params['previewWidthList'];
    $previewconverters = $this->params['previewconverters'];
    $timeout = $this->params['timeout'];
		$rmuser = $this->params['rmuser'];
		$task = $this->params['task'];

		if(!$task)
			return;

    $previewer = new SeedDMS_Preview_Previewer($cachedir, $previewwidth, $timeout);
    $previewer->setConverters($previewconverters);

		$docs = array();
		switch($task) {
		case "reviews_not_touched":
			$reviewStatus = $rmuser->getReviewStatus();
			foreach($reviewStatus['indstatus'] as $ri) {
				$document = $dms->getDocument($ri['documentID']);
				$ri['latest'] = $document->getLatestContent()->getVersion();
				if($ri['latest'] == $ri['version']) {
					if($ri['status'] == 0) {
						$document->verifyLastestContentExpriry();
						$lc = $document->getLatestContent();
						if($document->getAccessMode($user) >= M_READ && $lc) {
							$docs[] = $document;
						}
					}
				}
			}
			break;
		case "reviews_accepted":
			$reviewStatus = $rmuser->getReviewStatus();
			foreach($reviewStatus['indstatus'] as $ri) {
				$document = $dms->getDocument($ri['documentID']);
				$ri['latest'] = $document->getLatestContent()->getVersion();
				if($ri['latest'] == $ri['version']) {
					if($ri['status'] == 1) {
						$document->verifyLastestContentExpriry();
						$lc = $document->getLatestContent();
						if($document->getAccessMode($user) >= M_READ && $lc) {
							$docs[] = $document;
						}
					}
				}
			}
			break;
		case "reviews_rejected":
			$reviewStatus = $rmuser->getReviewStatus();
			foreach($reviewStatus['indstatus'] as $ri) {
				$document = $dms->getDocument($ri['documentID']);
				$ri['latest'] = $document->getLatestContent()->getVersion();
				if($ri['latest'] == $ri['version']) {
					if($ri['status'] == -1) {
						$docs[] = $document;
					}
				}
			}
			break;
		case "approvals_not_touched":
			$approvalStatus = $rmuser->getApprovalStatus();
			foreach($approvalStatus['indstatus'] as $ai) {
				$document = $dms->getDocument($ai['documentID']);
				$ai['latest'] = $document->getLatestContent()->getVersion();
				if($ai['latest'] == $ai['version']) {
					if($ai['status'] == 0) {
						$docs[] = $document;
					}
				}
			}
			break;
		case "approvals_accepted":
			$approvalStatus = $rmuser->getApprovalStatus();
			foreach($approvalStatus['indstatus'] as $ai) {
				$document = $dms->getDocument($ai['documentID']);
				$ai['latest'] = $document->getLatestContent()->getVersion();
				if($ai['latest'] == $ai['version']) {
					if($ai['status'] == 1) {
						$docs[] = $document;
					}
				}
			}
			break;
		case "approvals_rejected":
			$approvalStatus = $rmuser->getApprovalStatus();
			foreach($approvalStatus['indstatus'] as $ai) {
				$document = $dms->getDocument($ai['documentID']);
				$ai['latest'] = $document->getLatestContent()->getVersion();
				if($ai['latest'] == $ai['version']) {
					if($ai['status'] == -1) {
						$docs[] = $document;
					}
				}
			}
			break;
		}
		if($docs) {
			print "<table class=\"table table-condensed table-sm\">";
			print "<thead>\n<tr>\n";
			print "<th></th>\n";
			print "<th>".getMLText("name")."</th>\n";
			print "<th>".getMLText("status")."</th>\n";
			print "<th>".getMLText("action")."</th>\n";
			print "</tr>\n</thead>\n<tbody>\n";
			foreach($docs as $document) {
				$document->verifyLastestContentExpriry();
				$lc = $document->getLatestContent();
				if($document->getAccessMode($user) >= M_READ && $lc) {
					$txt = $this->callHook('documentListItem', $document, $previewer, false);
					if(is_string($txt))
						echo $txt;
					else {
						$extracontent = array();
						$extracontent['below_title'] = $this->getListRowPath($document);
						echo $this->documentListRowStart($document);
						echo $this->documentListRow($document, $previewer, true, 0, $extracontent);
						echo $this->documentListRowEnd($document);
					}
				}
			}
			echo "</tbody>\n</table>";
		}
	} /* }}} */

	function show() { /* {{{ */
		$dms = $this->params['dms'];
		$user = $this->params['user'];
		$rmuser = $this->params['rmuser'];

		$this->htmlStartPage(getMLText("admin_tools"));
		$this->globalNavigation();
		$this->contentStart();
		$this->pageNavigation(getMLText("admin_tools"), "admin_tools");
		$this->contentHeading(getMLText("rm_user_from_processes"));

		$this->warningMsg(getMLText("confirm_rm_user_from_processes", array ("username" => htmlspecialchars($rmuser->getFullName()))));
		$this->rowStart();
		$this->columnStart(4);

		$reviewStatus = $rmuser->getReviewStatus();
		$tmpr = array();
		$cr = array("-2"=>0, '-1'=>0, '0'=>0, '1'=>0);
		foreach($reviewStatus['indstatus'] as $ri) {
			$doc = $dms->getDocument($ri['documentID']);
			$ri['latest'] = $doc->getLatestContent()->getVersion();
			if($ri['latest'] == $ri['version'])
				$cr[$ri['status']]++;
			if(isset($tmpr[$ri['status']]))
				$tmpr[$ri['status']][] = $ri;
			else
				$tmpr[$ri['status']] = array($ri);
		}

		$approvalStatus = $rmuser->getApprovalStatus();
		$tmpa = array();
		$ca = array("-2"=>0, '-1'=>0, '0'=>0, '1'=>0);
		foreach($approvalStatus['indstatus'] as $ai) {
			$doc = $dms->getDocument($ai['documentID']);
			$ai['latest'] = $doc->getLatestContent()->getVersion();
			if($ai['latest'] == $ai['version'])
				$ca[$ai['status']]++;
			if(isset($tmpa[$ai['status']]))
				$tmpa[$ai['status']][] = $ai;
			else
				$tmpa[$ai['status']] = array($ai);
		}

		$out = array();
		if(isset($tmpr["0"])) {
			$out[] = array(
				'0',
				'review',
				'not_touched',
				getMLText('reviews_not_touched', array('no_reviews' => count($tmpr["0"]))),
				getMLText('reviews_not_touched_latest', array('no_reviews' => $cr["0"]))
			);	
		}
		if(isset($tmpr["1"])) {
			$out[] = array(
				'1',
				'review',
				'accepted',
				getMLText('reviews_accepted', array('no_reviews' => count($tmpr["1"]))),
				getMLText('reviews_accepted_latest', array('no_reviews' => $cr["1"]))
			);	
		}
		if(isset($tmpr["-1"])) {
			$out[] = array(
				'-1',
				'review',
				'rejected',
				getMLText('reviews_rejected', array('no_reviews' => count($tmpr["-1"]))),
				getMLText('reviews_rejected_latest', array('no_reviews' => $cr["-1"]))
			);	
		}
		if(isset($tmpa["0"])) {
			$out[] = array(
				'0',
				'approval',
				'not_touched',
				getMLText('approvals_not_touched', array('no_approvals' => count($tmpa["0"]))),
				getMLText('approvals_not_touched_latest', array('no_approvals' => $ca["0"]))
			);
		}
		if(isset($tmpa["1"])) {
			$out[] = array(
				'1',
				'approval',
				'accepted',
				getMLText('approvals_accepted', array('no_approvals' => count($tmpa["1"]))),
				getMLText('approvals_accepted_latest', array('no_approvals' => $ca["1"]))
			);
		}
		if(isset($tmpa["-1"])) {
			$out[] = array(
				'-1',
				'approval',
				'rejected',
				getMLText('approvals_rejected', array('no_approvals' => count($tmpa["-1"]))),
				getMLText('approvals_rejected_latest', array('no_approvals' => $ca["-1"]))
			);
		}

?>

<form class="form-horizontal" action="../op/op.UsrMgr.php" name="form1" method="post">
<input type="hidden" name="userid" value="<?php print $rmuser->getID();?>">
<input type="hidden" name="action" value="removefromprocesses">
<?php echo createHiddenFieldWithKey('removefromprocesses'); ?>

<?php
		echo "<table class=\"table table-condensed table-sm\">";
		foreach($out as $o) {
			echo "<tr><td>".$o[3]."</td><td>".$o[4]."</td><td><input style=\"margin-top: 0px;\" type=\"checkbox\" name=\"status[".$o[1]."][]\" value=\"".$o[0]."\"></td><td><span data-action=\"printList\" data-userid=\"".$rmuser->getId()."\" data-task=\"".$o[1]."s_".$o[2]."\"><i class=\"fa fa-list\"></i></span></td></tr>";
		}
		echo "</table>";

		/*
		$options = array();
		$allUsers = $dms->getAllUsers($sortusersinlist);
		foreach ($allUsers as $currUser) {
			if (!$currUser->isGuest())
				$options[] = array($currUser->getID(), htmlspecialchars($currUser->getLogin()), ($currUser->getID()==$user->getID()), array(array('data-subtitle', htmlspecialchars($currUser->getFullName()))));
		}
		$this->formField(
			getMLText("user"),
			array(
				'element'=>'select',
				'id'=>'newuser',
				'name'=>'newuserid',
				'class'=>'chzn-select',
				'options'=>$options
			)
		);
		 */
		$this->formSubmit("<i class=\"fa fa-remove\"></i> ".getMLText('rm_user_from_processes'));
?>

</form>
<?php
		$this->columnEnd();
		$this->columnStart(8);
		echo '<div id="kkkk" class="ajax" data-view="RemoveUserFromProcesses" data-action="printList" data-query="userid='.$rmuser->getId().'"></div>';
		$this->columnEnd();
		$this->rowEnd();
		$this->contentEnd();
		$this->htmlEndPage();
	} /* }}} */
}
?>
