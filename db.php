<?php 
require 'libs/rb.php';
R::setup( 'mysql:host=localhost;dbname=id8990699_saits','id8990699_saitsdb', '#wecandoit4pupil' ); 

if ( !R::testconnection() )
{
		exit ('Nav savienojuma ar datu bāzi');
}

session_start();
