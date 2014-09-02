<?php


class Solicitud extends Eloquent{

	protected $table = 'solicitud';


	protected $softDelete = true;

	protected $guarded = array();  // Important
}