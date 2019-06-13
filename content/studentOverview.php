<?php
include '../persistance/DbConnector.php';
include '../persistance/DbSummaryReader.php';
include_once '../settings.php';

$Dbreader = new DbSummaryReader(new DbConnector());
$result = $Dbreader->readSummaryFromStudentId(1);

var_dump($result);