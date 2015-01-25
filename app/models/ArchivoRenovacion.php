<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 25/01/15
 * Time: 12:20 AM
 */




class ArchivoRenovacion extends Eloquent {
    
    protected $fillable = [];
    protected $table = 'archivos_renovacion';
    protected $primaryKey = 'ARRE_ID_ARCHIVOS_RENOVACION';
    public $timestamps = false;

}