<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 20/11/14
 * Time: 12:50 AM
 */



class SolicitudRenovacion extends Eloquent {
    
    protected $fillable = [];
    protected $table = 'solicitud_renovacion';
    protected $primaryKey = 'SORE_ID_SOLICITUD_RENOVACION';
    public $timestamps = false;

}