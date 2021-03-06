<?php
/**
 * Implementation of UsrView view
 *
 * @category   DMS
 * @package    SeedDMS
 * @license    GPL 2
 * @version    @version@
 * @author     Uwe Steinmann <uwe@steinmann.cx>
 * @copyright  Copyright (C) 2002-2005 Markus Westphal,
 *             2006-2008 Malcolm Cowe, 2010 Matteo Lucarelli,
 *             2010-2012 Uwe Steinmann
 * @version    Release: @package_version@
 */

/**
 * Include parent class
 */
//require_once("class.Bootstrap.php");

/**
 * Class which outputs the html page for UsrView view
 *
 * @category   DMS
 * @package    SeedDMS
 * @author     Markus Westphal, Malcolm Cowe, Uwe Steinmann <uwe@steinmann.cx>
 * @copyright  Copyright (C) 2002-2005 Markus Westphal,
 *             2006-2008 Malcolm Cowe, 2010 Matteo Lucarelli,
 *             2010-2012 Uwe Steinmann
 * @version    Release: @package_version@
 */
class SeedDMS_View_UsrView extends SeedDMS_Theme_Style {

	function show() { /* {{{ */
		$dms = $this->params['dms'];
		$user = $this->params['user'];
		$users = $this->params['allusers'];
		$enableuserimage = $this->params['enableuserimage'];
		$httproot = $this->params['httproot'];

		$this->htmlStartPage(getMLText("my_account"));
		$this->globalNavigation();
		$this->contentStart();
		$this->pageNavigation(getMLText("my_account"), "my_account");

		$this->contentHeading(getMLText("users"));

		echo "<table class=\"table table-condensed table-sm\">\n";
		echo "<thead>\n<tr>\n";
		if($enableuserimage) echo "<th></th>\n";
		echo "<th>".getMLText("name")."</th>\n";
		echo "</tr>\n</thead>\n";

		foreach ($users as $currUser) {

			if ($currUser->isGuest())
				continue;

			if ($currUser->isHidden()) continue;

			echo "<tr>";
			if($enableuserimage) {
				echo "<td>";
				if ($currUser->hasImage())
					print "<img width=\"100\" src=\"".$httproot . "out/out.UserImage.php?userid=".$currUser->getId()."\">";
				echo "</td>";
			}
			echo "<td>";
			echo htmlspecialchars($currUser->getFullName())." (".htmlspecialchars($currUser->getLogin()).")<br />";
			echo "<a href=\"mailto:".htmlspecialchars($currUser->getEmail())."\">".htmlspecialchars($currUser->getEmail())."</a><br />";
			echo "<small>".htmlspecialchars($currUser->getComment())."</small>";
			echo "</td>";
			echo "</tr>";
		}

		echo "</table>\n";

		$this->contentEnd();
		$this->htmlEndPage();
	} /* }}} */
}
?>
